<?php

    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $a_id = $_COOKIE["a_id"];
    $pre_date = $_POST["date"];
    $prescription = $_POST["presc"];

    $sql = "SELECT p_id FROM appointment WHERE a_id='$a_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $pid = $row["p_id"];

    $sql = "SELECT pre_id FROM prescription WHERE a_id='$a_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $preid = $row["pre_id"];
    
    if($preid==""){
        $sql = "INSERT INTO prescription (a_id,p_id,pre_date,prescription) VALUES('$a_id','$pid','$pre_date','$prescription')";
    }
    else{
        $sql = "UPDATE prescription SET pre_date='$pre_date' , prescription='$prescription' WHERE a_id='$a_id'";
        $result = mysqli_query($conn,$sql);
    }

   
   
    if(!mysqli_query($conn,$sql)){
        echo "Not Inserted...";    
    }
    else{
        echo "Inserted...";   
    }
    
    header("refresh:0.3; url=appointment.php");
?>