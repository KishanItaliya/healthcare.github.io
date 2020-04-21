<?php
   session_start();
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   
   $user = $_SESSION["patient"];
   if(isset($_POST["readrecord"])){

    $data = '<div class="container">

                <div>
                    <br/><br/>
                    <h2 align="left">Book Your Appointment</h2>
                    <hr>
                </div>

                <form class="form-horizontal" action="appointment_db.php" method="POST">
      
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Name:</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" id="pname" placeholder="Enter Your Name" name="pname" value="'.$user.'" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">          
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email">  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date:</label>
                    <div class="col-sm-10">          
                        <input type="date" class="form-control" id="date" placeholder="Enter Date" name="date" onclick="ChangeTimeslot1()">  
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="doctor">Doctor:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="doctor" name="doctor" onchange="ChangeTimeslot()">
                            <option selected disabled>Select Doctor</option>'; ?>
                            
                            <?php 
                                $sql = "SELECT d_name FROM doctor";
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                $name = $row['d_name'];
                                $data .='"<option>'.$name.'</option>"';
                         
                            }    
                        $data.='
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="timeslot">Timeslot:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="timeslot" name="timeslot"> 
                        </select>       
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="fees">Fees</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" id="fees" value="150" name="fees" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="contact">Contact No.</label>
                    <div class="col-sm-10">          
                        <input type="text" class="form-control" id="contact" placeholder="Enter Contact No." name="contact">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="desc">Description</label>
                    <div class="col-sm-10">          
                        <textarea class="form-control" id="desc" placeholder="Enter Description..." name="desc" rows="2"></textarea>
                    </div>
                </div>

                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" style="margin-left:565px; margin-right:10px;">Book Appointment</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
                </form>
            </div>
            
            ';
    echo $data;
}

?>