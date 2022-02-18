<?php
include "classes/Database.php";

require("classes/Department.php");

if (session_id() == '') {
    session_start();
}

$departments = Department::getAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./vendors/font-awsome/css/all.css"/>
</head>

<body>
<header>
    <?php include "components/header.php"?>
    <div class="page-title">
        <h2 class="h1-aboutus">Departments</h2>
    </div>
</header>
<div class="Content3">

    <div class="departments">
        <?php
            foreach($departments as $department) {
                if($department['photo']) {
                    echo '<div class="post">
                            <img src="'.$department['photo'].'" class="dep-img " alt=""/>
                            <p class="p-dr">'.$department["title"].'</p>
                            <p class="p-dep">'.$department["description"].'</p>
                            <a href="/medical-clinic/department.php?id='.$department["id"].'" class="p-dep purple-color"> >Read more</a>
                         </div>';
                } else {
                    echo '<div class="post">
                            <img src="/photos/Orthopedics.png" class="dep-img " alt=""/>
                            <p class="p-dr">'.$department["title"].'</p>
                            <p class="p-dep">'.$department["description"].'</p>
                            <a href="/medical-clinic/department.php?id='.$department["id"].'" class="p-dep purple-color"> >Read more</a>
                         </div>';
                }

            }
        ?>
    </div>
</div>
<br>
<footer>
    <div class="footer">
        <p>@UBT 2020.</p>
    </div>
</footer>

</body>

</html>
