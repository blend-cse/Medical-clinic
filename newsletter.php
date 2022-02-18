<?php
include "classes/Database.php";
require("classes/Newsletter.php");

if (session_id() == '') {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
        $newsletter = new Newsletter();
        $newsletter->setEmail($email);
        $newsletter->setCrateDate(date('Y-m-d H:i:s'));


        if ($news = $newsletter->create()) {
            $_SESSION['message'] = "You subscribed to newsletter with this email: <b>${news['email']}</b>!";
        } else {
            $_SESSION['error'] = "You can't subscribe to newsletter with this email: <b>$email</b>!";
        }
        header('Location: /');
    }
}
