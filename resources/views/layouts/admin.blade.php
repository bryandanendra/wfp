<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Shopee Food</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #211C84;
            --primary-medium: #4D55CC;
            --primary-light: #7A73D1;
            --primary-very-light: #B5A8D5;
        }
        .sidebar {
            min-height: 100vh;
            background-color: var(--primary-dark);
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            border-radius: 0;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: var(--primary-medium);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: var(--primary-light);
        }
        .content {
            padding: 20px;
        }
        .main-header {
            background-color: var(--primary-medium);
            color: white;
            padding: 10px 0;
        }
        .footer {
            background-color: var(--primary-dark);
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .card {
            border-color: var(--primary-very-light);
        }
        .card-header {
            background-color: var(--primary-very-light);
            color: var(--primary-dark);
        }
        .card .card-title {
            color: var(--primary-dark);
        }
        .btn-primary {
            background-color: var(--primary-medium);
            border-color: var(--primary-medium);
        }
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        .bg-dark {
            background-color: var(--primary-dark) !important;
        }
        .bg-primary {
            background-color: var(--primary-medium) !important;
        }
        .table-dark {
            background-color: var(--primary-dark);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="p-3 mb-3" style="background-color: #191766;">
                    <h4>Shopee Food</h4>
                    <p>Admin Panel</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard-active')">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('food.index') }}" class="nav-link @yield('food-active')">
                            <i class="fas fa-utensils me-2"></i> Food
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link @yield('kategori-active')">
                            <i class="fas fa-tags me-2"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('members.index') }}" class="nav-link @yield('members-active')">
                            <i class="fas fa-users me-2"></i> Members
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link @yield('orders-active')">
                            <i class="fas fa-shopping-cart me-2"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reports') }}" class="nav-link @yield('reports-active')">
                            <i class="fas fa-chart-bar me-2"></i> Reports
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                <header class="main-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h3>@yield('title', 'Dashboard')</h3>
                            </div>
                        </div>
                    </div>
                </header>
                
                <main class="content">
                    @yield('content')
                </main>
                
                <footer class="footer">
                    <p>&copy; 2025 Shopee Food. All Rights Reserved.</p>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 