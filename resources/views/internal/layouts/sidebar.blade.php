    <div class="navbar-default sidebar" role="navigation" style="">
    <img src="{{asset('assets/img/logo.png')}}" alt="" srcset="" class="img-logo">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ route('upload') }}"><i class="fa fa-upload fa-fw"></i> Input Penggajian</a>
                </li>
                <li>
                    <a href="{{ route('slipgaji') }}"><i class="fa fa-print fa-fw"></i> Slip Gaji</a>
                </li>
                <li>
                    <a href="{{ route('jabatan') }}"><i class="fa fa-users fa-fw"></i> Jabatan</a>
                </li>
                {{-- <li>
                    <a href="{{ route('tunjangan') }}"><i class="fa fa-money fa-fw"></i> Tunjangan</a>
                </li>
                <li>
                    <a href="{{ route('transport') }}"><i class="fa fa-bus fa-fw"></i> Transport</a>
                </li> --}}
                <li>
                    <a href="{{ route('karyawan') }}"><i class="fa fa-users fa-fw"></i> Karyawan</a>
                </li>
                <li>
                    <a href="{{ route('pengguna') }}"><i class="fa fa-user-plus fa-fw"></i> Pengguna</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<style>
    .img-logo{
        width: 100px;
        position: absolute;
        top: 20px;
        left: 80px;
    }
    #side-menu li {
        border: none !important;
        margin-bottom: 10px;

    }
    #side-menu li a{
        color: #fff;
    }

    .sidebar ul li a{
        margin-left: 20px;
        transition: all 0.3s ease;
    }
    .sidebar ul li a.active,
    .sidebar ul li a:hover {
    border-radius: 30px 0px 0px 30px;
    background-color: #f3b643;
    color: #002e6d !important;
    margin-left: 20px;
}
#page-wrapper{
    border-left: none !important;
}
.navbar-default.sidebar{
    height: 100%;
    position: fixed;
    background: rgb(0,46,109);
    background: linear-gradient(0deg, rgba(0,46,109,1) 0%, rgba(0,46,109,1) 100%);
    margin-top: 0;
    padding-top: 150px;
    /* width: 20%; */
}
.navbar-header{
    left: 250px;
    position: relative;
}
.navbar-default {
    background-color: #ffffff;
    border-color: #ffffff;
}
.navbar-top-links li a{
    color: #012e6e !important;
}
i.fa.fa-user.fa-fw {
    background:#012e6e;
    width: 30px;
    height: 30px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: #fff;
    box-shadow: 1px 2px 5px 1px #0000002e;
}
.navbar-top-links li.dropdown a:hover{
    background: transparent !important;
}
@media(max-width:760px) {
    .img-logo{
        display: none;
    }
}
</style>