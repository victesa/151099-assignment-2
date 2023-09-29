<?php 
require_once("../config/config.php");
session_start();
class addTaskClass{
    public function addTask(){
        $title = $_POST["titleText"];
        $details = (string)$_POST["description"];
        $dueDate = (string)$_POST["date"];
        $userId = $_SESSION['user_id'];
        $db = new Database();
        $conn = $db->getConnection();

        try{
            $stmt = $conn->prepare("INSERT INTO tasks (title, description, due_date, user_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $details, $dueDate, $userId]);


            header("Location: index1.php");
            exit();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

if(isset($_POST["addTaskBtn"])){
    $addTask = new addTaskClass();
    $addTask->addTask();
}
?>