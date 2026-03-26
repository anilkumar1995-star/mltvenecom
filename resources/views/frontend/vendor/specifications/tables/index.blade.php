@extends('vendor-layouts.app')
@section('title', 'Specification Tables')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Specification Tables</h1>
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
                @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                <div class="card has-actions has-filter">
                    @include('admin-layouts.partials.table-header', ['bulkActions' => false])

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="specTables">
                                <thead>
                                    <tr>
                                        <th title="ID" width="50" class="text-center">ID</th>
                                        <th title="Name">Name</th>
                                        <th title="Created At">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($tables) > 0)
                                        @foreach($tables as $table)
                                        <tr>
                                            <td class="text-center">{{ $table->id }}</td>
                                            <td><strong>{{ $table->name }}</strong></td>
                                            <td>{{ $table->created_at->format('d M Y') }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No specification tables found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $tables->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'specTables'
    ])
@endpush
