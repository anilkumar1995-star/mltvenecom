<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\TableHelpers;
use App\Helpers\ImageHelper;
use Exception;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'email', 'subject', 'content'],
        ['id', 'status', 'created_at']
        );

        $contacts = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.contact.index', compact('contacts', 'filterColumns'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->status === 'unread') {
            $contact->status = 'read';
            $contact->save();
        }

        $replies = DB::table('meta_boxes')
            ->where('reference_id', $contact->id)
            ->where('reference_type', Contact::class)
            ->where('meta_key', 'reply_content')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $data = json_decode($item->meta_value);
                $user = \App\Models\User::find($data->replied_by);
                $data->user_name = $user ? $user->name : 'Unknown';
                return $data;
            });

        return view('admin-layouts.contact.show', compact('contact', 'replies'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'status' => 'required|in:read,unread,replied',
        ]);

        $contact->status = $request->status;
        $contact->save();

        if ($request->ajax()) {
            return response()->json(['status' => true, 'message' => 'Contact updated successfully.']);
        }

        if ($request->input('submitter') === 'save') {
            return redirect()->route('admin.contacts.list')->with('success', 'Contact updated successfully.');
        }

        return redirect()->back()->with('success', 'Contact updated successfully.');
    }

    public function reply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'message' => 'required|string',
        ]);

        // Mark as replied
        $contact->status = 'replied';
        $contact->save();

        // Store reply in meta_boxes for history
        DB::table('meta_boxes')->insert([
            'reference_id' => $contact->id,
            'reference_type' => Contact::class,
            'meta_key' => 'reply_content',
            'meta_value' => json_encode([
                'message' => $request->message,
                'replied_at' => now()->toDateTimeString(),
                'replied_by' => auth()->id()
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => true, 'message' => 'Reply sent successfully.']);
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Contact::class , 'Contact');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Contact::class , 'Contacts');
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
            if (empty($tagName))
                continue;

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
