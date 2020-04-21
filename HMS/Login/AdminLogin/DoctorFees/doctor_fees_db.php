<?php

   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   
   if(isset($_POST["readrecord"])){
    $data = '<table class="table table-bordered text-center table-striped table-fixed">
                <tr>
                    <th>Sr.No.</th>
                    <th>Doctor Name</th>
                    <th>Fees</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM doctor_fees";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0){

        $number = 1;

        while($row = mysqli_fetch_assoc($result)){  
            
            $did = $row["d_id"]; 
           
            $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
            $result1 = mysqli_query($conn,$sql);
            $row1 = mysqli_fetch_assoc($result1);
            $doctor = $row1["d_name"];

            $data .= '<tr>
                        <td>'.$number.'</td>
                        <td>'.$doctor.'</td>  
                        <td>'.$row["f_amount"].'</td> 
                        
                        <td><button onclick="GetFees('.$row['f_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeleteFees('.$row['f_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
                    $number++;
        }
    }
    $data.= '</table>';
    echo $data;
}

     //----------Add Doctor Fees-------------

    if(isset($_POST["doctor"]) && isset($_POST["amount"]) && isset($_POST["description"])) {
            
        $sql = "SELECT d_id FROM doctor WHERE d_name='$doctor'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $did = $row["d_id"];
    
        $sql = "INSERT INTO `doctor_fees`(`d_id`, `f_amount`, `f_description`)
                 VALUES ('$did','$amount','$description')";
        mysqli_query($conn,$sql);
           
    }

   //----------Delete Doctor Fees-------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM doctor_fees WHERE f_id='$userid'";
        mysqli_query($conn,$sql);
    }

    //---------Get Doctor FeesID For Update-----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $fid = $_POST['id'];
        $sql = "SELECT * FROM doctor_fees WHERE f_id = '$fid'";
        
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


    //--------- Update Doctor Fees---------------

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $amountupd = $_POST['amountupd'];
        $descriptionupd = $_POST['descriptionupd'];

        $sql = "UPDATE `doctor_fees` SET `f_amount`='$amountupd',`f_description`='$descriptionupd'
                WHERE f_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }

    

?>