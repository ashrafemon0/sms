<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 120px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 24px;
            color: #333;
        }
        .details {
            font-size: 18px;
            color: #333;
        }
        .details p {
            margin: 10px 0;
        }
        .details strong {
            color: #5c5c5c;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <!-- Add your logo -->
        <img src="{{ asset('public/backend/images/logo/logo.png') }}" alt="Company Logo">
        <h1>Payment Receipt</h1>
    </div>

    <div class="details">
        <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
        <p><strong>Transaction ID:</strong> {{ $payment->tran_id }}</p>
        <p><strong>Amount Paid:</strong> {{ number_format($payment->amount, 2) }} Taka</p>
        <p><strong>Paid By:</strong> {{ $user->name }}</p>
        <p><strong>User ID:</strong> {{ $user->user_id }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <div class="footer">
        <p>Thank you for your payment!</p>
        <p>Powered by Learning Tree</p>
    </div>
</div>
</body>
</html>
