<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../classes/Database.php";
    include "../classes/User.php";

    if (session_id() == '') {
        session_start();
    }
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $pass = md5($_POST["password"]);
        $user = User::getUserByEmailAndPassword($email, $pass);
        if (!$user) {
            $_SESSION['error'] = 'Wrong login credentials!';
        } else if (!($user['user_role'] == 'admin' || $user['user_role'] == 'super_admin')) {
            $_SESSION['error'] = 'You dont have permission to login!';
        }else {
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_name'] = $user['name'];
            $_SESSION['admin_surname'] = $user['surname'];
            $_SESSION['admin_role'] = $user['user_role'];
        }

        header('Location: /medical-clinic/admin');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <link rel="stylesheet" href="../css/admin-login.css"/>
    <link rel="stylesheet" href="../vendors/font-awsome/css/all.css"/>
    <title></title>
</head>

<body>

<div class="main">
    <p class="sign" align="center">Admin -> Sign in</p>
    <form class="form1" method="POST" action="login.php">
        <input class="un " type="email" name="email" placeholder="email" required>
        <input class="pass" type="password" name="password"  placeholder="Password" required>
        <button type="submit" class="submit" align="center">Sign in</button>
    </form>
</div>

</body>
</html>
