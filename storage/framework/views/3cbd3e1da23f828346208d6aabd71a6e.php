<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* GOOGLE FONT */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* RESET */
        * {
            box-sizing: border-box;
        }

        /* BODY */
        body {
            background: #f1f5f9;
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
            padding: 20px 0;
            box-shadow: 3px 0 20px rgba(0, 0, 0, 0.08);
        }

        /* SIDEBAR HEADER */
        .sidebar-header {
            padding: 0 25px 20px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-header h4 {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .sidebar-header p {
            font-size: 12px;
            color: #9ca3af;
        }

        /* MENU */
        .nav-menu {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }

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
            transition: .25s;
        }

        .nav-link:hover {
            background: #1f2937;
            color: white;
            transform: translateX(3px);
        }

        .nav-link i {
            font-size: 18px;
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
            margin-bottom: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        /* USER INFO */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

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
            border: none;
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* PRODUCT GRID */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 25px;
        }

        /* PRODUCT CARD */
        .product-card {
            background: white;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            transition: .3s;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        }

        /* PRODUCT IMAGE */
        .product-image {
            width: 100%;
            height: 190px;
            object-fit: contain;
            background: #f8fafc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 12px;
        }

        /* PRODUCT TITLE */
        .product-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        /* PRICE */
        .product-price {
            color: #16a34a;
            font-weight: 600;
            margin-bottom: 6px;
        }

        /* STOCK */
        .stock-badge {
            font-size: 12px;
            background: #ecfdf5;
            color: #16a34a;
            padding: 4px 8px;
            border-radius: 6px;
        }

        /* ADD CART BUTTON */
        .btn-add-cart {
            margin-top: auto;
            background: #2563eb;
            border: none;
            color: white;
            padding: 9px;
            border-radius: 8px;
            font-size: 14px;
            transition: .2s;
        }

        .btn-add-cart:hover {
            background: #1d4ed8;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            margin-top: 80px;
            color: #9ca3af;
        }

        .empty-state i {
            font-size: 60px;
            margin-bottom: 10px;
        }

        /* ALERT */
        .alert {
            border-radius: 10px;
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
            <h4>Customer Portal</h4>
            <p>Shooping Dashboard</p>
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
            <h4>Product</h4>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                </div>
                <div>
                    <strong><?php echo e(Auth::user()->name); ?></strong>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="logout-btn btn-sm mt-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle"><?php echo e(session('success')); ?></i>
            </div>
        <?php endif; ?>

        <?php if($products->count() > 0): ?>
            <div class="product-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-card">
                        <img src="<?php echo e(asset('/storage/product/' . $product->image)); ?>" alt="<?php echo e($product->title); ?>"
                            class="product-image">
                        <div class="product-info">
                            <div class="product-title"><?php echo e($product->title); ?></div>
                            <div class="product-price">Rp <?php echo e(number_format($product->price, 2, ',', '.')); ?></div>
                            <div class="product-stock">
                                <span class="stock-badge">
                                    <i class="bi bi-box-seam"></i> Stock:
                                    <?php echo e($product->stock); ?>

                                </span>
                            </div>
                            <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn-add-cart">
                                    <i class="bi bi-cart-plus"></i>ADD TO CART
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="d-flex justify-content-center">
                <?php echo e($product->links); ?>

            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h4>No Product Available</h4>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\laragon\www\projectrey\resources\views/customer/products.blade.php ENDPATH**/ ?>