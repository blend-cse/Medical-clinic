<?php


class Doctor
{
    private $id;
    private $name;
    private $surname;
    private $bio;
    private $departmentId;
    private $photo;

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

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    //Create
    public function saveToDatabase()
    {
        $conn = Database::connection();
        $name = $this->getName();
        $surname = $this->getSurname();
        $bio = $this->getBio();
        $departmentId = $this->getDepartmentId();
        $photo = $this->getPhoto();

        $sql = "INSERT INTO doctors (name, surname, bio, department_id, photo)
                            VALUES ('$name', '$surname', '$bio', '$departmentId', '$photo');";

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
        $bio = $this->getBio();
        $departmentId = $this->getDepartmentId();
        $photo = $this->getPhoto();

        $sql = "UPDATE doctors
                SET name='$name', surname='$surname', bio='$bio', department_id='$departmentId', photo='$photo'
                WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $sql = $conn->query("SELECT * FROM doctors WHERE id = '$id'");
            return mysqli_fetch_assoc($sql);
        }

        return false;
    }

    // Read
    public static function getAll()
    {
        $conn = Database::connection();

        $sql = $conn->query("SELECT * FROM doctors");

        return $sql->fetch_all( MYSQLI_ASSOC);
    }

    // Delete
    public static function deleteById($id)
    {
        $conn = Database::connection();
        $sql = "DELETE FROM doctors WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            return true;
        }

        return  false;
    }

    public static function getById($id)
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM doctors where id = $id");

        return mysqli_fetch_assoc($sql);
    }

    public static function getLast()
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM doctors ORDER BY id DESC");

        return mysqli_fetch_assoc($sql);
    }
}
