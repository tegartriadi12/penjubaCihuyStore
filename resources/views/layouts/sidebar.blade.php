<nav class="top-nav">
    <ul>

        {{-- =======================
            ADMIN, OWNER, KASIR, GUDANG (semua punya dashboard)
        ======================== --}}
        <li>
            <a href="/dashboard" class="top-menu">
                <div class="top-menu__icon"><i data-feather="home"></i></div>
                <div class="top-menu__title">Dashboard</div>
            </a>
        </li>


        {{-- =======================
            ADMIN ONLY – MASTER DATA
        ======================== --}}
        @if(auth()->user()->role == 'admin')
        <li>
            <a href="javascript:;" class="top-menu">
                <div class="top-menu__icon"><i data-feather="database"></i></div>
                <div class="top-menu__title">Master Data
                    <i data-feather="chevron-down" class="top-menu__sub-icon"></i>
                </div>
            </a>
            <ul>
                <li><a href="{{route('products.index')}}" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="box"></i></div>
                    <div class="top-menu__title">Produk</div></a>
                </li>

                <li><a href="{{route('categories.index')}}" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="tag"></i></div>
                    <div class="top-menu__title">Kategori</div></a>
                </li>

                <li><a href="{{route('units.index')}}" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="layers"></i></div>
                    <div class="top-menu__title">Satuan</div></a>
                </li>

                <li><a href="{{route('suppliers.index')}}" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="truck"></i></div>
                    <div class="top-menu__title">Supplier</div></a>
                </li>
            </ul>
        </li>
        @endif



        {{-- =======================
            ADMIN & OWNER – PEMBELIAN
        ======================== --}}
        @if(in_array(auth()->user()->role, ['admin','owner']))
        <li>
            <a href="{{route('purchases.index')}}" class="top-menu">
                <div class="top-menu__icon"><i data-feather="shopping-bag"></i></div>
                <div class="top-menu__title">Pembelian</div>
            </a>
        </li>
        @endif



        {{-- =======================
            ADMIN & KASIR – PENJUALAN
        ======================== --}}
        @if(in_array(auth()->user()->role, ['admin','kasir']))
        <li>
            <a href="javascript:;" class="top-menu">
                <div class="top-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="top-menu__title">Penjualan
                    <i data-feather="chevron-down" class="top-menu__sub-icon"></i>
                </div>
            </a>
            <ul>
                <li>
                    <a href="/pos" class="top-menu">
                        <div class="top-menu__icon"><i data-feather="monitor"></i></div>
                        <div class="top-menu__title">Kasir / POS</div>
                    </a>
                </li>
                <li>
                    <a href="/transactions" class="top-menu">
                        <div class="top-menu__icon"><i data-feather="clipboard"></i></div>
                        <div class="top-menu__title">Riwayat Transaksi</div>
                    </a>
                </li>
                <li>
                    <a href="/shift/close" class="top-menu">
                        <div class="top-menu__icon"><i data-feather="lock"></i></div>
                        <div class="top-menu__title">Close Shift</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif



        {{-- =======================
            ADMIN & KASIR – RETUR BARANG
        ======================== --}}
        @if(in_array(auth()->user()->role, ['admin','kasir']))
        <li>
            <a href="{{route('returns.index')}}" class="top-menu">
                <div class="top-menu__icon"><i data-feather="rotate-ccw"></i></div>
                <div class="top-menu__title">Return Barang</div>
            </a>
        </li>
        @endif



        {{-- =======================
            ADMIN & GUDANG – GUDANG & STOK
        ======================== --}}
        @if(in_array(auth()->user()->role, ['admin','gudang']))
        <li>
            <a href="javascript:;" class="top-menu">
                <div class="top-menu__icon"><i data-feather="archive"></i></div>
                <div class="top-menu__title">Gudang
                    <i data-feather="chevron-down" class="top-menu__sub-icon"></i>
                </div>
            </a>
            <ul>
                <li><a href="/stock" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="layers"></i></div>
                    <div class="top-menu__title">Dashboard Stok</div></a>
                </li>

                <li><a href="/stock/in" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="arrow-down"></i></div>
                    <div class="top-menu__title">Stok Masuk</div></a>
                </li>

                <li><a href="/stock/out" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="arrow-up"></i></div>
                    <div class="top-menu__title">Stok Keluar</div></a>
                </li>

                <li><a href="/stock/mutation" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="shuffle"></i></div>
                    <div class="top-menu__title">Mutasi Stok</div></a>
                </li>

                <li><a href="/stock/opname" class="top-menu">
                    <div class="top-menu__icon"><i data-feather="clipboard"></i></div>
                    <div class="top-menu__title">Stok Opname</div></a>
                </li>
            </ul>
        </li>
        @endif



        {{-- =======================
            ADMIN & OWNER – LAPORAN
        ======================== --}}
        @if(in_array(auth()->user()->role, ['admin','owner']))
        <li>
            <a href="/reports" class="top-menu">
                <div class="top-menu__icon"><i data-feather="bar-chart-2"></i></div>
                <div class="top-menu__title">Laporan</div>
            </a>
        </li>
        @endif



        {{-- =======================
            ADMIN ONLY – USER MANAGEMENT & SETTINGS
        ======================== --}}
        @if(auth()->user()->role == 'admin')
        <li>
            <a href="{{route('users.index')}}" class="top-menu">
                <div class="top-menu__icon"><i data-feather="users"></i></div>
                <div class="top-menu__title">User Management</div>
            </a>
        </li>

        <li>
            <a href="/settings" class="top-menu">
                <div class="top-menu__icon"><i data-feather="settings"></i></div>
                <div class="top-menu__title">Setting Toko</div>
            </a>
        </li>
        @endif

    </ul>
</nav>
