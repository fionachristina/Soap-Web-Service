<?php
require_once "lib/nusoap.php";

function get_students($student_adm){
    require 'db.php';

    $students = array();

    $student_retrieve_sql = "SELECT * FROM `student_table` WHERE student_adm = $student_adm";
    $student_results = mysqli_query($conn,$student_retrieve_sql);

    
    //return $student_results;
    
    while($row = mysqli_fetch_assoc($student_results)) {
        array_push($students, array(
            "id" => $row["id"],
            "student_name" => $row["student_name"],
            "student_adm" => $row["student_adm"],
            "email" => $row["email"],
            "phone_number" => $row["phone_number"],
            "address" => $row["address"],
            "entry_points" => $row["entry_points"],
            "course" => $row["course"]
        ));
    }
    return $students;
}

//create the soap object

$server = new soap_server();
$server->register("get_students");

$server->configureWSDL("studentrecords", "urn:studentrecords");

$server->register("get_students",
    array("student_adm" => "xsd:integer"),
    array("return" => "xsd:Array"),
    "urn:studentrecords",
    "urn:studentrecords#get_students",
    "rpc",
    "encoded",
    "Retrieve student records from database depending on student ID passed");
$server->service(file_get_contents('php://input'));
?>
