<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\TableHelpers;

class VendorWithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
        
        $query = Withdrawal::where('customer_id', $user->id);

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'amount', 'payment_channel'], // searchable
            ['id', 'status', 'payment_channel', 'created_at'] // filterable
        );

        $withdrawals = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'amount' => 'Amount',
            'status' => 'Status',
            'payment_channel' => 'Payment Channel',
            'created_at' => 'Date'
        ];

        return view('frontend.vendor.withdrawals.index', compact('withdrawals', 'filterColumns'));
    }

    public function create()
    {
        return view('frontend.vendor.withdrawals.create');
    }

    public function store(Request $request)
    {
        $user = Auth::guard('customer')->user();
        
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank_info' => 'required',
            'description' => 'nullable|string'
        ]);

        Withdrawal::create([
            'customer_id' => $user->id,
            'amount' => $request->amount,
            'bank_info' => ['details' => $request->bank_info],
            'description' => $request->description,
            'status' => 'pending',
            'payment_channel' => 'bank_transfer',
            'currency' => 'INR'
        ]);

        return redirect()->route('frontend.vendor.withdrawals.index')->with('success', 'Withdrawal request submitted successfully.');
    }
}
