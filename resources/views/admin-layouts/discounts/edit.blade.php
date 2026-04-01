@extends('admin-layouts.app')
@section('title', 'Edit Discount')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Discount
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <main class="page-body page-content">
        <form action="{{ route('admin.discounts.update', $discount->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="mb-3">
                                    <label class="form-label">Select type of discount</label>
                                    <select class="form-select" name="type" id="discount-type-select" onchange="toggleType(this.value)">
                                        <option value="coupon" {{ $discount->type == 'coupon' ? 'selected' : '' }}>Coupon code</option>
                                        <option value="promotion" {{ $discount->type == 'promotion' ? 'selected' : '' }}>Promotion</option>
                                    </select>
                                </div>

                                <div class="mb-3 {{ $discount->type == 'promotion' ? 'd-none' : '' }}" id="code-section">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label mb-0">Create coupon code</label>
                                        <a href="javascript:void(0)" onclick="generateCode()" class="text-primary text-decoration-none small">Generate coupon code</a>
                                    </div>
                                    <input type="text" class="form-control" name="code" id="coupon-code" placeholder="Enter coupon code" value="{{ $discount->code }}">
                                    <small class="form-hint">Customers will enter this coupon code when they checkout.</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="2" placeholder="Enter description">{{ $discount->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" name="can_use_with_promotion" {{ $discount->can_use_with_promotion ? 'checked' : '' }}>
                                        <span class="form-check-label">Can be used with promotion?</span>
                                    </label>

                                    <label class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" name="can_use_with_flash_sale" {{ $discount->can_use_with_flash_sale ? 'checked' : '' }}>
                                        <span class="form-check-label">Can be used with flash sale?</span>
                                    </label>
                                    <small class="form-hint d-block ms-4 mb-2">Allows customers to apply the coupon to items already on flash sale, enabling combined discounts.</small>

                                    <label class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="is-unlimited" onchange="toggleUnlimited()" {{ is_null($discount->quantity) ? 'checked' : '' }}>
                                        <span class="form-check-label">Unlimited coupon?</span>
                                    </label>

                                    <label class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" name="apply_via_url" {{ $discount->apply_via_url ? 'checked' : '' }}>
                                        <span class="form-check-label">Apply via URL?</span>
                                    </label>
                                    <small class="form-hint d-block ms-4 mb-2">This setting will apply coupon code when customers access the URL with the parameter "?coupon=code".</small>

                                    <label class="form-check mb-1">
                                        <input type="checkbox" class="form-check-input" name="display_at_checkout" {{ $discount->display_at_checkout ? 'checked' : '' }}>
                                        <span class="form-check-label">Display coupon code at the checkout page?</span>
                                    </label>
                                    <small class="form-hint d-block ms-4">The list of coupon codes will be displayed at the checkout page and customers can choose to apply.</small>
                                </div>

                                <div class="mb-3 {{ is_null($discount->quantity) ? 'd-none' : '' }}" id="quantity-section">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity-input" placeholder="Enter number" value="{{ $discount->quantity }}">
                                </div>

                                <div class="hr-text">Discount Details</div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Discount type</label>
                                        <select class="form-select" name="type_option" id="discount-type-option">
                                            <option value="amount" {{ $discount->type_option == 'amount' ? 'selected' : '' }}>Fixed amount</option>
                                            <option value="percentage" {{ $discount->type_option == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Discount</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="value" required min="0" step="0.01" value="{{ $discount->value }}" placeholder="0">
                                            <span class="input-group-text bg-white" id="discount-symbol">{{ $discount->type_option == 'amount' ? '₹' : '%' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Apply to</label>
                                        <select class="form-select" name="target" required onchange="toggleTargetOptions(this.value)">
                                            <option value="all-orders" {{ $discount->target == 'all-orders' ? 'selected' : '' }}>All orders</option>
                                            <option value="amount-minimum-order" {{ $discount->target == 'amount-minimum-order' ? 'selected' : '' }}>Order amount from</option>
                                            <option value="specific-product" {{ $discount->target == 'specific-product' ? 'selected' : '' }}>Specific product</option>
                                            <option value="group-products" {{ $discount->target == 'group-products' ? 'selected' : '' }}>Product collection</option>
                                            <option value="specific-customer" {{ $discount->target == 'specific-customer' ? 'selected' : '' }}>Customer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 {{ $discount->target == 'amount-minimum-order' ? '' : 'd-none' }}" id="min-order-section">
                                    <label class="form-label">Minimum Order Amount</label>
                                    <input type="number" class="form-control" name="min_order_price" placeholder="Enter amount" value="{{ $discount->min_order_price }}">
                                </div>

                                <div class="mb-3 {{ $discount->target == 'specific-product' ? '' : 'd-none' }}" id="product-selection-section">
                                    <label class="form-label">Select Products</label>
                                    <select class="form-select" name="products[]" multiple size="5">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $discount->products->contains($product->id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-hint">Hold Ctrl to select multiple products.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Time</h3>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Start date</label>
                                <div class="row g-2 mb-3">
                                    <div class="col-8">
                                        <div class="input-icon">
                                            <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg></span>
                                            <input type="date" class="form-control" name="start_date" required value="{{ $discount->start_date->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                         <div class="input-icon">
                                            <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg></span>
                                            <input type="time" class="form-control" name="start_time" value="{{ $discount->start_date->format('H:i') }}">
                                        </div>
                                    </div>
                                </div>

                                <div id="end-date-section" class="{{ is_null($discount->end_date) ? 'd-none' : '' }}">
                                    <label class="form-label">End date</label>
                                    <div class="row g-2 mb-3">
                                        <div class="col-8">
                                            <div class="input-icon">
                                                <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg></span>
                                                <input type="date" class="form-control" name="end_date" id="end-date-input" value="{{ $discount->end_date ? $discount->end_date->format('Y-m-d') : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-icon">
                                                <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg></span>
                                                <input type="time" class="form-control" name="end_time" value="{{ $discount->end_date ? $discount->end_date->format('H:i') : '23:59' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" id="never-expired" onchange="toggleNeverExpired()" {{ is_null($discount->end_date) ? 'checked' : '' }}>
                                        <span class="form-check-label">Never expired?</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                     <button type="submit" class="btn btn-primary w-100" name="submit" value="save">Save</button>
                                     <button type="submit" class="btn btn-outline-secondary w-100" name="submit" value="save_exit">Save & Exit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>


<script>
    function generateCode() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        const length = 10;
        let result = '';
        for (let i = 0; i < length; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('coupon-code').value = result;
    }

    function toggleTargetOptions(target) {
        document.getElementById('min-order-section').classList.add('d-none');
        document.getElementById('product-selection-section').classList.add('d-none');

        if (target === 'amount-minimum-order') {
            document.getElementById('min-order-section').classList.remove('d-none');
        } else if (target === 'specific-product') {
            document.getElementById('product-selection-section').classList.remove('d-none');
        }
    }

    function toggleType(type) {
        if (type === 'coupon') {
            document.getElementById('code-section').classList.remove('d-none');
        } else {
            document.getElementById('code-section').classList.add('d-none');
        }
    }

    function toggleUnlimited() {
        var isUnlimited = document.getElementById('is-unlimited').checked;
        if (isUnlimited) {
            document.getElementById('quantity-section').classList.add('d-none');
        } else {
            document.getElementById('quantity-section').classList.remove('d-none');
        }
    }

    function toggleNeverExpired() {
        var neverExpired = document.getElementById('never-expired').checked;
        var endDateSection = document.getElementById('end-date-section');
        if (neverExpired) {
            endDateSection.classList.add('d-none');
        } else {
            endDateSection.classList.remove('d-none');
        }
    }

    document.getElementById('discount-type-option').addEventListener('change', function() {
        document.getElementById('discount-symbol').innerText = this.value === 'amount' ? '₹' : '%';
    });
</script>
@endsection
