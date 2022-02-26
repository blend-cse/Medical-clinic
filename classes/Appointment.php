<?php


class Appointment
{
    private $id;
    private $name;
    private $surname;
    private $contactDescription;
    private $departmentId;
    private $date;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getContactDescription()
    {
        return $this->contactDescription;
    }

    public function setContactDescription($contactDescription)
    {
        $this->contactDescription = $contactDescription;
    }

    public function getDepartmentId()
    {
        if (!$this->departmentId) {
            return null;
        }
        return $this->departmentId;
    }

    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    public function getDate()
    {
        if (!$this->date) {
            return date('Y-m-d H:i:s');
        }
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    //Create
    public function saveToDatabase()
    {
        $conn = Database::connection();
        $name = $this->getName();
        $surname = $this->getSurname();
        $contactDescription = $this->getContactDescription();
        $department = $this->getDepartmentId();
        $date = $this->getDate();

        if ($department) {
            $sql = "INSERT INTO appointments (name, surname, contact_description, department_id, date)
                            VALUES ('$name', '$surname', '$contactDescription', $department, '$date');";
        } else {
            $sql = "INSERT INTO appointments (name, surname, contact_description, date)
                            VALUES ('$name', '$surname', '$contactDescription', '$date');";
        }

        if ($conn->query($sql) === TRUE) {
            return self::getLast();
        }

        return false;
    }

    //Update
    public function updateInDatabase()
    {
        $conn = Database::connection();
        $id = $this->getId();
        $name = $this->getName();
        $surname = $this->getSurname();
        $contactDescription = $this->getContactDescription();
        $department = $this->getDepartmentId();
        $date = $this->getDate();

        $sql = "UPDATE appointments
                SET name='$name', surname='$surname', contact_description='$contactDescription', department_id='$department', date='$date'
                WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $sql = $conn->query("SELECT * FROM appointments WHERE id = '$id'");

            return  mysqli_fetch_assoc($sql);
        }

        return false;
    }

    // Read
    public static function getAll()
    {
        $conn = Database::connection();

        $sql = $conn->query("SELECT * FROM appointments");

        return $sql->fetch_all( MYSQLI_ASSOC);
    }

    // Delete
    public static function deleteById($id)
    {
        $conn = Database::connection();
        $sql = "DELETE FROM appointments WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            return true;
        }

        return  false;
    }

    public static function getById($id)
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM appointments where id = $id");

        return mysqli_fetch_assoc($sql);
    }

    public static function getLast()
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM appointments ORDER BY id DESC");

        return mysqli_fetch_assoc($sql);
    }
}
