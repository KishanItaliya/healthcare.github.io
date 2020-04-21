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
                    <th>Test Name</th>
                    <th>Test Cost</th>
                    <th>Date</th>
                    <th>Delivery Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM patient_test";
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
                        <td>'.$row['t_name'].'</td> 
                        <td>'.$row['t_cost'].'</td> 
                        <td>'.$row['t_c_date'].'</td>
                        <td>'.$row['t_d_date'].'</td>  
                        
                        <td><button onclick="GetTest('.$row['t_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeleteTest('.$row['t_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
                    $number++;
        }
    }
    $data.= '</table>';
    echo $data;
}

     //----------Add Patient Test-------------

    if(isset($_POST["patientname"]) && isset($_POST["testname"]) && isset($_POST["testcost"]) 
        && isset($_POST["testcdate"])  && isset($_POST["testddate"]) && isset($_POST["testdescription"])) {
            
            $dsql = "SELECT p_id FROM patient WHERE p_name='$patientname'";
            $result = mysqli_query($conn,$dsql);
            $row = mysqli_fetch_assoc($result);
            $pid = $row["p_id"];

        $sql = "INSERT INTO `patient_test`(`p_id`, `t_name`, `t_cost`, `t_c_date`, `t_d_date`, `t_description`)
                 VALUES ('$pid','$testname','$testcost','$testcdate','$testddate','$testdescription')";
        mysqli_query($conn,$sql);
           
    }

   //----------Delete Patient Test-------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM patient_test WHERE t_id='$userid'";
        mysqli_query($conn,$sql);
    }

    //---------Get TestID For Update-----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $tid = $_POST['id'];
        $sql = "SELECT * FROM patient_test WHERE t_id = '$tid'";
        
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


    //--------- Update Patient Test---------------

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $testnameupd = $_POST['testnameupd'];
        $testcostupd = $_POST['testcostupd'];
        $testcdateupd = $_POST['testcdateupd'];
        $testddateupd = $_POST['testddateupd'];
        $testdescriptionupd = $_POST['testdescriptionupd'];

        $sql = "UPDATE `patient_test` SET `t_name`='$testnameupd',`t_cost`='$testcostupd',
         `t_c_date`='$testcdateupd',`t_d_date`='$testddateupd',`t_description`='$testdescriptionupd'
          WHERE t_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }

    

?>