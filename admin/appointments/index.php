<?php
require ("../../classes/Database.php");
require("../../classes/Appointment.php");
require("../../classes/Department.php");

if (session_id() == '') {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' ) { //Kur fshihet nje rrsht
    if (isset($_GET["id"]) && isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        Appointment::deleteById($id);
        $_SESSION['admin_message'] = 'Deleted!';
        header("Location: /medical-clinic/admin/appointments");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Kur behet forma submit
    if (isset($_POST["name"]) && isset($_POST["surname"]) && !empty($_POST["name"]) && !empty($_POST["surname"])) {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $contactDescription = $_POST["contact_description"];
        $departmentId = $_POST["department_id"];
        $date = $_POST["date"];

        $appointment = new Appointment();
        $appointment->setName($name);
        $appointment->setName($name);
        $appointment->setSurname($surname);
        $appointment->setContactDescription($contactDescription);
        $appointment->setDate($date);
        $appointment->setDepartmentId($departmentId);

        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            $appointment->setId($_POST["id"]);
            $saved = $appointment->updateInDatabase();
        } else {
            $saved = $appointment->saveToDatabase();
        }

        if ($saved) {
            $_SESSION['admin_message'] = 'Appointment created!';
        } else {
            $_SESSION['admin_error'] = 'Failed saving!';
        }
    } else {
        $_SESSION['admin_error'] = 'Fill all fields!';
    }
    header("Location: /medical-clinic/admin/appointments");
    exit();
} else { // Kur vizitohet faqja
    if (isset($_GET['id']) && $id = $_GET['id']) {
        $appointment = Appointment::getById($id);
    }
    $appointments = Appointment::getAll();
    $departments = Department::getAll();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/admin-style.css"/>
</head>
<body>
<?php include "../../components/admin_nav.php" ?>
<h1>Appointments Crud</h1>
<?php
    if (isset($appointment)) {
        echo "<h3>${appointment['name']}</h3>";
    } else {
        echo '<h3>Create</h3>';
    }
?>
<div class="container">

    <form method="post" action="/medical-clinic/admin/appointments/index.php">
        <input type="hidden" name="id" value="<?php echo isset($appointment) ?   $appointment['id'] :'' ?>" >
        <label for="fname">Name</label>
        <input type="text" id="fname" name="name" placeholder="Title" value="<?php echo isset($appointment) ?  $appointment['name'] :'' ?>">

        <label for="lname">Surname</label>
        <input type="text" id="lname" name="surname" placeholder="Surname"  value="<?php echo isset($appointment) ?  $appointment['surname'] :'' ?>">

        <label for="department">Department</label>
        <select id="department" name="department_id">
            <option>Select Department</option>
            <?php
            foreach ($departments as $department) {
                $selected = isset($appointment) && $department['id']  == $appointment['department_id'] ? 'selected' : '';
                echo "<option $selected value='${department['id']}'> ${department['title']} </option>";
            }
            ?>
        </select>

        <label for="description">Description</label>
        <textarea id="description" name="contact_description" placeholder="Write something.." style="height:200px"><?php echo isset($appointment) ? $appointment['contact_description'] :'' ?></textarea>

        <input type="submit" value="Save">
    </form>
</div>
<br>
<h3>List</h3>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Description</th>
        <th>Department</th>
        <th>Date</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($appointments as $appointment) {?>
        <tr>
            <td><?php echo $appointment['id']; ?></td>
            <td><?php echo $appointment['name']; ?></td>
            <td><?php echo $appointment['surname']; ?></td>
            <td style="max-width: 150px; overflow: hidden; white-space: nowrap"><?php echo $appointment['contact_description']; ?></td>
            <td><?php echo Department::getById( $appointment['department_id'])['title']; ?></td>
            <td><?php echo $appointment['date']; ?></td>
            <td>
                <a href="/medical-clinic/admin/appointments?id=<?php echo $appointment['id']?>">Edit</a>
                <a href="/medical-clinic/admin/appointments?id=<?php echo $appointment['id']?>&action=delete">Delete</a>

            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
</body>
</html>


