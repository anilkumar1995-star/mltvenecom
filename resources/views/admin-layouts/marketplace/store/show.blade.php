@extends('admin-layouts.app')

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
                                                <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.marketplace.store.index') }}">Stores</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">View store &quot;{{ $store->name }}&quot;</h1>
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
                        <div class="row row-cards">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Store information</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="text-center p-3">
                                            <div class="mb-2">
                                                <img src="{{ $store->logo ? asset('storage/' . $store->logo) : asset('vendor/core/core/base/images/placeholder.png') }}"
                                                     alt="{{ $store->name }}"
                                                     class="avatar avatar-rounded avatar-xl" />
                                            </div>
                                            <h3 class="mb-0">{{ $store->name }}</h3>
                                        </div>
                                        <div class="hr my-2"></div>
                                        <div class="p-3">
                                            <dl class="row">
                                                <dt class="col">Vendor Name</dt>
                                                <dd class="col-auto">
                                                    @if($store->customer)
                                                        <a href="#" target="_blank">
                                                            {{ $store->customer->name }}
                                                            <svg class="icon svg-icon-ti-ti-external-link" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg>
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </dd>
                                            </dl>
                                            <dl class="row">
                                                <dt class="col">Balance</dt>
                                                <dd class="col-auto">
                                                    <span class="vendor-balance">
                                                        {{ number_format($store->earnings ?? 0, 2) }}
                                                    </span>
                                                </dd>
                                            </dl>
                                            <dl class="row">
                                                <dt class="col">Products</dt>
                                                <dd class="col-auto">{{ $store->products_count ?? 0 }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-status-top bg-{{ $store->is_verified ? 'success' : 'warning' }}"></div>
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <svg class="icon svg-icon-ti-ti-shield-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.46 20.846a12 12 0 0 1 -7.96 -14.846a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.09 7.06" /><path d="M15 19l2 2l4 -4" /></svg>
                                            Store Verification
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        @if($store->is_verified)
                                            <div class="alert alert-success" role="alert">
                                                <div class="d-flex">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="alert-title">Verified</h4>
                                                        <div class="text-secondary">This store is verified.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning" role="alert">
                                                <div class="d-flex">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="alert-title">Not Verified</h4>
                                                        <div class="text-secondary">This store has not been verified yet.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <h3>Verification Pending</h3>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Statements</h4>
                                    </div>
                                    <div class="table-wrapper">
                                        <div class="card">
                                            <div class="card-table">
                                                <div class="table-responsive">
                                                    <table class="table card-table table-vcenter table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th title="ID" width="20">ID</th>
                                                                <th title="Description">Description</th>
                                                                <th title="Fee">Fee</th>
                                                                <th title="Sub amount">Sub amount</th>
                                                                <th title="Amount">Amount</th>
                                                                <th title="Type" width="100">Type</th>
                                                                <th title="Created At" width="100">Created At</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="7" class="text-center">No statements found</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

              
@endsection
