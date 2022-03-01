<?php

class Newsletter
{
    private $id;
    private $email;
    private $crateDate;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCrateDate()
    {
        if (!$this->crateDate) {
            return date('Y-m-d H:i:s');
        }
        return $this->crateDate;
    }

    public function setCrateDate($crateDate)
    {
        $this->crateDate = $crateDate;
    }

    //Create
    public function create()
    {
        $conn = Database::connection();

        $email = $this->getEmail();
        $date = $this->getCrateDate();

        $sql = "INSERT INTO newsletter (email, create_date) VALUES ('$email', '$date');";

        if ($conn->query($sql) === TRUE) {
            return self::getLast();
        }

        return false;
    }

    // Read
    public static function read()
    {
        $conn = Database::connection();

        $sql = $conn->query("SELECT * FROM newsletter");

        return mysqli_fetch_all($sql, MYSQLI_ASSOC);
    }

    //Delete
    public static function delete($id)
    {
        $conn = Database::connection();
        $sql = "DELETE FROM newsletter WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            return true;
        }

        return  false;

    }

    public static function getLast()
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM newsletter ORDER BY id DESC");

        return mysqli_fetch_assoc($sql);
    }
}
