<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <title>Admin Dashboard</title>

    <style>
        /* BODY */
        body {
            background: #f1f3f6;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #111827;
            color: white;
            padding-top: 20px;
        }

        /* SIDEBAR HEADER */
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            font-weight: 600;
        }

        /* MENU */
        .nav-menu {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            color: #d1d5db;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-link:hover {
            background: #1f2937;
            color: white;
        }

        .nav-link.active {
            background: #2563eb;
            color: white;
            border-left: 4px solid #60a5fa;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 35px;
        }

        /* USER INFO */
        .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .user-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* LOGOUT */
        .logout-btn {
            background: #ef4444;
            border: none;
            padding: 7px 16px;
            border-radius: 6px;
            color: white;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* GRID CARD */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        /* CARD */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-6px);
        }

        /* ICON */
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            margin-bottom: 10px;
        }

        .purple {
            background: #7c3aed;
        }

        .orange {
            background: #f97316;
        }

        .green {
            background: #10b981;
        }

        .stat-card h3 {
            font-size: 26px;
            font-weight: 600;
        }

        .stat-card p {
            color: #6b7280;
        }

        /* QUICK ACTION */
        .quick-actions {
            margin-top: 40px;
        }

        .action-btn {
            display: inline-block;
            background: #2563eb;
            padding: 10px 18px;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 10px;
            transition: 0.3s;
        }

        .action-btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

    @include('admin.sidebar')
    <div class="main-content">
        <h4>Welcome To Admin Dashboard</h4>
        <div class="user-info">
            <div class="user-left">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h3>{{ $productCount }}</h3>
                <p>Total Product</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="bi bi-cart-check"></i>
                </div>
                <h3>{{ $orderCount }}</h3>
                <p>Total Orders</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h3>{{ $revenue }}</h3>
                <p>Total Revenue</p>
            </div>
        </div>
        <div class="quick-actions">
            <h4>Quick Action</h4>
            <a href="{{ route('product.index') }}" class="action-btn">
                <i class="bi bi-box-seam"></i> Manage Product
            </a>
            <a href="{{ route('product.create') }}" class="action-btn">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
        </div>
    </div>
</body>

</html>
