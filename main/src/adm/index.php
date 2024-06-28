<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>ITSMYSTUDY</title>
    <link href="../../../assets/img/logo2.png" rel="icon">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../assets/css/admin-main.css">
</head>

<body class="align">

    <div class="grid align__item">

        <div class="register">
            <img src="../../../assets/img/logo2.png" alt="itsmystudy logo" class="site__logo" width="150" height="150">
            <h2>Login</h2>
            <form action="./backend/loginAdmin.php" method="post" class="form">

                <div class="form__field">
                    <input type="email" placeholder="Enter your email address" name="email" required>
                </div>

                <div class="form__field">
                    <input type="password" placeholder="Enter your password" name="pwd" required>
                </div>

                <div class="form__field">
                    <input type="submit" value="Login" name="login">
                </div>

            </form>
        </div>

    </div>

</body>

</html>