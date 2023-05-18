<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)" data-bs-toggle="modal"
        data-bs-target="#changeAvatarModal"><i data-feather="settings"></i></a><img
            class="img-90 rounded-circle" src="{{ Auth::user()->avatar }}"
            alt="" />
        {{-- <div class="badge-bottom"><span class="badge badge-primary">New</span></div> --}}
        <a href="javascript:void(0)">
            <h6 class="mt-3 f-14 f-w-600">{{Auth::user()->name}}</h6>
        </a>
        <p class="mb-0 font-roboto">{{$pegawai_data->jabatan}}</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i
                                class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="{{route('home')}}"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="airplay"></i><span>Widgets</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../widgets/general-widget.html" class="">General</a></li>
                            <li><a href="../widgets/chart-widget.html" class="">Chart</a></li>
                        </ul>
                    </li> --}}
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="#"><i data-feather="user"></i><span>Change Password</span></a>
                    </li>

                    @if (Auth::user()->role == '1' || Auth::user()->role == '2')
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Master</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href={{ Auth::user()->role == '1' ? route('pegawai.index') : route('pegawai.index')}}><i
                                data-feather="box"></i><span>Pegawai</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href={{route('bobot.edit')}}><i
                            data-feather="box"></i><span>Edit Bobot</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href={{ Auth::user()->role == '1' ? route('kegiatan.index') : route('kegiatan.index')}}><i
                                data-feather="box"></i><span>Kegiatan</span></a>
                    </li>
                    @endif
                    
                    {{-- <li class="sidebar-main-title">
                        <div>
                            <h6>Daily Report</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('home') }}"><i data-feather="activity"></i></i><span>Daily Report</span></a>
                    </li>
                    @if (Auth::user()->role == '1' || Auth::user()->role == '2' ) 
                    <li class="dropdown">
                        <a class="nav-link " href={{ Auth::user()->role == '1' ? route('home') : route('home')}}><i
                                data-feather="activity"></i><span>Report Daily Pegawai</span></a>
                    </li>
                    @endif --}}

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Kinerja Pegawai</h6>
                        </div>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="nav-link " href="{{route('home')}}"><i
                                data-feather="server"></i><span>Pengajuan Cuti</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../bootstrap-tables/bootstrap-basic-table.html"
                                    class="">Basic Tables</a></li>
                            <li><a href="../bootstrap-tables/bootstrap-sizing-table.html"
                                    class="">Sizing Tables</a></li>
                            <li><a href="../bootstrap-tables/bootstrap-border-table.html"
                                    class="">Border Tables</a></li>
                            <li><a href="../bootstrap-tables/bootstrap-styling-table.html"
                                    class="">Styling Tables</a></li>
                            <li><a href="../bootstrap-tables/table-components.html" class="">Table
                                    components</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href="{{route('home')}}"><i
                                data-feather="database"></i><span>Cuti Saya</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="../data-tables/datatable-basic-init.html" class="">Basic
                                    Init</a></li>
                            <li><a href="../data-tables/datatable-advance.html" class="">Advance
                                    Init</a></li>
                            <li><a href="../data-tables/datatable-styling.html" class="">Styling</a>
                            </li>
                            <li><a href="../data-tables/datatable-AJAX.html" class="">AJAX</a></li>
                            <li><a href="../data-tables/datatable-server-side.html" class="">Server
                                    Side</a></li>
                            <li><a href="../data-tables/datatable-plugin.html" class="">Plug-in</a>
                            </li>
                            <li><a href="../data-tables/datatable-API.html" class="">API</a></li>
                            <li><a href="../data-tables/datatable-data-source.html" class="">Data
                                    Sources</a></li>
                        </ul>
                    </li>
                    @if (Auth::user()->role == "1")
                    <li class="dropdown">
                        <a class="nav-link " href={{route('home')}}><i class="fas fa-fingerprint me-3"></i><span>Check Fingerprint</span></a>
                    </li> --}}
                    <li class="dropdown">
                        <a class="nav-link " href={{route('penilaian.index')}}><i
                            data-feather="database"></i><span>Penilaian</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href={{route('perhitungan.index')}}><i
                            data-feather="database"></i><span>Perhitungan</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href="{{route('home')}}"><i data-feather="file"></i><span>Cetak Laporan</span></a>
                    </li>
                    {{-- @elseif(Auth::user()->role == "2")
                    <li class="dropdown">
                        <a class="nav-link " href={{route('home')}}><i
                            data-feather="box"></i><span>Data Cuti Pegawai</span></a>
                    </li>
                    @endif
                    <li class="dropdown mb-5">
                        <a class="nav-link " href="{{route('home')}}"><i data-feather="database"></i><span>Hasil Kinerja</span><br><span class="ms-4">&nbsp;&nbsp;Libur Nasional</span></a>
                    </li> --}}
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>