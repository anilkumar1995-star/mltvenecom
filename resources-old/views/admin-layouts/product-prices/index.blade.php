@extends('admin-layouts.app')
@section('title', 'Product Prices')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Product Prices
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @php
                                        $displayImage = $product->image ?: (is_array($product->images) && !empty($product->images) ? $product->images[0] : null);
                                        $imageUrl = $displayImage ? asset('uploads/' . $displayImage) : asset('home-dashboard-files/placeholder.png');
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="avatar me-2" style="object-fit:cover;" onerror="this.src='{{ asset('home-dashboard-files/placeholder.png') }}'">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>
                                    <input type="number" step="0.01" class="form-control update-price" data-pk="{{ $product->id }}" data-name="price" value="{{ $product->price }}">
                                </td>
                                <td>
                                    <input type="number" step="0.01" class="form-control update-price" data-pk="{{ $product->id }}" data-name="sale_price" value="{{ $product->sale_price }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.update-price').on('change', function() {
            let input = $(this);
            let pk = input.data('pk');
            let name = input.data('name');
            let value = input.val();

            $.ajax({
                url: '{{ route("admin.product-prices.update") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    pk: pk,
                    name: name,
                    value: value
                },
                success: function(response) {
                    if(response.success) {
                        toastr.success('Price updated successfully');
                    } else {
                        toastr.error('Failed to update price');
                    }
                },
                error: function() {
                    toastr.error('Error updating price');
                }
            });
        });
    });
</script>
@endpush
@endsection
