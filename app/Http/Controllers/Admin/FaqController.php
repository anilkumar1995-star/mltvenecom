<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppFaq;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = AppFaq::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('question', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['faqs'] = $query->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.faqs.index', $data);
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

            return response()->json([
                'status' => true,
                'message' => 'FAQ created successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $data['faq'] = AppFaq::findOrFail($id);
        return view('admin-layouts.product.faqs.edit', $data);
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

            return response()->json([
                'status' => true,
                'message' => 'FAQ updated successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $faq = AppFaq::findOrFail($request->id);
            $faq->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'FAQ deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            AppFaq::whereIn('id', $request->ids)->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected FAQs deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
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
