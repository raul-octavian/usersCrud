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
        echo $id;
         $query = $this->db->dbCon->prepare("DELETE FROM `users_table` WHERE ID=$id" );
         if($query->execute()) {
             $this->message = "User deleted";
             Header("Location: allUsers.php");
         } else {
             $this->message = "User could not be deleted";
         }
    }
}