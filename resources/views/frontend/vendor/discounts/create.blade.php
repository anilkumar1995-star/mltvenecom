@extends('vendor-layouts.app')
@section('title', 'Create Discount')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.discounts.index') }}">Discounts</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Discount</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('frontend.vendor.discounts.store') }}" method="POST">
                @csrf
                <div class="row row-cards">
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label required">Select type of discount</label>
                                            <select class="form-select" name="type" id="discount-type-select" onchange="toggleType(this.value)">
                                                <option value="coupon">Coupon code</option>
                                                <option value="promotion">Promotion</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3" id="coupon-code-group">
                                    <label class="form-label required">Coupon code</label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="text" class="form-control" name="code" id="coupon-code-input" placeholder="Coupon code" value="{{ old('code') }}">
                                            <small class="form-hint">Customers will enter this coupon code when they checkout.</small>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" onclick="generateCode()" class="btn btn-outline-primary">
                                                Generate coupon code
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 d-none" id="promotion-title-group">
                                    <label class="form-label required">Promotion Name</label>
                                    <input type="text" class="form-control" name="title" placeholder="Promotion Name" value="{{ old('title') }}">
                                </div>

                                <div class="hr-text hr-text-left">Options</div>

                                <div class="mb-3">
                                    <div class="form-label">Configuration</div>
                                    <div class="mb-2">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="can_use_with_promotion" value="1" {{ old('can_use_with_promotion') ? 'checked' : '' }}>
                                            <span class="form-check-label">Can be used with other promotions?</span>
                                        </label>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="unlimited_coupon" id="unlimited-coupon-check" value="1" {{ old('unlimited_coupon', 1) ? 'checked' : '' }} onchange="toggleUnlimited()">
                                            <span class="form-check-label">Unlimited usage?</span>
                                        </label>
                                    </div>

                                    <div class="mb-3 ms-4 {{ old('unlimited_coupon', 1) ? 'd-none' : '' }}" id="quantity-group">
                                        <label class="form-label required">Total usage limit</label>
                                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" placeholder="Enter limit">
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="display_at_checkout" value="1" {{ old('display_at_checkout') ? 'checked' : '' }}>
                                            <span class="form-check-label">Display at checkout page?</span>
                                        </label>
                                        <small class="form-hint">Allows customers to select this coupon directly during checkout.</small>
                                    </div>
                                </div>

                                <div class="hr-text hr-text-left">Discount Details</div>

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label required">Discount type</label>
                                            <select class="form-select" name="type_option" id="type_option" onchange="updateCurrencySymbol(this.value)">
                                                <option value="amount" {{ old('type_option') == 'amount' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                                                <option value="percentage" {{ old('type_option') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label required">Discount Value</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="currency-symbol">₹</span>
                                                <input type="number" step="0.01" class="form-control" name="value" placeholder="0" value="{{ old('value') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label required">Apply to</label>
                                            <select class="form-select" name="target">
                                                <option value="all-orders" {{ old('target') == 'all-orders' ? 'selected' : '' }}>All orders</option>
                                                <option value="amount-minimum-order" {{ old('target') == 'amount-minimum-order' ? 'selected' : '' }}>Minimum order amount</option>
                                                <option value="specific-product" {{ old('target') == 'specific-product' ? 'selected' : '' }}>Specific product</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Validity Period</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Start date</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}">
                                </div>
                                <div class="mb-3 {{ old('never_expired', 1) ? 'd-none' : '' }}" id="end-date-group">
                                    <label class="form-label">End date</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="never_expired" id="never-expired-check" value="1" {{ old('never_expired', 1) ? 'checked' : '' }} onchange="toggleNeverExpired()">
                                        <span class="form-check-label">Never expires</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><circle cx="12" cy="14" r="2"></circle><path d="M14 4l0 4l-6 0l0 -4"></path></svg>
                                    Save Discount
                                </button>
                                <a href="{{ route('frontend.vendor.discounts.index') }}" class="btn btn-link w-100">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
    function generateCode() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = '';
        for (let i = 0; i < 10; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        document.getElementById('coupon-code-input').value = result;
    }

    function toggleType(type) {
        if (type === 'coupon') {
            document.getElementById('coupon-code-group').classList.remove('d-none');
            document.getElementById('promotion-title-group').classList.add('d-none');
        } else {
            document.getElementById('coupon-code-group').classList.add('d-none');
            document.getElementById('promotion-title-group').classList.remove('d-none');
        }
    }

    function toggleUnlimited() {
        const isUnlimited = document.getElementById('unlimited-coupon-check').checked;
        const quantityGroup = document.getElementById('quantity-group');
        if (isUnlimited) {
            quantityGroup.classList.add('d-none');
        } else {
            quantityGroup.classList.remove('d-none');
        }
    }

    function toggleNeverExpired() {
        const isNeverExpired = document.getElementById('never-expired-check').checked;
        const endDateGroup = document.getElementById('end-date-group');
        if (isNeverExpired) {
            endDateGroup.classList.add('d-none');
        } else {
            endDateGroup.classList.remove('d-none');
        }
    }

    function updateCurrencySymbol(value) {
        const symbol = document.getElementById('currency-symbol');
        symbol.innerText = (value === 'percentage') ? '%' : '₹';
    }
    
    // Initial State Check
    document.addEventListener('DOMContentLoaded', function() {
        toggleType(document.getElementById('discount-type-select').value);
        toggleUnlimited();
        toggleNeverExpired();
        updateCurrencySymbol(document.getElementById('type_option').value);
    });
</script>
@endsection
