<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = \App\Models\Page::orderBy('created_at', 'desc')->paginate(10);
        return view('admin-layouts.pages.index', compact('pages'));
    }

    public function show($id)
    {
        $page = \App\Models\Page::findOrFail($id);
        return view('pages.show', compact('page'));
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
        ]);

        \App\Models\Page::create($request->all());

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
        ]);

        $page = \App\Models\Page::findOrFail($id);
        $page->update($request->all());

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = \App\Models\Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
