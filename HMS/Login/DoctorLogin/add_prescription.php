<?php

    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);

    $a_id = $_POST["id"];

    $sql = "SELECT p_id FROM appointment WHERE a_id='$a_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $pid = $row["p_id"];

    $psql = "SELECT p_name FROM patient WHERE p_id='$pid'";
    $tmp = mysqli_query($conn,$psql);
    $row = mysqli_fetch_assoc($tmp);
    $pname = $row["p_name"];

    setcookie("a_id", $a_id, time() + (86400 * 30));

    $data = '<div class="container">
            <br/>

            <div>
                <h2 align="left" style="margin-top:50px;margin-left:50px;"><b>Add Prescription</b></h2>
                <hr align="left" style="width:500px;margin-left:40px;">
            </div>
            <br/>
        
            <form class="form-horizontal" action="prescription_db.php" method="POST" style="margin-left:50px;">
            
                <div class="form-group">
                    <label class="control-label col-sm-2" for="aid">Appointment ID:</label>
                    <div class="col-sm-6" style="width:540px;">          
                        <input type="text" class="form-control" id="aid" value="'.$a_id.'" name="aid" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date:</label>
                    <div class="col-sm-6" style="width:540px;">          
                        <input type="date" class="form-control" id="date" placeholder="Enter Date" name="date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="presc">Prescription:</label>
                    <div class="col-sm-6" style="width:540px;">          
                        <textarea class="form-control" id="presc" placeholder="Enter Prescription..." name="presc" rows="3"></textarea>
                    </div>
                </div>

                <br/>
                <div class="form-group">        
                    <div class="col-sm-offset-10 col-sm-6">
                        <button type="submit" class="btn btn-primary" style="width:90px; margin-left:257px; margin-right:10px;">Submit</button>
                        <button type="reset" class="btn btn-danger" style="width:90px;">Reset</button>
                    </div>
                </div>
            </form>
        </div>
        
   
';

echo $data;
    
?>




            

            

