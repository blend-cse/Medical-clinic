<?php
if (session_id() == '') {
    session_start();
}
//var_dump($_SESSION['admin_email']);die();
if (!$_SESSION['admin_email']) {
    header('Location: /medical-clinic/admin/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/admin-style.css"/>
</head>
<body>
<?php include "../components/admin_nav.php"?>
    <h5>Logged in as:</h5>
    <h3> <?php echo "${_SESSION['admin_name']} with role ${_SESSION['admin_role']} "?></h3>
</body>
</html>

