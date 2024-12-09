<?php
session_start();
include('connect.php');  // Include the database connection

$cartItems = $_SESSION['cart'] ?? [];

if (isset($_POST['placeOrder'])) {
    // Collect the order information from the form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Calculate the total order amount (sum of cart item prices)
    $totalAmount = 0;
    foreach ($cartItems as $item) {
        $totalAmount += $item['item_price'] * $item['item_quantity'];
    }

    // Prepare the order insertion query
    try {
        // Insert order details into the `orders` table
        $query = "INSERT INTO orders (user_id, total_amount, name, address, payment_method) VALUES (:user_id, :total_amount, :name, :address, :payment_method)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);  // Assuming you have a logged-in user
        $stmt->bindParam(':total_amount', $totalAmount);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->execute();

        // Get the last inserted order ID
        $order_id = $pdo->lastInsertId();

        // Insert each cart item into the `order_items` table
        foreach ($cartItems as $item) {
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (:order_id, :item_id, :quantity, :price)");
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':item_id', $item['item_id']);
            $stmt->bindParam(':quantity', $item['item_quantity']);
            $stmt->bindParam(':price', $item['item_price']);
            $stmt->execute();
        }
        

        // Save order details in the session (for order summary)
        $_SESSION['order_details'] = [
            'name' => $name,
            'address' => $address,
            'payment_method' => $payment_method,
            'cart_items' => $cartItems,
            'total_amount' => $totalAmount,
            'order_id' => $order_id
        ];

        // Redirect to the order summary page
        header("Location: order_summary.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
