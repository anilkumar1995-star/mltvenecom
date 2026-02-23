@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4 align-items-center">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Dashboard</h4>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary">Quick action</button>
                    <button class="btn btn-sm btn-primary">Create</button>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-orders p-3 rounded">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3"><i class="fas fa-shopping-cart"></i></div>
                        <div>
                            <div class="stat-label">Orders</div>
                            <div class="stat-value">{{ $adminStats['orders'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-products p-3 rounded">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3"><i class="fas fa-box-open"></i></div>
                        <div>
                            <div class="stat-label">Products</div>
                            <div class="stat-value">{{ $adminStats['products'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-customers p-3 rounded">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3"><i class="fas fa-users"></i></div>
                        <div>
                            <div class="stat-label">Customers</div>
                            <div class="stat-value">{{ $adminStats['customers'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-reviews p-3 rounded">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-3"><i class="fas fa-star"></i></div>
                        <div>
                            <div class="stat-label">Reviews</div>
                            <div class="stat-value">{{ $adminStats['reviews'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card p-3">
                    <h5 class="mb-3">Recent Posts</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="text-muted small"><th>#</th><th>Name</th><th>Created At</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>1</td><td>Example Post</td><td>2026-01-01</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-3">
                    <h5 class="mb-3">Activity Logs</h5>
                    <div class="activity-list small text-muted">
                        <div class="mb-2">Anil Kuar logged in</div>
                        <div class="mb-2">Product XYZ updated</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
