<?php

class User
{
    //Properties
    private $id;
    private $name;
    private $surname;
    private $email;
    private $role;
    private $password;

    //Getters & Setters
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role = 'patient')
    {
        $this->role = $role;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    //Functions

    //Create
    public function saveToDatabase()
    {
        $conn = Database::connection();
        $name = $this->getName();
        $surname = $this->getSurname();
        $email = $this->getEmail();
        $role = $this->getRole();
        $password = $this->getPassword();

        $sql = "INSERT INTO users (name, surname, email, user_role, password)
                            VALUES ('$name', '$surname', '$email', '$role', '$password');";

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
        $email = $this->getEmail();
        $role = $this->getRole();
        $password = $this->getPassword();
        $sql = "UPDATE users
                SET name='$name', surname='$surname', email='$email', user_role='$role'
                WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $sql = $conn->query("SELECT * FROM users WHERE id = '$id'");
            return mysqli_fetch_assoc($sql);
        }

        return false;
    }

    // Read
    public static function getAll()
    {
        $conn = Database::connection();

        $sql = $conn->query("SELECT * FROM users");

        return $sql->fetch_all( MYSQLI_ASSOC);
    }

    // Delete
    public static function deleteUserById($id)
    {
        $conn = Database::connection();
        $sql = "DELETE FROM users WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            return true;
        }

        return  false;
    }

    public static function getUserByEmailAndPassword($email, $password)
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM users where email = '$email' and password = '$password'");

        return mysqli_fetch_assoc($sql);
    }

    public static function getById($id)
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM users where id = $id");

        return mysqli_fetch_assoc($sql);
    }

    public static function getLast()
    {
        $conn = Database::connection();
        $sql = $conn->query("SELECT * FROM users ORDER BY id DESC");

        return mysqli_fetch_assoc($sql);
    }

    // Delete
    public static function deleteById($id)
    {
        $conn = Database::connection();
        $sql = "DELETE FROM users WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            return true;
        }

        return false;
    }
}
