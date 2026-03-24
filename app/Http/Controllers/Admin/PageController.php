<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::query();

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'name', 'status', 'template', 'description'], // searchable
            ['id', 'name', 'status', 'template'] // filterable
        );

        $pages = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'template' => 'Template'
        ];

        return view('admin-layouts.pages.index', compact('pages', 'filterColumns'));
    }

    public function show($id)
    {
        // Admin detail view: strictly use admin-layouts and ensure it stays in admin
        $page = Page::findOrFail($id);
        return view('admin-layouts.pages.show', compact('page'));
    }

    public function create()
    {
        return view('admin-layouts.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'submitter']);
        if ($request->hasFile('image')) {
            $upload = \App\Helpers\ImageHelper::imageUploadHelper('page_', $request->file('image'));
            if ($upload['status']) {
                $data['image'] = $upload['data']['target_file'];
            }
        }

        $page = Page::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Page created successfully.',
                'redirect' => $request->input('submitter') === 'apply'
                ? route('admin.pages.edit', $page->id)
                : route('admin.pages.index')
            ]);
        }

        if ($request->input('submitter') === 'apply') {
            return redirect()->route('admin.pages.edit', $page->id)->with('success', 'Page created and editing continues.');
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin-layouts.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $page = Page::findOrFail($id);
        $data = $request->except(['_token', '_method', 'submitter']);

        if ($request->hasFile('image')) {
            $upload = \App\Helpers\ImageHelper::imageUploadHelper('page_', $request->file('image'));
            if ($upload['status']) {
                $data['image'] = $upload['data']['target_file'];
            }
        }

        $page->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Page updated successfully.',
                'redirect' => $request->input('submitter') === 'apply'
                ? null
                : route('admin.pages.index')
            ]);
        }

        if ($request->input('submitter') === 'apply') {
            return redirect()->route('admin.pages.edit', $page->id)->with('success', 'Page updated and editing continues.');
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Page::class, 'page');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Page::class, 'pages');
    }
}
