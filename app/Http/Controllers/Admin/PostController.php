<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\TableHelpers;
use App\Helpers\ImageHelper;
use Exception;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['categories', 'author']);

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'description'], // searchable
            ['id', 'status', 'created_at']   // filterable
        );

        $posts = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.blog.posts.index', compact('posts', 'filterColumns'));
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

        try {
            DB::beginTransaction();

            $post = new Post($request->all());
            $post->is_featured = $request->has('is_featured') ? 1 : 0;
            $post->author_type = 'Admin';

            if ($request->filled('author_id')) {
                $post->author_id = $request->author_id;
            } elseif (auth()->check()) {
                $post->author_id = auth()->id();
            }

            if ($request->hasFile('image')) {
                $upload = ImageHelper::imageUploadHelper('post_', $request->file('image'));
                if ($upload['status']) {
                    $post->image = $upload['data']['target_file'];
                }
            }

            $post->save();

            // Handle Slug
            $slugKey = $request->input('slug') ?: Str::slug($post->name);
            DB::table('slugs')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post'],
                ['key' => $slugKey, 'prefix' => 'blog', 'created_at' => now(), 'updated_at' => now()]
            );

            // Handle SEO & FAQ (Meta Boxes)
            $this->saveMetaBoxes($post, $request);

            // Sync Categories
            if ($request->has('categories')) {
                $post->categories()->sync($request->categories);
            }

            // Sync Tags
            $this->syncTags($post, $request->post_tags);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Post created successfully.',
                    'redirect_url' => route('admin.blog.posts.index')
                ]);
            }

            return redirect()->route($request->has('save_and_exit') ? 'admin.blog.posts.index' : 'admin.blog.posts.edit', $post->id)
                             ->with('success', 'Post created successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage())->withInput();
        }
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

        $this->loadMetaBoxes($post);

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

        try {
            DB::beginTransaction();

            $post->fill($request->all());
            $post->is_featured = $request->has('is_featured') ? 1 : 0;

            if ($request->hasFile('image')) {
                $upload = ImageHelper::imageUploadHelper('post_', $request->file('image'));
                if ($upload['status']) {
                    $post->image = $upload['data']['target_file'];
                }
            }

            $post->save();

            // Handle Slug
            $slugKey = $request->input('slug') ?: Str::slug($post->name);
            DB::table('slugs')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post'],
                ['key' => $slugKey, 'prefix' => 'blog', 'updated_at' => now()]
            );

            // Meta Boxes
            $this->saveMetaBoxes($post, $request);

            // Sync Categories
            $post->categories()->sync($request->categories ?? []);

            // Sync Tags
            $this->syncTags($post, $request->post_tags);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Post updated successfully.',
                    'redirect_url' => route('admin.blog.posts.index')
                ]);
            }

            return redirect()->route($request->has('save_and_exit') ? 'admin.blog.posts.index' : 'admin.blog.posts.edit', $post->id)
                             ->with('success', 'Post updated successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Post::class, 'Post');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Post::class, 'Posts');
    }

    protected function syncTags($post, $tagString)
    {
        if (empty($tagString)) {
            $post->tags()->detach();
            return;
        }

        $tagNames = explode(',', $tagString);
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

    protected function saveMetaBoxes($post, $request)
    {
        // SEO
        if ($request->has(['seo_title', 'seo_description'])) {
            $existingMeta = DB::table('meta_boxes')
                ->where(['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post', 'meta_key' => 'seo_meta'])
                ->value('meta_value');
            $existingData = $existingMeta ? json_decode($existingMeta, true) : [];

            $seoMeta = [
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_index' => $request->input('seo_index', 1),
                'seo_image' => $existingData['seo_image'] ?? null,
            ];

            if ($request->hasFile('seo_image')) {
                $upload = ImageHelper::imageUploadHelper('seo_', $request->file('seo_image'));
                if ($upload['status']) {
                    $seoMeta['seo_image'] = $upload['data']['target_file'];
                }
            }

            DB::table('meta_boxes')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post', 'meta_key' => 'seo_meta'],
                ['meta_value' => json_encode($seoMeta), 'updated_at' => now()]
            );
        }

        // FAQ
        if ($request->has('faq_schema_config')) {
            DB::table('meta_boxes')->updateOrInsert(
                ['reference_id' => $post->id, 'reference_type' => 'Botble\Blog\Models\Post', 'meta_key' => 'faq_schema_config'],
                ['meta_value' => json_encode(array_values($request->input('faq_schema_config'))), 'updated_at' => now()]
            );
        }
    }

    protected function loadMetaBoxes($post)
    {
        $meta = DB::table('meta_boxes')
            ->where('reference_id', $post->id)
            ->where('reference_type', 'Botble\Blog\Models\Post')
            ->pluck('meta_value', 'meta_key');

        if (isset($meta['seo_meta'])) {
            $seo = json_decode($meta['seo_meta'], true);
            $post->seo_title = $seo['seo_title'] ?? '';
            $post->seo_description = $seo['seo_description'] ?? '';
            $post->seo_image = $seo['seo_image'] ?? null;
            $post->seo_index = $seo['seo_index'] ?? 1;
        }

        if (isset($meta['faq_schema_config'])) {
            $post->faq_schema_config = json_decode($meta['faq_schema_config'], true);
        }
    }
}
