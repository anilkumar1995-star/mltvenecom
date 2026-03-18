<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\TableHelpers;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'content'], // Searchable
            ['id', 'name', 'is_active', 'created_at'] // Filterable
        );

        $announcements = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'         => 'ID',
            'name'       => 'Name',
            'is_active'  => 'Is Active',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.announcements.index', compact('announcements', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'action_label' => 'nullable|string|max:255',
            'action_url' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            Announcement::create([
                'name' => $request->name,
                'content' => $request->content,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'has_action' => $request->has('has_action') ? 1 : 0,
                'action_label' => $request->action_label,
                'action_url' => $request->action_url,
                'action_open_new_tab' => $request->has('action_open_new_tab') ? 1 : 0,
            ]);

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.announcements.index')->with('success', 'Announcement created successfully.');
            }

            return redirect()->back()->with('success', 'Announcement created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin-layouts.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'action_label' => 'nullable|string|max:255',
            'action_url' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $announcement = Announcement::findOrFail($id);
            $announcement->update([
                'name' => $request->name,
                'content' => $request->content,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'has_action' => $request->has('has_action') ? 1 : 0,
                'action_label' => $request->action_label,
                'action_url' => $request->action_url,
                'action_open_new_tab' => $request->has('action_open_new_tab') ? 1 : 0,
            ]);

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully.');
            }

            return redirect()->back()->with('success', 'Announcement updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Announcement::class, 'announcement');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Announcement::class, 'announcements');
    }
}
