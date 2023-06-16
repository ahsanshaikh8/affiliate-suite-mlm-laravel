<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">  {{ Auth::user()->name }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item {{ (request()->segment(2) == 'users') ? 'menu-open' : '' }} ">
                <a href="{{ route ('admin.users') }}" class="nav-link {{ (request()->segment(2) == 'users') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                    Users
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route ('admin.user.create') }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add Afiliate</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('admin.users') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Show Affliate</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('admin.user.tree') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Show Tree</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  {{ (request()->segment(2) == 'products') ? 'menu-open' : '' }}">
                <a href="{{ route ('admin.products.index') }}" class="nav-link {{ (request()->segment(2) == 'products') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                    Products
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route ('admin.products.index') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>List All</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('admin.products.create') }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Create New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  {{ (request()->segment(2) == 'orders') ? 'menu-open' : '' }}">
                <a href="{{ route ('admin.orders.index') }}" class="nav-link {{ (request()->segment(2) == 'orders') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                    Orders
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route ('admin.orders.index') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>List All</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('admin.orders.create') }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Create New</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Settings
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</div>