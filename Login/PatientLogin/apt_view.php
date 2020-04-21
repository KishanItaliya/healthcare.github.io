<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);
    $user = $_SESSION["patient"];
    
    if(isset($_POST["aptid"])){

        $id = $_POST['aptid'];
        $sql = "SELECT * FROM appointment WHERE a_id='$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $pid = $row['p_id'];

        $sname = "SELECT * FROM patient WHERE p_id=$pid";
        $tmp = mysqli_query($conn,$sname);
        $patient = mysqli_fetch_array($tmp);

        $did=$row['d_id'];
        $sname = "SELECT d_name FROM doctor WHERE d_id=$did";
        $tmp = mysqli_query($conn,$sname);
        $doctor = mysqli_fetch_array($tmp);

        $data = '<div class="container frs form-horizontal">

                    <div>
                        <br/>
                        <h2 align="left">Patient Appointment ID is '.$id.'</h2>
                        <hr>
                    </div>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">ID:</label>
                        <div class="col-sm-10">          
                            '.$id.'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Patient:</label>
                        <div class="col-sm-10">          
                            '.$user.'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Doctor:</label>
                        <div class="col-sm-10">          
                            '.$doctor['d_name'].'
                        </div>
                    </div></br>
                    

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Date:</label>
                        <div class="col-sm-10">          
                            '.$row['a_date'].'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Time:</label>
                        <div class="col-sm-10">          
                            '.$row['a_timeslot'].'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Contact:</label>
                        <div class="col-sm-10">          
                            '.$patient['p_contact'].'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Fees:</label>
                        <div class="col-sm-10">          
                            '.$row['a_fees'].'
                        </div>
                    </div></br>
    
                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Status:</label>
                        <div class="col-sm-10">          
                            '.$row['a_status'].'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Address:</label>
                        <div class="col-sm-10">          
                            '.$patient['p_address'].'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Description:</label>
                        <div class="col-sm-10" style="width:400px;">          
                            '.$row['a_description'].'
                        </div>
                    </div></br>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <form action="apt_print.php" method="post">
                                <input type="hidden" id="tid" name="aptID" value="'.$row['a_id'].'">
                                <input type="submit" value="Print Receipt" class="btn btn-primary">                           
                            </form>
                        </div>
                        </div>
                    </div>';

        echo $data;
    }
    
?>
    
