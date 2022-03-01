<?php
require("../../classes/Database.php");
require("../../classes/User.php");

if (session_id() == '') {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') { //Kur fshihet nje rrsht
    if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        User::deleteById($id);
        $_SESSION['admin_message'] = 'Deleted!';
        header("Location: /medical-clinic/admin/users");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Kur behet forma submit
    if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"])) {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $userRole = $_POST["user_role"];
        $password = $_POST["password"];


        $user = new User();
        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($email);
        $user->setRole($userRole);
        $user->setPassword($password);

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $user->setId($_POST["id"]);
            $saved = $user->updateInDatabase();
        } else {
            $saved = $user->saveToDatabase();
        }

        if ($saved) {
            $_SESSION['admin_message'] = 'User created!';
        } else {
            $_SESSION['admin_error'] = 'Failed saving!';
        }
    } else {
        $_SESSION['admin_error'] = 'Fill all fields!';
    }
    header("Location: /medical-clinic/admin/users");
    exit();
} else { // Kur vizitohet faqja
    if (isset($_GET['id']) && $id = $_GET['id']) {
        $user = User::getById($id);
    }
    $users = User::getAll();
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
if (isset($user)) {
    echo "<h3>${user['name']}</h3>";
} else {
    echo '<h3>Create</h3>';
}
?>
<div class="container">

    <form method="post" action="/medical-clinic/admin/users/index.php">
        <input type="hidden" name="id" value="<?php echo isset($user) ? $user['id'] : '' ?>">
        <label for="fname">Name</label>
        <input type="text" id="fname" name="name" placeholder="Title"
               value="<?php echo isset($user) ? $user['name'] : '' ?>">

        <label for="lname">Surname</label>
        <input type="text" id="lname" name="surname" placeholder="Surname"
               value="<?php echo isset($user) ? $user['surname'] : '' ?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email"
               value="<?php echo isset($user) ? $user['email'] : '' ?>">

        <label for="roles">Roles</label>
        <select id="roles" name="user_role">
            <option <?php echo isset($user) && $user['user_role'] == 'super_admin' ? 'selected' : ''; ?>
                    value="super_admin">Super Admin
            </option>
            <option <?php echo isset($user) && $user['user_role'] == 'admin' ? 'selected' : ''; ?> value="admin">Admin
            </option>
            <option <?php echo isset($user) && $user['user_role'] == 'staf' ? 'selected' : ''; ?> value="staf">Staf
            </option>
            <option <?php echo isset($user) && $user['user_role'] == 'patient' ? 'selected' : ''; ?> value="patient">
                Patient
            </option>
        </select>
        <?php if (!isset($user)) { ?>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" value="">
        <?php } ?>

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
        <th>Email</th>
        <th>Role</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['surname']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['user_role']; ?></td>
            <td>
                <a href="/medical-clinic/admin/users?id=<?php echo $user['id'] ?>">Edit</a>
                <a href="/medical-clinic/admin/users?id=<?php echo $user['id'] ?>&action=delete">Delete</a>

            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>


