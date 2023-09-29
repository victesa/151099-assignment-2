<?php
require_once('../config/config.php');
session_start();

class UserRegistration {
    private $db;
    private $conn;
    private $fname;
    private $lname;
    private $email;
    private $password;
    private $confirmPassword;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
        $this->fname = $_POST["fname"];
        $this->lname = $_POST["lname"];
        $this->email = $_POST["email"];
        $this->password = $_POST["password"];
        $this->confirmPassword = $_POST["confirmPassword"];
    }

    public function registerUser() {

        if ($this->password == $this->confirmPassword) {
            $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);

            try {
                $stmt = $this->conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (:fname, :lname, :email, :password)");
                $stmt->bindParam(':fname', $this->fname);
                $stmt->bindParam(':lname', $this->lname);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':password', $hashedPassword);
            
                $stmt->execute();
                $_SESSION['emai;'] = $email;
                
                $_SESSION['user_authenticated'] = true; 

                header("Location: signIn.html");
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error: Passwords do not match";
        }
    }

    public function checkIfUserExists(){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        $user =$stmt->fetch(PDO::FETCH_ASSOC);

        if(isset($user['email']) == $this->email){
            echo "Email Exists";
        }else{
            $this->registerUser();
        }
    }

}

if(isset($_POST["submit"])){
    $userRegistration = new UserRegistration();
    $userRegistration->checkIfUserExists();
}



?>
