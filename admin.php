<?php
include("./connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        $productName = mysqli_real_escape_string($conn, $_POST['product_name']);
        if(isset($_FILES['product_image'])) {
            $fileName = $_FILES['product_image']['name'];
            $fileTmpName = $_FILES['product_image']['tmp_name'];
            $fileSize = $_FILES['product_image']['size'];
            $fileError = $_FILES['product_image']['error'];
            if ($fileError === 0) {
               echo "File added successfully!";
            } else {
                echo "Error uploading file!";
                exit();
            }
        } else {
            echo "No file selected!";
            exit();
        }
        $productPrice = mysqli_real_escape_string($conn, $_POST['product_price']);

        $insertProductQuery = "INSERT INTO `product_first` (`des`, `image`, `price`)
            VALUES ('$productName', '$fileName', '$productPrice')";

        if (mysqli_query($conn, $insertProductQuery)) {
            echo "Product added successfully!";
        } else {
            echo "Error adding product: " . mysqli_error($conn);
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $productId = mysqli_real_escape_string($conn, $_GET['id']);
    $deleteProductQuery = "DELETE FROM product_first WHERE product_id = '$productId'";

    if (mysqli_query($conn, $deleteProductQuery)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL</title>
    <link rel="stylesheet" href="adminstyle.css">
    <link rel="icon" href="./img/logo1.png">
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div></div>
            <div style="font-family: sans; font-size: larger;">DASHBOARD</div>
            <div><a href="logout.php">Logout</a></div>
        </nav>
    </header>

    <section class="main">
        <div class="add">
            <h3>ADD PRODUCTS</h3>
            <form method="POST" action="" class="form" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label for="product_name">Product name:</label></td>
                        <td><input type="text" name="product_name"></input></td>
                    </tr>
                    <tr>
                        <td><label for="product_image">Product image:</label></td>
                        <td><input type="file" name="product_image"></input></td>
                    </tr>
                    <tr>
                        <td><label for="product_price">Product price:</label></td>
                        <td><input type="text" name="product_price"></input></td>
                    </tr>
                </table>
                <button type="submit" name="add_product" class="btn">Add Product</button>
            </form>
        </div>
        <div class="delete">
            <h3>EXISTING PRODUCTS</h3>
            <table>
                <tr>
                    <th>Products</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                <?php
                $productListQuery = "SELECT * FROM product_first";
                $resultProductList = mysqli_query($conn, $productListQuery);

                while ($row = mysqli_fetch_assoc($resultProductList)) {
                    echo "<tr>
                    <td>{$row['des']}</td>
                    <td>{$row['price']}</td>
                    <td><a href='admin.php?action=delete&id={$row['product_id']}'>Delete</a></td>
                  </tr>";
                }
                ?>
            </table>
        </div>
    </section>


</body>

</html>