<?php
   session_start();
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   $user = $_SESSION["doctor"];
   
   if(isset($_POST["readrecord"])){
    $data = '<table class="table text-center table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Contact</th>
                    <th>Fees</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>';

    $sql = "SELECT d_id FROM doctor WHERE d_name='$user'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $did = $row["d_id"];

    $sql = "SELECT * FROM appointment WHERE d_id='$did' ORDER BY a_id ASC";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){


        while($row = mysqli_fetch_assoc($result)){

            $pid=$row['p_id'];
            $sname = "SELECT * FROM patient WHERE p_id=$pid";
            $tmp = mysqli_query($conn,$sname);
            $patient = mysqli_fetch_array($tmp);
                            
            $did=$row['d_id'];
            $sname = "SELECT d_name FROM doctor WHERE d_id=$did";
            $tmp = mysqli_query($conn,$sname);
            $doctor = mysqli_fetch_array($tmp);
            
            $data .= '<tr>
                        <td>'.$row['a_id'].'</td>
                        <td>'.$patient['p_name'].'</td> 
                        <td>'.$doctor['d_name'].'</td> 
                        <td>'.$row['a_date'].'</td> 
                        <td>'.$row['a_timeslot'].'</td>  
                        <td>'.$patient['p_contact'].'</td>  
                        <td>'.$row['a_fees'].'</td>  
                        <td>'.$row['a_status'].'</td> 
                    
                        <td><button onclick="ViewAppointment('.$row['a_id'].')" 
                             class="btn btn-primary">View</button>
                        </td>

                      </tr>';
        }
    }
    $data.= '</table>';
    echo $data;
}

?>