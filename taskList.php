<?php

require_once('config/config.php');

class TaskList {
    public function __construct() {
        $db = new Database();
        $conn = $db->getConnection();
        $user_id = $_SESSION["user_id"];

        $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if there are tasks
        if (count($tasks) > 0) {
            $number = 1;
            // Loop through tasks and display them in rows
            foreach ($tasks as $task) {
                $title = $task["title"];
                $details = $task["description"];
                $dueDate = $task["due_date"];

                echo '<tr>';
                echo '<td>' . $number . '</td>';
                echo '<td>' . $title . '</td>';
                echo '<td>' . $details . '</td>';
                echo '<td>' . $dueDate . '</td>';
                echo '</tr>';

                $number++;
            }

            echo '</table>';
        } else {
            echo 'No tasks found.';
        }
    }
}

?>
