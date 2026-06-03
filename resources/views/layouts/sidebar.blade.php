<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Main Menu</span>
</li>

<li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-dashboard"></i>
        <div>Dashboard</div>
    </a>
</li>

<li class="menu-item {{ request()->routeIs('admin.products.*') ? 'active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-box"></i>
        <div>Products</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('admin.products.index') }}" class="menu-link">
                <div>All Products</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.products.create') }}" class="menu-link">
                <div>Add Product</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
    <a href="{{ route('admin.categories.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-tags"></i>
        <div>Categories</div>
    </a>
</li>

<li class="menu-item {{ request()->routeIs('admin.stock.*') ? 'active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-warehouse"></i>
        <div>Stock Management</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('admin.stock.index') }}" class="menu-link">
                <div>Manage Stock</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.stock.history') }}" class="menu-link">
                <div>Stock History</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
    <a href="{{ route('admin.banners.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-photo"></i>
        <div>Banners</div>
    </a>
</li>

<li class="menu-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
    <a href="{{ route('admin.testimonials.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-star"></i>
        <div>Testimonials</div>
    </a>
</li>

<li class="menu-item {{ request()->routeIs('admin.articles.*') ? 'active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-news"></i>
        <div>Blog</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('admin.articles.index') }}" class="menu-link">
                <div>All Articles</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('admin.articles.create') }}" class="menu-link">
                <div>Add Article</div>
            </a>
        </li>
    </ul>
</li>

<li class="menu-header small text-uppercase mt-3">
    <span class="menu-header-text">Settings</span>
</li>

<li class="menu-item {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
    <a href="{{ route('admin.about.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-info-circle"></i>
        <div>About Us</div>
    </a>
</li>

<li class="menu-item {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
    <a href="{{ route('admin.contact.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-address-book"></i>
        <div>Contact</div>
    </a>
</li>

<hr class="my-2">

<li class="menu-item">
    <a href="{{ route('home') }}" class="menu-link" target="_blank">
        <i class="menu-icon tf-icons ti ti-external-link"></i>
        <div>View Website</div>
    </a>
</li>

<li class="menu-item">
    <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf
        <a href="javascript:void(0);" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="menu-icon tf-icons ti ti-logout"></i>
            <div>Logout</div>
        </a>
    </form>
</li>