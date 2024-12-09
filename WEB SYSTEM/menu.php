<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_info_id'])) {
    header('location: loginform.php?error=pleaseLogIn');
    exit();
}

// Assuming you have the user's full name stored in the session
$username = $_SESSION['user_info_fullname'];

// ... rest of your dashboard code
echo " -------------------";
echo "<h2>Welcome, " . $username . "</h2>";

if (!isset($_SESSION['user_info_user_type'])) {
    header('location: loginform.php?error=pleaseLogIn');
}


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location: loginform.php?successfulLogout");
    exit();
}

if (isset($_GET['clearCart'])) {
    unset($_SESSION['cart']);
    header("location: menu.php");
    exit();
}

if (isset($_POST['addToCart'])) {
    $item_id = $_POST['item_id'];
    $quantity = isset($_POST['quantity']) && $_POST['quantity'] > 0 ? (int)$_POST['quantity'] : 1;

    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_id = :item_id");
    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        if (!isset($_SESSION['cart'][$item_id])) {
            $_SESSION['cart'][$item_id] = [
                'item_id' => $item['item_id'],
                'item_name' => $item['item_name'],
                'item_price' => $item['item_price'],
                'item_image' => $item['item_image'],
                'item_quantity' => $quantity
            ];
        } else {
            $_SESSION['cart'][$item_id]['item_quantity'] += $quantity;
        }
    }
    header("location: menu.php");
    exit();
}


try {
    $stmt = $conn->query("SELECT DISTINCT item_category FROM menu_items");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $itemsByCategory = [];
    foreach ($categories as $category) {
        $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_category = :category ORDER BY item_name");
        $stmt->bindParam(':category', $category['item_category']);
        $stmt->execute();
        $itemsByCategory[$category['item_category']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f1e1; /* Light beige background for a warm feel */
        }
        h1 {
            text-align: center;
            font-family: 'Luminari', sans-serif;
            color: #6f4f28; /* Coffee brown color */
            padding: 20px;
            background-color: #f0e6d6; /* Light cream background */
            margin: 0;
        }
        .actions {
            text-align: right;
            padding: 20px;
        }
        .btn {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            background-color: #6f4f28; /* Dark coffee brown */
            border-radius: 5px;
            margin: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #5c4032; /* Darker brown for hover effect */
        }
        /* Grid Layout for Items */
        .category-section {
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #fff7e6;
            border-radius: 8px;
        }
        .category-title {
            font-size: 24px;
            color: #6f4f28;
            text-align: center;
            font-weight: bold;
            padding: 10px;
            background-color: #f0e6d6; /* Cream background for category title */
            border-radius: 5px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .grid-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff7e6; /* Light coffee cream background */
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: box-shadow 0.3s ease;
        }
        .grid-item:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .grid-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .item-name {
            font-weight: bold;
            font-size: 16px;
            color: #6f4f28; /* Coffee brown for item name */
            margin-bottom: 10px;
        }
        .item-price {
            color: #9e7b44; /* Muted golden brown for price */
            font-size: 18px;
            margin-bottom: 15px;
        }
        .btn-add-to-cart {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #6f4f28; /* Dark coffee brown for button */
            color: white;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
            display: inline-block;
        }
        .btn-add-to-cart:hover {
            background-color: #5c4032; /* Darker brown for hover effect */
        }
        .quantity-control {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
        }
        .quantity-btn {
            padding: 10px 15px;
            background-color: #6d4c41;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .quantity-btn:hover {
            background-color: #5a3a2d;
        }
        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f4f4f4;
        }
        .quantity-control:focus-within .quantity-input {
            border-color: #6d4c41;
        }
    </style>
</head>
<body>

<h1>Coffee Shop Menu</h1>

<div class="actions">
    <a href="?clearCart" class="btn">Clear Cart</a>
    <a href="cart.php" class="btn">View Cart</a>
    <a href="?logout" class="btn">Logout</a>
</div>

<!-- Organize Items by Category -->
<?php foreach ($itemsByCategory as $category_name => $menu_items): ?>
    <div class="category-section">
        <div class="category-title"><?= htmlspecialchars($category_name) ?></div>
        <div class="grid-container">
            <?php foreach ($menu_items as $item): ?>
                <div class="grid-item">
                    <img src="images/<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>">
                    <div class="item-name"><?= htmlspecialchars($item['item_name']) ?></div>
                    <div class="item-price">Php <?= number_format($item['item_price'], 2) ?></div>
                    <div class="quantity-control">
                        <button class="quantity-btn decrement" onclick="updateQuantity('quantity-<?= $item['item_id'] ?>', -1)">−</button>
                        <input type="number" class="quantity-input" id="quantity-<?= $item['item_id'] ?>" value="1" min="1" readonly>
                        <button class="quantity-btn increment" onclick="updateQuantity('quantity-<?= $item['item_id'] ?>', 1)">+</button>
                    </div>
                    <a href="#" onclick="addToCart(<?= $item['item_id'] ?>)" class="btn-add-to-cart">Add to Cart</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<script>
    function updateQuantity(inputId, delta) {
        const input = document.getElementById(inputId);
        let currentQuantity = parseInt(input.value);
        currentQuantity += delta;
        if (currentQuantity < 1) {
            currentQuantity = 1;
        }
        input.value = currentQuantity;
    }

    function addToCart(itemId) {
        const quantityInput = document.getElementById(`quantity-${itemId}`);
        const quantity = parseInt(quantityInput.value);

        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                item_id: itemId,
                quantity: quantity,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Item added to cart!");
            } else {
                alert("Failed to add item to cart.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
</script>

</body>
</html>
