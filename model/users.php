<?php
require_once "lib/database.php";
class Users
{
    public $id;
    public $firstname;
    public $lastname;
    public $address;
    public $gender;
    public $username;
    public $password;
    public $img;

    private static $tableName = "users";

    public function __construct($firstname, $lastname, $address, $gender, $username, $password, $img)
    {


        $this->firstname = $firstname;
        $this->lastname  = $lastname;
        $this->address   = $address;
        $this->gender    = $gender;
        $this->username  = $username;
        $this->password  = $password;
        $this->img       = $img;
    }


    public static function getAlluser($login = false, $id = 0)
    {
        if ($login == true) {
            $sql = "SELECT * FROM " . static::$tableName . " WHERE id != $id";
        } else {
            $sql = "SELECT * FROM " . static::$tableName . "";
        }

        $stmt = DATABASE::getInstance()->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users', array('firstname', 'lastname', 'address', 'gender', 'username', 'password', 'img'));
        return !empty($users) ? $users : false;
    }
    public static function getUser($id)
    {
        $sql = "SELECT * FROM " . static::$tableName . " WHERE id=:id";
        $stmt = DATABASE::getInstance()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users', array('firstname', 'lastname', 'address', 'gender', 'username', 'password', 'img'));
        return !empty($user) ? array_shift($user) : false;
    }

    public static function auth($username, $password)
    {
        $sql = "SELECT * FROM " . static::$tableName . " WHERE username=:username AND password=:password";
        $stmt = DATABASE::getInstance()->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users', array('firstname', 'lastname', 'address', 'gender', 'username', 'password', 'img'));
        return !empty($user) ? array_shift($user) : false;
    }

    public static function checkUserexist($username)
    {

        $sql = "SELECT * FROM " . static::$tableName . " WHERE username=:username";
        $stmt = DATABASE::getInstance()->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users', array('firstname', 'lastname', 'address', 'gender', 'username', 'password', 'img'));
        return !empty($user) ? array_shift($user) : false;
    }


    public function insertUser()
    {
        $sql = "INSERT INTO " . static::$tableName . " set firstname=:firstname,
                                      lastname=:lastname,
                                      address=:address,
                                      gender=:gender,
                                      username=:username,
                                      password=:password,
                                      img=:img";
        $stmt = DATABASE::getInstance()->prepare($sql);
        var_dump($stmt);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":img", $this->img);

        return $stmt->execute();
    }
    public function updateUser()
    {

        $sql = "UPDATE " . static::$tableName . " set firstname=:firstname,
                                lastname=:lastname,
                                address=:address,
                                gender=:gender,
                                username=:username,
                                password=:password,
                                img=:img
                                WHERE
                                id=:id";


        $stmt = DATABASE::getInstance()->prepare($sql);

        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':img', $this->img);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
    public function deleteUser()
    {
        $sql = "DELETE FROM " . static::$tableName . " WHERE id=:id";
        $stat = DATABASE::getInstance()->prepare($sql);
        $stat->bindParam(":id", $this->id);
        return $stat->execute();
    }
}
