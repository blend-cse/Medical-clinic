<?php
require ("../../classes/Database.php");
require("../../classes/Doctor.php");
require("../../classes/Department.php");

if (session_id() == '') {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' ) { //Kur fshihet nje rrsht
    if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        Doctor::deleteById($id);
        $_SESSION['admin_message'] = 'Deleted!';
        header("Location: /medical-clinic/admin/doctors");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Kur behet forma submit
    if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["bio"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["bio"])) {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $bio = $_POST["bio"];
        $photo = $_POST["photo"];
        $departmentId = $_POST["department_id"];

        $doctor = new Doctor();
        $doctor->setName($name);
        $doctor->setSurname($surname);
        $doctor->setBio($bio);
        $doctor->setPhoto($photo);
        $doctor->setDepartmentId($departmentId);

        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            $doctor->setId($_POST["id"]);
            $doctor->updateInDatabase();
        } else {
            $doctor->saveToDatabase();
        }

        $_SESSION['admin_message'] = 'Doctor created!';
    } else {
        $_SESSION['admin_error'] = 'Fill all fields!';
    }
    header("Location: /medical-clinic/admin/doctors");
    exit();
} else { // Kur vizitohet faqja
    if (isset($_GET['id']) && $id = $_GET['id']) {
        $doctor = Doctor::getById($id);
    }
    $doctors = Doctor::getAll();
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
<h1>Doctors Crud</h1>
<?php
    if (isset($doctor)) {
        echo "<h3>${doctor['name']}</h3>";
    } else {
        echo '<h3>Create</h3>';
    }
?>
<div class="container">

    <form method="post" action="/medical-clinic/admin/doctors/index.php">
        <input type="hidden" name="id" value="<?php echo isset($doctor) ?   $doctor['id'] :'' ?>" >
        <label for="fname">Name</label>
        <input type="text" id="fname" name="name" placeholder="Title" value="<?php echo isset($doctor) ?  $doctor['name'] :'' ?>">

        <label for="lname">Surname</label>
        <input type="text" id="lname" name="surname" placeholder="Surname"  value="<?php echo isset($doctor) ?  $doctor['surname'] :'' ?>">

        <label for="photo">Photo</label>
        <input type="text" id="photo" name="photo" placeholder="Photo path"  value="<?php echo isset($doctor) ?  $doctor['photo'] :'' ?>">

        <label for="department">Department</label>
        <select id="department" name="department_id">
            <option>Select Department</option>
            <?php
            foreach ($departments as $department) {
                $selected = isset($doctor) && $department['id']  == $doctor['department_id'] ? 'selected' : '';
                echo "<option $selected value='${department['id']}'> ${department['title']} </option>";
            }
            ?>
        </select>

        <label for="content">Bio</label>
        <textarea id="content" name="bio" placeholder="Write something.." style="height:200px"><?php echo isset($doctor) ? $doctor['bio'] :'' ?></textarea>

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
        <th>Photo</th>
        <th>Bio</th>
        <th>Department</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($doctors as $doctor) {?>
        <tr>
            <td><?php echo $doctor['id']; ?></td>
            <td><?php echo $doctor['name']; ?></td>
            <td><?php echo $doctor['surname']; ?></td>
            <td><?php echo $doctor['photo']; ?></td>
            <td style="max-width: 150px; overflow: hidden; white-space: nowrap"><?php echo $doctor['bio']; ?></td>
            <td><?php echo Department::getById( $doctor['department_id'])['title']; ?></td>
            <td>
                <a href="/medical-clinic/admin/doctors?id=<?php echo $doctor['id']?>">Edit</a>
                <a href="/medical-clinic/admin/doctors?id=<?php echo $doctor['id']?>&action=delete">Delete</a>

            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
</body>
</html>


