<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);
    $user = $_SESSION["patient"];

    $sql= "SELECT p_id FROM patient WHERE p_name='$user'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $pid = $row["p_id"];

        $data = '<table class="table table-bordered text-center table-striped table-fixed">
                    <tr>
                        <th>Appointment ID</th>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Prescription Date</th>
                        <th>Action</th>
                    </tr>';

    
        $presql = "SELECT * FROM prescription WHERE p_id='$pid' ORDER BY pre_id ASC";
        $result = mysqli_query($conn,$presql);


        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_assoc($result)){  

                
                $aid = $row["a_id"];
                $sql = "SELECT d_id FROM appointment WHERE a_id='$aid'";
                $result1 = mysqli_query($conn,$sql);
                $row1 = mysqli_fetch_assoc($result1);
                $did = $row1["d_id"];

                $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
                $result2 = mysqli_query($conn,$sql);
                $row2 = mysqli_fetch_assoc($result2);
                $doctor = $row2["d_name"];
    
                $data .= '<tr>
                            <td>'.$aid.'</td>
                            <td>'.$doctor.'</td>  
                            <td>'.$user.'</td> 
                            <td>'.$row['pre_date'].'</td>  
                            
                            <td><button onclick="ViewPrescription('.$row['pre_id'].')" 
                                 class="btn btn-primary">View</button>
                            </td>
    
                          </tr>';
            }
        }

        $data.= '</table>';
        echo $data;

                   
?>



    