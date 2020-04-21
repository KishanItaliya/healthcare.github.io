<?php
   
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   $user = $_POST["category"];

   if($user=="Doctor"){

    $sql= "SELECT d_name FROM doctor";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $doctor = $row["d_name"];
        echo "<option>$doctor</option>";
    }

   }
   else if($user=="Patient"){

    $sql= "SELECT p_name FROM patient";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $patient = $row["p_name"];
        echo "<option>$patient</option>";
    }

   }
   else if($user=="Receptionist"){
       echo "<option>Receptionist</option>";
   }

?>