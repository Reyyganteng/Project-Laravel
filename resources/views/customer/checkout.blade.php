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
        <a href="{{ route('customer.cart') }}" class="text-decoration-none mb-4 d-inline-block">
            <i class="bi bi-arrow-left"></i> Back to Cart
        </a>
        <form action="{{ route('customer.checkout.process') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Shipping Information -->
                <div class="col-md-7">
                    <h4 class="mb-3">
                        <i class="bi bi-truck"></i> Shipping Information
                    </h4>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="shipping_name" class="form-control"
                            value="{{ old('shipping_name', Auth::user()->name) }}" required>
                        @error('shipping_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="shipping_phone" class="form-control" placeholder="08xxxxxxxxxx"
                            value="{{ old('shipping_phone') }}" required>
                        @error('shipping_phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Shipping Address</label>
                        <textarea name="shipping_address" class="form-control" rows="4"
                            placeholder="Complete address including street, city, zip code" required>{{ old('shipping_address') }}</textarea>

                        @error('shipping_address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
                            @foreach ($cartItems as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $item->product->title }} x {{ $item->quantity }}</span>
                                    <span>
                                        Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                            <hr>
                            <div class="d-flex justify-content-between fw-bold mb-3">
                                <span>Total Pay</span>
                                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
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
