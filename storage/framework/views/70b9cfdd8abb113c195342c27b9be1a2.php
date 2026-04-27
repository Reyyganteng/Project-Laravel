<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .page-title {
            font-weight: 700;
            color: #333;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .card-body {
            padding: 30px;
        }

        /* BUTTON */

        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 7px 16px;
        }

        .btn-dashboard {
            background: #6c757d;
            color: white;
        }

        .btn-dashboard:hover {
            background: #5c636a;
        }

        .btn-add {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
        }

        .btn-add:hover {
            opacity: 0.9;
        }

        /* TABLE */

        table thead {
            background: #343a40;
            color: white;
            text-align: center;
        }

        table th,
        table td {
            vertical-align: middle;
        }

        tbody tr {
            transition: 0.2s;
        }

        tbody tr:hover {
            background: #f1f3f5;
        }

        .product-img {
            border-radius: 8px;
            object-fit: cover;
        }

        .actions .btn {
            margin: 2px;
        }

        /* PAGINATION */

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="page-title">
                <i class="bi bi-box-seam"></i> Product List
            </h3>

            <div>

                <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-dashboard">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>

                <a href="<?php echo e(route('product.create')); ?>" class="btn btn-add">
                    <i class="bi bi-plus-circle"></i> Add Product
                </a>

            </div>

        </div>


        <div class="card">

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?php echo e(asset('/storage/product/' . $product->image)); ?>" width="120"
                                        class="product-img">
                                </td>
                                <td><?php echo e($product->title); ?></td>
                                <td><?php echo $product->description; ?></td>
                                <td>
                                    Rp<?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                </td>
                                <td><?php echo e($product->stock); ?></td>
                                <td class="text-center actions">
                                    <a href="<?php echo e(route('product.show', $product->id)); ?>" class="btn btn-sm btn-dark">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('product.edit', $product->id)); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('product.destroy', $product->id)); ?>" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus produk ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-danger text-center m-3">
                                        Produk belum tersedia
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($products->links()); ?>

            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\projectrey\resources\views/product/index.blade.php ENDPATH**/ ?>