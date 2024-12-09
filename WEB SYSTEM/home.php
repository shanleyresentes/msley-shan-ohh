<?php
session_start();

// Ensure 'connect.php' is included safely
if (file_exists('conn.php')) {
    include 'conn.php';
} else {
    die("Error: 'connect.php' not found. Please check the file path.");
}

// Process form submissions for accepting or canceling orders
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['order_id'])) {
        $order_id = intval($_POST['order_id']);
        $action = $_POST['action']; // 'accept' or 'cancel'

        try {
            // Update order status based on action
            $stmt = $conn->prepare("UPDATE orders SET status = :status WHERE id = :order_id");
            $status = ($action === 'accept') ? 'Accepted' : 'Canceled';
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->execute();

            $message = "Order #" . htmlspecialchars($order_id) . " has been " . strtolower($status) . ".";
        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }
}

// Fetch orders from the database
try {
    $stmt = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            color: white;
            margin: 5px;
        }
        .btn-accept {
            background-color: green;
        }
        .btn-cancel {
            background-color: red;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h1>Manage Orders</h1>

    <?php if (!empty($message)): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['id']) ?></td>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td><?= htmlspecialchars($order['email']) ?></td>
                    <td>PHP <?= number_format($order['total_amount'], 2) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><?= htmlspecialchars($order['order_date']) ?></td>
                    <td>
                        <?php if ($order['status'] === 'Pending'): ?>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                                <button type="submit" name="action" value="accept" class="btn btn-accept">Accept</button>
                            </form>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                                <button type="submit" name="action" value="cancel" class="btn btn-cancel">Cancel</button>
                            </form>
                        <?php else: ?>
                            <span><?= htmlspecialchars($order['status']) ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>