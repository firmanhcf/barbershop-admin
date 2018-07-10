<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">MENU</li>
                <li> <a class="has-arrow  " href="#" aria-expanded="true"><i class="fa fa-tachometer"></i><span class="">Dashboard </span></a>
                    <ul aria-expanded="true" class="collapse in">
                        <li><a href="{{ url('/') }}"> Dashboard Utama </a></li>
                        <li><a href="{{ url('transaction') }}"> Transaksi Harian </a></li>
                        @if(Auth::user()->staff_position < 7 || Auth::user()->staff_position == 8)
                        <li><a href="{{ url('operational') }}"> Biaya Operasional Outlet </a></li>
                        @endif
                    </ul>
                </li>

                @if(Auth::user()->staff_position < 6 || Auth::user()->staff_position == 7)
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="">Kemitraan </span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if(Auth::user()->staff_position < 6)
                        <li><a href="{{ url('partner') }}"> Partner/Investor </a></li>
                        @endif
                        <li><a href="{{ url('outlet') }}"> Outlet </a></li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->staff_position < 6)
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="">Manajemen </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('employee') }}"> Karyawan </a></li>
                        <li><a href="{{ url('asset') }}"> Aset </a></li>
                    </ul>
                </li>
                @endif

                @if(Auth::user()->staff_position == 0)
                <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-gear"></i><span class="">Admin </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('account') }}"> Akun Login </a></li>
                    </ul>
                </li>
                @endif
                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>