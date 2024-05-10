<?php
include("./connect.php");
?>

<?php
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['id'])) {

    if (isset($_POST["add"])) {
        $producId = $_GET["id"];
        $productName = $_POST["hidden_name"];
        $productImage = $_POST["hidden_image"];
        $productPrice = $_POST["hidden_price"];
        $productQuantity = $_POST["quantity"];

        $userId = $_SESSION['id'];
        $checkUserQuery = "SELECT * FROM `login` WHERE `id` = '$userId'";
        $resultCheckUser = mysqli_query($conn, $checkUserQuery);

        if (mysqli_num_rows($resultCheckUser) == 1) {
            $checkProductQuery = "SELECT * FROM `product_second`
            WHERE `des` = '$productName'
            AND `image` = '$productImage'
            AND `price` = '$productPrice'
            AND `user_id` = '$userId'";

            $resultCheckProduct = mysqli_query($conn, $checkProductQuery);

            if (mysqli_num_rows($resultCheckProduct) > 0) {
                $_SESSION['product_already_added'] = "Product already added to the cart.";
            } else {
                $sql = "INSERT INTO `product_second` (`des`, `image`, `price`, `quantity`, `user_id`)
            VALUES ('$productName', '$productImage', '$productPrice', '$productQuantity', '$userId')";

                if (mysqli_query($conn, $sql)) {
                    echo "Product added to cart successfully.";
                    header("Location: user.php?success=1");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Error: User ID does not exist.";
        }
    }
} else {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCRIT's Smart Cash Counter</title>
    <link rel="icon" href="./img/logo1.png">
    <link rel="stylesheet" href="userstyle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://kit.fontawesome.com/0d38072254.js" crossorigin="anonymous"></script>

</head>

<body>
    <header class="header">
        <nav class="navbar">
            <a href="#home">HOME</a>
            <a href="#about">ABOUT US</a>
            <a href="#contact">CONTACT</a>
            <a href="logout.php">LOGOUT</a>
        </nav>
        <div class="icons">
            <div id="menu-btn"><i class="fa-solid fa-bars"></i></div>
            <a href="cart.php">
                <div id="cart-btn" class="x"><i class="fa-solid fa-cart-shopping"></i></div>
            </a>
            <div id="profile-btn"><i class="fa-solid fa-user"></i></div>
        </div>
    </header>

    <section class="home" id="home">
        <img src="img/logo1.png" height="120" width="110">
        <div class="content">
            <p1>AGNEL CHARITIES'</p1>
            <p2>FR. C. RODRIGUES INSTITUE OF TECHNOLOGY</p2>
            <p3>Agnel Technical Education Complex Sector 9-A, Vashi, Navi Mumbai, Maharashtra, India PIN - 400703</p3>
        </div>
    </section>

    <section class="products">
        <h3>OUR <span>PRODUCTS</span></h3>
        <?php
        if (isset($_SESSION['product_already_added'])) {
            echo '<p class="success-message">' . $_SESSION['product_already_added'] . '</p>';
            unset($_SESSION['product_already_added']);
        }
        $query = "SELECT * FROM `product_first` ORDER BY product_id ASC";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
        ?>
            <div class="swiper container">
                <div class="swiper-wrapper">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <div class="swiper-slide box">
                            <form action="user.php?action=add&id=<?php echo $row["product_id"] ?>" method="post">
                                <img src="img/<?php echo $row["image"]; ?>" alt="roduct Image">
                                <h3><?php echo $row["des"] ?></h3>
                                <p>&#x20B9; <?php echo $row["price"]; ?></p>
                                <input type="text" id="quantity" name="quantity" value="1">
                                <input type="hidden" name="hidden_image" value="<?php echo $row["image"]; ?>">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["des"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>"><br>
                                <input type="submit" class="btn" name="add" value="Add to Cart">
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </section>


    <section class="about" id="about">
        <div class="container2">
            <div class="left">
                <h1>ABOUT US</h1>
            </div>
            <div class="right">
                <p>Welcome to our Online Cash Counter at FCRIT! We are committed to providing a seamless financial experience for our students and staff. Our platform ensures secure and efficient transactions, contributing to the overall convenience of financial processes within the college. Your satisfaction and trust are our top priorities as we strive to simplify your financial interactions on campus. Our only motto is "Empowering transactions,enhancing campus life"</p><br>
                <p2>To visit college site click below</p2><br>
                <a href="https://fcrit.ac.in/">Visit site &gt;</a>
            </div>
        </div>
    </section>

    <footer class="footer" id="contact">
        <div class="container1">
            <div class="box1">
                <h4>Contact</h4>
                <div class="contact">
                    <p><i class="fa-solid fa-square-phone"></i>(022) 27771000 , 27662949</p>
                    <p><i class="fa-solid fa-tty"></i>(022) 27660619</p>
                    <p><i class="fa-solid fa-envelope"></i>principal@fcrit.ac.in</p>
                </div>
            </div>
            <div class="box1">
                <h4>Links</h4>
                <div class="links">
                    <a href="https://www.youtube.com/@fcritvashiofficial4407"><i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://www.facebook.com/FCRIT/"><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="jscopy.js"></script>

</body>

</html>