<?php include_once "connect.php";?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <style>
        table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background-color: #f8f8f8;
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Our Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody id="productTable">
        </tbody>
    </table>
    <script>
        // Fetch the product data from the backend
    function fetchItems (elementId) {
        fetch('items_backend.php') // Replace with your backend script path
            .then(response => response.json())
            .then(data => {
                const table = document.getElementById(elementId);
                data.forEach(product => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${product.item_name}</td>
                        <td>${product.item_desc}</td>
                        <td>$${parseFloat(product.item_price).toFixed(2)}</td>
                    `;
                    console.log(product.item_name);
                    table.appendChild(tr);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        }
         
        fetchItems('productTable'); -->

    </script>
</body>
</html>