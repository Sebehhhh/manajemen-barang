<div class="left-side-bar">
    <div class="brand-logo">
        <a href="#">
            <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo">
            <img src="{{ asset('vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1 "></span><span class="mtext">Dashboard</span>
                    </a>
                </li>

                @if (Auth::check() && Auth::user()->isAdmin)
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="dropdown-toggle no-arrow {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <span class="micon dw dw-user"></span><span class="mtext">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('barang.index') }}"
                            class="dropdown-toggle no-arrow {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                            <span class="micon dw dw-box"></span><span class="mtext">Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('transaksi.index') }}"
                            class="dropdown-toggle no-arrow {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                            <span class="micon dw dw-money"></span><span class="mtext">Transaksi</span>
                        </a>
                    </li>
                @endif

                <!-- Menu untuk pengguna biasa -->
                @if (Auth::check() && !Auth::user()->isAdmin)
                    <li>
                        <a href="{{ route('barang.index') }}"
                            class="dropdown-toggle no-arrow {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                            <span class="micon dw dw-box"></span><span class="mtext">Barang</span>
                        </a>
                    </li>
                @endif


            </ul>
        </div>
    </div>
</div>
