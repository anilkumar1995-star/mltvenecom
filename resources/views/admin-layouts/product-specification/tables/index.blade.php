@extends('admin-layouts.app')
@section('title','Table')
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1"
                                        href="{{ route('home') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Specification Tables</h1>
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
            @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

            <div class="card has-actions has-filter">
                @section('table_actions')
                    <a href="{{ route('admin.producttable.create') }}" class="btn btn-primary d-flex align-items-center">
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
                    'tableId'     => 'specTables'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive table-has-actions table-has-filter">
                        <table class="table card-table table-vcenter table-hover datatable" id="specTables">
                            <thead class="bg-light text-uppercase">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="50">ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Assigned Groups</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-end">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tables as $table)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $table->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $table->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.producttable.edit', $table->id) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $table->name }}
                                        </a>
                                    </td>
                                    <td>{{ $table->description }}</td>
                                    <td>
                                        @foreach($table->groups as $group)
                                            <span class="badge bg-blue-lt">{{ $group->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center small">{{ $table->created_at }}</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.producttable.edit', $table->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.producttable.Delete', ['id' => $table->id]) }}"
                                                title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No tables found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $tables->firstItem() ?? 0 }} to {{ $tables->lastItem() ?? 0 }} of {{ $tables->total() }} entries
                        </div>
                        <div>
                            {{ $tables->appends(request()->query())->links() }}
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
        'tableId'       => 'specTables',
        'bulkDeleteUrl' => route('admin.producttable.bulk-delete')
    ])
@endpush