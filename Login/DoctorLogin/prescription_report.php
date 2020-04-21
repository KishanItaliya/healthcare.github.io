<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);

    if(isset($_POST["id"])){

        $data ='<br/><h2 align="left">Patient Prescription Listing Page</h2>';
        $data .= '<table class="table table-bordered text-center table-striped table-fixed">
                    <tr>
                        <th>Appointment ID</th>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Prescription Date</th>
                        <th>Action</th>
                    </tr>';

        $a_id = $_POST["id"];
        $sql = "SELECT p_id FROM appointment WHERE a_id='$a_id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $pid = $row["p_id"];
                
        $sql = "SELECT p_name FROM patient WHERE p_id='$pid'";
        $tmp = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($tmp);
        $patient = $row["p_name"];
    
        $presql = "SELECT * FROM prescription WHERE p_id='$pid'";
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
                            <td>'.$row["a_id"].'</td>
                            <td>'.$doctor.'</td>  
                            <td>'.$patient.'</td> 
                            <td>'.$row['pre_date'].'</td>  
                            
                            <td><button onclick="ViewPrescription('.$row['pre_id'].')" 
                                 class="btn btn-primary">View</button>
                            </td>
    
                          </tr>';
            }
        }

        $data.= '</table>';
        echo $data;

    }                
?>



    