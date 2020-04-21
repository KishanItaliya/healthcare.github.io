<?php
    
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
    //$conn1 = mysqli_connect("localhost","root","","hms");
    //if(!$conn1){
    //    die("ERROR:".mysqli_connect_error());
    //}

    $doctor = $_POST["doctor"];
    $dsql = "SELECT d_id FROM doctor WHERE d_name='$doctor'";
    $result = mysqli_query($conn,$dsql);
    $row = mysqli_fetch_assoc($result);
    $did = $row["d_id"];

    $pname = $_POST["pname"];
    $psql = "SELECT p_id FROM patient WHERE p_name='$pname'";
    $result1 = mysqli_query($conn,$psql);
    $row1 = mysqli_fetch_assoc($result1);
    $pid = $row1["p_id"];
    
    
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $description = $_POST["desc"];

    $date = $_POST["date"];
    $timeslot = $_POST["timeslot"];
    $status = "Pending";

    $sql = "INSERT INTO appointment (d_id,p_id,a_date,a_timeslot,a_fees,a_description,a_status) VALUES ('$did','$pid','$date','$timeslot','150','$description','$status')";
    
    if(!mysqli_query($conn,$sql)){
        echo "Not Inserted Appointment....";
    }
    else{
        echo "Inserted.......";
    }
    
    if($pid==""){
        $ptsql = "INSERT INTO patient (p_name,p_contact,p_address) VALUES('$pname','$contact','$address')";
        
        if(!mysqli_query($conn,$ptsql)){
            echo "Not Inserted Patient....";
        }
        else{
            echo "Inserted.......";
        }
    
    }
       
    

    header("refresh:0.5; url=appointment_form.php");
?>