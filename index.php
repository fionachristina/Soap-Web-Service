<?php
require 'db.php';

if(isset($_POST['submit'])){
    $student_name = $_POST['student_name'];
    $student_adm = $_POST['student_adm'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $entry_points = $_POST['entry_points'];
    $course = $_POST['course'];
   

    if($course !== '0'){
        $students_sql = "INSERT INTO `student_table`(`student_name`, `student_adm`, `email`, `phone_number`, `address`, `entry_points`, `course`)
        VALUES ('$student_name','$student_adm','$email','$phone_number','$address','$entry_points','$course')";

        if(mysqli_query($conn, $students_sql)){
            echo "<br>";
            echo '<div class="p-3 mb-2 bg-success text-white">';
            echo '<pre> Successfull </pre>';
            echo "</div>";
        } else {  
            echo "<br>";
            echo '<div class="p-3 mb-2 bg-danger text-white">';
            echo '<pre> '. mysqli_error($conn) .' </pre>';
            echo "</div>";      
        }
    } else {
        echo "<br>";
        echo '<div class="p-3 mb-2 bg-danger text-white">';
        echo '<pre> Please check your course selection </pre>';
        echo "</div>";
    }
    
    

}

//soap client

require_once "lib/nusoap.php";


if(isset($_POST['display'])){
    require 'db.php';

    $student_adm = $_POST['student_adm'];

    /* 
    We can use the url below or create a wsdl file with the contents from the URL
    below then use the file to create the client object  
    */
    $client = new nusoap_client("./studentrecords.wsdl", true);

    $error = $client->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }

    $results = $client->call("get_students", array("student_adm" => $student_adm)); 

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">'
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="form.css">
    <title>Document</title>
</head>
<body>
<div class="container-fluid px-0" id="bg-div">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12">
            <div class="card card0">
                <div class="d-flex" id="wrapper">
                    <!-- Sidebar -->
                    <div class="bg-light border-right" id="sidebar-wrapper">
                        <div class="sidebar-heading pt-5 pb-4"><strong>Student Details</strong></div>
                        <div class="list-group list-group-flush"> <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item bg-light">
                                <div class="list-div my-2">
                                    <div class="fa fa-home"></div> &nbsp;&nbsp; Add Student
                                </div>
                            </a> <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item active1">
                                <div class="list-div my-2">
                                    <div class="fa fa-credit-card"></div> &nbsp;&nbsp; Check Details
                                </div>
                            </a> 
                            </div>
                    </div> <!-- Page Content -->
                    <div id="page-content-wrapper">
                        <div class="row pt-3" id="border-btm">
                            <div class="col-4"> <button class="btn btn-success mt-4 ml-3 mb-3" id="menu-toggle">
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                </button> </div>
                        </div>
                        <div class="tab-content">
                            <div id="menu1" class="tab-pane">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="form-card">
                                            <h3 class="mt-0 mb-4 text-center">Enter student details</h3>
                                            <form action="" method="post"> 
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required name="student_name" id="inputName" placeholder="Your Full name"> <label>Student Name</label> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required name="student_adm" id="inputAdm" placeholder="######"> <label>Admission Number</label> </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required placeholder="name@gmail.com" class="placeicon" name="email" id="inputEmail4"> <label>Email</label> </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required placeholder="0700000000" class="placeicon" name="phone_number" id="inputphone_number"> <label>Phone Number</label> </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required placeholder="0-100" class="placeicon" name="entry_points" id="inputEntry_points"> <label>Entry Points</label> </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required placeholder="e.g. BICS, BBIT, BCOM" class="placeicon" name="course" id="inputCourse"> <label>Course</label> </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required placeholder="e.g. Nairobi, Kisumu, Machakos" class="placeicon" name="address" id="inputAddress"> <label>Home Address</label> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"> <input type="submit" name="submit" value="Submit" class="btn btn-success placeicon"> </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane in active">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="form-card">
                                            <h3 class="mt-0 mb-4 text-center">Search student number</h3>
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" required name="student_adm" id="inputAdm" placeholder="######"> <label>Admission Number</label> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"> <input type="submit" name="display" value="Search" class="btn btn-success placeicon"> </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="col-12">
                                                
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>








<div class="container-fluid px-0" id="#bg-div-1">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12">
            <div class="card card0">
                <div class="d-flex" id="wrapper">

                <?php
        if(isset($_POST['display'])){
        ?>
        <div class="container" style="padding-top: 50px;">
            <table class="table table-stripped">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student Adm Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Entry Points</th>
                    <th scope="col">Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        if ($client->fault) {
                            echo '<div class="p-3 mb-2 bg-danger text-white">';
                            echo '<h2>Fault</h2>';
                            print_r($results);
                            echo "</div>";
                        } else {
                            $error = $client->getError();
                            if ($error) {
                                echo '<div class="p-3 mb-2 bg-danger text-white">';
                                echo '<h2>Error! </h2>';
                                echo '<pre>' . $error . '</pre>';
                                echo "</div>";
                            } else {
                                foreach($results as $result){
                                    echo '
                                    <tr>
                                        <td>'.$result["id"].'</td>
                                        <td>'.$result["student_name"].'</td>
                                        <td>'.$result["student_adm"].'</td>
                                        <td>'.$result["email"].'</td>
                                        <td>'.$result["phone_number"].'</td>
                                        <td>'.$result["address"].'</td>
                                        <td>'.$result["entry_points"].'</td>
                                        <td>'.$result["course"].'</td>
                                    </tr>
                                    ';
                                }
                            }
                        }                     
                    ?>
                </tbody>
            </table>
        </div>
        <?php
            } 
        ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="form.js"></script>

</body>
</html>