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
                    <th>Test Name</th>
                    <th>Test Cost</th>
                    <th>Test Duration</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM laboratory_test";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0){

        $number = 1;

        while($row = mysqli_fetch_assoc($result)){    

            $data .= '<tr>
                        <td>'.$number.'</td>
                        <td>'.$row['lab_t_name'].'</td>  
                        <td>'.$row['lab_t_cost'].'</td> 
                        <td>'.$row['lab_t_duration'].'</td>  
                        
                        <td><button onclick="GetTest('.$row['lab_t_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeleteTest('.$row['lab_t_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
                    $number++;
        }
    }
    $data.= '</table>';
    echo $data;
}

     //----------Add Laboratory Test-------------

    if(isset($_POST["testname"]) && isset($_POST["testcost"]) && isset($_POST["testduration"]) 
        && isset($_POST["testsample"])  && isset($_POST["testdescription"])) {
            
            $testname = $_POST["testname"];
            $testcost = $_POST["testcost"];
            $testduration = $_POST["testduration"];
            $testsample = $_POST["testsample"];
            $testdescription = $_POST["testdescription"];

        $sql = "INSERT INTO `laboratory_test`(`lab_t_name`, `lab_t_cost`, `lab_t_duration`, `lab_t_sample`, `lab_t_description`) 
                VALUES ('$testname','$testcost','$testduration','$testsample','$testdescription')";
        mysqli_query($conn,$sql);
           
    }

   //----------Delete Laboratory Test-------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM laboratory_test WHERE lab_t_id='$userid'";
        mysqli_query($conn,$sql);
    }

    //---------Get TestID For Update-----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $tid = $_POST['id'];
        $sql = "SELECT * FROM laboratory_test WHERE lab_t_id = '$tid'";
        
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


    //--------- Update Laboratory Test---------------

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $testnameupd = $_POST['testnameupd'];
        $testcostupd = $_POST['testcostupd'];
        $testdurationupd = $_POST['testdurationupd'];
        $testsampleupd = $_POST['testsampleupd'];
        $testdescriptionupd = $_POST['testdescriptionupd'];

        $sql = "UPDATE `laboratory_test` SET `lab_t_name`='$testnameupd',`lab_t_cost`='$testcostupd',
         `lab_t_duration`='$testdurationupd',`lab_t_sample`='$testsampleupd',`lab_t_description`='$testdescriptionupd'
          WHERE lab_t_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }

    

?>