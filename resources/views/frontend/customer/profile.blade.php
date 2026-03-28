@extends('frontend.layouts.app')

@section('title', 'Account Settings')

@section('content')
  <main>
        <div class="bb-customer-page crop-avatar">
            <div class="container">
                <div class="customer-body">
                    <div class="d-lg-none bg-white border-bottom p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="wrapper-image page_speed_3267104">
                                    <img class="rounded-circle img-fluid shadow-sm" style="width:40px;height:40px;object-fit:cover;" src="{{ $customer->avatar_url }}" alt="{{ $customer->name ?? 'User' }}">
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
                                                    <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;object-fit:cover;" src="{{ $customer->avatar_url }}" alt="{{ $customer->name ?? 'User' }}">
                                                </div>
                                                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                                <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('frontend.customer.sidebar', ['active' => 'profile'])
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-9">
                            <div class="bb-profile-content p-4 p-md-5">
                                <div class="bb-profile-header mb-4">
                                    <h1 class="bb-profile-header-title h3 mb-0"> Account Settings </h1>
                                </div>
                                <div class="bb-profile-main">
                                    <div class="bb-customer-card-list account-settings-cards">
                                        
                                        {{-- Profile Information Card --}}
                                        <div class="card mb-4 border-0 shadow-sm rounded-3 overflow-hidden">
                                            <div class="card-header bg-white border-bottom p-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 text-primary">
                                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="h5 mb-1">Profile Information</h3>
                                                        <p class="text-muted small mb-0">Update your account profile information and email address.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-4">
                                                <form action="{{ route('frontend.customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row g-4">
                                                        <div class="col-12 mb-2">
                                                            <div class="d-flex align-items-center gap-4">
                                                                <div class="position-relative">
                                                                    <img id="avatar-preview" src="{{ $customer->avatar_url }}" 
                                                                         class="rounded-circle border border-2 border-primary-subtle shadow-sm" 
                                                                         style="width:100px; height:100px; object-fit:cover;" 
                                                                         alt="{{ $customer->name }}">
                                                                    <label for="avatar-input" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm cursor-pointer" style="width:32px; height:32px; display:flex; align-items:center; justify-content:center;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                                                    </label>
                                                                    <input type="file" id="avatar-input" name="avatar" class="d-none" accept="image/*" onchange="previewImage(this, 'avatar-preview')">
                                                                </div>
                                                                <div>
                                                                    <p class="small text-muted mb-0">Allowed JPG, GIF or PNG. Max size 2MB</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium" for="name">Full Name</label>
                                                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" required placeholder="Enter your full name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium" for="email">Email Address</label>
                                                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" required placeholder="Enter your email address">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium" for="phone">Phone Number</label>
                                                            <input class="form-control" type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" placeholder="e.g. 9876543210">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium" for="dob">Date of Birth</label>
                                                            <input class="form-control" type="date" id="dob" name="dob" value="{{ old('dob', $customer->dob ? $customer->dob->format('Y-m-d') : '') }}" placeholder="YYYY-MM-DD">
                                                        </div>

                                                        <div class="col-12 text-end">
                                                            <button type="submit" class="btn btn-primary px-4">
                                                                Update Profile
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Change Password Card --}}
                                        <div class="card mb-4 border-0 shadow-sm rounded-3 overflow-hidden">
                                            <div class="card-header bg-white border-bottom p-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 text-warning">
                                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6"></path>
                                                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                                            <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="h5 mb-1">Change Password</h3>
                                                        <p class="text-muted small mb-0">Ensure your account is using a long, random password to stay secure.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-4">
                                                <form action="{{ route('frontend.customer.profile.change-password') }}" method="POST">
                                                    @csrf
                                                    <div class="row g-4">
                                                        <div class="col-12">
                                                            <label class="form-label fw-medium" for="old_password">Current Password</label>
                                                            <input class="form-control" type="password" id="old_password" name="old_password" required autocomplete="current-password" placeholder="Enter your current password">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium" for="password">New Password</label>
                                                            <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password" placeholder="Enter new password">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-medium" for="password_confirmation">Confirm New Password</label>
                                                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm new password">
                                                        </div>

                                                        <div class="col-12 text-end">
                                                            <button type="submit" class="btn btn-primary px-4">
                                                                Change Password
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Delete Account Card --}}
                                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                                            <div class="card-header bg-white border-bottom p-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bg-danger bg-opacity-10 rounded-circle p-2 text-danger">
                                                        <svg class="icon text-danger" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h3 class="h5 mb-1 text-danger">Delete Account</h3>
                                                        <p class="text-muted small mb-0">Permanently delete your account and all associated data.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="alert alert-warning border-0 bg-warning-subtle d-flex align-items-start gap-3 mb-4" role="alert">
                                                    <svg class="icon text-warning flex-shrink-0 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 9v4"></path>
                                                        <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0"></path>
                                                        <path d="M12 16h.01"></path>
                                                    </svg>
                                                    <div>
                                                        <h6 class="alert-heading mb-1 fw-bold">Warning</h6>
                                                        <p class="mb-0 small fw-medium text-warning-emphasis">This action will permanently delete your account and is irreversible.</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-account-modal">
                                                    Delete your account
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Delete Account Modal --}}
                                    <div class="modal fade" id="delete-account-modal" tabindex="-1" aria-labelledby="delete-account-modal-title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header border-bottom p-4">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 text-danger">
                                                            <svg class="icon text-danger" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M12 9v4"></path>
                                                                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0"></path>
                                                                <path d="M12 16h.01"></path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h4 class="modal-title h5 mb-0" id="delete-account-modal-title">Delete Account</h4>
                                                            <p class="text-muted small mb-0">This action cannot be undone</p>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="alert alert-danger border-0 bg-danger-subtle d-flex align-items-start gap-3 mb-4" role="alert">
                                                        <svg class="icon text-danger flex-shrink-0 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 9h.01"></path>
                                                            <path d="M11 12h1v4h1"></path>
                                                        </svg>
                                                        <div>
                                                            <p class="mb-0 small fw-medium text-danger-emphasis text-center">We will send you an email to confirm your account deletion. Once you confirm, your account will be deleted permanently.</p>
                                                        </div>
                                                    </div>
                                                    <form method="POST" action="{{ route('frontend.customer.account.deletion.request') }}">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="del_password" class="form-label fw-semibold">Confirm your password</label>
                                                            <input type="password" id="del_password" name="password" class="form-control" placeholder="Enter your current password" required>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="reason" class="form-label fw-semibold">Reason (optional)</label>
                                                            <textarea id="reason" name="reason" class="form-control" rows="3" placeholder="Tell us why you want to delete your account..."></textarea>
                                                        </div>
                                                        <div class="d-flex gap-3">
                                                            <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger flex-fill">Delete Account</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
@push('scripts')
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@push('styles')
<style>
    .cursor-pointer {
        cursor: pointer;
    }
    .bg-opacity-10 {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
</style>
@endpush
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
                                            <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;object-fit:cover;" src="{{ $customer->avatar_url }}" alt="{{ $customer->name ?? 'User' }}">
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                        <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.customer.sidebar', ['active' => 'profile'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
