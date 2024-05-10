<?php
include("./connect.php");
?>

<?php
session_start();

if (!$conn) {
    echo "Connection failed";
} else {
    echo "Connection success";
}

if (isset($_POST['userid']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES);
        return $data;
    }

    $uid = validate($_POST["userid"]);
    $pwd = validate($_POST["password"]);

    if (empty($uid)) {
        header("Location:login.php?error=User ID Required.");
        exit();
    } else if (empty($pwd)) {
        header("Location:login.php?error=Password Required.");
        exit();
    } else {
        $sql = "SELECT * FROM login WHERE id='$uid'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPwd = $row['pw'];

            if (password_verify($pwd, $hashedPwd)) {
                $_SESSION['is_admin'] = $row['is_admin'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];

                if ($_SESSION['is_admin'] == 1) {
                    header("Location: admin.php");
                    exit();
                } else {
                    header("Location: user.php");
                    exit();
                }
            } else {
                header("Location:login.php?error=Incorrect User ID or Password.");
                exit();
            }
        } else {
            header("Location:login.php?error=Incorrect User ID or Password.");
            exit();
        }
    }
} else {
    header("Location:login.php");
    exit();
}
?>
