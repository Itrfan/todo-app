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

$label_name = $_POST["label_name"];

if ( empty($label_name) ) {
    echo "Please type sum";
} else{

$sql = "INSERT INTO todos (`label`) VALUES (:label)";

$query = $database->prepare( $sql );

$query->execute([
    "label" => $label_name
]);

header("Location: index.php");
exit;

};