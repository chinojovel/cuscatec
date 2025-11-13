<!DOCTYPE html>
<html>
<head>
    <title>New Order</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h1>Welcome, Administrador!</h1>

    <div style="text-align: center; margin: 20px 0;">
        <img src="https://importguadalajara.com/assets/images/logo.jpg" alt="Company Logo" style="width: 50px; height: auto;">
    </div>

    <p>A new purchase order No. {{ $order_id }} has been received from customer {{ $name }}.</p>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>