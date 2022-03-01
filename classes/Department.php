<?php

class Department
{
    private $id;
    private $title;
    private $description;
    private $createDate;
    private $photo;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCreateDate()
    {
        if (!$this->createDate) {
            return date('Y-m-d H:i:s');
        }
        return $this->createDate;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
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

        $title = $this->getTitle();
        $content = $this->getDescription();
        $date = $this->getCreateDate();
        $photo = $this->getPhoto();

        $sql = "INSERT INTO departments (title, description, create_date, photo) VALUES ('$title', '$content', '$date', '$photo');";

        if ($conn->query($sql) === TRUE) {
            return self::getLast();
        }
        var_dump($conn->error);die();

        return false;
    }

    //Update
    public function updateInDatabase()
    {
        $conn = Database::connection();
        $id = $this->getId();

        $title = $this->getTitle();
        $content = $this->getDescription();
        $date = $this->getCreateDate();
        $photo = $this->getPhoto();
        $sql = "UPDATE departments
                SET title='$title', description='$content', create_date='$date', photo='$photo'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $sql = $conn->query("SELECT * FROM departments WHERE id = '$id'");
            return mysqli_fetch_assoc($sql);
        }


        return false;
    }


    // Read
    public static function getById($id)
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM departments where id = $id");

        return mysqli_fetch_assoc($sql);
    }

    public static function getAll()
    {
        $conn = Database::connection();

        $sql = $conn->query("SELECT * FROM departments");

        return $sql->fetch_all( MYSQLI_ASSOC);
    }

    public static function getLast()
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM departments ORDER BY id DESC");

        return mysqli_fetch_assoc($sql);
    }

    // Delete
    public static function deleteById($id)
    {
        $conn = Database::connection();
        $sql = "DELETE FROM departments WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            return true;
        }

        return false;
    }
}
