<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="./img/logo1.png">

    <style>
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    img.bg{
        position: absolute;
        height: 100vh;
        width: 100%;
        z-index:-1;
        opacity: 0.7;
    }
    img.logo{
        position: absolute;
        top:10px;
        right: 20px;
        width: 100px;
    }
    form{
        max-width: 400px;
        min-height: 80vh;
        padding: 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #ffffffac;
    }
    h1{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        text-align: center;
        margin-bottom: 40px;
    }
    input{
        display: block;
        margin: 5px 10px;
        padding: 10px;
        width: 300px;
        border-radius: 5px;
        border: 1px solid #0004ff;
    }
    .btn{   
        margin-top: 30px;
        padding: 10px 20px;
        background-color:#2a2ea9;
        color: #fff;
        cursor: pointer;
        border-radius: 10px;
        border: none;
        transition: .5s ease;
    }
    .btn:hover{
        background: #cad0ff;
        color: #000;
    }
    p.error{
        display: flex;
        align-items: center;
        justify-content: start;
        width: 90%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        color: #fff;
        background: rgba(255, 0, 0, 0.5);
    }
    </style>
</head>


<body>
    <img class="bg" src="img/bg.webp" alt="FCRIT"> 
    <img class="logo" src="img/logo1.png" alt="FCRIT">
    <form action="action.php" method="post">
        <h1>LOGIN</h1>
        <link rel="icon" href="./img/logo1.png">

        <?php
        if (isset($_GET['error'])) {?>
            <p class='error'><?php echo $_GET['error'];?></p>
        <?php
        }
        ?>
        <input type="tel" name="userid" id="id" placeholder="User ID" autofocus>
        <br>
        <input type="password" name="password" id="pw" placeholder="Password">

        <button type="submit" class="btn">LOGIN</button>
    </form>
</body>
</html>