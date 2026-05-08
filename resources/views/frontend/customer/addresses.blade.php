@extends('frontend.layouts.app')

@section('title', 'Addresses')

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
                                    @include('frontend.customer.sidebar', ['active' => 'addresses'])
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-9">
                            <div class="bb-profile-content p-4 p-md-5">
                                <div class="bb-profile-header mb-4 d-flex justify-content-between align-items-center">
                                    <h1 class="bb-profile-header-title h3 mb-0"> Addresses </h1>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                        Add New Address
                                    </button>
                                </div>
                                <div class="bb-profile-main">
                                    

                                    <div class="row g-4">
                                        @forelse($addresses as $address)
                                            <div class="col-md-6">
                                                <div class="card border {{ $address->is_default ? 'border-primary' : '' }} shadow-sm h-100 rounded-3">
                                                    <div class="card-body p-4 position-relative">
                                                        @if($address->is_default)
                                                            <span class="badge bg-primary position-absolute top-0 end-0 m-3">Default</span>
                                                        @endif
                                                        <h5 class="card-title fw-bold mb-1">{{ $address->name }}</h5>
                                                        <p class="text-muted small mb-3">{{ $address->phone }} • {{ $address->email }}</p>
                                                        
                                                        <p class="card-text mb-1">{{ $address->address }}</p>
                                                        <p class="card-text mb-0">{{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}</p>
                                                        <p class="card-text">{{ $address->country }}</p>
                                                        
                                                        <div class="mt-3 pt-3 border-top d-flex gap-2">
                                                            <button class="btn btn-outline-secondary btn-sm rounded-1" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">Edit</button>
                                                            <form id="delete-address-form-{{ $address->id }}" action="{{ route('frontend.customer.addresses.delete', $address->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-outline-danger btn-sm rounded-1 btn-delete-address" data-id="{{ $address->id }}">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Address Modal for #{{ $address->id }} -->
                                            <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                                              <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <form action="{{ route('frontend.customer.addresses.update', $address->id) }}" method="POST" class="modal-content">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="modal-header">
                                                    <h5 class="modal-title fw-bold" id="editAddressModalLabel{{ $address->id }}">Edit Address</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body p-4">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $address->name }}" required {{ !empty($customer->name) ? 'readonly' : '' }}>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $address->email }}" required {{ !empty($customer->email) ? 'readonly' : '' }}>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $address->phone }}" required {{ !empty($customer->phone) ? 'readonly' : '' }}>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Address</label>
                                                            <input type="text" class="form-control" name="address" value="{{ $address->address }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">City</label>
                                                            <input type="text" class="form-control" name="city" value="{{ $address->city }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">State</label>
                                                            <input type="text" class="form-control" name="state" value="{{ $address->state }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Zip Code</label>
                                                            <input type="text" class="form-control" name="zip_code" value="{{ $address->zip_code }}" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Country</label>
                                                            <input type="text" class="form-control" name="country" value="{{ $address->country }}" required>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="is_default" value="1" id="is_default_edit_{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="is_default_edit_{{ $address->id }}">
                                                                    Set as default address
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-please-wait">Update Address</button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>

                                        @empty
                                            <div class="col-12">
                                                <div class="text-center py-5 border rounded-3 bg-light">
                                                    <div class="mb-3">
                                                        <svg class="icon svg-icon-ti-ti-map-pins text-muted" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M10.828 9.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"></path>
                                                            <path d="M8 7l0 7"></path>
                                                            <path d="M21 21l-3 -3"></path>
                                                            <path d="M18 15a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"></path>
                                                            <path d="M16 13l0 8"></path>
                                                        </svg>
                                                    </div>
                                                    <h5 class="fw-semibold">No addresses found</h5>
                                                    <p class="text-muted">You haven't saved any addresses yet.</p>
                                                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                                        Add New Address
                                                    </button>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Sidebar Output -->
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="customerSidebar" aria-labelledby="customerSidebarLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="customerSidebarLabel">Account Menu</h5><button type=button class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                        <div class="bb-customer-sidebar flex-1">
                            <div class="bb-customer-sidebar-heading">
                                <div class="d-flex align-items-center gap-3 p-4">
                                    <div class="position-relative">
                                        <div class="wrapper-image"><img data-bb-lazy="true" class="rounded-circle border border-2 border-white shadow-sm" loading="lazy" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}"></img></div>
                                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white page_speed_2141159512"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                        <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.customer.sidebar', ['active' => 'addresses'])
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Add Address Modal -->
            <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <form action="{{ route('frontend.customer.addresses.store') }}" method="POST" class="modal-content">
                  @csrf
                  <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addAddressModalLabel">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="John Doe" value="{{ $customer->name ?? '' }}" {{ !empty($customer->name) ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required placeholder="example@domain.com" value="{{ $customer->email ?? '' }}" {{ !empty($customer->email) ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" required placeholder="123-456-7890" value="{{ $customer->phone ?? '' }}" {{ !empty($customer->phone) ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" required placeholder="123 Main St">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" required placeholder="New York">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" name="state" required placeholder="NY">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" required placeholder="10001">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" required placeholder="United States">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_default" value="1" id="is_default">
                                <label class="form-check-label" for="is_default">
                                    Set as default address
                                </label>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-please-wait">Save Address</button>
                  </div>
                </form>
              </div>
            </div>
            
        </div>
    </main>
@endsection

@push('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script>
$(document).ready(function() {
    // SweetAlert Delete Confirmation
    $('.btn-delete-address').on('click', function() {
        var addressId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This address will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-address-form-' + addressId).submit();
            }
        });
    });

    // Please Wait on Update/Save buttons
    $('form').on('submit', function() {
        var btn = $(this).find('.btn-please-wait');
        if (btn.length) {
            btn.prop('disabled', true);
            btn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Please wait...');
        }
    });
});
</script>
@endpush
