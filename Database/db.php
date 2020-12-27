<?php

$server_name = "localhost";
$user_name = "root";
$pass = "";
$database_name = "studentsinfo";


// Create connection
$conn = mysqli_connect($server_name, $user_name, $pass);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$db_sql = "CREATE DATABASE IF NOT EXISTS $database_name";
if (mysqli_query($conn, $db_sql)) {
} else {
  //echo "Error creating database: " . mysqli_error($conn);
}

$conn = mysqli_connect($server_name, $user_name, $pass, $database_name);
$table_sql = "CREATE TABLE IF NOT EXISTS student_table(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    student_name varchar(255),
    student_adm INTEGER UNIQUE,
    email varchar(255),
    phone_number varchar(255),
    address varchar(255),
    entry_points varchar(255),
    course varchar(255)
)";
if (mysqli_query($conn, $table_sql)) {
  } else {
  }

//mysqli_close($conn);

?>