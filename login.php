<?php
include "classes/Database.php";
include "classes/User.php";

if (session_id() == '') {
    session_start();
}

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $pass = md5($_POST["password"]);
    $user = User::getUserByEmailAndPassword($email, $pass);

    if (!$user) {
        $_SESSION['error'] = 'Wrong login credentials!';
    } else {
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['surname'] = $user['surname'];
        $_SESSION['role'] = $user['role'];
    }

    header('Location: /medical-clinic');
}
