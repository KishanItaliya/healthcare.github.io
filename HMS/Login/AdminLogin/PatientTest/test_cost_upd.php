<?php

    $testupd = $_COOKIE["testupd"];
   
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $sql = "SELECT lab_t_cost FROM laboratory_test WHERE lab_t_name='$testupd'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $cost = $row['lab_t_cost'];   
    
    echo "<option>$cost</option>";

?>