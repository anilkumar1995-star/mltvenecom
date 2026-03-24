@extends('admin-layouts.app')
@section('title','Attributes')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a>Ecommerce</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>Specification Attributes</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

            <div class="card has-actions has-filter">
                @section('table_actions')
                    <a href="{{ route('admin.productAttribute.create') }}" class="btn btn-primary d-flex align-items-center">
                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        Create
                    </a>
                @endsection

                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'attributesTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive table-has-actions table-has-filter">
                        <table class="table card-table table-vcenter table-hover datatable" id="attributesTable">
                            <thead class="bg-light text-uppercase">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="50">ID</th>
                                    <th>Name</th>
                                    <th>Associated Group</th>
                                    <th>Field Type</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-end">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($specAttributes as $attribute)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $attribute->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $attribute->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.productAttribute.edit', $attribute->id) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $attribute->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($attribute->group)
                                            <span class="badge bg-blue-lt">{{ $attribute->group->name }}</span>
                                        @else
                                            <span class="text-muted small">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-blue-lt">{{ $attribute->type }}</span>
                                    </td>
                                    <td class="text-center small">{{ $attribute->created_at }}</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.productAttribute.edit', $attribute->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.productAttribute.Delete', ['id' => $attribute->id]) }}"
                                                title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No attributes found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $specAttributes->firstItem() ?? 0 }} to {{ $specAttributes->lastItem() ?? 0 }} of {{ $specAttributes->total() }} entries
                        </div>
                        <div>
                            {{ $specAttributes->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId'       => 'attributesTable',
        'bulkDeleteUrl' => route('admin.productAttribute.bulk-delete')
    ])
@endpush
