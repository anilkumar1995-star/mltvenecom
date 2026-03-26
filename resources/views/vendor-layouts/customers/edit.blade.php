@extends('admin-layouts.app')
@section('title', 'Edit Customer: ' . $customer->name)

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none text-uppercase">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Ecommerce</span>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.customers.index') }}">Customers</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Edit: {{ $customer->name }}</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content mt-0">
        <div class="container-xl">
            <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data" class="ajax-form">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    {{-- LEFT COLUMN: Main Info --}}
                    <div class="col-md-9">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title fw-bold"> <i class="fas fa-user-circle me-2 text-primary"></i> Customer Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $customer->name) }}" placeholder="Full Name" required>
                                            <label for="name">Full Name <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $customer->email) }}" placeholder="Email Address" required>
                                            <label for="email">Email Address <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}" placeholder="Phone Number">
                                            <label for="phone">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob', $customer->dob) }}" placeholder="Date of Birth">
                                            <label for="dob">Date of Birth</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                            <label for="password">New Password (Empty to keep current)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                            <label for="password_confirmation">Confirm Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="is_vendor" id="is_vendor" value="1" {{ old('is_vendor', $customer->is_vendor) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-medium" for="is_vendor">Register as Vendor</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Private Notes</label>
                                        <textarea class="form-control bg-light" name="private_notes" rows="4" placeholder="Notes are only visible to administrators...">{{ old('private_notes', $customer->private_notes ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Addresses Section --}}
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h3 class="card-title fw-bold"><i class="fas fa-map-marker-alt me-2 text-danger"></i> Saved Addresses</h3>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-address">
                                    <i class="fas fa-plus me-1"></i> Add New
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="address-list">
                                    @if($customer->addresses->count() > 0)
                                        <div class="row g-3">
                                            @foreach($customer->addresses as $address)
                                                <div class="col-md-6">
                                                    <div class="p-3 border rounded-3 position-relative shadow-xs bg-white h-100">
                                                        @if($address->is_default)
                                                            <span class="badge bg-primary-lt position-absolute top-0 end-0 mt-2 me-2">Default</span>
                                                        @endif
                                                        <h4 class="mb-1 text-dark">{{ $address->name }}</h4>
                                                        <div class="text-muted small">
                                                            <p class="mb-1"><i class="fas fa-home me-1 opacity-50"></i> {{ $address->address }}</p>
                                                            <p class="mb-1">{{ $address->city }}, {{ $address->state }}, {{ $address->country }} - {{ $address->zip_code }}</p>
                                                            <p class="mb-0"><i class="fas fa-phone me-1 opacity-50"></i> {{ $address->phone }}</p>
                                                        </div>
                                                        <div class="mt-3 text-end">
                                                            <button type="button" class="btn btn-icon btn-sm btn-outline-danger delete-btn border-0" data-url="{{ route('admin.customers.addresses.destroy', $address->id) }}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-4 bg-light rounded-3">
                                            <i class="fas fa-map-marked-alt fa-3x text-muted mb-3 opacity-20"></i>
                                            <p class="text-muted mb-0">No addresses saved for this customer.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Orders Section --}}
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title fw-bold"><i class="fas fa-shopping-bag me-2 text-info"></i> Recent Orders</h3>
                            </div>
                            <div class="card-table">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-hover card-table">
                                        <thead class="bg-light text-uppercase small">
                                            <tr>
                                                <th width="120">Order ID</th>
                                                <th>Date</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customer->orders->take(5) as $order)
                                                <tr>
                                                    <td class="fw-bold">ORD-{{ $order->id }}</td>
                                                    <td class="text-muted small">{{ $order->created_at->format('M d, Y') }}</td>
                                                    <td class="text-center fw-bold text-dark">₹{{ number_format($order->amount, 2) }}</td>
                                                    <td class="text-center">
                                                        @php
                                                            $statusClass = match(strtolower($order->status)) {
                                                                'completed' => 'bg-success',
                                                                'pending' => 'bg-warning',
                                                                'canceled' => 'bg-danger',
                                                                default => 'bg-secondary'
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $statusClass }} text-white px-2 rounded-pill shadow-xs">{{ ucfirst($order->status) }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-xs">View Details</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">No orders found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Payments Section --}}
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title fw-bold"><i class="fas fa-credit-card me-2 text-purple"></i> Latest Payments</h3>
                            </div>
                            <div class="card-table">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-hover card-table">
                                        <thead class="bg-light text-uppercase small">
                                            <tr>
                                                <th>Ref #</th>
                                                <th>Method</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-end">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customer->orders->take(5) as $order)
                                                <tr>
                                                    <td class="small text-muted">ORD-{{ $order->id }}</td>
                                                    <td>
                                                        <span class="text-dark fw-medium small">{{ strtoupper($order->payment_method ?: 'cod') }}</span>
                                                    </td>
                                                    <td class="text-center fw-bold">₹{{ number_format($order->amount, 2) }}</td>
                                                    <td class="text-center">
                                                        @php
                                                            $payStatus = strtolower($order->payment_status ?? 'pending');
                                                            $payClass = match($payStatus) {
                                                                'completed' => 'bg-success',
                                                                'pending' => 'bg-warning',
                                                                default => 'bg-danger'
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $payClass }} px-2 rounded-pill shadow-xs">{{ ucfirst($payStatus) }}</span>
                                                    </td>
                                                    <td class="text-end text-muted small">{{ $order->created_at->format('M d, H:i') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">No payments found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Reviews & Wishlist Side-by-Side --}}
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="card-header bg-white py-3">
                                        <h4 class="card-title fw-bold"><i class="fas fa-star me-2 text-warning"></i> Reviews</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group list-group-flush list-group-hoverable">
                                            @forelse($customer->reviews->take(4) as $review)
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar avatar-sm rounded" style="background-image: url({{ $review->product && $review->product->image ? asset('storage/' . $review->product->image) : asset('home/placeholder.png') }})"></div>
                                                        </div>
                                                        <div class="col text-truncate">
                                                            <div class="text-reset d-block fw-bold small text-decoration-none">{{ $review->product->name ?? 'Unknown Product' }}</div>
                                                            <div class="d-flex text-yellow mt-1">
                                                                @for($i=1; $i<=5; $i++) <i class="fas fa-star {{ $i <= $review->star ? 'fill-yellow' : 'opacity-20' }} small"></i> @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center py-5 text-muted small">No reviews submitted.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="card-header bg-white py-3">
                                        <h4 class="card-title fw-bold"><i class="fas fa-heart me-2 text-danger"></i> Wishlist</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group list-group-flush list-group-hoverable">
                                            @forelse($customer->wishlist->take(4) as $item)
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar avatar-sm rounded" style="background-image: url({{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : asset('home/placeholder.png') }})"></div>
                                                        </div>
                                                        <div class="col text-truncate">
                                                            <div class="text-reset d-block fw-bold small text-decoration-none">{{ $item->product->name ?? 'Unknown Product' }}</div>
                                                            <div class="text-muted small">Added {{ $item->created_at->diffForHumans() }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center py-5 text-muted small">Wishlist is empty.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT COLUMN: Sidebar --}}
                    <div class="col-md-3">
                        {{-- Publish Card --}}
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white py-3">
                                <h4 class="card-title fw-bold"><i class="fas fa-paper-plane me-2 text-primary"></i> Publish</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Account Status</label>
                                    <select class="form-select border-2 border-primary-lt" name="status" required>
                                        <option value="activated" {{ $customer->status == 'activated' ? 'selected' : '' }}>✓ Activated</option>
                                        <option value="locked" {{ $customer->status == 'locked' ? 'selected' : '' }}>✗ Locked / Suspended</option>
                                    </select>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary py-2 fw-bold shadow-sm" type="submit">
                                        <i class="fas fa-save me-2"></i> Update Profile
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Avatar Card --}}
                        <div class="card shadow-sm border-0 mb-4 text-center">
                            <div class="card-header bg-white py-3 justify-content-center">
                                <h4 class="card-title fw-bold">Customer Avatar</h4>
                            </div>
                            <div class="card-body">
                                <div class="avatar-upload position-relative mb-3 d-inline-block">
                                    <div class="avatar-edit position-absolute top-0 end-0 mt-n2 me-n2 z-index-10">
                                        <button type="button" class="btn btn-icon btn-sm btn-white rounded-circle shadow-sm border" onclick="document.getElementById('avatar').click()">
                                            <i class="fas fa-pencil-alt text-primary"></i>
                                        </button>
                                    </div>
                                    <div class="avatar-preview">
                                        @php
                                            $avatarUrl = $customer->avatar ? asset('storage/' . $customer->avatar) : asset('home/placeholder.png');
                                        @endphp
                                        <img id="avatar-preview" src="{{ $avatarUrl }}" alt="Avatar" class="rounded-circle shadow-md border border-4 border-white" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*" onchange="previewAvatar(this)">
                                </div>
                                <p class="text-muted small px-3">Allowed: JPG, PNG. Recommended size: 500x500px.</p>
                            </div>
                        </div>

                        {{-- Stats Sidebar Card --}}
                        <div class="card shadow-sm border-0 bg-primary-lt text-primary mb-4 overflow-hidden">
                            <div class="card-body p-4 position-relative">
                                <div class="opacity-10 position-absolute end-0 bottom-0 mb-n4 me-n4">
                                    <i class="fas fa-user-check fa-6x"></i>
                                </div>
                                <h5 class="fw-bold mb-3">Customer Activity</h5>
                                <div class="mb-2 d-flex justify-content-between">
                                    <span>Orders:</span>
                                    <span class="fw-bold">{{ $customer->orders->count() }}</span>
                                </div>
                                <div class="mb-2 d-flex justify-content-between">
                                    <span>Reviews:</span>
                                    <span class="fw-bold">{{ $customer->reviews->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Member since:</span>
                                    <span class="fw-bold">{{ $customer->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

{{-- Add Address Modal (Standardized) --}}
<div class="modal modal-blur fade" id="modal-address" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark"><i class="fas fa-plus-circle me-2 text-primary"></i> Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.customers.addresses.store', $customer->id) }}" method="POST" class="ajax-form">
                @csrf
                <div class="modal-body py-4">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="name" id="addr_name" placeholder="Name" required>
                                <label for="addr_name">Recipient Full Name</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="phone" id="addr_phone" placeholder="Phone" required>
                                <label for="addr_phone">Contact Phone</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-1">
                                <input type="email" class="form-control" name="email" id="addr_email" placeholder="Email" required>
                                <label for="addr_email">Contact Email</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="country" id="addr_country" placeholder="Country" value="India" required>
                                <label for="addr_country">Country</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="address" id="addr_line" placeholder="Address" required>
                                <label for="addr_line">Street Address / House No.</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="city" id="addr_city" placeholder="City" required>
                                <label for="addr_city">City</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="state" id="addr_state" placeholder="State" required>
                                <label for="addr_state">State</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="zip_code" id="addr_zip" placeholder="Zip" required>
                                <label for="addr_zip">Zip Code</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-check form-switch mt-2">
                                <input type="checkbox" class="form-check-input" name="is_default" id="addr_default" value="1">
                                <label class="form-check-label" for="addr_default">Set as default shipping address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-link link-secondary fw-medium" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">Save Address</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
                $('#avatar-preview').addClass('pulse-animation');
                setTimeout(() => $('#avatar-preview').removeClass('pulse-animation'), 1000);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        // Handle AJAX form deletion with SweetAlert2 (assuming global scripts are loaded)
        $(document).on('click', '.delete-btn', function() {
            let url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "This address will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if (res.success) location.reload();
                        }
                    });
                }
            });
        });
    });
</script>
<style>
    .pulse-animation {
        animation: avatar-pulse 1s ease-in-out;
    }
    @keyframes avatar-pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }
    .shadow-xs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
</style>
@endpush
@endsection
