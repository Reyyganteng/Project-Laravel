<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* IMPORT FONT */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* RESET */
        * {
            box-sizing: border-box;
        }

        /* BODY */
        body {
            background: #f1f4f9;
            font-family: 'Poppins', sans-serif;
            color: #374151;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #111827;
            color: white;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 3px 0 20px rgba(0, 0, 0, 0.08);
        }

        /* SIDEBAR HEADER */
        .sidebar-header {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 18px;
        }

        /* MENU */
        .nav-menu {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }

        /* MENU ITEM */
        .nav-item {
            margin: 6px 12px;
        }

        /* MENU LINK */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #d1d5db;
            text-decoration: none;
            font-size: 14px;
            transition: all .25s ease;
        }

        /* ICON */
        .nav-link i {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        /* HOVER */
        .nav-link:hover {
            background: #1f2937;
            color: white;
            transform: translateX(3px);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 35px;
        }

        /* TOP BAR */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        /* USER INFO */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* USER AVATAR */
        .user-avatar {
            width: 42px;
            height: 42px;
            background: #2563eb;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* LOGOUT */
        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            margin-top: 2px;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* WELCOME CARD */
        .welcome-card {
            margin-top: 25px;
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            color: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .welcome-card h3 {
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {

            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
            }

        }
    </style>

</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>Customer Panel</h4>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('customer.dashboard') }}" class="nav-link">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer.products') }}" class="nav-link">
                    <i class="bi bi-bag-check"></i>
                    Browse Product
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer.cart') }}" class="nav-link">
                    <i class="bi bi-cart3"></i>
                    My Cart
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer.orders') }}" class="nav-link">
                    <i class="bi bi-receipt"></i>
                    My Orders
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="top-bar">
            <h4>Customer Dashboard</h4>
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="welcome-card">
            <h3>Welcome, {{ Auth::user()->name }}</h3>
            <p>Browse products and manage your orders here.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
