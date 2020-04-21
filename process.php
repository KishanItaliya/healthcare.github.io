<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
    $uname = $_POST["uname"];
    $pwd = $_POST["pwd"];
    $us = $_POST["user"];

    $select = "SELECT * FROM users WHERE u_username='$uname' AND u_password='$pwd' AND u_type='$us'";
    $result = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($result);
    $utype = $row["u_type"];
    $user = $row["u_name"];
   // $dpwd = $row["u_password"];

   // $checkpwd = password_verify($pwd,$dpwd);

    $sql = "SELECT d_name FROM doctor WHERE d_name='$user'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $doctor = $row["d_name"];

    $sql = "SELECT p_name FROM patient WHERE p_name='$user'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $patient = $row["p_name"];

    $_SESSION["doctor"] = $doctor;
    $_SESSION["patient"] = $patient;
    $_SESSION["receptionist"] = $user;

   // if($checkpwd){

        if($utype=='Doctor'){ 
            header('Location: Login/DoctorLogin/appointment.php');
        }
    
        else if($utype=='Patient'){
            header('Location: Login/PatientLogin/appointment_book_form.php');
        }
    
        else if($utype=='Admin'){
            header('Location: Login/AdminLogin/Appointment/appointment_approve.php');
        }
        
        else if($utype=='Receptionist'){
            header('Location: Login/ReceptionistLogin/Appointment/appointment_approve.php');
        }
    
        else{
            echo "User Not Found";
        }
    
    //}

    //else{
    //    echo "Invalid Details";
   // }
    

    mysqli_close($conn);

?>