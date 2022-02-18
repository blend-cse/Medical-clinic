<?php
include "classes/Database.php";
include "classes/Doctor.php";

require("classes/Page.php");

if (session_id() == '') {
    session_start();
}


$page = Page::getById(1);

if (!$page) {
    $_SESSION['error'] = 'Department does not exist!';
    header('Location: /page404.php');
    exit();
}

$doctors = Doctor::getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="vendors/font-awsome/css/all.css"/>

</head>

<body>
<header>
    <?php include "components/header.php" ?>

    <div class="page-title">
        <h2 class="h1-aboutus"><?php echo $page['title'] ?>  </h2>
        <small style="color: #f9f9f9"><?php echo $page['date'] ?></small>
    </div>

</header>
<div class="about-section">
    <div class="section-col text-right">
        <img class="aboutus-img" src="photos/aboutus.jpg" alt=""/>
    </div>
    <div class="section-col text-left">
        <p class="about-medical"><?php echo $page['title'] ?></p>
        <?php echo $page['content'] ?>
    </div>
</div>
<div class="Quote-about">
    <p>Providing you with the best doctors for the best care </p>
</div>
<div class="Content-2">
    <?php
    foreach ($doctors as $doctor) {
        echo '<div class="Aboutus2">
        <img src="' . $doctor['photo'] . '" class="dr-images " alt="AmdrewKhan"/>
        <p class="p-dr">' . $doctor['name'] . ' ' . $doctor['surname'] . '</p>
        <p class="p-dr2">' . $doctor['bio'] . ' </p>

    </div>';
    }
    ?>
</div>
<br></br>
<footer>
    <div class="footer">
        <p>@UBT 2020.</p>
    </div>
</footer>
</body>

</html>
