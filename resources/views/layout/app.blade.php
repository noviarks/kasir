<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="/assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Date picker -->
    <link href="/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <!-- Css -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="/assets/images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="/assets/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="/assets/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="/assets/images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="/profile"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <hr class="my-2">
                                        <li><a href="/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <!-- <li class="nav-label">Dashboard</li> -->
                    <li>
                        <a href="/home" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    @if (Auth::user()->role == 'admin')
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">Master</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/user">User</a></li>
                            <li><a href="/jenis-barang">Jenis Barang</a></li>
                            <li><a href="/barang">Barang</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Laporan</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/laporan/transaksi">Transaksi</a></li>
                        </ul>
                    </li>
                    @endif

                    @if (Auth::user()->role == 'kasir')
                    <li>
                        <a href="/transaksi" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Transaksi</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="/assets/plugins/common/common.min.js"></script>
    <script src="/assets/js/custom.min.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/gleek.js"></script>
    <script src="/assets/js/styleSwitcher.js"></script>

    <script src="/assets/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <script src="/assets/js/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/assets/js/sweetalert/sweetalert.min.js"></script>

    <script src="/assets/plugins/moment/moment.js"></script>
   
    <script src="/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <script src="/assets/plugins/select2/js/select2.full.min.js"></script>

    @stack('transaksi_script')

    @stack('laporan_script')

    @if (session('success'))
        <script>
            var SweetAlert2Demo = function(){
                var initDemos   = function(){
                    swal({
                        title   : "Berhasil",
                        text    : "{{ session('success') }}",
                        icon    : "success",
                        buttons : {
                            confirm: {
                                text        : "OK",
                                value       : true,
                                visible     : true,
                                className   : "btn btn-success",
                                closeModal  : true
                            }
                        }
                    })
                };

                return{
                    init : function(){
                        initDemos();
                    }
                };

            }();

            jQuery(document).ready( function(){
                SweetAlert2Demo.init();
            });

        </script>
    @endif

    @if (session('error'))
        <script>
            var SweetAlert2Demo = function(){
                var initDemos   = function(){
                    swal({
                        title   : "Error",
                        text    : "{{ session('error') }}",
                        icon    : "error",
                        buttons : {
                            confirm: {
                                text        : "OK",
                                value       : true,
                                visible     : true,
                                className   : "btn btn-danger",
                                closeModal  : true
                            }
                        }
                    })
                };

                return{
                    init : function(){
                        initDemos();
                    }
                };

            }();

            jQuery(document).ready( function(){
                SweetAlert2Demo.init();
            });

        </script>
    @endif
</body>

</html>