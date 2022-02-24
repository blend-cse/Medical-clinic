<?php include "admin_messages.php"?>
<div id="mySidenav" class="sidenav">
    <a href="/medical-clinic/admin"><?php echo $_SESSION['admin_name']?></a>
    <br>
    <a href="/medical-clinic/admin/appointments">Appointments</a>
    <a href="/medical-clinic/admin/departments">Departments</a>
    <a href="/medical-clinic/admin/doctors">Doctors</a>
    <?php if($_SESSION['admin_role'] == 'super_admin') { ?>
        <a href="/medical-clinic/admin/users">Users</a>
    <?php } ?>
    <a href="/medical-clinic/admin/about">About</a>

    <a href="/medical-clinic/logout.php" style="position: absolute; z-index: 1; bottom: 100px;" > Logout</a>
</div>
