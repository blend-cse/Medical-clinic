<?php
require ("../../classes/Database.php");
require("../../classes/Page.php");

if (session_id() == '') {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
    if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        Page::deleteById($id);
        $_SESSION['admin_message'] = 'Deleted!';
        header("Location: /medical-clinic/admin/about");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["title"]) && isset($_POST["content"]) && !empty($_POST["title"])&& !empty($_POST["content"])) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $photo = $_POST["photo"];

        $page = new Page();
        $page->setTitle($title);
        $page->setContent($content);
        $page->setPhoto($photo);

        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            $page->setId($_POST["id"]);
            $page->updateInDatabase();
        } else {
            $page->saveToDatabase();
        }

        $_SESSION['admin_message'] = 'Page created!';
    } else {
        $_SESSION['admin_error'] = 'Fill all fields!';
    }
    header("Location: /medical-clinic/admin/about");
    exit();
} else {
    if (isset($_GET['id']) && $id = $_GET['id']) {
        $page = Page::getById($id);
    }
    $pages = Page::getAll();
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
<h1>About Crud</h1>
<?php
    if (isset($page)) {
        echo "<h3>${page['title']}</h3>";
    } else {
        echo '<h3>Create</h3>';
    }
?>
<div class="container">

    <form method="post" action="/medical-clinic/admin/about/index.php">
        <input type="hidden" name="id" value="<?php echo isset($page) ?   $page['id'] :'' ?>" >
        <label for="fname">Title</label>
        <input type="text" id="fname" name="title" placeholder="Title" value="<?php echo isset($page) ?  $page['title'] :'' ?>">

        <label for="lname">Photo</label>
        <input type="text" id="lname" name="photo" placeholder="Photo path"  value="<?php echo isset($page) ?  $page['photo'] :'' ?>">
<!--        <label for="country">Country</label>-->
<!--        <select id="country" name="country">-->
<!--            <option value="australia">Australia</option>-->
<!--            <option value="canada">Canada</option>-->
<!--            <option value="usa">USA</option>-->
<!--        </select>-->

        <label for="content">Content</label>
        <textarea id="content" name="content" placeholder="Write something.." style="height:200px"><?php echo isset($page) ?  $page['content'] :'' ?></textarea>

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
        <th>Photo</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($pages as $page) {?>
        <tr>
            <td><?php echo $page['id']; ?></td>
            <td><?php echo $page['title']; ?></td>
            <td style="max-width: 150px; overflow: hidden; white-space: nowrap"><?php echo $page['content']; ?></td>
            <td><?php echo $page['date']; ?></td>
            <td><?php echo $page['photo']; ?></td>
            <td>
                <a href="/medical-clinic/admin/about?id=<?php echo $page['id']?>">Edit</a>
                <a href="/medical-clinic/admin/about?id=<?php echo $page['id']?>&action=delete">Delete</a>

            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
</body>
</html>


