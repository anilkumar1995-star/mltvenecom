@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/ecommerce') }}">Ecommerce</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Create Product</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card p-3">
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card p-3">
                        <h6 class="mb-3">Publish</h6>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 0) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock Status</label>
                            <select name="stock_status" class="form-select">
                                <option value="">-- Select --</option>
                                <option value="In stock" {{ old('stock_status') == 'In stock' ? 'selected' : '' }}>In stock</option>
                                <option value="Out of stock" {{ old('stock_status') == 'Out of stock' ? 'selected' : '' }}>Out of stock</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="action" value="save" class="btn btn-primary btn-block">
                                <i class="fas fa-save me-1"></i> Save
                            </button>
                            <button type="submit" name="action" value="save_exit" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-sign-out-alt me-1"></i> Save &amp; Exit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
