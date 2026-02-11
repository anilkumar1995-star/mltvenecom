@extends('admin-layouts.app')
@section('title','Product Taxes')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Ecommerce</li>
                    <li class="breadcrumb-item active">Taxes</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div class="w-100 justify-content-between d-flex align-items-center">
                        <h4 class="card-title mb-0">Product Taxes (VAT, GST)</h4>
                        <a href="{{ route('admin.taxes.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Create</a>
                    </div>
                </div>
                <div class="card-table">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover">
                            <thead>
                                <tr>
                                    <th width="40"><input class="form-check-input" id="checkAll" type="checkbox"></th>
                                    <th width="40">ID</th>
                                    <th>Title</th>
                                    <th>Percentage</th>
                                    <th>Priority</th>
                                    <th class="text-center">Status</th>
                                    <th width="100" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($taxes as $row)
                                <tr>
                                    <td><input type="checkbox" class="form-check-input row-checkbox" value="{{ $row->id }}"></td>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><a href="{{ route('admin.taxes.edit', $row->id) }}">{{ $row->title }}</a></td>
                                    <td>{{ $row->percentage }}%</td>
                                    <td>{{ $row->priority }}</td>
                                    <td class="text-center">
                                            <span class="badge {{ $row->status == 'published' ? 'bg-success text-success-fg' : 'bg-danger text-danger-fg' }} rounded-pill px-2">
                                                {{ ucwords($row->status) }}
                                            </span>
                                        </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.taxes.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <button onclick="deleteItem({{ $row->id }})" class="btn btn-icon btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center">No taxes found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
<script>
function deleteItem(id) {
    Swal.fire({title: "Are you sure?", icon: "warning", showCancelButton: true, confirmButtonText: "Yes, delete!"}).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.taxes.delete") }}', type: 'POST', data: { id: id, _token: '{{ csrf_token() }}' },
                success: function(res) { if (res.status) Swal.fire('Deleted!', res.message, 'success').then(() => location.reload()); }
            });
        }
    });
}
</script>
@endpush
