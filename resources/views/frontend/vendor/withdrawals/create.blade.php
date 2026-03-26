@extends('vendor-layouts.app')
@section('title', 'Request Withdrawal')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.withdrawals.index') }}">Withdrawals</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Request Withdrawal</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('frontend.vendor.withdrawals.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Withdrawal Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Amount to Withdraw</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" step="0.01" class="form-control" name="amount" placeholder="0.00" value="{{ old('amount') }}" required>
                                    </div>
                                    <small class="form-hint">Enter the amount you wish to withdraw from your store balance.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">Bank Account / Payment Information</label>
                                    <textarea class="form-control" name="bank_info" rows="5" placeholder="Enter your bank name, account number, IFSC code, and branch details..." required>{{ old('bank_info') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Note (Optional)</label>
                                    <textarea class="form-control" name="description" rows="2" placeholder="Any additional notes for the administrator...">{{ old('description') }}</textarea>
                                </div>

                                <div class="alert alert-info">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                                        </div>
                                        <div>
                                            Withdrawal requests are typically processed within 3-5 business days after approval by the administrator.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ route('frontend.vendor.withdrawals.index') }}" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
