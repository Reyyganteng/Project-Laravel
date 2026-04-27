<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* BODY */

        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }


        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: white;
            border-right: 1px solid #eee;
            padding: 20px 0;
        }

        .sidebar-header {
            padding: 0 20px 20px 20px;
            border-bottom: 1px solid #eee;
        }

        .sidebar-header h4 {
            font-size: 18px;
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
            text-decoration: none;
            color: #333;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: #f1f3f5;
            color: #0d6efd;
        }

        .nav-link i {
            font-size: 18px;
        }


        /* MAIN CONTENT */

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }


        /* TOP BAR */

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }


        /* USER */

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }


        /* LOGOUT */

        .logout-btn {
            background: #dc3545;
            border: none;
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .logout-btn:hover {
            background: #bb2d3b;
        }


        /* TABLE CONTAINER */

        .orders-table {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }


        /* TABLE */

        table thead {
            background: #343a40;
            color: white;
        }

        table th,
        table td {
            vertical-align: middle;
        }


        /* STATUS BADGE */

        .badge-status {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
        }

        /* STATUS COLORS */

        .status-pending {
            background: #ffc107;
        }

        .status-processing {
            background: #0dcaf0;
        }

        .status-completed {
            background: #198754;
        }

        .status-cancelled {
            background: #dc3545;
        }


        /* VIEW BUTTON */

        .btn-view {
            background: #0d6efd;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-view:hover {
            background: #0b5ed7;
            color: white;
        }


        /* EMPTY STATE */

        .empty-state {
            text-align: center;
            margin-top: 80px;
        }

        .empty-state i {
            font-size: 60px;
            color: #bbb;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>Welcome To Customer Dashboard</h4>
            <div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('customer.dashboard') }}" class="nav-link">
                            <i class="bi bi-speedometer2"></i>
                            Dashoard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.products') }}" class="nav-link">
                            <i class="bi bi-bag-check"></i>
                            Browser Product
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
        </div>
    </div>
    <div class="main-content">
        <div class="top-bar">
            <h4>Order History</h4>
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn btn-sm mt-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        @if ($orders->count() > 0)
            <div class="orders-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>Rp{{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                <td>{{ str_replace('_', ' ', $order->payment_method) }}</td>
                                <td>
                                    <span class="badge-status status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('customer.order-detail', $order->id) }}"
                                        class="btn btn-sm btn-primary">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-clipboard-x"></i>
                <h4>No Orders</h4>
                <a href="{{ route('customer.products') }}" class="btn btn-success mt-3">Start Shoopping</a>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
