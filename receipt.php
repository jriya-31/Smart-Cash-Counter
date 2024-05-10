<?php
include('./connect.php');

session_start();
$userId = $_SESSION['id'];

$name = "";
$query = "SELECT `name` FROM login WHERE id = '$userId'";
$nameResult = mysqli_query($conn, $query);
if ($nameRow = mysqli_fetch_assoc($nameResult)) {
    $name = $nameRow['name'];
}

$paymentQuery = "SELECT total_amount, purchased_items, payment_date FROM Payments WHERE user_id = '$userId'";
$paymentResult = mysqli_query($conn, $paymentQuery);
if ($paymentRow = mysqli_fetch_assoc($paymentResult)) {
    $totalAmount = $paymentRow['total_amount'];
    $date = $paymentRow['payment_date'];
    $purchasedItems = unserialize($paymentRow['purchased_items']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && !isset($_SESSION["payment_processed"])) {
    $_SESSION["payment_processed"] = true;
    header("Location: receipt.php");
    exit();
}

?>


<!DOCTYPE html>

<head>
    <title>Receipt</title>
    <link rel="icon" href="./img/logo1.png">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        cursor: pointer;
        text-decoration: none;
    }

    :root {
        --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
        --outline: 0.1rem solid rgba(0, 0, 0, 0.1);
        --outline-hover: 0.1rem solid black;
    }

    html {
        font-size: 100%;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    body {
        background-color: #eee;
    }

    .receipt {
        background-color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: 10rem 20rem;
        padding: 2rem;
        border: var(--outline);
        border-radius:0.5rem;
        box-shadow: var(--box-shadow);
    }

    .prod{
        margin-bottom: 1rem;
    }
</style>

<body>
<div class="receipt">
        <h3 style="text-align: center; font-family: Poppins; font-size: x-large;">FR. C. RODRIGUES INSTITUE OF TECHNOLOGY</h3><br><br>
        <p style="font-weight: bold;">Name: <?php echo $name;?></p>
        <p style="font-weight: bold;">Date: <?php echo $date;?></p>
        <div class="prod">
            <?php
            if (isset($purchasedItems) && is_array($purchasedItems)) {
                foreach ($purchasedItems as $item) {
                    echo "<br>";
                    $productName = $item['product_name'];
                    $price = $item['price'];
                    $quantity = $item['quantity'];

                    echo "<p>Product: $productName</p>";
                    echo "<p>Price: $price</p>";
                    echo "<p>Quantity: $quantity</p>";
                }
            } else {
                echo "No purchased items found.";
            }
            ?>
        </div>
        <p style="font-weight: bold;">Total Amount Paid: <?php echo $totalAmount; ?></p>
    </div>
</body>

</html>