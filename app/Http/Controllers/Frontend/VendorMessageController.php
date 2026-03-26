<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\TableHelpers;

class VendorMessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        $query = Message::where('store_id', $store->id)
            ->with(['customer', 'store']);

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'name', 'email', 'content'], // searchable
            ['id', 'name', 'email', 'content', 'created_at'] // filterable
        );

        $messages = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'name' => 'Sender',
            'email' => 'Email',
            'content' => 'Message Content',
            'created_at' => 'Date'
        ];

        return view('frontend.vendor.messages.index', compact('messages', 'filterColumns'));
    }

    public function show(Message $message)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($message->store_id != $store->id) {
            abort(403);
        }

        return view('frontend.vendor.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($message->store_id != $store->id) {
            abort(403);
        }

        $message->delete();

        return redirect()->route('frontend.vendor.messages.index')->with('success', 'Message deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        Message::whereIn('id', $ids)->where('store_id', $store->id)->delete();

        return response()->json(['status' => true, 'message' => 'Messages deleted successfully.']);
    }
}
