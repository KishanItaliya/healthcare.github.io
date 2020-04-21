<?php

   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   
   if(isset($_POST["readrecord"])){
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
    $data.= '</table>';
    echo $data;
}

     //----------Add Prescription-------------

    if(isset($_POST["ID"]) && isset($_POST["date"]) && isset($_POST["prescription"])) {
            
        $sql = "SELECT p_id FROM appointment WHERE a_id='$ID'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $pid = $row["p_id"];
    
        $sql = "INSERT INTO `prescription`(`a_id`, `p_id`, `pre_date`, `prescription`)
                 VALUES ('$ID','$pid','$date','$prescription')";
        mysqli_query($conn,$sql);
           
    }

   //----------Delete Prescription-------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM prescription WHERE pre_id='$userid'";
        mysqli_query($conn,$sql);
    }

    //---------Get PrescriptionID For Update-----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $preid = $_POST['id'];
        $sql = "SELECT * FROM prescription WHERE pre_id = '$preid'";
        
        if(!$result = mysqli_query($conn,$sql)){
            exit(mysqli_error());
        }

        $response = array();

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $response = $row;
            }
        }
        else{
            $response['status'] = 200;
            $response['message'] = "Data not found";
        }
        echo json_encode($response);
    }

    else{
        $response['status'] = 200;
        $response['message'] = "Invalid Request!";
    }


    //--------- Update Prescription---------------

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $dateupd = $_POST['dateupd'];
        $prescriptionupd = $_POST['prescriptionupd'];

        $sql = "UPDATE `prescription` SET `pre_date`='$dateupd',`prescription`='$prescriptionupd'
                WHERE pre_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }

    

?>