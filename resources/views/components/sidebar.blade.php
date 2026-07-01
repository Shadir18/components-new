<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="/products" class="brand-link">
            <span class="brand-text fw-light">SpaceX Admin</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">
                
                <li class="nav-item">
                    <x-nav-link href="/products" :active="request()->is('products')">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Product</p>
                    </x-nav-link>
                </li>

                <li class="nav-item {{ request()->is('products/create') ? 'menu-open' : '' }}">
                    <x-nav-link href="#" class="nav-link {{ request()->is('products/create') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Actions
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </x-nav-link>
                    
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <x-nav-link href="/products/create" :active="request()->is('products/create')">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Create Product</p>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <x-nav-link href="/about" :active="request()->is('about')">
                        <i class="nav-icon bi bi-info-circle-fill"></i>
                        <p>About</p>
                    </x-nav-link>
                </li>

                <li class="nav-item">
                     <x-nav-link href="/contact" :active="request()->is('contact')">
                        <i class="nav-icon bi bi-envelope-fill"></i>
                        <p>Contact</p>
                    </x-nav-link>
                </li>
            </ul>
        </nav>
    </div>
</aside>