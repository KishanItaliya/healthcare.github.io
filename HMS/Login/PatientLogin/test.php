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
                        <th>Sr.No.</th>
                        <th>Patient Name</th>
                        <th>Test</th>
                        <th>Date</th>
                        <th>Delivery Date</th>
                        <th>Action</th>
                    </tr>';
                
        $sql = "SELECT * FROM patient_test  WHERE p_id='$pid' ORDER BY t_id ASC";
        $result = mysqli_query($conn,$sql);


        if(mysqli_num_rows($result) > 0){

            $number = 1;

            while($row = mysqli_fetch_assoc($result)){    
    
                $data .= '<tr>
                            <td>'.$number.'</td>
                            <td>'.$user.'</td>  
                            <td>'.$row['t_name'].'</td> 
                            <td>'.$row['t_c_date'].'</td>
                            <td>'.$row['t_d_date'].'</td>  
                            
                            <td><button onclick="ViewTest('.$row['t_id'].')" 
                                 class="btn btn-primary">View</button>
                            </td>
    
                          </tr>';
                        $number++;
            }
        }
        $data.= '</table>';
        echo $data;              
?>



    