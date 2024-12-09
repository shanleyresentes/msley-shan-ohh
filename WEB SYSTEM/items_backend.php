<?php
// // Database connection
// //$conn = new mysqli('localhost', 'username', 'password', 'database');
// require_once "connect.php";
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Query to fetch product details
// $sql = "SELECT item_name, item_desc, item_price FROM items_lists";
// $result = $conn->query($sql);

// $products = [];
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $products[] = $row;
//     }
// }

// // Send the product data as JSON
// header('Content-Type: application/json');
// echo json_encode($products);

// $conn->close();
?>