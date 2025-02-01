<!DOCTYPE html>
<html>
<head>
    <title>Order Cancellation Notice</title>
</head>
<body>
    <h1>Hello, {{ $order->user->name }}</h1>

    <p>We regret to inform you that your order has been cancelled.</p>

    <h3>Order Details:</h3>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>

    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item['product_name'] }} - Quantity: {{ $item['quantity'] }} - Price: Rs{{ $item['price'] }}</li>
        @endforeach
    </ul>

    <p><strong>Total Amount:</strong> Rs{{ $order->total_amount }}</p>

    <p>Reason for cancellation: <strong>{{ $order->cancellation_reason }}</strong></p>

    <p>If you have any questions, feel free to contact us.</p>

    <hr>
    <p><strong>Email:</strong> info@zeroskill.com</p>
    <p><strong>Telephone:</strong> +94 123 456 789</p>
</body>
</html>
