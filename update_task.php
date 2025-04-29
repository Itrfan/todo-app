<?php

// backend code only
$host = "127.0.0.1";
$database_name = "todo_app";
$database_user = "root";
$database_password = "";


// 2. connect PHP with the MySQL database
//PDO (PHP Database Object)
$database = new PDO("mysql:host=$host;dbname=$database_name", 
$database_user, 
$database_password);

    $task_id = $_POST["label_id"];
    $completion = $_POST["completed"];

    if ($completion == 0){
        $sql = "UPDATE todos SET completed = 1 WHERE id = :id";
    } else {
        $sql = "UPDATE todos SET completed = 0 WHERE id = :id";
    }
    $query = $database->prepare( $sql );
    // 3.3 execute the SQL query (cook it)
    $query->execute([
        "id" => $task_id
    ]);

    header("Location: index.php");
    exit;