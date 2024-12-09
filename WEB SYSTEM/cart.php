<?php
session_start();
$cartItems = $_SESSION['cart'] ?? [];

if (isset($_POST['placeOrder'])) {
    // Collect the user information
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Save the order details into the session or a database (for simplicity, using session here)
    $_SESSION['order_details'] = [
        'name' => $name,
        'address' => $address,
        'payment_method' => $payment_method,
        'cart_items' => $cartItems
    ];

    // Redirect to the order summary page
    header("Location: order_summary.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f1e1;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #6f4f28;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #6f4f28;
            color: white;
        }

        .cart-summary {
            font-size: 18px;
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }

        .btn {
            background-color: #6f4f28;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #5c4032;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
            margin-top: 30px;
            width: 100%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-container h3 {
            text-align: center;
            color: #6f4f28;
        }

        .form-container label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #6f4f28;
        }

        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container input:focus, .form-container select:focus {
            outline: none;
            border-color: #6f4f28;
        }

        .form-container button {
            width: 100%;
            padding: 14px;
            background-color: #6f4f28;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #5c4032;
        }

    </style>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <?php if (!empty($cartItems)): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($cartItems as $item): 
                    $subtotal = $item['item_price'] * $item['item_quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="images/<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($item['item_name']) ?></td>
                        <td>Php<?= number_format($item['item_price'], 2) ?></td>
                        <td><?= htmlspecialchars($item['item_quantity']) ?></td>
                        <td>Php<?= number_format($subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="cart-summary">Total: Php<?= number_format($total, 2) ?></p>

        <!-- Order Form -->
        <div class="form-container">
            <h3>Place Your Order</h3>
            <form method="POST">
                <label for="name">Full Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="address">Delivery Address:</label>
                <input type="text" name="address" id="address" required>

                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                </select>

                <button type="submit" name="placeOrder">Place Order</button>
            </form>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
