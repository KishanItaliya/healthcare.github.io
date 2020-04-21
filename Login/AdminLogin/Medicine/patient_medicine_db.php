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
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Cost</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM medicine";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0){

        $number = 1;

        while($row = mysqli_fetch_assoc($result)){    
            
            $pid = $row["p_id"]; 
    
            $sql = "SELECT p_name FROM patient WHERE p_id='$pid'";
            $result1 = mysqli_query($conn,$sql);
            $row1 = mysqli_fetch_assoc($result1);
            $patient = $row1["p_name"];

            $data .= '<tr>
                        <td>'.$number.'</td>
                        <td>'.$patient.'</td>  
                        <td>'.$row['m_date'].'</td> 
                        <td>'.$row['m_cost'].'</td>  
                        
                        <td><button onclick="GetMedicine('.$row['m_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeleteMedicine('.$row['m_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
                    $number++;
        }
    }
    $data.= '</table>';
    echo $data;
}

    //----------Add Patient Medicines------------

    if(isset($_POST["patientname"]) && isset($_POST["date"]) && isset($_POST["cost"]) 
        && isset($_POST["medicine"])){

        $dsql = "SELECT p_id FROM patient WHERE p_name='$patientname'";
        $result = mysqli_query($conn,$dsql);
        $row = mysqli_fetch_assoc($result);
        $pid = $row["p_id"];
        
        $sql = "INSERT INTO `medicine`(`p_id`, `m_date`, `m_cost`, `medicines`) 
                VALUES ('$pid','$date','$cost','$medicine')";
        mysqli_query($conn,$sql);
           
    }

   //----------Delete Patient Medicines-------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM medicine WHERE m_id='$userid'";
        mysqli_query($conn,$sql);
    }

    //---------Get MedicineID For Update-----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $mid = $_POST['id'];
        $sql = "SELECT * FROM medicine WHERE m_id = '$mid'";
        
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


    //--------- Update Patient Medicines ---------------

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $dateupd = $_POST['dateupd'];
        $costupd = $_POST['costupd'];
        $medicineupd = $_POST['medicineupd'];

        $sql = "UPDATE `medicine` SET `m_date`='$dateupd',`m_cost`='$costupd',`medicines`='$medicineupd' 
        WHERE m_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }

    

?>