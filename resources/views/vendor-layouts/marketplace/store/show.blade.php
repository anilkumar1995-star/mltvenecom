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
                                                <img src="{{ $store->logo ? asset('/' . $store->logo) : asset('vendor/core/core/base/images/placeholder.png') }}"
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
                                            <svg class="icon svg-icon-ti-ti-shield-check"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M11.46 20.846a12 12 0 0 1 -7.96 -14.846a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.09 7.06" />
                                                <path d="M15 19l2 2l4 -4" />
                                            </svg> Store Verification
                                        </h3>
                                    </div>

                                    <div class="card-body">
                                        @if($store->is_verified)
                                            <div class="alert" style="background-color: #f5fbf7; border: 1px solid #d0f0db; border-radius: 8px;">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10"></path></svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="alert-title font-weight-bold" style="font-size: 16px; margin-bottom: 5px; color: #111827;">Verified</h4>
                                                        <div style="color: #6b7280; font-size: 14px;">This store has been verified and can be trusted.</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <div class="text-uppercase text-muted fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.5px; color: #6b7280;">VERIFIED AT</div>
                                                <div style="font-size: 16px; color: #111827;">{{ $store->verified_at ? \Carbon\Carbon::parse($store->verified_at)->format('M d, Y H:i') : 'N/A' }}</div>
                                            </div>

                                            @if($store->verification_note)
                                            <div class="mt-4 alert" style="background-color: #eff6ff; border: 1px solid #dbeafe; border-radius: 8px;">
                                                <div class="d-flex mb-2 align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#2563eb" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect><line x1="9" y1="12" x2="15" y2="12"></line><line x1="9" y1="16" x2="15" y2="16"></line></svg>
                                                    <h4 class="alert-title m-0" style="font-size: 16px; color: #2563eb;">Verification Note</h4>
                                                </div>
                                                <div style="color: #6b7280; font-size: 15px;">{{ $store->verification_note }}</div>
                                            </div>
                                            @endif

                                            <div class="text-center mt-4 pt-2">
                                                <form action="{{ route('admin.marketplace.store.verify', $store->id) }}" method="POST" id="unverify-store-form">
                                                    @csrf
                                                    <button type="submit" class="btn w-100" style="color: #f59e0b; border: 1px solid #f59e0b; background: transparent; border-radius: 6px; font-weight: 500; padding: 10px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 21a9 9 0 0 0 9 -9a9 9 0 0 0 -9 -9a9 9 0 0 0 -9 9a9 9 0 0 0 9 9z"/><path d="M9 12l2 2l4 -4"/><line x1="16" y1="16" x2="19" y2="19"/></svg>
                                                        Unverify Store
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="alert alert-warning" role="alert">
                                                <div class="d-flex">
                                                    <div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="12" cy="12" r="9"></circle>
                                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="alert-title">Not Verified</h4>
                                                        <div class="text-secondary">This store has not been verified yet.</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center py-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg text-muted mb-3" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path>
                                                    <circle cx="12" cy="11" r="1"></circle>
                                                    <line x1="12" y1="12" x2="12" y2="14.5"></line>
                                                </svg>
                                                <h3>Verification Pending</h3>
                                                <p class="text-muted">Click the button below to verify this store and display the verified badge.</p>

                                                <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#verify-store-modal">
                                                    <svg class="icon svg-icon-ti-ti-shield-check"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M11.46 20.846a12 12 0 0 1 -7.96 -14.846a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.09 7.06" />
                                                        <path d="M15 19l2 2l4 -4" />
                                                    </svg> Verify Store
                                                </button>
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
                                                            @forelse($statements as $statement)
                                                                <tr>
                                                                    <td>{{ $statement->id }}</td>
                                                                    <td>{{ Str::limit($statement->description, 50) }}</td>
                                                                    <td>{{ number_format($statement->fee, 2) }}</td>
                                                                    <td>{{ number_format($statement->amount, 2) }}</td>
                                                                    <td>{{ number_format($statement->amount - $statement->fee, 2) }}</td>
                                                                    <td>
                                                                        <span class="badge bg-secondary text-secondary-fg">Withdrawal</span>
                                                                    </td>
                                                                    <td>{{ $statement->created_at->format('Y-m-d') }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="7" class="text-center">No statements found</td>
                                                                </tr>
                                                            @endforelse
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

                <!-- Verify Store Modal -->
                <div class="modal fade" id="verify-store-modal" tabindex="-1" aria-labelledby="verifyStoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('admin.marketplace.store.verify', $store->id) }}" method="POST" id="verify-store-form">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="verifyStoreModalLabel">Verify Store</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to verify the store "{{ $store->name }}"? This action will mark them as a trusted seller.</p>
                                    <div class="mb-3 mt-4">
                                        <label for="verification_note" class="form-label font-weight-bold">Verification Note</label>
                                        <textarea class="form-control form-control-lg" id="verification_note" name="verification_note" rows="3" placeholder="Authentication documentation verified, checked background, etc..."></textarea>
                                        <small class="form-hint">Enter the reasoning or notes for verifying this vendor.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Verify Store</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#verify-store-form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let btn = form.find('button[type="submit"]');
        let originalText = btn.html();
        btn.prop('disabled', true).text('Verifying...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(res) {
                if (res.status) {
                    Swal.fire('Verified!', res.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', res.message, 'error');
                    btn.prop('disabled', false).html(originalText);
                }
            },
            error: function(err) {
                Swal.fire('Error', 'Something went wrong', 'error');
                btn.prop('disabled', false).html(originalText);
            }
        });
    });

    $('#unverify-store-form').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This will revoke the store's verified status immediately.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Unverify Store'
        }).then((result) => {
            if (result.isConfirmed) {
                let btn = form.find('button[type="submit"]');
                let originalText = btn.html();
                btn.prop('disabled', true).text('Processing...');
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Success!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', res.message, 'error');
                            btn.prop('disabled', false).html(originalText);
                        }
                    },
                    error: function(err) {
                        Swal.fire('Error', 'Something went wrong', 'error');
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            }
        });
    });
});
</script>
@endpush
