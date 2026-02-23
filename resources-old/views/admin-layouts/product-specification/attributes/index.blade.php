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
            <div class="table-wrapper">
                <div class="card has-actions">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="dropdown d-inline-block">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Bulk Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item text-danger" onclick="bulkDelete()">
                                            Delete
                                        </button>
                                    </div>
                                </div>

                                <form action="{{ route('admin.productattributes.Index') }}" method="GET">
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="q" class="form-control ps-2" placeholder="Search..." value="{{ request('q') }}">
                                        <span class="input-group-text px-2">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.productAttribute.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                                    <i class="fas fa-plus"></i>
                                    <span>Create</span>
                                </a>
                                <button class="btn btn-light d-flex align-items-center gap-1" onclick="location.reload()">
                                    <i class="fas fa-sync-alt"></i>
                                    <span>Reload</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-table">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter table-hover datatable" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="40" class="text-center"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                                        <th width="40">ID</th>
                                        <th>NAME</th>
                                        <th>ASSOCIATED GROUP</th>
                                        <th>FIELD TYPE</th>
                                        <th class="text-center">CREATED AT</th>
                                        <th width="100" class="text-center">OPERATIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($attributes))
                                    @foreach($attributes as $attribute)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" class="form-check-input row-checkbox" value="{{ $attribute->id }}"></td>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><a href="{{ route('admin.productAttribute.edit', $attribute->id) }}">{{ $attribute->name }}</a></td>
                                        <td>{{ $attribute->group ? $attribute->group->name : 'N/A' }}</td>
                                        <td>{{ ucwords($attribute->type) }}</td>
                                        <td class="text-center text-muted small">{{ $attribute->created_at }}</td>
                                        <td class="text-center text-nowrap">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('admin.productAttribute.edit', $attribute->id) }}" class="btn btn-sm btn-icon btn-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" onclick="deleteItem({{ $attribute->id }})" class="btn btn-sm btn-icon btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if(!empty($attributes) && $attributes->hasPages())
                        <div class="card-footer d-flex align-items-center">
                            {{ $attributes->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('change', '#checkAll', function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });
    });

    function deleteItem(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this attribute?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.productAttribute.Delete") }}',
                    type: 'POST',
                    data: { id: id, _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Deleted!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }

    function bulkDelete() {
        var ids = [];
        $('.row-checkbox:checked').each(function() {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            Swal.fire('Error', 'Please select at least one item', 'error');
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to delete " + ids.length + " items.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete them!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.productAttribute.bulk-delete") }}',
                    type: 'POST',
                    data: { ids: ids, _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Deleted!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }
</script>
@endpush
