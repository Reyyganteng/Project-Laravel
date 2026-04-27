<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container mt-5 mb-5">
        <!-- Back Button -->
        <a href="<?php echo e(route('customer.cart')); ?>" class="text-decoration-none mb-4 d-inline-block">
            <i class="bi bi-arrow-left"></i> Back to Cart
        </a>
        <form action="<?php echo e(route('customer.checkout.process')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-4">
                <!-- Shipping Information -->
                <div class="col-md-7">
                    <h4 class="mb-3">
                        <i class="bi bi-truck"></i> Shipping Information
                    </h4>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="shipping_name" class="form-control"
                            value="<?php echo e(old('shipping_name', Auth::user()->name)); ?>" required>
                        <?php $__errorArgs = ['shipping_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="shipping_phone" class="form-control" placeholder="08xxxxxxxxxx"
                            value="<?php echo e(old('shipping_phone')); ?>" required>
                        <?php $__errorArgs = ['shipping_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Shipping Address</label>
                        <textarea name="shipping_address" class="form-control" rows="4"
                            placeholder="Complete address including street, city, zip code" required><?php echo e(old('shipping_address')); ?></textarea>

                        <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <!-- Payment Method -->
                    <h4 class="mb-3">
                        <i class="bi bi-credit-card"></i> Payment Method
                    </h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="bank_transfer" required checked>
                                <div>
                                    <i class="bi bi-bank fs-3"></i>
                                    <div>Bank Transfer</div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="e_wallet" required>
                                  
                                <div>
                                    <i class="bi bi-cash fs-3"></i>
                                    <div>E-Wallet</div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="COD" required>
                                <div>
                                    <i class="bi bi-wallet2 fs-3"></i>
                                    <div>COD</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="col-md-5">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Order Summary</h5>
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex justify-content-between mb-2">
                                    <span><?php echo e($item->product->title); ?> x <?php echo e($item->quantity); ?></span>
                                    <span>
                                        Rp<?php echo e(number_format($item->product->price * $item->quantity, 0, ',', '.')); ?>

                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold mb-3">
                                <span>Total Pay</span>
                                <span>Rp<?php echo e(number_format($total, 0, ',', '.')); ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                Place Order <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>
    

            const paymentOptions = document.querySelectorAll('.payment-option');
            paymentOptions.forEach(option => {
                option.addEventListener('click', () => {
                    paymentOptions.forEach(opt => opt.classList.remove('selected'));
                    
                    option.classList.add('selected');

                });
            });

            document.querySelector('input[name="payment_method"]:checked').closest('.payment-option').classList.add('selected');
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\projectrey\resources\views/customer/checkout.blade.php ENDPATH**/ ?>