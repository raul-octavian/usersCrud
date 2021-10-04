<?php
spl_autoload_register(function ($class)
{require_once"classes/".$class.".php";});

class User
{
    protected $username= "";
    protected $lName= "";
    protected $fName= "";
    protected $description= "";
    protected $email= "";
    protected $rank = 1;
    public $db;
    public $message = '';

    public function __construct($username = "", $lName = "", $fName = "", $description = "", $rank = 1, $email = "" ) {

   $this->db = new DBConn();
   $this->username = $username;
   $this->lName = $lName;
   $this->fName = $fName;
   $this->description =$description;
   $this->email = $email;
   $this->rank = $rank;

    }

    public function hashPassword( $password,  $iteration = 15 ) {
        $iterations = ['cost' => $iteration];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);
        return $hashed_password;
    }

    public function fetchAllUsers() {

        $query = $this->db->dbCon->prepare("SELECT * FROM users_table");
        if($query->execute()) {
            $result = $query->fetchall();
            return $result;
        }
        return "The database did not hold any data";

    }

    public function createUser($pass, $itr = 15) {


        $password =  $this->hashPassword($pass, $itr);

        $query = $this->db->dbCon->prepare("INSERT INTO `users_table` (username, password, lName, fName, description, email, rank) 
                                    VALUES (:username, :password, :lName, :fName, :description, :email, :rank)");

        $query->bindValue(':username', $this->username);
        $query->bindValue(':lName', $this->lName);
        $query->bindValue(':fName', $this->fName);
        $query->bindValue(':description', $this->description);
        $query->bindValue(':email', $this->email);
        $query->bindValue(':rank', $this->rank);
        $query->bindValue(':password', $password);

        if ($query->execute()) {
            $this->message = "User Created.";
        } else {
            $this->message = "User could not be created.";
        }

    }

    public function deleteUser($id) {
         $query = $this->db->dbCon->prepare("DELETE FROM `users_table` WHERE ID=$id" );
         if($query->execute()) {
             $this->message = "User deleted";
             Header("Location: allUsers.php");
         } else {
             $this->message = "User could not be deleted";
         }
    }

    public function fetchUser($id) {

        $query =$this->db->dbCon->prepare(
            "SELECT username, password, lName, fName, description, email, rank 
                    FROM `users_table`
                    WHERE ID = '$id'
                    ");
        $result_user = null;
        if($query->execute()) {
            $result_user = $query->fetch(PDO::FETCH_ASSOC);
        }else {
            $this->message = "the user could not be found";
            exit;
        }

        $this->username = $result_user['username'];
        $this->lName = $result_user['lName'];
        $this->fName = $result_user['fName'];
        $this->description =$result_user['description'];
        $this->email = $result_user['email'];
        $this->rank = $result_user['rank'];



        return $result_user;
    }

    public function updateValues($username, $lName, $fName , $description , $rank , $email, $id ) {

        $this->username = $username;
        $this->lName = $lName;
        $this->fName = $fName;
        $this->description =$description;
        $this->email = $email;
        $this->rank = $rank;
        $ID = $id;

        $query = $this->db->dbCon->prepare("
                                            UPDATE `users_table` 
                                            SET 
                                                username = :username, 
                                                lName = :lName , 
                                                fName = :fName, 
                                                description = :description, 
                                                email = :email, 
                                                rank = :rank
                                            WHERE ID = '$ID'
                                            ");

        $query->bindValue(':username', $this->username);
        $query->bindValue(':lName', $this->lName);
        $query->bindValue(':fName', $this->fName);
        $query->bindValue(':description', $this->description);
        $query->bindValue(':email', $this->email);
        $query->bindValue(':rank', $this->rank);

        if ($query->execute()) {
            $this->message = "User Updated.";
        } else {
            $this->message = "User could not be updated.";
        }


    }
}