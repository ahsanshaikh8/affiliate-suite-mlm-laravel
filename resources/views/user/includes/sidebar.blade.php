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
         
            <li class="nav-item  {{ (request()->segment(2) == 'users') ? 'menu-open' : '' }}">
                <a href="{{ route ('users') }}" class="nav-link {{ (request()->segment(2) == 'users') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                    Users
                    </p>
                </a>
            </li>
                <li class="nav-item">
                        <a href="{{ route ('user.create') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add Affliate</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('users') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Show Affliate</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('user.tree') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Show Tree</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('user.referral') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Referral Link</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route ('user.earnings') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Earnings</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route ('user.withdraw') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Withdraw</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Buy More Nfts</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Buy Coin</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Mint NFT</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Support</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route ('user.marketing') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Marketing</p>
                        </a>
                    </li>
                    <li class="nav-item  {{ (request()->segment(2) == 'orders') ? 'menu-open' : '' }}">
                <a href="{{ route ('user.orders.index') }}" class="nav-link {{ (request()->segment(2) == 'orders') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                    Orders
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route ('user.orders.index') }}" class="nav-link ">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>List All</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route ('user.orders.create') }}" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Create New</p>
                        </a>
                    </li>
                </ul>
            </li>
            
          
        </ul>
    </nav>
</div>