<?php
session_start();

// Ensure that the order details were stored in the session after order placement
if (!isset($_SESSION['order_details'])) {
    header("Location: menu.php"); // Redirect to menu if order details aren't available
    exit();
}

$orderDetails = $_SESSION['order_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f1e1;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #6f4f28;
        }
        .confirmation-message {
            text-align: center;
            margin-top: 20px;
        }
        .order-details, .order-items {
            width: 100%;
            margin-top: 30px;
        }
        .order-details th, .order-items th {
            text-align: left;
            padding: 8px;
            background-color: #6f4f28;
            color: white;
        }
        .order-details td, .order-items td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .order-summary {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            background-color: #6f4f28;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #5c4032;
        }
    </style>
</head>
<body>
    <h1>Order Confirmation</h1>
    <div class="confirmation-message">
        <p>Thank you for your order, <?= htmlspecialchars($orderDetails['name']) ?>!</p>
        <p>Your order has been successfully placed. Here are your order details:</p>
    </div>

    <!-- Customer Details Section -->
    <table class="order-details">
        <tr>
            <th>Full Name:</th>
            <td><?= htmlspecialchars($orderDetails['name']) ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td><?= htmlspecialchars($orderDetails['address']) ?></td>
        </tr>
        <tr>
            <th>Payment Method:</th>
            <td><?= htmlspecialchars($orderDetails['payment_method']) ?></td>
        </tr>
    </table>

    <!-- Ordered Items Section -->
    <h2>Items Ordered</h2>
    <table class="order-items">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($orderDetails['cart_items'] as $item):
                $subtotal = $item['item_price'] * $item['item_quantity'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['item_name']) ?></td>
                    <td>Php<?= number_format($item['item_price'], 2) ?></td>
                    <td><?= htmlspecialchars($item['item_quantity']) ?></td>
                    <td>Php<?= number_format($subtotal, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Order Summary Section -->
    <div class="order-summary">
        <h3>Total: Php<?= number_format($total, 2) ?></h3>
    </div>

    <!-- Button to go back to the menu or order page -->
    <div style="text-align: center;">
        <a href="menu.php" class="btn">Back to Menu</a>
        <a href="index.php" class="btn">Go to Home</a>
    </div>
</body>
</html>
