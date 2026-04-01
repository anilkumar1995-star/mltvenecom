@extends('frontend.layouts.app')

@section('title', 'Invoices')

@section('content')
  <main>
        <div class="bb-customer-page crop-avatar">
            <div class="container">
                <div class="customer-body">
                    <div class="d-lg-none bg-white border-bottom p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="wrapper-image page_speed_3267104">
                                    <img class="rounded-circle img-fluid" style="width:40px;height:40px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $customer->name ?? 'User' }}</div>
                                    <div class="text-muted small">Account Dashboard</div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#customerSidebar" aria-controls="customerSidebar">
                                <svg class="icon icon-sm" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 6l16 0" />
                                    <path d="M4 12l16 0" />
                                    <path d="M4 18l16 0" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="row g-0">
                        {{-- Desktop Sidebar --}}
                        <div class="col-lg-3 col-xl-3 d-none d-lg-block">
                            <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                                <div class="bb-customer-sidebar flex-1">
                                    <div class="bb-customer-sidebar-heading">
                                        <div class="d-flex align-items-center gap-3 p-4">
                                            <div class="position-relative">
                                                <div class="wrapper-image">
                                                    <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                                </div>
                                                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                                <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('frontend.customer.sidebar', ['active' => 'invoices'])
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-9">
                            <div class="bb-profile-content p-4 p-md-5">
                                <div class="bb-profile-header mb-4">
                                    <h1 class="bb-profile-header-title h3 mb-0"> Invoices </h1>
                                </div>
                                <div class="bb-profile-main">
                                    @if($invoices->isNotEmpty())
                                        <div class="card border-0 shadow-sm rounded-3">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-hover align-middle mb-0">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="ps-4 py-3 text-uppercase small fw-bold text-muted border-0">Invoice Code</th>
                                                                <th class="py-3 text-uppercase small fw-bold text-muted border-0">Date</th>
                                                                <th class="py-3 text-uppercase small fw-bold text-muted border-0 text-center">Amount</th>
                                                                <th class="py-3 text-uppercase small fw-bold text-muted border-0 text-center">Status</th>
                                                                <th class="pe-4 py-3 text-uppercase small fw-bold text-muted border-0 text-end">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($invoices as $invoice)
                                                                <tr>
                                                                    <td class="ps-4 py-3">
                                                                        <span class="fw-semibold text-dark">{{ $invoice->code }}</span>
                                                                    </td>
                                                                    <td class="py-3 text-muted small">
                                                                        {{ $invoice->created_at->format('M d, Y') }}
                                                                    </td>
                                                                    <td class="py-3 text-center fw-bold">
                                                                        ₹{{ number_format($invoice->amount, 2) }}
                                                                    </td>
                                                                    <td class="py-3 text-center">
                                                                        @php
                                                                            $statusClass = match($invoice->status) {
                                                                                'paid' => 'bg-success-subtle text-success',
                                                                                'pending' => 'bg-warning-subtle text-warning',
                                                                                'cancelled' => 'bg-danger-subtle text-danger',
                                                                                default => 'bg-light text-muted'
                                                                            };
                                                                        @endphp
                                                                        <span class="badge rounded-pill {{ $statusClass }} px-3 py-2 text-uppercase small" style="letter-spacing: 0.5px;">
                                                                            {{ $invoice->status }}
                                                                        </span>
                                                                    </td>
                                                                    <td class="pe-4 py-3 text-end">
                                                                        <a href="{{ route('frontend.customer.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                                            View
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if($invoices->hasPages())
                                                <div class="card-footer bg-white border-0 py-4">
                                                    {{ $invoices->links() }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="card border-0 shadow-sm rounded-3">
                                            <div class="card-body p-4 p-md-5 text-center">
                                                <div class="mb-4">
                                                    <svg class="icon text-muted" style="width: 64px; height: 64px;" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" />
                                                        <path d="M9 7l1 0" />
                                                        <path d="M9 13l6 0" />
                                                        <path d="M13 17l2 0" />
                                                    </svg>
                                                </div>
                                                <h4 class="fw-semibold text-dark">No invoices found</h4>
                                                <p class="text-muted mb-4">You do not have any invoices generated for your orders yet.</p>
                                                <a href="{{ route('frontend.products.index') }}" class="btn btn-primary px-4">
                                                    Start shopping now
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Mobile Sidebar Offcanvas --}}
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="customerSidebar" aria-labelledby="customerSidebarLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="customerSidebarLabel">Account Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                        <div class="bb-customer-sidebar flex-1">
                            <div class="bb-customer-sidebar-heading">
                                <div class="d-flex align-items-center gap-3 p-4">
                                    <div class="position-relative">
                                        <div class="wrapper-image">
                                            <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                        <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.customer.sidebar', ['active' => 'invoices'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
