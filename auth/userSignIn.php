<?php 
require_once('../config/config.php');
session_start();
    class userSignIn{
        public function signInUser(){
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            $db = new Database();
            $conn = $db ->getConnection();
    
            $confirmPasswordSql = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $confirmPasswordSql -> execute([$email]);
            $user = $confirmPasswordSql->fetch(PDO::FETCH_ASSOC);
    
            if(password_verify($password, $user['password'])){
                $_SESSION['user_id'] = $user['id'];
                
                $_SESSION['user_authenticated'] = true;

                header("Location: ../index/index1.php");
                exit();
            }else{
                echo "Error: Password is incorrect";
            }
    
        }
    }

    if(isset($_POST["signIn"])){
        $userSignIn = new userSignIn();
        $userSignIn-> signInUser();
    }

?>