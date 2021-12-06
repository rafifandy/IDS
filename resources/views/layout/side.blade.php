<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            @if($x == 'home')
                            <a class="nav-link active" href="/h2">
                            @else
                            <a class="nav-link" href="/h2">
                            @endif
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Customer
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            @if($x == 'customer')
                            <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            @else
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            @endif
                                <nav class="sb-sidenav-menu-nested nav">
                                    @if($x == 'customer')
                                    <a class="nav-link active" href="/customer">Data Customer</a>
                                    @else
                                    <a class="nav-link" href="/customer">Data Customer</a>
                                    @endif
                                </nav>
                            </div>
                            @if($x == 'barang')
                            <a class="nav-link active" href="/barang">
                            @else
                            <a class="nav-link" href="/barang">
                            @endif
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Label TnJ 108
                            </a>
                            @if($x == 'toko')
                            <a class="nav-link active" href="/toko">
                            @else
                            <a class="nav-link" href="/toko">
                            @endif
                                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                                Toko
                            </a>
                    <div class="sb-sidenav-footer">
                        <div class="small"></div>
                        
                    </div>
                </nav>
            </div>