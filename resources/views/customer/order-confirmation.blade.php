<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="confirmation-card">
        <div class="success-icon">
            <i class="bi bi-check-lg"></i>
        </div>
        <h3>Payment Successfull</h3>
        <div class="order-details">
            <div class="detail-row">
                <span>Order Number</span>
                <span>{{ $order->order_number }}</span>
            </div>

            <div class="detail-row">
                <span>Date:</span>
                <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>

            <div class="detail-row">
                <span>Payment Method</span>
                <span>{{ str_replace('_', ' ', $order->payment_method) }}</span>
            </div>

            <div class="detail-row">
                <span>Total Amount</span>
                <span>Rp {{ number_format($order->total_amount, 2, ',', '.') }}</span>
            </div>

        </div>

        <a href="{{ route('customer.products') }}" class="btn-home">Continue Shipping</a>
        <a href="{{ route('customer.orders') }}" class="btn-outline">View Order History</a>
    </div>
</body>

</html>
