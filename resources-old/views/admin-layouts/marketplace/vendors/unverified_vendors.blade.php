@extends('admin-layouts.app')
@section('title', 'Unverified Vendors')
@section('content')


  <div class="page-wrapper">
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li
                                                class="breadcrumb-item">
                                                <a
                                                    class="mb-0 d-inline-block fs-6 lh-1"
                                                    href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li
                                                class="breadcrumb-item">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Marketplace</h1>
                                            </li>
                                            <li
                                                class="breadcrumb-item active"
                                                aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Unverified vendors</h1>
                                            </li>
                                        </ol>
                                    </nav>

                                </div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="page-body page-content">
                    <div class="container-xl">


                        <div class="table-wrapper">

                            <div class="card">
                                <div class="card-header">
                                    <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                        <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">


                                            <div class="table-search-input">
                                                <label>
                                                    <input
                                                        type="search"
                                                        class="form-control input-sm"
                                                        placeholder="Search..."
                                                        style="min-width: 120px">
                                                    <button
                                                        type="button"
                                                        title="Search..."
                                                        class="search-icon"><svg class="icon svg-icon-ti-ti-search"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                        </svg></button>
                                                    <button
                                                        type="button"
                                                        title="Clear"
                                                        class="search-reset-icon"><svg class="icon svg-icon-ti-ti-x"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg></button>
                                                </label>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">

                                            <button
                                                class="btn" type="button" data-bb-toggle="dt-buttons" data-bb-target=".buttons-reload" tabindex="0" aria-controls="botble-marketplace-tables-unverified-vendor-table">
                                                <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                </svg>
                                                Reload

                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-table">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter table-striped table-hover" id="botble-marketplace-tables-unverified-vendor-table">
                                            <thead>
                                                <tr>
                                                    <th title="ID" width="20" class="text-center no-column-visibility column-key-0">ID</th>
                                                    <th title="Avatar" width="70" class="column-key-1">Avatar</th>
                                                    <th title="Vendor Name" class="text-start column-key-2">Vendor Name</th>
                                                    <th title="Store name" class="text-start column-key-3">Store name</th>
                                                    <th title="Store phone" class="text-start column-key-4">Store phone</th>
                                                    <th title="Store Status" class="text-center column-key-5">Store Status</th>
                                                    <th title="Created At" width="100" class="column-key-6">Created At</th>
                                                    <th title="Operations">Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($stores as $store)
                                                    <tr>
                                                        <td class="text-center">{{ $store->id }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.marketplace.vendors.show', $store->customer->id ?? '#') }}">
                                                                @if($store->logo)
                                                                    <img src="{{ asset('storage/' . $store->logo) }}" class="avatar" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" alt="{{ $store->name }}">
                                                                @else
                                                                    <img src="{{ asset('vendor/core/core/base/images/placeholder.png') }}" class="avatar" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" alt="{{ $store->name }}">
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if($store->customer)
                                                                <a href="{{ route('admin.marketplace.vendors.show', $store->customer->id) }}">{{ $store->customer->name }}</a>
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.marketplace.store.show', $store->id) }}">{{ $store->name }}</a>
                                                        </td>
                                                        <td>{{ $store->phone ?? 'N/A' }}</td>
                                                        <td class="text-center">
                                                            @if($store->status == 'published')
                                                                <span class="badge bg-success text-white">Published</span>
                                                            @elseif($store->status == 'draft')
                                                                <span class="badge bg-secondary text-white">Draft</span>
                                                            @else
                                                                <span class="badge bg-warning text-white">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $store->created_at->format('M d, Y') }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-list flex-nowrap justify-content-center">
                                                                @if($store->customer)
                                                                    <a href="{{ route('admin.marketplace.vendors.show', $store->customer->id) }}" class="btn btn-icon btn-sm btn-info" data-bs-toggle="tooltip" data-bs-original-title="View Vendor">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                           <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                                           <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                                        </svg>
                                                                    </a>
                                                                @endif
                                                                <a href="{{ route('admin.marketplace.store.edit', $store->id) }}" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit Store">
                                                                    <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                                                </a>
                                                                <button type="button" class="btn btn-icon btn-success btn-sm btn-verify-store" data-store-id="{{ $store->id }}" data-bs-toggle="tooltip" data-bs-original-title="Verify Store">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                       <path d="M5 12l5 5l10 -10"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-happy mb-2" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                   <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                                   <path d="M9 9l.01 0"></path>
                                                                   <path d="M15 9l.01 0"></path>
                                                                   <path d="M8 13a4 4 0 1 0 8 0h-8"></path>
                                                                </svg>
                                                                <p class="mb-0">No unverified vendors found</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if($stores->hasPages())
                                <div class="card-footer d-flex align-items-center">
                                    {{ $stores->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                                @endif
                            </div>
                        </div>




                    </div>
                </main>

        



@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // Verify Store Button Click
        $(document).on('click', '.btn-verify-store', function () {
            let storeId = $(this).data('store-id');
            let $row = $(this).closest('tr');

            Swal.fire({
                title: "Verify Store?",
                text: "Are you sure you want to verify this store?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, Verify!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Please wait...",
                        text: "Verifying store...",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('admin.marketplace.store.verify', ':id') }}".replace(':id', storeId),
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (res) {
                            if (res.status) {
                                Swal.fire("Verified!", res.message, "success");
                                $row.fadeOut(500, function() {
                                    $(this).remove();
                                    // Check if table is empty
                                    if ($('#botble-marketplace-tables-unverified-vendor-table tbody tr').length === 0) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire("Error!", res.message, "error");
                            }
                        },
                        error: function (xhr) {
                            Swal.fire("Error!", xhr?.responseJSON?.message || "Something went wrong", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endpush