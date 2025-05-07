<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Modern Petshop Management System">
    <meta name="author" content="">
    <title>Petshop Dashboard</title>
    <!-- Custom fonts with modern choices -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Modern gradient styles -->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-gradient: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);
            --accent-color: #8e44ad;
            --hover-effect: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        /* Modern sidebar */
        #accordionSidebar {
            background: var(--sidebar-gradient);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            background: rgba(255, 255, 255, 0.1);
            margin: 1rem;
            border-radius: 12px;
            padding: 1rem 0;
            transition: var(--hover-effect);
        }

        .sidebar-brand:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .sidebar-brand-icon {
            transform: rotate(0deg);
            transition: transform 0.5s ease;
        }

        .sidebar-brand:hover .sidebar-brand-icon {
            transform: rotate(-15deg);
        }

        .sidebar-brand-text {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .nav-item {
            margin: 0.5rem 1rem;
            border-radius: 8px;
            overflow: hidden;
            transition: var(--hover-effect);
        }

        .nav-item:hover {
            transform: translateX(5px);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.75rem 1rem !important;
            border-radius: 8px !important;
            transition: var(--hover-effect) !important;
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1) !important;
            transform: translateX(5px);
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.1) !important;
            margin: 1rem;
        }

        .sidebar-heading {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 1rem;
        }

        /* Modern topbar */
        .topbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            height: 70px;
        }

        .navbar-search input {
            border-radius: 20px !important;
            border: 1px solid #e2e8f0 !important;
            padding: 0.5rem 1.25rem;
            transition: var(--hover-effect);
        }

        .navbar-search input:focus {
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 3px rgba(142, 68, 173, 0.1);
        }

        .navbar-search .btn {
            border-radius: 0 20px 20px 0 !important;
            background: var(--primary-gradient);
            border: none;
        }

        /* User dropdown */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            margin-top: 0;
            display: none;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: var(--hover-effect);
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        /* Content area */
        .container-fluid {
            padding: 2rem;
            background: #f8fafc;
        }

        /* Cards and content */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: var(--hover-effect);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            transition: var(--hover-effect);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* Footer */
        .sticky-footer {
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Logout modal */
        #logoutModal .modal-content {
            border-radius: 16px;
            overflow: hidden;
            border: none;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 4px;
        }

        /* Collapse animation */
        .collapse {
            transition: all 0.3s ease;
        }

        /* Modern select2 styling */
        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0 !important;
            height: auto !important;
            padding: 0.5rem 1rem !important;
        }

        /* User profile dropdown on hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        /* Remove hover shift effect for user profile */
        .nav-item.dropdown.no-arrow {
            margin: 0;
        }

        .nav-item.dropdown.no-arrow:hover {
            transform: none;
        }

        .nav-item.dropdown.no-arrow .nav-link {
            padding: 0.5rem !important;
        }

        .nav-item.dropdown.no-arrow .nav-link:hover {
            transform: none;
            background: transparent !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #accordionSidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                position: fixed;
                z-index: 1040;
                height: 100vh;
            }

            #accordionSidebar.show {
                transform: translateX(0);
            }

            #content {
                margin-left: 0 !important;
            }

            /* Show dropdown on click for mobile */
            .nav-item.dropdown .dropdown-menu {
                display: none;
            }

            .nav-item.dropdown.show .dropdown-menu {
                display: block;
                position: absolute;
            }
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-paw"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Petshop Pro</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">Navigation</div>
            <!-- Nav Items -->
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/jenis">
                    <i class="fas fa-tags"></i>
                    <span>Transaction Types</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="true" aria-controls="collapseTransaksi">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transactions</span>
                    <i class="fas fa-fw fa-caret-down float-right"></i>
                </a>
                <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaction Types:</h6>
                        <a class="collapse-item" href="/transaksi/pemasukan/1">
                            <i class="fas fa-arrow-circle-down text-success mr-2"></i>Income
                        </a>
                        <a class="collapse-item" href="/transaksi/pengeluaran/0">
                            <i class="fas fa-arrow-circle-up text-danger mr-2"></i>Expenses
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/sumberdana">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Funding Sources</span>
                </a>
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST" class="ml-3">
                    @csrf
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control border-0" placeholder="Search transactions..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn" type="button" style="background: var(--primary-gradient); color: white;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::check())
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name ?? Auth::user()->email }}</span>
                                @endif
                                <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>© 2025 Petshop Pro | Designed with <i class="fas fa-heart text-danger"></i> by Nasril Saputra</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to logout from your current session?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <script>
        // Modern sidebar toggle for mobile
        $(document).ready(function() {
            $('#sidebarToggleTop').click(function() {
                $('#accordionSidebar').toggleClass('show');
            });

            // Add smooth scrolling to all links
            $("a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function(){
                        window.location.hash = hash;
                    });
                }
            });

            // Ensure dropdown works on mobile
            $(window).resize(function() {
                if ($(window).width() <= 768px) {
                    $('.nav-item.dropdown').off('mouseenter mouseleave');
                } else {
                    $('.nav-item.dropdown').hover(
                        function() {
                            $(this).addClass('show');
                            $(this).find('.dropdown-menu').addClass('show');
                        },
                        function() {
                            $(this).removeClass('show');
                            $(this).find('.dropdown-menu').removeClass('show');
                        }
                    );
                }
            }).resize(); // Trigger on load
        });
    </script>
</body>
</html>
