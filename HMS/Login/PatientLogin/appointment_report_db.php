<?php
   session_start();
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   
   $user = $_SESSION["patient"];
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

    $sql = "SELECT * FROM patient WHERE p_name='$user'";
    $result = mysqli_query($conn,$sql);
    $row1 = mysqli_fetch_array($result);
    $pid = $row1["p_id"];
    $patient = $row1["p_name"];

    $sql = "SELECT * FROM appointment WHERE p_id='$pid' ORDER BY a_id ASC";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){


        while($row = mysqli_fetch_assoc($result)){

            $did=$row['d_id'];
            $sname = "SELECT d_name FROM doctor WHERE d_id=$did";
            $tmp = mysqli_query($conn,$sname);
            $dname = mysqli_fetch_array($tmp);
            $doctor = $dname["d_name"];
                            
            $data .= '<tr>
                        <td>'.$row['a_id'].'</td>
                        <td>'.$patient.'</td> 
                        <td>'.$doctor.'</td> 
                        <td>'.$row['a_date'].'</td> 
                        <td>'.$row['a_timeslot'].'</td>  
                        <td>'.$row1['p_contact'].'</td>  
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