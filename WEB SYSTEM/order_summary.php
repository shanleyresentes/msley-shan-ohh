<?php
include 'db_config.php';
session_start();

// Fetch the order details from the session
$orderDetails = $_SESSION['order_details'] ?? null;

if (!$orderDetails) {
    // If no order details exist, redirect to cart page
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <style>
        /* Add some styles here */
    </style>
</head>
<body>
    <h1>Order Summary</h1>

    <h2>Customer Details</h2>
    <p>Name: <?= htmlspecialchars($orderDetails['name']) ?></p>
    <p>Address: <?= htmlspecialchars($orderDetails['address']) ?></p>
    <p>Payment Method: <?= htmlspecialchars($orderDetails['payment_method']) ?></p>

    <h2>Items Ordered</h2>
    <table>
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
            foreach ($orderDetails['cart_items'] as $item) {
                $subtotal = $item['item_price'] * $item['item_quantity'];
                $total += $subtotal;
                echo "<tr>
                        <td>" . htmlspecialchars($item['item_name']) . "</td>
                        <td>Php " . number_format($item['item_price'], 2) . "</td>
                        <td>" . htmlspecialchars($item['item_quantity']) . "</td>
                        <td>Php " . number_format($subtotal, 2) . "</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <p><strong>Total: Php <?= number_format($total, 2) ?></strong></p>

    <a href="cart.php" class="btn">Go back to Cart</a>
    <a href="checkout_complete.php" class="btn">Complete Order</a>
</body>
</html>
