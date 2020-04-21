<?php
   session_start();
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   $user = $_SESSION["doctor"];

   $sql = "SELECT * FROM doctor WHERE d_name='$user'";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result);
   $_SESSION["mobile"] = $row["d_mobile"];
   $_SESSION["email"] = $row['d_email'];
   $_SESSION["dob"] = $row['d_dob'];


   $sql = "SELECT * FROM users WHERE u_name='$user'";
   $result1 = mysqli_query($conn,$sql);
   $row1 = mysqli_fetch_array($result1);

   
   if(isset($_POST["readrecord"])){

    $data = '<div class="container">

                <div>
                    <br/><br/>
                    <h2 align="left">My Profile</h2>
                    <hr>
                </div>

                <form class="form-horizontal" action="appointment_form_db.php" method="POST">
      
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Name:</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" id="pname" placeholder="Enter Your Name" name="name" value="'.$user.'" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="contact">Contact No.</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" id="contact" name="contact" value="'.$_SESSION["mobile"].'">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">          
                        <input type="email" class="form-control" id="email" name="email" value="'.$_SESSION["email"].'">  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date of Birth:</label>
                    <div class="col-sm-10">          
                        <input type="date" class="form-control" id="date" name="date" value="'.$_SESSION["dob"].'">  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="uname">Username:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="uname" value="'.$row1['u_username'].'" name="uname">       
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Password:</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" id="pwd" value="'.$row1['u_password'].'" name="pwd">
                    </div>
                </div>

                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" style="margin-left:658px; margin-right:10px;">Update</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
                </form>
            </div>
            
            ';
    echo $data;
}

?>