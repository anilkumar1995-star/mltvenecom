@extends('vendor-layouts.app')
@section('title', 'Reviews')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Reviews</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('table_actions')
    @endsection

    <div class="page-body">
        <div class="container-xl">
            <div class="table-wrapper">
                @php
                    $filterArgs = ['filterColumns' => $filterColumns];
                @endphp
                @include('admin-layouts.partials.table-filters', $filterArgs)

                <div class="card has-actions has-filter">
                    @php
                        $headerArgs = ['bulkActions' => true];
                    @endphp
                    @include('admin-layouts.partials.table-header', $headerArgs)

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="reviewsTable">
                                <thead>
                                    <tr>
                                        <th title="Checkbox" width="20">
                                            <input class="form-check-input m-0 align-middle table-check-all" type="checkbox">
                                        </th>
                                        <th title="ID" width="50" class="text-center">ID</th>
                                        <th title="Product">Product</th>
                                        <th title="Customer">Customer</th>
                                        <th title="Star" width="100" class="text-center">Star</th>
                                        <th title="Created At">Date</th>
                                        <th title="Status" width="100" class="text-center">Status</th>
                                        <th title="Operations" class="text-end">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($reviews) > 0)
                                        @foreach($reviews as $review)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $review->id }}">
                                            </td>
                                            <td class="text-center">{{ $review->id }}</td>
                                            <td><strong>{{ $review->product->name }}</strong></td>
                                            <td>{{ $review->customer->name }}</td>
                                            <td class="text-center">
                                                @for($i=1; $i<=5; $i++)
                                                    <i class="fa fa-star {{ $i <= $review->star ? 'text-warning' : 'text-muted opacity-50' }}"></i>
                                                @endfor
                                            </td>
                                            <td>{{ $review->created_at->format('d M Y') }}</td>
                                            <td class="text-center">
                                                @if($review->status == 'published')
                                                    <span class="badge bg-success text-white">Published</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($review->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('frontend.vendor.reviews.show', $review->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No reviews found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $reviews->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'reviewsTable',
        'bulkDeleteUrl' => route('frontend.vendor.reviews.bulk-delete')
    ])
@endpush
