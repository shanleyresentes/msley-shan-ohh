
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            font-family: luminari;
        }
        .actions {
            margin-bottom: 20px;
            text-align: right;
        }
        .btn {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            background-color: #8d6e63;
            border-radius: 5px;
            margin: 5px;
        }
        .btn:hover {
            background-color: darkred;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(5, minmax(200px, 1fr));
            gap: 20px;
        }
        .grid-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .grid-item img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .item-name {
            font-weight: bold;
            margin: 10px 0;
        }
        .item-price {
            color: black;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .btn-add-to-cart {
            text-decoration: none;
            padding: 8px 12px;
            color: white;
            background-color: darkred;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-add-to-cart:hover {
            background-color: #6d4c41;
        }
        .search-container {
    text-align: center;
    margin-bottom: 20px;
}

.search-container input {
    padding: 10px;
    width: 60%;  /* Adjust width as needed */
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.search-container input:focus {
    outline: none;
    border-color: #8d6e63;  /* Change border color when the input is focused */
    box-shadow: 0 0 8px rgba(255, 99, 71, 0.5);
    </style>
</head>
<body>
<h1>Coffee Shop Menu</h1>
<div class="actions">
<a href="lp.php" class="btn">BACK</a>
    <a href="loginform.php" class="btn">ORDER NOW</a>
</div>
<!-- Search Bar -->
<div class="search-container" style="text-align: center; margin-bottom: 20px;">
    <input type="text" id="searchBar" placeholder="Search for products..." onkeyup="filterItems()">
</div>

<script>
function filterItems() {
    const searchQuery = document.getElementById('searchBar').value.toLowerCase();
    const gridItems = document.querySelectorAll('.grid-item');

    gridItems.forEach(item => {
        const itemName = item.querySelector('.item-name').innerText.toLowerCase();
        if (itemName.includes(searchQuery)) {
            item.style.display = 'block';  // Show matching items
        } else {
            item.style.display = 'none';   // Hide non-matching items
        }
    });
}
</script>

<?php
if (isset($_SESSION['cart'])) {
    echo "<h2>Your Cart:</h2>";
    foreach ($_SESSION['cart'] as $item) {
        echo "<p>" . htmlspecialchars($item['item_id']) . "</p>";
    }
}

include 'db_config.php';

try {
    // Fetch categories from the database
    $stmt = $conn->query("SELECT DISTINCT item_category FROM menu_items");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetch items for each category
    $itemsByCategory = [];
    foreach ($categories as $category) {
        $category_name = $category['item_category'];
        $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_category = :category ORDER BY item_name");
        $stmt->bindParam(':category', $category_name);
        $stmt->execute();
        $itemsByCategory[$category_name] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

?>

<?php foreach ($itemsByCategory as $category_name => $menu_items): ?>
    <h2><?= htmlspecialchars($category_name) ?></h2>
    <div class="grid-container">
        <?php foreach ($menu_items as $item): ?>
        <div class="grid-item">
            <!-- Fetch and display the image dynamically from the database -->
            <img src="images/<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>" class="item-image">
            
            <div class="item-name"><?= htmlspecialchars($item['item_name']) ?></div>
            <div class="item-price">PHP <?= number_format($item['item_price'], 2) ?></div>
            
            <!-- Center hover area -->
            <div class="hover-center" 
                onmouseover="showItemDetails(event, '<?= htmlspecialchars($item['item_name']) ?>', '<?= htmlspecialchars($item['item_desc']) ?>', '<?= number_format($item['item_price'], 2) ?>')" 
                onmouseout="hideItemDetails()">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<!-- Tooltip Section -->
<div id="itemTooltip" style="display: none; position: absolute; background: white; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); z-index: 1000;">
    <h3 id="tooltipItemName" style="margin: 0; font-size: 18px;"></h3>
    <p id="tooltipItemDescription" style="margin: 5px 0; font-size: 14px; color: #555;"></p>
</div>

<script>
function showItemDetails(event, itemName, itemDesc, itemPrice) {
    // Get the tooltip element
    const tooltip = document.getElementById('itemTooltip');
    
    // Set content
    document.getElementById('tooltipItemName').innerText = itemName;
    document.getElementById('tooltipItemDescription').innerText = itemDesc;
    
    // Position the tooltip near the cursor
    tooltip.style.left = `${event.pageX + 15}px`;
    tooltip.style.top = `${event.pageY + 15}px`;
    
    // Show the tooltip
    tooltip.style.display = 'block';
}

function hideItemDetails() {
    // Hide the tooltip
    document.getElementById('itemTooltip').style.display = 'none';
}
</script>

<style>
.grid-container {
    display: grid;
    grid-template-columns: repeat(5, minmax(200px, 1fr));
    gap: 20px;
}

.grid-item {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    cursor: pointer;
}

.grid-item:hover {
    background-color: #f9f9f9;
}

.item-image {
    width: 200px; /* Fixed width */
    height: 200px; /* Fixed height */
    object-fit: cover; /* Maintain aspect ratio and fill the container */
    border-radius: 5px;
    margin-bottom: 10px;
}

.hover-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: auto; /* Ensure it captures mouse events */
}

.grid-item:hover .hover-center {
    opacity: 1;
}

.hover-center:hover {
    cursor: pointer;

}

#itemTooltip {
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: absolute;
    z-index: 1000;
    display: none;
}
</style>

</body>
</html>

