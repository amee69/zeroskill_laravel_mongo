<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order, {{ $order['shipping_details']['full_name'] }}!</h1>

    <p>We have received your order and it is now being processed.</p>

    <h3>Order Details:</h3>
    <ul>
        @foreach ($order['items'] as $item)
            <li>{{ $item['product_name'] }} - Quantity: {{ $item['quantity'] }} - Price: Rs.{{ $item['price'] }}</li>
        @endforeach
    </ul>

    <p>Total Amount: <strong>Rs.{{ $order['total_amount'] }}</strong></p>

    <p>Your order will be shipped to:</p>
    <p>{{ $order['shipping_details']['address'] }}, {{ $order['shipping_details']['city'] }}</p>

    <p>Thank you for shopping with us!</p>

    <hr>
    <p>If you have any questions, feel free to contact us:</p>
    <p><strong>Email:</strong> info@zeroskill.com</p>
    <p><strong>Telephone:</strong> +94 123 456 789</p>
</body>
</html>
