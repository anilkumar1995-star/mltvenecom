<div class="card">
    <div class="card-header">
        Vendor Menu
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('frontend.vendor.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('frontend.vendor.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('frontend.vendor.products.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('frontend.vendor.products.*') ? 'active' : '' }}">
            My Products
        </a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger"
           onclick="event.preventDefault(); document.getElementById('global-logout-form').submit();">
            Logout
        </a>
    </div>
</div>
