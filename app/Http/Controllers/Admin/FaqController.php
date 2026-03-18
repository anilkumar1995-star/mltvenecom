<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppFaq;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\TableHelpers;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = AppFaq::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'question', 'answer'],
            ['id', 'status', 'created_at']
        );

        $faqs = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'question' => 'Question',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product.faqs.index', compact('faqs', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.product.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            AppFaq::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'order' => $request->order ?? 0,
                'status' => $request->status,
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'FAQ created successfully.'
                ]);
            }

            return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $faq = AppFaq::findOrFail($id);
        return view('admin-layouts.product.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $faq = AppFaq::findOrFail($id);
            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'order' => $request->order ?? 0,
                'status' => $request->status,
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'FAQ updated successfully.'
                ]);
            }

            return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, AppFaq::class, 'FAQ');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, AppFaq::class, 'FAQs');
    }

    public function getAjaxFaqs(Request $request)
    {
        $keyword = $request->input('q');
        $excludeIds = $request->input('exclude_ids', []);

        if (!$keyword) {
            return response()->json([]);
        }

        $faqs = AppFaq::where('question', 'LIKE', '%' . $keyword . '%')
            ->whereNotIn('id', $excludeIds)
            ->select('id', 'question', 'answer')
            ->limit(20)
            ->get();

        return response()->json($faqs);
    }
}
