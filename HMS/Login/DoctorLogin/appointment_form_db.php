<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
    //$conn1 = mysqli_connect("localhost","root","","hms");
    //if(!$conn1){
    //    die("ERROR:".mysqli_connect_error());
    //}

    $user = $_SESSION["doctor"];

    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $date = $_POST["date"];

    $username = $_POST["uname"];
    $password = $_POST["pwd"];

    $uname = $_POST["uname"];
    $pwd = $_POST["pwd"];

    $sql = "UPDATE `doctor` SET `d_mobile`='$contact',
            `d_email`='$email',`d_dob`='$date' WHERE d_name='$user'";
    mysqli_query($conn,$sql);

    $sql = "UPDATE `users` SET `u_username`='$uname',`u_password`='$pwd'
            WHERE u_name='$user'";
    mysqli_query($conn,$sql);

    header("refresh:0.3; url=appointment_book_form.php");
?>