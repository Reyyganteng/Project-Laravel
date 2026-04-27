<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Orders -Admin</title>

    <style>
        /* FONT */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* BODY */
        body {
            background: #f1f4f9;
            font-family: 'Poppins', sans-serif;
            color: #374151;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 35px;
        }

        /* PAGE TITLE */
        .main-content h3 {
            font-weight: 600;
            color: #111827;
        }

        /* CARD STYLE */
        .card-header {
            background: white;
            border: none;
            padding: 20px 25px;
            border-radius: 12px 12px 0 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header h5 {
            font-weight: 600;
            margin: 0;
        }

        .card-body {
            background: white;
            border-radius: 0 0 12px 12px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        /* TABLE */
        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        /* TABLE HEADER */
        .table thead {
            background: #111827;
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-size: 14px;
            font-weight: 500;
        }

        /* TABLE BODY */
        .table tbody td {
            padding: 16px 15px;
            font-size: 14px;
            border-top: 1px solid #f1f1f1;
        }

        /* HOVER EFFECT */
        .table-hover tbody tr {
            transition: all .2s;
        }

        .table-hover tbody tr:hover {
            background: #f9fafb;
            transform: scale(1.01);
        }

        /* BADGE STATUS */
        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        /* ORDER STATUS */
        .status-pending {
            background: #fff7e6;
            color: #d97706;
        }

        .status-processing {
            background: #e0f2fe;
            color: #0284c7;
        }

        .status-completed {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        /* PAYMENT STATUS */
        .status-paid {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-unpaid {
            background: #fee2e2;
            color: #dc2626;
        }

        /* BUTTON */
        .btn-primary {
            background: #2563eb;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        /* ALERT */
        .alert {
            border-radius: 8px;
            border: none;
        }

        /* PAGINATION */
        .pagination {
            margin-top: 15px;
        }

        .page-link {
            border: none;
            margin: 0 3px;
            border-radius: 6px;
            color: #374151;
        }

        .page-item.active .page-link {
            background: #2563eb;
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width:768px) {

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .table {
                font-size: 13px;
            }

        }
    </style>

</head>

<body>
    @include('admin.sidebar')

    <div class="main-content">
        <h3 class="mb-4">Manage Orders</h3>
        <div class="card-header">
            <h5>Order List</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Payment status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>Rp{{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                <td class="text-uppercase">{{ str_replace('-', '', $order->payment_methode) }}</td>
                                <td>
                                    <span class="badge-status status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge-status status-{{ $order->payment_status }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.update', $order->id) }}"
                                        class="btn btn-sm btn-primary">View & Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</html>
