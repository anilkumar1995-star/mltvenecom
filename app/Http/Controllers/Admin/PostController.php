<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['categories', 'author']);
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin-layouts.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('status', 'published')->orderBy('order', 'asc')->get();
        $tags = Tag::where('status', 'published')->orderBy('name', 'asc')->get();
        $authors = User::where('role', 'admin')->orderBy('name', 'asc')->get();
        
        return view('admin-layouts.blog.posts.create', compact('categories', 'tags', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string|max:400',
            'status' => 'required|in:published,draft,pending',
            'categories' => 'nullable|array',
            'author_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = new Post($request->all());
        $post->is_featured = $request->has('is_featured') ? 1 : 0;
        
        // Handle author
        $post->author_type = 'Admin';
        if ($request->filled('author_id')) {
            $post->author_id = $request->author_id;
        } elseif (auth()->check()) {
            $post->author_id = auth()->id();
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog/posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        // Handle Slug
        $slugKey = $request->input('slug') ?: Str::slug($post->name);
        DB::table('slugs')->updateOrInsert(
            ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post'],
            [
                'key' => $slugKey,
                'prefix' => 'blog',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Handle SEO Meta
        if ($request->has('seo_title') || $request->has('seo_description') || $request->hasFile('seo_image') || $request->has('seo_index')) {
            $seoMeta = [
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_index' => $request->input('seo_index', 1),
            ];

            if ($request->hasFile('seo_image')) {
                $seoMeta['seo_image'] = $request->file('seo_image')->store('blog/seo', 'public');
            }

            DB::table('meta_boxes')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post', 'meta_key' => 'seo_meta'],
                ['meta_value' => json_encode($seoMeta), 'updated_at' => now()]
            );
        }

        // Handle FAQ Schema
        if ($request->has('faq_schema_config')) {
            $faqConfig = array_values($request->input('faq_schema_config', []));
            DB::table('meta_boxes')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post', 'meta_key' => 'faq_schema_config'],
                ['meta_value' => json_encode($faqConfig), 'updated_at' => now()]
            );
        }

        // Sync Categories
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        // Handle Tags
        if ($request->filled('post_tags')) {
            $tagNames = explode(',', $request->post_tags);
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName);
                if (empty($tagName)) continue;
                
                $tag = Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['author_id' => $post->author_id, 'author_type' => 'Admin', 'status' => 'published']
                );
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }

        if ($request->has('save_and_exit')) {
             return redirect()->route('admin.blog.posts.index')->with('success', 'Post created successfully.');
        }

        return redirect()->route('admin.blog.posts.edit', $post->id)->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::where('status', 'published')->orderBy('order', 'asc')->get();
        $tags = Tag::where('status', 'published')->orderBy('name', 'asc')->get();
        $authors = User::where('role', 'admin')->orderBy('name', 'asc')->get();
        
        $post->slug = DB::table('slugs')
            ->where('reference_id', $post->id)
            ->where('reference_type', 'Botble\Blog\Models\Post')
            ->value('key');

        $seoMeta = DB::table('meta_boxes')
            ->where('reference_id', $post->id)
            ->where('reference_type', 'Botble\Blog\Models\Post')
            ->where('meta_key', 'seo_meta')
            ->value('meta_value');
        
        if ($seoMeta) {
            $seoMeta = json_decode($seoMeta, true);
            $post->seo_title = $seoMeta['seo_title'] ?? '';
            $post->seo_description = $seoMeta['seo_description'] ?? '';
            $post->seo_image = $seoMeta['seo_image'] ?? null;
            $post->seo_index = $seoMeta['seo_index'] ?? 1;
        }

        $faqSchema = DB::table('meta_boxes')
            ->where('reference_id', $post->id)
            ->where('reference_type', 'Botble\Blog\Models\Post')
            ->where('meta_key', 'faq_schema_config')
            ->value('meta_value');
        
        if ($faqSchema) {
            $post->faq_schema_config = json_decode($faqSchema, true);
        }

        return view('admin-layouts.blog.posts.edit', compact('post', 'categories', 'tags', 'authors'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string|max:400',
            'status' => 'required|in:published,draft,pending',
            'author_id' => 'nullable|exists:users,id',
            'categories' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post->fill($request->all());
        $post->is_featured = $request->has('is_featured') ? 1 : 0;
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('blog/posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        // Handle Slug
        $slugKey = $request->input('slug') ?: Str::slug($post->name);
        DB::table('slugs')->updateOrInsert(
            ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post'],
            [
                'key' => $slugKey,
                'prefix' => 'blog',
                'updated_at' => now(),
            ]
        );

        // Handle SEO Meta
        if ($request->has('seo_title') || $request->has('seo_description') || $request->hasFile('seo_image') || $request->has('seo_index')) {
            // Fetch existing meta to preserve SEO image if not updated
            $existingMetaValue = DB::table('meta_boxes')
                ->where('reference_id', $post->id)
                ->where('reference_type', 'Botble\Blog\Models\Post')
                ->where('meta_key', 'seo_meta')
                ->value('meta_value');
            
            $existingMeta = $existingMetaValue ? json_decode($existingMetaValue, true) : [];

            $seoMeta = [
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_index' => $request->input('seo_index', 1),
                'seo_image' => $existingMeta['seo_image'] ?? null,
            ];

            if ($request->hasFile('seo_image')) {
                // Delete old SEO image if exists
                if (!empty($seoMeta['seo_image']) && Storage::disk('public')->exists($seoMeta['seo_image'])) {
                    Storage::disk('public')->delete($seoMeta['seo_image']);
                }
                $seoMeta['seo_image'] = $request->file('seo_image')->store('blog/seo', 'public');
            }

            DB::table('meta_boxes')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post', 'meta_key' => 'seo_meta'],
                ['meta_value' => json_encode($seoMeta), 'updated_at' => now()]
            );
        }

        // Handle FAQ Schema
        if ($request->has('faq_schema_config')) {
            $faqConfig = array_values($request->input('faq_schema_config', []));
            DB::table('meta_boxes')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post', 'meta_key' => 'faq_schema_config'],
                ['meta_value' => json_encode($faqConfig), 'updated_at' => now()]
            );
        }

        // Sync Categories
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->detach();
        }

        // Handle Tags
        if ($request->filled('post_tags')) {
            $tagNames = explode(',', $request->post_tags);
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName);
                if (empty($tagName)) continue;
                
                $tag = Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['author_id' => $post->author_id, 'author_type' => 'Admin', 'status' => 'published']
                );
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        } else {
            $post->tags()->detach();
        }

        if ($request->has('save_and_exit')) {
             return redirect()->route('admin.blog.posts.index')->with('success', 'Post updated successfully.');
        }

        return redirect()->route('admin.blog.posts.edit', $post->id)->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['success' => true, 'message' => 'Post deleted successfully.']);
    }
}
