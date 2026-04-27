<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart</title>
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }


        /* CART CONTAINER */

        .cart-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }


        /* CART ITEM */

        .cart-item {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }


        /* PRODUCT IMAGE */

        .item-image {
            width: 90px;
            height: 90px;
            object-fit: contain;
            border-radius: 8px;
            background: #f8f9fa;
        }


        /* DETAILS */

        .item-details {
            flex: 1;
        }

        .item-title {
            font-weight: 600;
        }

        .item-price {
            color: #198754;
            font-weight: bold;
        }


        /* QUANTITY */

        .qty-input {
            width: 70px;
            padding: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            text-align: center;
        }


        /* REMOVE BUTTON */

        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .btn-remove:hover {
            background: #bb2d3b;
        }


        /* SUMMARY */

        .cart-summary {
            background: white;
            padding: 20px;
            border-radius: 10px;
            height: fit-content;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .summary-title {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }


        /* CHECKOUT BUTTON */

        .btn-checkout {
            width: 100%;
            background: #198754;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: 500;
            margin-top: 10px;
        }

        .btn-checkout:hover {
            background: #157347;
        }


        /* EMPTY CART */

        .empty-cart {
            text-align: center;
            margin-top: 80px;
        }

        .empty-cart i {
            font-size: 60px;
            color: #bbb;
            margin-bottom: 10px;
        }


        /* SUCCESS ALERT */

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
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
                        <a href="<?php echo e(route('customer.dashboard')); ?>" class="nav-link">
                            <i class="bi bi-speedometer2"></i>
                            Dashoard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('customer.products')); ?>" class="nav-link">
                            <i class="bi bi-bag-check"></i>
                            Browser Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('customer.cart')); ?>" class="nav-link">
                            <i class="bi bi-cart3"></i>
                            My Cart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('customer.orders')); ?>" class="nav-link">
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
            <h4>My Cart</h4>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                </div>
                <div>
                    <strong><?php echo e(Auth::user()->name); ?></strong>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                    </form>
                </div>
            </div>
            <div class=""></div>
        </div>
        <?php if(session('success')): ?>
            <div class="alert-success">
                <i class="bi bi-check-circle"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($cartItems->count() > 0): ?>
            <div class="cart-container">
                <div class="cart-item">
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="cart-item">
                            <img src="<?php echo e(asset('storage/product/' . $item->product->image)); ?>"
                                alt="<?php echo e($item->product->title); ?>" class="item-image">
                            <div class="item-details">
                                <div class="item-title"><?php echo e($item->product->title); ?></div>
                                <div class="item-price">Rp<?php echo e(number_format($item->product->price, 2, ',', '.')); ?></div>
                            </div>
                            <div class="quantity-control">
                                <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1"
                                        class="qty-input" onchange="this.form.submit()">
                                </form>
                            </div>
                            <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-remove">
                                    <i class="bi bi-trash"></i> Remove </button>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="cart-summary">
                    <div class="summary-title">Order Summary</div>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rp<?php echo e(number_format($total, 2, ',', '.')); ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Total</span>
                        <span>Rp<?php echo e(number_format($total, 2, ',', '.')); ?></span>
                    </div>
                    <a href="<?php echo e(route('customer.checkout')); ?>">
                        <button class="btn-checkout">
                            Proceed to Checkout
                        </button>
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <i class="bi bi-cart-x"></i>
                <h4>Your Cart Is Empty</h4>
                <a href="<?php echo e(route('customer.products')); ?>" style="text-decoration: none">
                    <button class="btn-checkout">Browse Product</button>
                </a>
            </div>

        <?php endif; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\laragon\www\projectrey\resources\views/customer/cart.blade.php ENDPATH**/ ?>