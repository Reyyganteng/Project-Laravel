<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* ================= GLOBAL ================= */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #1f2937;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
        }

        .sidebar-header {
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .nav-link {
            display: block;
            padding: 15px 20px;
            color: #d1d5db;
            text-decoration: none;
            font-size: 15px;
            transition: 0.3s;
        }

        .nav-link i {
            margin-right: 8px;
        }

        .nav-link:hover {
            background: #374151;
            color: white;
        }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            margin-left: 240px;
            padding: 30px;
        }

        /* ================= TOP BAR ================= */
        .top-bar {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        /* ================= USER INFO ================= */
        .user-avatar {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
        }

        /* ================= CARD ================= */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: #f9fafb;
            font-weight: 600;
        }

        /* ================= TABLE ================= */
        .table {
            margin: 0;
        }

        .table thead th {
            font-weight: 600;
            font-size: 14px;
        }

        .table td {
            vertical-align: middle;
        }

        /* ================= PRODUCT IMAGE ================= */
        .table img {
            border-radius: 6px;
            border: 1px solid #eee;
        }

        /* ================= BUTTON ================= */
        .btn-secondary {
            border-radius: 6px;
        }

        .btn-danger {
            border-radius: 6px;
        }

        /* ================= BADGE ================= */
        .badge {
            padding: 6px 10px;
            font-size: 12px;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width:768px) {

            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 20px;
            }

        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>Customer Portal</h4>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?php echo e(route('customer.dashboard')); ?>" class="nav-link">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo e(route('customer.products')); ?>" class="nav-link">
                    <i class="bi bi-bag-check"></i> Browse
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo e(route('customer.cart')); ?>" class="nav-link">
                    <i class="bi bi-cart3"></i> My Cart
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo e(route('customer.orders')); ?>" class="nav-link">
                    <i class="bi bi-receipt"></i> My Orders
                </a>
            </li>
        </ul>
    </div>


    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- TOP BAR -->
        <div class="top-bar d-flex justify-content-between align-items-center mb-4">
            <h2>Order Details</h2>

            <div class="user-info d-flex align-items-center gap-2">
                <div class="user-avatar">
                    <?php echo e(strtoupper(substr(auth()->user()?->name ?? '', 0, 1))); ?>

                </div>

                <div>
                    <strong><?php echo e(auth()->user()?->name); ?></strong>

                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- BACK BUTTON -->
        <a href="<?php echo e(route('customer.orders')); ?>" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back to Orders
        </a>


        <!-- ORDER INFORMATION -->
        <div class="card mb-4">
            <div class="card-header">
                Order Information
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-3">
                        <div class="text-muted">Order Number</div>
                        <strong><?php echo e($order->order_number); ?></strong>
                    </div>

                    <div class="col-md-3">
                        <div class="text-muted">Date Placed</div>
                        <strong><?php echo e($order->created_at->format('d M Y')); ?></strong>
                    </div>

                    <div class="col-md-3">
                        <div class="text-muted">Status</div>
                        <span class="badge bg-primary">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </div>

                    <div class="col-md-3">
                        <div class="text-muted">Payment Method</div>
                        <strong><?php echo e(str_replace('_', ' ', $order->payment_method)); ?></strong>
                    </div>

                </div>
            </div>
        </div>


        <!-- SHIPPING DETAILS -->
        <div class="card mb-4">
            <div class="card-header">
                Shipping Details
            </div>

            <div class="card-body">

                <div class="mb-2">
                    <div class="text-muted">Recipient Name</div>
                    <strong><?php echo e($order->shipping_name); ?></strong>
                </div>

                <div class="mb-2">
                    <div class="text-muted">Phone Number</div>
                    <strong><?php echo e($order->shipping_phone); ?></strong>
                </div>

                <div>
                    <div class="text-muted">Shipping Address</div>
                    <strong><?php echo e($order->shipping_address); ?></strong>
                </div>

            </div>
        </div>


        <!-- ORDER ITEMS -->
        <div class="card">
            <div class="card-header">
                Order Items
            </div>

            <div class="card-body p-0">
                <table class="table mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td>
                                    <div class="d-flex align-items-center gap-2">

                                        <img src="<?php echo e(asset('storage/product/' . ($item->product->image ?? 'default.png'))); ?>"
                                            width="50">

                                        <?php echo e($item->product->name ?? 'Product Deleted'); ?>


                                    </div>
                                </td>

                                <td>
                                    Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?>

                                </td>

                                <td>
                                    <?php echo e($item->quantity); ?>

                                </td>

                                <td class="text-end fw-bold">
                                    Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?>

                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        <tr class="table-light">
                            <td colspan="3" class="text-end fw-bold">
                                Total Amount
                            </td>
                            <td class="text-end fw-bold">
                                Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php /**PATH C:\laragon\www\projectrey\resources\views/customer/order-detail.blade.php ENDPATH**/ ?>