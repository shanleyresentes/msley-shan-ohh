
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General page styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f1e1; /* Light beige background */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #6f4f28; /* Coffee brown */
            margin-bottom: 40px;
        }

        /* Container for buttons */
        .admin-actions {
            display: flex;
            justify-content: space-around;
            gap: 30px;
            flex-wrap: wrap;
        }

        /* Button styling */
        .btn {
            background-color: #8d6e63; /* pinkish brown brown */
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            width: 200px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #5c4032; /* Darker brown for hover effect */
        }

        .admin-actions .btn {
            margin-bottom: 20px;
        }

        .admin-actions .btn:active {
            background-color: #3e2b23; /* Even darker brown on button click */
        }

        /* Container for the page footer */
        footer {
            text-align: center;
            padding: 10px;
            background-color: #8d6e63; /* pinkish brown */
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

    <h1>Welcome to Admin Dashboard</h1>

    <!-- Admin Action Buttons -->
    <div class="admin-actions">
        <!-- Button for handling items -->
        <a href="manage_items.php" class="btn">Manage Items</a>

        <!-- Button for viewing revenue -->
        <a href="view_revenue.php" class="btn">View Revenue</a>

        <!-- Button for managing orders -->
        <a href="manage_orders.php" class="btn">Manage Orders</a>

        <!-- Logout Button -->
        <a href="lp.php" class="btn">Logout</a>
    </div>

    <!-- Page Footer -->
    <footer>
        <p> Admin Dashboard</p>
    </footer>

</body>
</html>