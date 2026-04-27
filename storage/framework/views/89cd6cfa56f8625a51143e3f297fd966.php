<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* IMPORT FONT */
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

        /* TITLE */
        h3 {
            font-weight: 600;
            color: #111827;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            transition: 0.25s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        /* CARD HEADER */
        .card-header {
            font-weight: 600;
            font-size: 15px;
            background: white;
            border-bottom: 1px solid #f1f1f1;
            padding: 16px 20px;
        }

        /* PRIMARY HEADER */
        .card-header.bg-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
        }

        /* CARD BODY */
        .card-body {
            padding: 20px;
        }

        /* TABLE */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            border-bottom: 1px solid #eee;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 14px;
            padding: 14px 8px;
        }

        /* TABLE ROW HOVER */
        .table tbody tr {
            transition: 0.2s;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }

        /* PRODUCT IMAGE */
        .table img {
            width: 50px;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        /* GRAND TOTAL */
        .table-light {
            background: #f9fafb !important;
        }

        /* FORM */
        .form-label {
            font-size: 13px;
            font-weight: 500;
        }

        .form-select {
            border-radius: 8px;
            padding: 10px;
        }

        /* BUTTON */
        .btn {
            border-radius: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            border: none;
            padding: 10px;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        /* BACK BUTTON */
        .btn-outline-secondary {
            border-radius: 8px;
        }

        /* CUSTOMER ICON */
        .rounded-circle {
            background: #f3f4f6;
        }

        /* ALERT */
        .alert {
            border: none;
            border-radius: 8px;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

        }
    </style>
</head>

<body>

    <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="main-content container mt-4">

        <div class="d-flex align-items-center mb-3 gap-3">
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <h3 class="mb-3">Order Details #<?php echo e($order->order_number); ?></h3>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="row mt-3">
            <!-- ORDER ITEMS -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Order Items
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="<?php echo e(asset('storage/product/' . ($item->product?->image ?? 'default.png'))); ?>"
                                                    width="50">

                                                <span>
                                                    <?php echo e($item->product?->title ?? 'Product Deleted'); ?>

                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?>

                                        </td>
                                        <td>
                                            <?php echo e($item->quantity); ?>

                                        </td>
                                        <td>
                                            Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr class="table-light">
                                    <td colspan="3">
                                        <strong>Grand Total</strong>
                                    </td>
                                    <td>
                                        <strong>
                                            Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>

                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- RIGHT SIDE -->
            <div class="col-md-4">
                <!-- UPDATE STATUS -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        Update Order Status
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.orders.update', $order->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">
                                    Order Status
                                </label>
                                <select name="status" class="form-select">
                                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>
                                        Pending
                                    </option>
                                    <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>
                                        Processing
                                    </option>
                                    <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>
                                        Completed
                                    </option>
                                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>
                                        Cancelled
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Payment Status
                                </label>
                                <select name="payment_status" class="form-select">
                                    <option value="paid" <?php echo e($order->payment_status == 'paid' ? 'selected' : ''); ?>>
                                        Paid
                                    </option>
                                    <option value="unpaid" <?php echo e($order->payment_status == 'unpaid' ? 'selected' : ''); ?>>
                                        Unpaid
                                    </option>
                                </select>
                            </div>
                            <button class="btn btn-primary w-100">
                                Update Status
                            </button>
                        </form>
                    </div>
                </div>
                <!-- CUSTOMER INFO -->
                <div class="card">
                    <div class="card-header">
                        Customer Info
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                style="width:40px;height:40px">

                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <div class="fw-bold">
                                    <?php echo e($order->user->name); ?>

                                </div>
                                <div class="text-muted small">
                                    <?php echo e($order->user->email); ?>

                                </div>
                            </div>
                        </div>
                        <div class="text-muted small">
                            Joined: <?php echo e($order->user->created_at->format('d M Y')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php /**PATH C:\laragon\www\projectrey\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>