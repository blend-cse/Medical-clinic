<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include "classes/Database.php";

require("classes/Appointment.php");
require("classes/Department.php");

if (session_id() == '') {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['contact_description'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $contactDescription = $_POST['contact_description'];

        $contact = new Appointment();
        $contact->setName($name);
        $contact->setSurname($surname);
        $contact->setContactDescription($contactDescription);

        if (isset($_POST['department_id'])) {
            $contact->setDepartmentId($_POST['department_id']);
        }

        $contact->setDate(date('Y-m-d H:i:s'));
        $data = $contact->saveToDatabase();

        if ($data) {
            $_SESSION['message'] = "The appointment was done.";
        } else {
            $_SESSION['error'] = "Something went wrong!";
        }

    } else {
        $_SESSION['error'] = "Please fill all required fields!";
    }

    header('Location: /medical-clinic/contact.php');
    exit();
}
$departments = Department::getAll();
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
    <?php include "components/header.php"?>

    <div class="page-title">
        <h2 class="h1-aboutus">Contact Us</h2>
    </div>
</header>

<div class="contact-page">
    <div class="contact-us">
        <div class="contact-us-col contact-address">
            <h3> Our Location</h3>
            <br>
            <p> 500 Terry Francois Street</p>
            <p> San Francisco, CA 94158</p>
            <br>
            <p> Tel: 123-456-7890</p>
            <p> Fax: 123-456-7890</p>
            <br>
            <p><i class="far fa-envelope"></i> info@medical-clinic.com</p>
        </div>
        <div class="contact-us-col">
            <div class="container">
                <form method="POST" action="/medical-clinic/contact.php">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="name" placeholder="Your name.." required>

                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="surname" placeholder="Your last name.." required>

                    <label for="department-id" style="margin-bottom:5px">Departments</label>
                    <select id="department-id" name="department_id" style="width: 100%; padding: 5px 20px; margin-bottom: 10px;">
                       <option value=""> Select a department</option>
                       <?php
                            foreach($departments as $department) {
                                echo "<option value='${department['id']}'>${department['title']}</option>";
                            }
                       ?>
                    </select>
                    <label for="contact_description" style="margin-bottom:5px">Subject</label><br>
                    <textarea id="contact_description" name="contact_description" placeholder="Write something.." required
                              style="height:150px; width: 100%;"></textarea>

                    <input class="submit-button" type="submit" value="Submit">
                </form>
            </div>
        </div>
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
