<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Purchase!</title>
</head>
<body>
    <h1>Thank You, {{ $order->user->name }}!</h1>

    <p>Your order has been successfully delivered.</p>

    <h3>Order Details:</h3>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>

    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item['product_name'] }} - Quantity: {{ $item['quantity'] }} - Price: Rs{{ $item['price'] }}</li>
        @endforeach
    </ul>

    <p><strong>Total Amount:</strong> Rs{{ $order->total_amount }}</p>

    <p>We appreciate you and look forward to serving you again!</p>

    <hr>
    <p>If you have any questions, feel free to contact us:</p>
    <p><strong>Email:</strong> info@zeroskill.com</p>
    <p><strong>Telephone:</strong> +94 123 456 789</p>
</body>
</html>
