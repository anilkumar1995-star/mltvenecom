<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Exception;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $tags = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin-layouts.blog.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin-layouts.blog.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'status' => 'required|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            $tag = new Tag($request->all());
            $tag->author_type = 'Admin';
            if (auth()->check()) {
                $tag->author_id = auth()->id();
            }
            $tag->save();

            // Handle Slug
            $slugKey = $request->input('slug') ?: Str::slug($tag->name);
            DB::table('slugs')->updateOrInsert(
                ['reference_id' => $tag->id, 'reference_type' => 'Botble\Blog\Models\Tag'],
                [
                    'key' => $slugKey,
                    'prefix' => 'tag',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Handle SEO Meta
            if ($request->has('seo_title') || $request->has('seo_description') || $request->hasFile('seo_image')) {
                $seoMeta = [
                    'seo_title' => $request->input('seo_title'),
                    'seo_description' => $request->input('seo_description'),
                    'seo_index' => $request->input('seo_index', 1),
                ];

                if ($request->hasFile('seo_image')) {
                    $seoMeta['seo_image'] = $request->file('seo_image')->store('blog/seo', 'public');
                }

                DB::table('meta_boxes')->updateOrInsert(
                    ['reference_id' => $tag->id, 'reference_type' => 'Botble\Blog\Models\Tag', 'meta_key' => 'seo_meta'],
                    ['meta_value' => json_encode($seoMeta), 'updated_at' => now()]
                );
            }

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.blog.tags.index')->with('success', 'Tag created successfully.');
            }

            return redirect()->route('admin.blog.tags.edit', $tag->id)->with('success', 'Tag created successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        
        $tag->slug = DB::table('slugs')
            ->where('reference_id', $tag->id)
            ->where('reference_type', 'Botble\Blog\Models\Tag')
            ->value('key');

        $seoMeta = DB::table('meta_boxes')
            ->where('reference_id', $tag->id)
            ->where('reference_type', 'Botble\Blog\Models\Tag')
            ->where('meta_key', 'seo_meta')
            ->value('meta_value');
        
        if ($seoMeta) {
            $seoMeta = json_decode($seoMeta, true);
            $tag->seo_title = $seoMeta['seo_title'] ?? '';
            $tag->seo_description = $seoMeta['seo_description'] ?? '';
            $tag->seo_image = $seoMeta['seo_image'] ?? null;
            $tag->seo_index = $seoMeta['seo_index'] ?? 1;
        }

        return view('admin-layouts.blog.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'status' => 'required|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            $tag = Tag::findOrFail($id);
            $tag->fill($request->all());
            $tag->save();

            // Handle Slug
            $slugKey = $request->input('slug') ?: Str::slug($tag->name);
            DB::table('slugs')->updateOrInsert(
                ['reference_id' => $tag->id, 'reference_type' => 'Botble\Blog\Models\Tag'],
                [
                    'key' => $slugKey,
                    'prefix' => 'tag',
                    'updated_at' => now(),
                ]
            );

            // Handle SEO Meta
            if ($request->has('seo_title') || $request->has('seo_description') || $request->hasFile('seo_image')) {
                $existingMetaValue = DB::table('meta_boxes')
                    ->where('reference_id', $tag->id)
                    ->where('reference_type', 'Botble\Blog\Models\Tag')
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
                    if (!empty($seoMeta['seo_image']) && Storage::disk('public')->exists($seoMeta['seo_image'])) {
                        Storage::disk('public')->delete($seoMeta['seo_image']);
                    }
                    $seoMeta['seo_image'] = $request->file('seo_image')->store('blog/seo', 'public');
                }

                DB::table('meta_boxes')->updateOrInsert(
                    ['reference_id' => $tag->id, 'reference_type' => 'Botble\Blog\Models\Tag', 'meta_key' => 'seo_meta'],
                    ['meta_value' => json_encode($seoMeta), 'updated_at' => now()]
                );
            }

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.blog.tags.index')->with('success', 'Tag updated successfully.');
            }

            return redirect()->route('admin.blog.tags.edit', $tag->id)->with('success', 'Tag updated successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $tag = Tag::findOrFail($id);
            
            // Delete associated slugs and meta
            DB::table('slugs')->where('reference_id', $tag->id)->where('reference_type', 'Botble\Blog\Models\Tag')->delete();
            DB::table('meta_boxes')->where('reference_id', $tag->id)->where('reference_type', 'Botble\Blog\Models\Tag')->delete();
            
            // Delete associations with posts
            $tag->posts()->detach();
            
            $tag->delete();

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Tag deleted successfully.']);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (empty($ids)) {
            return response()->json(['status' => false, 'message' => 'No tags selected.'], 400);
        }

        try {
            DB::beginTransaction();

            foreach ($ids as $id) {
                $tag = Tag::find($id);
                if ($tag) {
                    DB::table('slugs')->where('reference_id', $tag->id)->where('reference_type', 'Botble\Blog\Models\Tag')->delete();
                    DB::table('meta_boxes')->where('reference_id', $tag->id)->where('reference_type', 'Botble\Blog\Models\Tag')->delete();
                    $tag->posts()->detach();
                    $tag->delete();
                }
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Tags deleted successfully.']);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
