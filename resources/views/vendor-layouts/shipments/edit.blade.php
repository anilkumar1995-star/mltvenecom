@extends('admin-layouts.app')
@section('title', 'Edit Shipment #' . $shipment->id)
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.shipments.index') }}">Shipments</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Shipment #{{ $shipment->id }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form action="{{ route('admin.shipments.update', $shipment->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Tracking Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tracking ID</label>
                                        <input type="text" class="form-control" name="tracking_id" value="{{ old('tracking_id', $shipment->tracking_id) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Shipping Company</label>
                                        <input type="text" class="form-control" name="shipping_company_name" value="{{ old('shipping_company_name', $shipment->shipping_company_name) }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tracking Link</label>
                                    <input type="url" class="form-control" name="tracking_link" value="{{ old('tracking_link', $shipment->tracking_link) }}">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Estimated Date Shipped</label>
                                        <input type="datetime-local" class="form-control" name="estimate_date_shipped" value="{{ old('estimate_date_shipped', $shipment->estimate_date_shipped ? $shipment->estimate_date_shipped->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Actual Date Shipped</label>
                                        <input type="datetime-local" class="form-control" name="date_shipped" value="{{ old('date_shipped', $shipment->date_shipped ? $shipment->date_shipped->format('Y-m-d\TH:i') : '') }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Weight (g)</label>
                                    <input type="number" step="0.01" class="form-control" name="weight" value="{{ old('weight', $shipment->weight) }}">
                                </div>
                                
                                <div class="mb-0">
                                    <label class="form-label">Note</label>
                                    <textarea class="form-control" name="note" rows="3">{{ old('note', $shipment->note) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Status</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Shipment Status</label>
                                    <select class="form-select" name="status">
                                        <option value="pending" {{ old('status', $shipment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="delivering" {{ old('status', $shipment->status) == 'delivering' ? 'selected' : '' }}>Delivering</option>
                                        <option value="delivered" {{ old('status', $shipment->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="canceled" {{ old('status', $shipment->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">COD Status</label>
                                    <select class="form-select" name="cod_status">
                                        <option value="pending" {{ old('cod_status', $shipment->cod_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ old('cod_status', $shipment->cod_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                                
                                <div class="mb-0">
                                    <label class="form-label text-muted">Order</label>
                                    <div><a href="{{ route('admin.orders.edit', $shipment->order_id ?? 0) }}" class="text-primary">#{{ $shipment->order_id }}</a></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <button type="submit" name="submit" value="save" class="btn btn-primary w-100 mb-2">Save</button>
                                <button type="submit" name="save_and_exit" value="1" class="btn btn-outline-primary w-100">Save & Exit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

@endsection
