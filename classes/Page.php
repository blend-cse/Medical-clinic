<?php


class Page
{
    private $id;
    private $title;
    private $content;
    private $date;
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

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
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
        $content = $this->getContent();
        $date = $this->getDate();
        $photo = $this->getPhoto();

        $sql = "INSERT INTO pages (title, content, date, photo) VALUES ('$title', '$content', '$date', '$photo');";

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

        $title = $this->getTitle();
        $content = $this->getContent();
        $date = $this->getDate();
        $photo = $this->getPhoto();
        $sql = "UPDATE pages
                SET title='$title', content='$content', date='$date', photo='$photo'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $sql = $conn->query("SELECT * FROM pages WHERE id = '$id'");
            return mysqli_fetch_assoc($sql);
        }


        return false;
    }

    // Read
    public static function getAll()
    {
        $conn = Database::connection();

        $sql = $conn->query("SELECT * FROM pages");

        return $sql->fetch_all(MYSQLI_ASSOC);
    }

    // Delete
    public static function deleteById($id)
    {
        $conn = Database::connection();
        $sql = "DELETE FROM pages WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            return true;
        }

        return false;
    }

    public static function getById($id)
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM pages where id = $id");

        return mysqli_fetch_assoc($sql);
    }

    public static function getLast()
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM pages ORDER BY id DESC");

        return mysqli_fetch_assoc($sql);
    }


}
