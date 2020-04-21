<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);

    if(isset($_POST["id"])){

        $data ='<br/><h2 align="left">Patient Test Report</h2>';
        $data .= '<table class="table table-bordered text-center table-striped table-fixed">
                    <tr>
                        <th>Sr.No.</th>
                        <th>Patient Name</th>
                        <th>Test</th>
                        <th>Date</th>
                        <th>Delivery Date</th>
                        <th>Action</th>
                    </tr>';

        $id = $_POST["id"];
        $sql_id = "SELECT p_id FROM appointment WHERE a_id='$id'";
        $result1 = mysqli_query($conn,$sql_id);
        $row1 = mysqli_fetch_assoc($result1);
        $pid = $row1["p_id"];
                
        $sql_name = "SELECT p_name FROM patient WHERE p_id='$pid'";
        $result2 = mysqli_query($conn,$sql_name);
        $row2 = mysqli_fetch_assoc($result2);
        $patient = $row2["p_name"];
                
        $sql = "SELECT * FROM patient_test  WHERE p_id='$pid'";
        $result = mysqli_query($conn,$sql);


        if(mysqli_num_rows($result) > 0){

            $number = 1;

            while($row = mysqli_fetch_assoc($result)){    
    
                $data .= '<tr>
                            <td>'.$number.'</td>
                            <td>'.$patient.'</td>  
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

    }                
?>



    