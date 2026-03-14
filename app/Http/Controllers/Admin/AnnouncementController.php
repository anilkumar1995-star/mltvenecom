<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $announcements = Announcement::orderBy('id', 'desc')->paginate(10);
        
        if ($request->ajax()) {
            return view('admin-layouts.announcements.table', compact('announcements'))->render();
        }

        return view('admin-layouts.announcements.index', compact('announcements'));
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
        ]);

        try {
            DB::beginTransaction();

            Announcement::create([
                'name' => $request->name,
                'content' => $request->content,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->has('is_active') ? 1 : 0,
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

    public function destroy(Request $request, $id = null)
    {
        try {
            DB::beginTransaction();
            $itemId = $request->id ?? $id;
            $announcement = Announcement::findOrFail($itemId);
            $announcement->delete();
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Announcement deleted successfully.'
                ]);
            }
            return back()->with('success', 'Announcement deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!$request->ids || !is_array($request->ids)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No items selected.'
                ], 400);
            }

            Announcement::whereIn('id', $request->ids)->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected announcements deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }
}
