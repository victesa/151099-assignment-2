<!DOCTYPE html>

<?php
session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['user_authenticated'])) {
    // Redirect to the login page or any other page
    header("Location: ../auth/signIn.html"); // Replace 'login.php' with your actual login page
    exit();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <header>
            <h1>TaskMaster</h1>
        </header>

        <button id="addTask">Add task</button>

        <table border="1" id="tableDetails">
            <tr>

                <th>No.</th>
                <th>Title</th>
                <th>description</th>
                <th>Due Date</th>
            </tr>

            <?php 
            require_once('../tasklist.php');
                $taskList = new TaskList();
            
            ?>

        </table>

        <div id="taskDiv" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModalButton">&times;</span>
                <h2>Fill out the Form</h2>
                <form action="index.php" method="post">
                    <input type="text" placeholder="Title" id="title" name="titleText" required><br><br>
                    <textarea id = "details" rows="8" cols="50" name = "description" placeholder="Details"></textarea><br><br>
                    <label for="date">Due Date</label><br>
                    <input type="date" name="date" id="date" name="date" required><br><br><br>
                    <button type="submit" name="addTaskBtn" id="submit">Add</button>
                </form>
            </div>
        </div>
        
        <script src="index.js" async defer></script>
    </body>
</html>