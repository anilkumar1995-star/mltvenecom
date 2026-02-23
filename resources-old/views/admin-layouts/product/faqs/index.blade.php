@extends('admin-layouts.app')
@section('title','Product FAQs')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Ecommerce</li>
                    <li class="breadcrumb-item active">FAQs</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div class="w-100 justify-content-between d-flex align-items-center">
                        <h4 class="card-title mb-0">Product FAQs</h4>
                        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Create</a>
                    </div>
                </div>
                <div class="card-table">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover">
                            <thead>
                                <tr>
                                    <th width="40"><input class="form-check-input" id="checkAll" type="checkbox"></th>
                                    <th width="40">ID</th>
                                    <th>Question</th>
                                    <th>Order</th>
                                    <th class="text-center">Status</th>
                                    <th width="100" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs as $row)
                                <tr>
                                    <td><input type="checkbox" class="form-check-input row-checkbox" value="{{ $row->id }}"></td>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><a href="{{ route('admin.faqs.edit', $row->id) }}">{{ Str::limit($row->question, 60) }}</a></td>
                                    <td>{{ $row->order }}</td>
                                    <td class="text-center">
                                                <span
                                                    class="badge {{ $row->status == 'published' ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }} rounded-pill px-2">
                                                    {{ ucwords($row->status) }}
                                                </span>
                                            </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.faqs.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <button onclick="deleteItem({{ $row->id }})" class="btn btn-icon btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center">No FAQs found.</td></tr>
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
                url: '{{ route("admin.faqs.delete") }}', type: 'POST', data: { id: id, _token: '{{ csrf_token() }}' },
                success: function(res) { if (res.status) Swal.fire('Deleted!', res.message, 'success').then(() => location.reload()); }
            });
        }
    });
}
</script>
@endpush
