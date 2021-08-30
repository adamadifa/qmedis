<div class="collapse navbar-collapse" id="navbar-menu">
    <ul class="navbar-nav pt-lg-3">
        @if (!empty(Auth::guard('user')->user()->level))
        @if (Auth::guard('user')->user()->level=="admin")
        <li class="nav-item {{ set_active(['dashboard']) }}">
            <a class="nav-link" href="{{url('dashboard ')}}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="5 12 3 12 12 3 21 12 19 12" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                    Home
                </span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is(['dokter','dokter/*','kategori',
                'kategori/*','supplier','supplier/*',
                'produk','produk/*',
                'satuan','satuan/*',
                'apotek','apotek/*',
                'persentaselaba','persentaselaba/*',
                'lokasiproduk','lokasiproduk/*']) ? 'show' : '' }}" href="#navbar-extra" data-toggle="dropdown"
                role="button" aria-expanded="{{ set_true(['karyawan','karyawan/create','unit']) }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/database -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                        <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
                        <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
                    </svg>
                </span>
                <span class="nav-link-title">
                    Data Master
                </span>
            </a>
            <div class="dropdown-menu  {{ request()->is(['dokter','dokter/*','kategori',
                'kategori/*','supplier','supplier/*',
                'produk','produk/*',
                'satuan','satuan/*',
                'apotek','apotek/*',
                'persentaselaba','persentaselaba/*',
                'lokasiproduk','lokasiproduk/*']) ? 'show' : '' }}">
                <a class="dropdown-item  {{ request()->is(['apotek','apotek/*']) ? 'active' : '' }}" href="/apotek">
                    <i class="fa fa-hospital-o mr-2"></i>Apotek
                </a>
                <a class="dropdown-item  {{ request()->is(['dokter','dokter/*']) ? 'active' : '' }}" href="/dokter">
                    <i class="fa fa-user mr-2"></i>Dokter
                </a>

                <a class="dropdown-item  {{ request()->is(['supplier','supplier/*']) ? 'active' : '' }}"
                    href="/supplier">
                    <i class="fa fa-user mr-2"></i>Supplier
                </a>
                <a class="dropdown-item  {{ request()->is(['kategori','kategori/*']) ? 'active' : '' }}"
                    href="/kategori">
                    <i class="fa fa-th-large mr-2"></i>Kategori
                </a>
                <a class="dropdown-item  {{ request()->is(['satuan','satuan/*']) ? 'active' : '' }}" href="/satuan">
                    <i class="fa fa-sort-amount-desc mr-2"></i>Satuan
                </a>
                <a class="dropdown-item  {{ request()->is(['produk','produk/*']) ? 'active' : '' }}" href="/produk">
                    <i class="fa fa-dropbox mr-2"></i>Produk
                </a>
                <a class="dropdown-item  {{ request()->is(['persentaselaba','persentaselaba/*']) ? 'active' : '' }}"
                    href="/persentaselaba">
                    <i class="fa fa-bar-chart-o  mr-2"></i>Persentase Laba
                </a>
                <a class="dropdown-item  {{ request()->is(['lokasiproduk','lokasiproduk/*']) ? 'active' : '' }}"
                    href="/lokasiproduk">
                    <i class="fa  fa-map-pin  mr-2"></i>Lokasi Produk
                </a>
            </div>

        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is(['opname','opname/*']) ? 'show' : '' }}"
                href="#navbar-extra" data-toggle="dropdown" role="button"
                aria-expanded="{{ set_true(['karyawan','karyawan/create','unit']) }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/building-warehouse -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21v-13l9 -4l9 4v13" />
                        <path d="M13 13h4v8h-10v-6h6" />
                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" /></svg>
                </span>
                <span class="nav-link-title">
                    Data Persediaan
                </span>
            </a>
            <div class="dropdown-menu  {{ request()->is(['opname','opname/*',
            'histori','histori/*']) ? 'show' : '' }}">
                <a class="dropdown-item  {{ request()->is(['opname','opname/*']) ? 'active' : '' }}" href="/opname">
                    <i class="fa fa-file-text-o mr-2"></i>Stok Opname
                </a>
                <a class="dropdown-item  {{ request()->is(['histori','histori/*']) ? 'active' : '' }}" href="/histori">
                    <i class="fa fa-file-text-o mr-2"></i>Riwayat Opname
                </a>


            </div>

        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is(['penjualan','penjualan/*']) ? 'show' : '' }}"
                href="#navbar-extra" data-toggle="dropdown" role="button"
                aria-expanded="{{ set_true(['karyawan','karyawan/create','unit']) }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="6" cy="19" r="2" />
                        <circle cx="17" cy="19" r="2" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" /></svg>
                </span>
                <span class="nav-link-title">
                    Data Pembelian
                </span>
            </a>
            <div class="dropdown-menu  {{ request()->is(['pembelian','pembelian/*',
            ]) ? 'show' : '' }}">
                <a class="dropdown-item  {{ request()->is(['pembelian/create']) ? 'active' : '' }}"
                    href="/penjualan/create">
                    <i class="fa fa-cart-plus mr-2"></i>Input Pembelian
                </a>
                <a class="dropdown-item  {{ request()->is(['pembelian']) ? 'active' : '' }}" href="/penjualan">
                    <i class="fa fa-cart-plus mr-2"></i>Data Pembelian
                </a>


            </div>

        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is(['penjualan','penjualan/*']) ? 'show' : '' }}"
                href="#navbar-extra" data-toggle="dropdown" role="button"
                aria-expanded="{{ set_true(['karyawan','karyawan/create','unit']) }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="6" cy="19" r="2" />
                        <circle cx="17" cy="19" r="2" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" /></svg>
                </span>
                <span class="nav-link-title">
                    Data Penjualan
                </span>
            </a>
            <div class="dropdown-menu  {{ request()->is(['penjualan','penjualan/*',
            ]) ? 'show' : '' }}">
                <a class="dropdown-item  {{ request()->is(['penjualan/create']) ? 'active' : '' }}"
                    href="/penjualan/create">
                    <i class="fa fa-cart-plus mr-2"></i>Input Penjualan
                </a>
                <a class="dropdown-item  {{ request()->is(['penjualan']) ? 'active' : '' }}" href="/penjualan">
                    <i class="fa fa-cart-plus mr-2"></i>Data Penjualan
                </a>
                <a class="dropdown-item  {{ request()->is(['penjualan/retur']) ? 'active' : '' }}"
                    href="/penjualan/retur">
                    <i class="fa  fa-exchange mr-2"></i>Retur Penjualan
                </a>
                <a class="dropdown-item  {{ request()->is(['penjualan/retur']) ? 'active' : '' }}"
                    href="/penjualan/retur">
                    <i class="fa  fa-exchange mr-2"></i>Data Retur
                </a>


            </div>

        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is(['laporan','laporan/*']) ? 'show' : '' }}"
                href="#navbar-extra" data-toggle="dropdown" role="button"
                aria-expanded="{{ set_true(['karyawan','karyawan/create','unit']) }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                    <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <line x1="9" y1="9" x2="10" y2="9" />
                        <line x1="9" y1="13" x2="15" y2="13" />
                        <line x1="9" y1="17" x2="15" y2="17" /></svg>
                </span>
                <span class="nav-link-title">
                    Laporan
                </span>
            </a>
            <div class="dropdown-menu  {{ request()->is(['laporan','laporan/*',
            ]) ? 'show' : '' }}">
                <a class="dropdown-item  {{ request()->is(['laporan/penjualan']) ? 'active' : '' }}"
                    href="/laporan/penjualan">
                    <i class="fa fa-file-text mr-2"></i>Penjualan
                </a>

                <a class="dropdown-item  {{ request()->is(['laporan/pembelian']) ? 'active' : '' }}"
                    href="/penjualan/create">
                    <i class="fa fa-file-text mr-2"></i>Pembelian
                </a>
            </div>

        </li>



        @endif
        @elseif (!empty(Auth::guard('karyawan')->user()->level))
        @if (Auth::guard('karyawan')->user()->level=="user")
        <li class="nav-item {{ set_active(['karyawan/'.Auth::guard('karyawan')->user()->npp]) }}">
            <a class="nav-link" href="/karyawan/{{Auth::guard('karyawan')->user()->npp}}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="5 12 3 12 12 3 21 12 19 12" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                    Home
                </span>
            </a>
        </li>

        @endif
        @endif
    </ul>

</div>
