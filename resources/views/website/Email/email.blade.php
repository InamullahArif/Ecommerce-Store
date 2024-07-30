<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header h1 {
            margin: 0;
        }
        .order-details {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        .order-details th,
        .order-details td {
            padding: 10px;
            text-align: left;
            border: 1px solid #e0e0e0;
        }
        .order-details th {
            background-color: #f0f0f0;
        }
        .total {
            text-align: right;
            padding: 10px;
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hello, {{ $name }}!</h1>
        </div>
        <p>Thank you for your order. Here are the details:</p>
        <table class="order-details">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                @php
                  $path = parse_url($item['image'], PHP_URL_PATH);
                  $filename = basename($path);
                //   dd($filename);
                @endphp
                <tr>
                    <td>
                        {{-- <img src="{{ asset($item['image']) }}" alt="{{ 'no image found' }}" style="max-width: 50px; height: auto;"> --}}
                        <img class="mini-thumbnail thumbnail" src="{{ url('/product_images/' . $filename) }}" alt="{{ 'No image found' }}" style="max-width: 50px; height: auto;">
                        {{ $item['name'] }}
                    </td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Shipping Charges</td>
                    <td>$10.00</td>
                </tr>
                <tr>
                    <td colspan="2" class="total">Total Price</td>
                    <td class="total">${{ number_format($amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
        <p>Best regards,<br>Bisum</p>
        <div class="footer">
            <p>© {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
