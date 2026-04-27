<style>
    /* RESET */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* BODY */
    body {
        background: #f1f3f7;
        font-family: 'Poppins', sans-serif;
    }

    /* SIDEBAR */
    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: #111827;
        color: white;
        display: flex;
        flex-direction: column;
        box-shadow: 3px 0 20px rgba(0, 0, 0, 0.08);
        z-index: 1000;
    }

    /* HEADER */
    .sidebar-header {
        padding: 22px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .sidebar-header h4 {
        margin: 0;
        font-weight: 600;
        font-size: 18px;
    }

    .sidebar-header p {
        margin: 2px 0 0;
        font-size: 12px;
        color: #9ca3af;
    }

    /* MENU */
    .nav-menu {
        list-style: none;
        padding: 15px 0;
        margin: 0;
        flex: 1;
    }

    /* ITEM */
    .nav-item {
        margin: 6px 12px;
    }

    /* LINK */
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
        transform: translateX(4px);
    }

    /* ACTIVE */
    .nav-link.active {
        background: #2563eb;
        color: white;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }

    /* MAIN CONTENT */
    .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
        min-height: 100vh;
        padding: 30px;
    }

    /* RESPONSIVE */
    @media(max-width:768px) {

        .sidebar {
            width: 220px;
        }

        .main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
        }

    }
</style>

<div class="sidebar">

    <div class="sidebar-header">
        <h4>Panel Admin</h4>
        <p>Management System</p>
    </div>

    <ul class="nav-menu">

        <li class="nav-item">
            <a href="<?php echo e(route('admin.dashboard')); ?>"
                class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo e(route('product.index')); ?>" class="nav-link <?php echo e(request()->routeIs('product.*') ? 'active' : ''); ?>">
                <i class="bi bi-box-seam"></i>
                Product Management
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo e(route('admin.orders.index')); ?>"
                class="nav-link <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>">
                <i class="bi bi-cart-check"></i>
                Manage Order
            </a>
        </li>

        <li class="nav-item">
            <a href="<?php echo e(route('admin.seles')); ?>"
                class="nav-link <?php echo e(request()->routeIs('admin.sales') ? 'active' : ''); ?>">
                <i class="bi bi-graph-up"></i>
                Sales Report
            </a>
        </li>

    </ul>

</div>
<?php /**PATH C:\laragon\www\projectrey\resources\views/admin/sidebar.blade.php ENDPATH**/ ?>