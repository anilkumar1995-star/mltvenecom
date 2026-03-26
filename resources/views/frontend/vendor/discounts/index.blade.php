@extends('vendor-layouts.app')
@section('title', 'Discounts')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Discounts</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('table_actions')
        <a href="{{ route('frontend.vendor.discounts.create') }}" class="btn btn-primary">
            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Create
        </a>
    @endsection

    <div class="page-body">
        <div class="container-xl">
            <div class="table-wrapper">
                @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                <div class="card has-actions has-filter border-0 shadow-sm">
                    @include('admin-layouts.partials.table-header', ['bulkActions' => true])

                    <div class="card-table">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter datatable" id="discountsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="20">
                                            <input class="form-check-input m-0 align-middle table-check-all" type="checkbox">
                                        </th>
                                        <th width="50" class="text-center">ID</th>
                                        <th width="400">DETAIL</th>
                                        <th class="text-center">USED</th>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                        <th>STORE</th>
                                        <th class="text-end">OPERATIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($discounts as $discount)
                                    @php $isExpired = $discount->isExpired(); @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $discount->id }}">
                                        </td>
                                        <td class="text-center text-muted">{{ $discount->id }}</td>
                                        <td>
                                            <div class="position-relative p-3 rounded bg-primary text-white mb-0 @if($isExpired) opacity-50 @endif" style="min-height: 100px; overflow: hidden;">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h4 class="mb-0 text-uppercase fw-bold" style="letter-spacing: 1px;">
                                                        @if($discount->type == 'coupon')
                                                            COUPON CODE: {{ $discount->code }}
                                                        @else
                                                            PROMOTION: {{ $discount->title }}
                                                        @endif
                                                    </h4>
                                                    @if($discount->type == 'coupon')
                                                    <button class="btn btn-sm btn-ghost-light p-1 border-0" onclick="copyToClipboard('{{ $discount->code }}')" title="Copy Code">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.412 .412 1.737 1.012" /></svg>
                                                    </button>
                                                    @endif
                                                </div>
                                                <div class="fs-4 mb-2">
                                                    Discount {{ $discount->type_option == 'percentage' ? $discount->value.'%' : '₹'.number_format($discount->value, 2) }} for all orders
                                                </div>
                                                <div class="small fw-normal italic" style="opacity: 0.8;">
                                                    ({{ $discount->type == 'coupon' ? 'Coupon code' : 'Promotion' }} <strong>{{ $discount->can_use_with_promotion ? 'can' : 'cannot' }}</strong> be used with promotion).
                                                </div>
                                                @if($isExpired)
                                                    <div class="position-absolute border border-danger text-danger fw-bold px-2 py-1 rotate-12 rounded" 
                                                         style="top: 10px; right: 10px; font-size: 0.7rem; background: rgba(255,255,255,0.9);">
                                                        Expired
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold fs-3">{{ $discount->total_used }}</td>
                                        <td>{{ $discount->start_date ? $discount->start_date->format('Y-m-d') : '—' }}</td>
                                        <td>{{ $discount->end_date ? $discount->end_date->format('Y-m-d') : '—' }}</td>
                                        <td>{{ $discount->store->name ?? '—' }}</td>
                                        <td class="text-end">
                                            <div class="btn-group shadow-sm">
                                                <a href="{{ route('frontend.vendor.discounts.edit', $discount->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('frontend.vendor.discounts.destroy', $discount->id) }}" data-id="{{ $discount->id }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            No discounts found. Create your first coupon to boost sales!
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $discounts->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                if (typeof notify === 'function') {
                    notify('Copied: ' + text, 'success');
                } else {
                    alert('Copied: ' + text);
                }
            });
        }
    </script>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'discountsTable',
        'bulkDeleteUrl' => route('frontend.vendor.discounts.bulk-delete')
    ])
@endpush
