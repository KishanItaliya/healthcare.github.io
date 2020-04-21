<?php

    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);

    if(isset($_POST['id'])){

        $id = $_POST['id'];
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

        $data ='<div class="back-box" id="#">
                    <a class="back-btn" href="appointment.php">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
                <br/>
                
                <h2 align="left">Patient Appointment ID is '.$id.'</h2><hr>';
        
        $data .= '<div class="container form-horizontal">

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Patient:</label>
                        <div class="col-sm-10">          
                            '.$patient["p_name"].'
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
                    </div>';

        

        echo $data;
    }
?>
