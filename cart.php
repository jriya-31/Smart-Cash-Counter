<?php
session_start();
include("./connect.php");

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $productName = $_GET["name"];
    $userId = $_SESSION['id'];

    $deleteQuery = "DELETE FROM `product_second` WHERE des = '$productName' AND user_id = '$userId'";
    mysqli_query($conn, $deleteQuery);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && !isset($_SESSION["payment_processed"])) {
    $email = $_POST["email"];
    $userId = $_SESSION['id'];
    $totalAmount = $_POST["totalAmount"];
    $date = date("Y-m-d");

    $query = "SELECT * FROM `product_second` WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $query);
    $purchasedItems = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $purchasedItems[] = array(
            'product_name' => $row['des'],
            'price' => $row['price'],
            'quantity' => $row['quantity']
        );
    }

    $serializedItems = serialize($purchasedItems);

    $insertQuery = "INSERT INTO Payments (user_id, email, total_amount, purchased_items, payment_date) VALUES ('$userId', '$email', '$totalAmount', '$serializedItems', '$date')";
    mysqli_query($conn, $insertQuery);

    $deleteCartQuery = "DELETE FROM `product_second` WHERE user_id = '$userId'";
    mysqli_query($conn, $deleteCartQuery);

    $_SESSION["payment_processed"] = true;

    header("Location: receipt.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>
    <link rel="icon" href="./img/logo1.png">
    <link rel="stylesheet" href="ctstyle.css">
    <style>
        .payment-box {
    display: none;
    position: absolute;
    top: -100%;
    left: 50%;
    transform: translateX(-50%) ;
    background-color: #f3f2f2;
    padding: 1.4rem;
    border: var(--outline);
    border-radius: 0.5rem;
    box-shadow: var(--box-shadow);
    z-index: 999;
    transition: top 0.6s ease;
}

.close-btn {
    position: inherit;
    color: red;
    top: 0.1rem;
    right: 0.4rem;
    cursor: pointer;
}

.payment-box input[type="email"],
.payment-box input[type="integer"] {
    width: 100%;
    padding: 0.4rem;
    margin-bottom: 0.2rem;
    border: var(--outline);
    border-radius: 0.3rem;
    box-sizing: border-box;
}
    </style>

</head>

<body>
    <nav>
        <a href="user.php"><span>Shop here</span></a>
        <div>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="cart">
        <table>
            <h1>Cart</h1>
            <tr>
                <th></th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th></th>
            </tr>
            <?php
            $userId = $_SESSION['id'];
            $query = "SELECT * FROM `product_second` WHERE user_id = '$userId' ORDER BY user_id ASC";
            $result = mysqli_query($conn, $query);
            $total = 0;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <tr>
                        <td><img src="img/<?php echo $row["image"]; ?>" alt=""></td>
                        <td><?php echo $row["des"]; ?></td>
                        <td><?php echo $row["price"]; ?></td>
                        <td><?php echo $row["quantity"]; ?></td>
                        <td><?php echo number_format($row["quantity"] * $row["price"], 2); ?></td>
                        <td><a href="cart.php?action=delete&name=<?php echo $row["des"]; ?>"><span style="font-size: 1rem; color:red;">Remove item</span></a></td>
                    </tr>
            <?php
                    $total = $total + ($row["quantity"] * $row["price"]);
                }
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?php echo number_format($total, 2); ?></td>
                <td><button class="btn" id="proceedBtn">Proceed to Payment</button></td>
            </tr>
        </table>
    </div>


    <div class="payment-box" id="paymentBox">
        <span class="close-btn" onclick="closePaymentBox()">&times;</span>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="cardNo">Card Number:</label><br>
            <input type="integer" id="cardNo" name="cardNo" maxlength="16" pattern="[0-9]{16}" required><br>
            <label for="expiry">Expiry:</label><br>
            <input type="integer" id="expiry" name="expiry" maxlength="4" placeholder="MM/YY" required><br>
            <label for="cvv">CVV:</label><br>
            <input type="integer" id="cvv" name="cvv" maxlength="3" required><br><br>
            <input type="hidden" id="totalAmount" name="totalAmount" value="<?php echo $total; ?>">
            <button type="submit" class="btn" id="paybtn">Pay <?php echo number_format($total, 2); ?></button>
        </form>
    </div>

    <script>
        function closePaymentBox() {
            var paymentBox = document.getElementById('paymentBox');
            paymentBox.style.display = 'none';
        }

        document.getElementById('proceedBtn').addEventListener('click', function() {
            var paymentBox = document.getElementById('paymentBox');
            paymentBox.style.display = 'block';
            slidePaymentBox();
        });

        function slidePaymentBox() {
            var paymentBox = document.getElementById('paymentBox');
            var pos = -paymentBox.offsetHeight;
            var id = setInterval(frame, 5);

            function frame() {
                if (pos >= (window.innerHeight - paymentBox.offsetHeight) / 2) {
                    clearInterval(id);
                } else {
                    pos += 5;
                    paymentBox.style.top = pos + 'px';
                }
            }
        }

        document.getElementById('paybtn').addEventListener('click', function() {
            var paymentBox = document.getElementById('receipt.php')});

    </script>
</body>

</html>