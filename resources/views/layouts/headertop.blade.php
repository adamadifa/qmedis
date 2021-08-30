<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">

                    @if (!empty(Auth::guard('karyawan')->user()->level))
                    <?php $path = Storage::url('foto/'.Auth::guard('karyawan')->user()->foto); ?>
                    <span class="avatar avatar"
                        style="margin-right:20px !important; background-image: url({{url($path)}}"></span>
                    @else

                    @endif
                    <div class="d-none d-xl-block pl-2 ml-3">
                        <div style="color:white">

                            @if (!empty(Auth::guard('user')->user()->name))
                            {{Auth::guard('user')->user()->name}}
                            @elseif(!empty(Auth::guard('karyawan')->user()->nama_lengkap))
                            {{Auth::guard('karyawan')->user()->nama_lengkap}}
                            @endif

                        </div>
                        <div class="mt-1 small text-muted"></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a href="/logout" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">

        </div>
    </div>
</header>