<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sales Report - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }


        /* CARD */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* STAT CARD */
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-label {
            font-size: 14px;
            color: #6c757d;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
        }

        /* TABLE */
        table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #0d6efd;
            color: white;
        }

        thead th {
            font-weight: 500;
        }

        tbody tr:hover {
            background: #f1f5ff;
        }

        /* STATUS BADGE */
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* BUTTON */
        .btn-outline-secondary {
            border-radius: 8px;
        }

        /* PRINT STYLE */
        @media print {

            .sidebar,
            form,
            .btn {
                display: none;
            }

            .main-content {
                margin: 0;
                padding: 0;
            }

        }
    </style>

</head>

<body>

    <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="main-content">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Sales Report</h2>

            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>

        <!-- FILTER -->
        <div class="card mb-4">
            <div class="card-body">

                <form action="<?php echo e(route('admin.seles')); ?>" method="GET" class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label>Period</label>
                        <select name="period" class="form-select" onchange="this.form.submit()">

                            <option value="all" <?php echo e($period == 'all' ? 'selected' : ''); ?>>All Item</option>
                            <option value="daily" <?php echo e($period == 'daily' ? 'selected' : ''); ?>>Daily</option>
                            <option value="weekly" <?php echo e($period == 'weekly' ? 'selected' : ''); ?>>Weekly</option>
                            <option value="monthly" <?php echo e($period == 'monthly' ? 'selected' : ''); ?>>Monthly</option>

                        </select>
                    </div>

                    <?php if($period != 'all'): ?>
                        <div class="col-md-3">
                            <label>Select Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo e($date); ?>"
                                onchange="this.form.submit()">
                        </div>
                    <?php endif; ?>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>

                </form>

            </div>
        </div>

        <h3 class="mb-3"><?php echo e($title); ?></h3>

        <!-- STATISTIC -->
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-label">Total Revenue</div>
                    <div class="stat-value text-success">
                        Rp<?php echo e(number_format($totalRevenue, 2, ',', '.')); ?>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-label">Total Orders</div>
                    <div class="stat-value">
                        <?php echo e(number_format($totalOrders)); ?>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-label">Successful Orders</div>
                    <div class="stat-value">
                        <?php echo e(number_format($succesfulOrders)); ?>

                    </div>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($order->order_number); ?></td>
                                    <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                                    <td><?php echo e($order->user->name); ?></td>
                                    <td>Rp<?php echo e(number_format($order->total_amount, 2, ',', '.')); ?></td>
                                    <td>
                                        <span class="badge-status status-<?php echo e($order->status); ?>">
                                            <?php echo e(ucfirst($order->status)); ?>

                                        </span>
                                    </td>
                                    <td class="text-uppercase">
                                        <?php echo e(str_replace('_', '', $order->payment_method)); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                        <p class="text-muted mt-2">
                                            No Orders Found For This Period
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php /**PATH C:\laragon\www\projectrey\resources\views/admin/seles/index.blade.php ENDPATH**/ ?>