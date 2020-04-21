<?php
   
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

  extract($_POST);
  
   if(isset($_POST["contact_uname"]) && isset($_POST["contact_email"]) && isset($_POST["contact_mobile"]) 
      && isset($_POST["contact_message"])){

        $sql = "INSERT INTO `contact_us`(`contact_name`, `contact_email`, `contact_mobile`, `contact_message`) 
                VALUES ('$contact_uname','$contact_email','$contact_mobile','$contact_message')"; 
        if(mysqli_query($conn,$sql)){
            echo "Saved Successfully";
        }
        else{
            "not saved";
        }
   }
   else{
       "not saved";
   }
    
   header("refresh:0.3; url=index.php");

?>