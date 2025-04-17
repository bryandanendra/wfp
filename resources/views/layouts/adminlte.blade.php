<!doctype html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title') - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Resto App" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Fonts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4D55CC;
            --secondary-color: #7A73D1;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
        }
        
        body {
            font-family: 'Source Sans 3', sans-serif;
            background-color: #f4f6f9;
        }
        
        .app-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .app-header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            height: 56px;
        }
        
        .app-sidebar {
            width: var(--sidebar-width);
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            z-index: 100;
            box-shadow: 2px 0 5px rgba(0,0,0,.1);
            transition: width 0.3s;
        }
        
        .sidebar-brand {
            height: 56px;
            display: flex;
            align-items: center;
            padding-left: 1rem;
            padding-right: 1rem;
            background-color: #2c3136;
        }
        
        .brand-link {
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 600;
        }
        
        .brand-image {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        
        .sidebar-wrapper {
            overflow-y: auto;
            height: calc(100% - 56px);
        }
        
        .sidebar-menu .nav-link {
            color: rgba(255,255,255,.7);
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        
        .sidebar-menu .nav-link:hover, 
        .sidebar-menu .nav-link.active {
            color: #ffffff;
            background-color: rgba(255,255,255,.1);
        }
        
        .nav-icon {
            margin-right: 10px;
        }
        
        .app-main {
            margin-left: var(--sidebar-width);
            margin-top: 56px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.3s;
        }
        
        .app-content-header {
            padding: 10px 0 20px 0;
        }
        
        .app-footer {
            text-align: center;
            padding: 15px;
            background-color: #ffffff;
            border-top: 1px solid #dee2e6;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s;
        }
        
        .card-outline {
            border-top: 3px solid;
        }
        
        .card-outline.card-primary {
            border-top-color: var(--primary-color);
        }
        
        .card-outline.card-info {
            border-top-color: #17a2b8;
        }
        
        .card-outline.card-success {
            border-top-color: #28a745;
        }
        
        .card-outline.card-warning {
            border-top-color: #ffc107;
        }
        
        .card-outline.card-danger {
            border-top-color: #dc3545;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .app-sidebar {
                width: var(--sidebar-collapsed-width);
            }
            
            .sidebar-wrapper p,
            .brand-text {
                display: none;
            }
            
            .app-main,
            .app-footer {
                margin-left: var(--sidebar-collapsed-width);
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- App Wrapper -->
    <div class="app-wrapper">
      <!-- Header -->
      <nav class="app-header navbar navbar-expand bg-light">
        <!-- Container -->
        <div class="container-fluid">
          <!-- Start Navbar Links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#" role="button" id="toggle-sidebar">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
          </ul>
          <!-- End Start Navbar Links -->
          
          <!-- End Navbar Links -->
          <ul class="navbar-nav ms-auto">            
            <!-- User Menu Dropdown -->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i>
                <span class="d-none d-md-inline">Admin</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!-- User Image -->
                <li class="user-header bg-primary text-white p-3 text-center">
                  <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                  <p>
                    Admin - Resto Manager
                    <small>Member since 2023</small>
                  </p>
                </li>
                <!-- Menu Footer -->
                <li class="user-footer d-flex justify-content-between p-3">
                  <a href="#" class="btn btn-default btn-sm">Profile</a>
                  <a href="#" class="btn btn-default btn-sm">Sign out</a>
                </li>
                <!-- End Menu Footer -->
              </ul>
            </li>
            <!-- End User Menu Dropdown -->
          </ul>
          <!-- End End Navbar Links -->
        </div>
        <!-- End Container -->
      </nav>
      <!-- End Header -->
      
      <!-- Sidebar -->
      <aside class="app-sidebar">
        <!-- Sidebar Brand -->
        <div class="sidebar-brand">
          <!-- Brand Link -->
          <a href="{{ route('dashboard') }}" class="brand-link">
            <!-- Brand Image -->
            <i class="bi bi-book fs-4"></i>
            <!-- Brand Text -->
            <span class="brand-text ms-2">Resto Admin</span>
            <!-- End Brand Text -->
          </a>
          <!-- End Brand Link -->
        </div>
        <!-- End Sidebar Brand -->
        
        <!-- Sidebar Wrapper -->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!-- Sidebar Menu -->
            <ul
              class="nav sidebar-menu flex-column"
              role="menu"
            >
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard-active')">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link @yield('categories-active')">
                  <i class="nav-icon bi bi-tags-fill"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('food.index') }}" class="nav-link @yield('food-active')">
                  <i class="nav-icon bi bi-egg-fried"></i>
                  <p>Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('orders.index') }}" class="nav-link @yield('orders-active')">
                  <i class="nav-icon bi bi-cart-fill"></i>
                  <p>Pesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('reports') }}" class="nav-link @yield('reports-active')">
                  <i class="nav-icon bi bi-bar-chart-fill"></i>
                  <p>Laporan</p>
                </a>
              </li>
            </ul>
            <!-- End Sidebar Menu -->
          </nav>
        </div>
        <!-- End Sidebar Wrapper -->
      </aside>
      <!-- End Sidebar -->
      
      <!-- Content Wrapper -->
      <main class="app-main">
        <!-- Content Header -->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">@yield('title')</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- End Content Header -->
        
        <!-- Main Content -->
        <div class="app-content">
          <div class="container-fluid">
            @yield('content')
          </div>
        </div>
        <!-- End Main Content -->
      </main>
      <!-- End Content Wrapper -->
      
      <!-- Footer -->
      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Resto Admin Panel</div>
        <strong>Copyright &copy; 2023-2024</strong>
        All rights reserved.
      </footer>
      <!-- End Footer -->
    </div>
    <!-- End App Wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
    
    <!-- Bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha256-CDcpP32dxQiN95qlVI9rJsqHn95nWPtJ5tGgQXUV6a4="
      crossorigin="anonymous"
    ></script>
    
    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar
            const toggleBtn = document.getElementById('toggle-sidebar');
            const sidebar = document.querySelector('.app-sidebar');
            const mainContent = document.querySelector('.app-main');
            const footer = document.querySelector('.app-footer');
            
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                
                if (sidebar.classList.contains('collapsed')) {
                    sidebar.style.width = 'var(--sidebar-collapsed-width)';
                    mainContent.style.marginLeft = 'var(--sidebar-collapsed-width)';
                    footer.style.marginLeft = 'var(--sidebar-collapsed-width)';
                    
                    const textElements = sidebar.querySelectorAll('.sidebar-menu p, .brand-text');
                    textElements.forEach(el => {
                        el.style.display = 'none';
                    });
                } else {
                    sidebar.style.width = 'var(--sidebar-width)';
                    mainContent.style.marginLeft = 'var(--sidebar-width)';
                    footer.style.marginLeft = 'var(--sidebar-width)';
                    
                    const textElements = sidebar.querySelectorAll('.sidebar-menu p, .brand-text');
                    textElements.forEach(el => {
                        el.style.display = 'block';
                    });
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html> 