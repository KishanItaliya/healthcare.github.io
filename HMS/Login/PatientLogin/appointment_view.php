<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);
    $user = $_SESSION["patient"];

    if(isset($_POST['aptid'])){

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

        $data ='<br/><h2 align="left">Patient Appointment ID is '.$id.'</h2>';
        $data .= '<table class="table text-center table-bordered table-striped">
                <tr>
                    <th>Patient:</th>
                    <td>'.$user.'</td>
                </tr>
                <tr>
                    <th>Doctor:</th>
                    <td>'.$doctor['d_name'].'</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>'.$row['a_date'].'</td>
                </tr>
                <tr>
                    <th>Time:</th>
                    <td>'.$row['a_timeslot'].'</td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td>'.$patient['p_contact'].'</td>
                </tr>
                <tr>
                    <th>Fees:</th>
                    <td>'.$row['a_fees'].'</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>'.$row['a_status'].'</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td>'.$patient['p_address'].'</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>'.$row['a_description'].'</td>
                </tr>';
        $data.= '</table>';

        

        echo $data;
    }
?>
