<?php
require ("../../classes/Database.php");
require("../../classes/Department.php");

if (session_id() == '') {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
    if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        Department::deleteById($id);
        $_SESSION['admin_message'] = 'Deleted!';
        header("Location: /medical-clinic/admin/departments" );
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["title"]) && isset($_POST["description"]) && !empty($_POST["title"])&& !empty($_POST["description"])) {
        $title = $_POST["title"];
        $content = $_POST["description"];
        $photo = $_POST["photo"];

        $department = new Department();
        $department->setTitle($title);
        $department->setDescription($content);
        $department->setPhoto($photo);

        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            $department->setId($_POST["id"]);
            $department->updateInDatabase();
        } else {
            $department->saveToDatabase();
        }

        $_SESSION['admin_message'] = 'Page created!';
    } else {
        $_SESSION['admin_error'] = 'Fill all fields!';
    }
    header("Location: /medical-clinic/admin/departments");
    exit();
} else {
    if (isset($_GET['id']) && $id = $_GET['id']) {
        $department = Department::getById($id);
    }
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
<h1>Departments Crud</h1>
<?php
    if (isset($department)) {
        echo "<h3>${department['title']}</h3>";
    } else {
        echo '<h3>Create</h3>';
    }
?>
<div class="container">

    <form method="post" action="/medical-clinic/admin/departments/index.php">
        <input type="hidden" name="id" value="<?php echo isset($department) ?   $department['id'] :'' ?>" >
        <label for="fname">Title</label>
        <input type="text" id="fname" name="title" placeholder="Title" value="<?php echo isset($department) ?  $department['title'] :'' ?>">

        <label for="lname">Photo</label>
        <input type="text" id="lname" name="photo" placeholder="Photo path"  value="<?php echo isset($department) ?  $department['photo'] :'' ?>">

        <label for="content">Description</label>
        <textarea id="content" name="description" placeholder="Write something.." style="height:200px"><?php echo isset($department) ?  $department['description'] :'' ?></textarea>

        <input type="submit" value="Save">
    </form>
</div>
<br>
<h3>List</h3>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Date</ht>
        <th>Photo</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($departments as $department) {?>
        <tr>
            <td><?php echo $department['id']; ?></td>
            <td><?php echo $department['title']; ?></td>
            <td style="max-width: 150px; overflow: hidden; white-space: nowrap"><?php echo $department['description']; ?></td>
            <td><?php echo $department['create_date']; ?></td>
            <td><?php echo $department['photo']; ?></td>
            <td>
                <a href="/medical-clinic/admin/departments?id=<?php echo $department['id']?>">Edit</a>
                <a href="/medical-clinic/admin/departments?id=<?php echo $department['id']?>&action=delete">Delete</a>

            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
</body>
</html>


