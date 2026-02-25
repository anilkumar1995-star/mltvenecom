@extends('admin-layouts.app')
@section('title', 'Edit Customer')
@section('content')

    <div class="page-wrapper">
        <div class="page-header d-print-none">
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Ecommerce</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.customers.index') }}">Customers</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Edit customer: {{ $customer->name }}</h1>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-9">
                        <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data" class="ajax-form">
                            @csrf
                            @method('PUT')
                            <!-- Customer Details Card -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">Customer Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label required">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name', $customer->name) }}" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label required">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email', $customer->email) }}" placeholder="e.g. example@domain.com" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_vendor" value="1" {{ old('is_vendor', $customer->is_vendor) ? 'checked' : '' }}>
                                                    <span class="form-check-label">Is vendor?</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $customer->phone) }}" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Date of birth</label>
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                                                    </span>
                                                    <input class="form-control" placeholder="Y-m-d" id="dob" name="dob" value="{{ old('dob', $customer->dob) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Password confirmation</label>
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Leave blank to keep current password">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Private notes</label>
                                                <textarea class="form-control" name="private_notes" rows="4" placeholder="Private notes are only visible to admins">{{ old('private_notes', $customer->private_notes ?? '') }}</textarea>
                                                <small class="form-hint">Private notes are only visible to admins</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Publish</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-list">
                                    <button class="btn btn-primary" type="submit" name="submitter" value="save">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                            <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                                        </svg>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Status <span class="text-danger">*</span></h4>
                            </div>
                            <div class="card-body">
                                <select class="form-select" name="status" required>
                                    <option value="activated" {{ $customer->status == 'activated' ? 'selected' : '' }}>Activated</option>
                                    <option value="locked" {{ $customer->status == 'locked' ? 'selected' : '' }}>Locked</option>
                                </select>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Avatar</h4>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <div class="avatar-preview-container" style="cursor: pointer;" onclick="document.getElementById('avatar').click()">
                                        @if($customer->avatar)
                                            <img id="avatar-preview" src="{{ asset('storage/' . $customer->avatar) }}" alt="Avatar" class="rounded mb-2" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                            <div id="avatar-placeholder" class="p-4 border border-dashed rounded bg-light" style="display: none;">
                                        @else
                                            <img id="avatar-preview" src="{{ asset('media/images/placeholder.png') }}" alt="Avatar" class="rounded mb-2" style="max-width: 150px; max-height: 150px; object-fit: cover; display: none;">
                                            <div id="avatar-placeholder" class="p-4 border border-dashed rounded bg-light">
                                        @endif
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M15 8h.01"></path>
                                               <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12"></path>
                                               <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path>
                                               <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path>
                                            </svg>
                                            <div class="mt-2 text-muted">Choose image</div>
                                        </div>
                                    </div>
                                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*" onchange="previewAvatar(this)">
                                    <div class="mt-2">
                                        <a href="#" class="text-primary small">or Add from URL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <!-- Addresses Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Addresses</h3>
                                <div class="card-actions">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-address">
                                        Add address
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="address-list">
                                    @if($customer->addresses->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($customer->addresses as $address)
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="mb-1">{{ $address->name }} @if($address->is_default) <span class="badge bg-primary ms-2">Default</span> @endif</h4>
                                                            <div class="text-muted">
                                                                {{ $address->address }}<br>
                                                                {{ $address->city }}, {{ $address->state }}, {{ $address->country }} - {{ $address->zip_code }}<br>
                                                                Phone: {{ $address->phone }} | Email: {{ $address->email }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-icon btn-danger btn-sm delete-btn" data-url="{{ route('admin.customers.addresses.destroy', $address->id) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="empty">
                                            <div class="empty-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                                            </div>
                                            <p class="empty-title">No addresses found</p>
                                            <p class="empty-subtitle text-muted">
                                                This customer has no addresses yet.
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Orders Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customer->orders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                                <td>{{ number_format($order->amount, 2) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $order->status === 'completed' ? 'green' : ($order->status === 'canceled' ? 'red' : 'yellow') }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No orders found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Payments Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Payments</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customer->orders as $order)
                                            <tr>
                                                <td>
                                                    <a href="#">#{{ $order->id }}</a>
                                                </td>
                                                <td>
                                                    {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : ucfirst($order->payment_method) }}
                                                </td>
                                                <td>{{ number_format($order->amount, 2) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $order->payment_status === 'completed' ? 'green' : ($order->payment_status === 'pending' ? 'yellow' : 'red') }}">
                                                        {{ ucfirst($order->payment_status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No payments found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Reviews Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Reviews</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                @forelse($customer->reviews as $review)
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-auto">
                                                @if($review->product && $review->product->image)
                                                    <img src="{{ asset('storage/' . $review->product->image) }}" class="avatar" alt="{{ $review->product->name }}">
                                                @else
                                                    <span class="avatar bg-secondary-lt">P</span>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <a href="#" class="text-reset font-weight-bold">{{ $review->product->name ?? 'Unknown Product' }}</a>
                                                        <div class="text-muted mt-1">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star {{ $i <= $review->star ? 'text-yellow fill-yellow' : 'text-muted' }}" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                                </div>
                                                <div class="mt-2">
                                                    {{ Str::limit($review->comment, 100) }}
                                                </div>
                                                <div class="mt-2">
                                                    <span class="badge bg-{{ $review->status === 'published' ? 'green' : 'secondary' }}">{{ ucfirst($review->status) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty">
                                        <div class="empty-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                                        </div>
                                        <p class="empty-title">No reviews found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Wishlist Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Wishlist</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                @forelse($customer->wishlist as $item)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="avatar" alt="{{ $item->product->name }}">
                                                @else
                                                    <span class="avatar bg-secondary-lt">P</span>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <a href="#" class="text-reset d-block">{{ $item->product->name ?? 'Unknown Product' }}</a>
                                                <div class="text-muted text-truncate mt-n1">
                                                    Added on {{ $item->created_at->format('d M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty">
                                        <div class="empty-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                        </div>
                                        <p class="empty-title">Wishlist is empty</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>

    <!-- Add Address Modal -->
    <div class="modal modal-blur fade" id="modal-address" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Note: 'ajax-form' class added for AJAX handling -->
                <form action="{{ route('admin.customers.addresses.store', $customer->id) }}" method="POST" class="ajax-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Full name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter phone" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="e.g. example@domain.com" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Country</label>
                                    <input type="text" class="form-control" name="country" placeholder="Country" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="State" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label required">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter address" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Zip Code</label>
                                    <input type="text" class="form-control" name="zip_code" placeholder="Zip Code" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_default" value="1">
                                        <span class="form-check-label">Use this address as default.</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ms-auto">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                    document.getElementById('avatar-preview').style.display = 'inline-block';
                    document.getElementById('avatar-placeholder').style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
