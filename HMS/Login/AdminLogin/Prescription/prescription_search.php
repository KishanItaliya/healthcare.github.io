<?php

include 'search_db.php';

$conn = mysqli_connect("localhost","root","","hms");
if(!$conn){
    die("ERROR:".mysqli_connect_error());
}

   
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $search = "$search%";
        if(strlen($search)>1){

            $data = '<table class="table table-bordered text-center table-striped table-fixed">
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Prescription Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

            $sql = "SELECT * FROM patient WHERE p_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
            $row1 = $stmt->fetch();
            $patient = $row1["p_name"];

            $pid = $row1['p_id'];
            $sql = "SELECT * FROM prescription WHERE p_id='$pid'";
            $result = mysqli_query($conn,$sql);
            
            while($row = mysqli_fetch_array($result)){

                $aid = $row["a_id"];
                $sql = "SELECT d_id FROM appointment WHERE a_id='$aid'";
                $result1 = mysqli_query($conn,$sql);
                $row1 = mysqli_fetch_assoc($result1);
                
                $did = $row1["d_id"];  
                $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
                $tmp = mysqli_query($conn,$sql);
                $doctor = mysqli_fetch_array($tmp);

                $data .= '<tr>
                        <td>'.$row["a_id"].'</td>
                        <td>'.$doctor["d_name"].'</td>  
                        <td>'.$patient.'</td> 
                        <td>'.$row['pre_date'].'</td> 
                       
                        <td><button onclick="GetPrescription('.$row['pre_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeletePrescription('.$row['pre_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
                    

               
            }
        }
        else{
            $data = '<table class="table table-bordered text-center table-striped table-fixed">
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Prescription Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

            $sql = "SELECT * FROM prescription";
            $result = mysqli_query($conn,$sql);
    
            if(mysqli_num_rows($result) > 0){

      
                while($row = mysqli_fetch_assoc($result)){  
            
                    $aid = $row["a_id"]; 
                    $pid = $row["p_id"];
    
                    $sql = "SELECT d_id FROM appointment WHERE a_id='$aid'";
                    $result1 = mysqli_query($conn,$sql);
                    $row1 = mysqli_fetch_assoc($result1);
                    $did = $row1["d_id"];

                    $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
                    $result2 = mysqli_query($conn,$sql);
                    $row2 = mysqli_fetch_assoc($result2);
                    $doctor = $row2["d_name"];

                    $name = "SELECT p_name FROM patient WHERE p_id=$pid";
                    $tmp = mysqli_query($conn,$name);
                    $row3 = mysqli_fetch_array($tmp);
                    $patient = $row3["p_name"];

                    $data .= '<tr>
                        <td>'.$row["a_id"].'</td>
                        <td>'.$doctor.'</td>  
                        <td>'.$patient.'</td> 
                        <td>'.$row['pre_date'].'</td> 
                       
                        <td><button onclick="GetPrescription('.$row['pre_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeletePrescription('.$row['pre_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
                    
                }
            }
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
