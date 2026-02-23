@extends('frontend.layouts.app')

@section('title', 'Vendor Dashboard')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
             @include('frontend.vendor.sidebar')
        </div>
        <div class="col-md-9">
            <h2 class="mb-4">Vendor Dashboard</h2>
            <div class="card">
                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    <p>This is your vendor dashboard. Use the menu to manage your products.</p>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">My Products</h5>
                            <a href="{{ route('vendor.products.index') }}" class="btn btn-primary">Manage Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
