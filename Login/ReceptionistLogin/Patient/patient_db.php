<?php
   
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   
   if(isset($_POST["readrecord"])){
    $data = '<table class="table table-bordered text-center table-striped table-fixed">
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Edit</th>
                    <th>Create</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM patient ORDER BY p_id ASC";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){    
            
            $data .= '<tr>
                        <td>'.$row['p_id'].'</td>
                        <td>'.$row["p_name"].'</td>
                        <td>'.$row["p_contact"].'</td>
                        <td>'.$row["p_email"].'</td>  
                        <td>'.$row["p_dob"].'</td>   
                        
                        <td><button onclick="GetPatient('.$row['p_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td><button onclick="GetUser('.$row['p_id'].')" 
                             class="btn btn-success">LoginID</button>
                        </td>

                        <td>
                             <button onclick="DeletePatient('.$row['p_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
        }
    }
    $data.= '</table>';
    echo $data;
}

    //---------- Add User ------------

    if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["gender"]) && isset($_POST["dob"])
        && isset($_POST["status"]) && isset($_POST["height"]) && isset($_POST["weight"]) && isset($_POST["mobile"])
        && isset($_POST["emobile"]) && isset($_POST["address"]) && isset($_POST["uname"]) && isset($_POST["pwd"]) && isset($_POST["state"])){
        
        //$file = addslashes(file_get_contents($_FILES["profile"]["tmp"]));  
 
        $patient = "Patient";

        $sql = "INSERT INTO `patient`(`p_name`, `p_email`, `p_gender`, `p_dob`, `p_status`, `p_height`, `p_weight`, `p_contact`, `p_econtact`, `p_state` ,`p_address`) 
                VALUES ('$name','$email','$gender','$dob','$status','$height','$weight','$mobile','$emobile','$state','$address')";
        mysqli_query($conn,$sql);

        $usql = "INSERT INTO `users`(`u_type`,`u_name`, `u_username`, `u_password`, `u_mobile`, `u_email`, `u_dob`, `u_address`, `u_state`) 
                VALUES ('$patient','$name','$uname','$pwd','$mobile','$email','$dob','$address','$state')";
        mysqli_query($conn,$usql);
           
    }

   //---------- Delete User -------------

   if(isset($_POST["deleteid"])){
        $pid = $_POST["deleteid"];
        $sql = "DELETE FROM patient WHERE p_id='$pid'";
        mysqli_query($conn,$sql);
    }

    //--------- Get PatientID For Update -----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $pid = $_POST['id'];
        $sql = "SELECT * FROM patient WHERE p_id = '$pid'";
        
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


    //--------- Update Patient ---------------

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $nameupd = $_POST['nameupd'];
        $emailupd = $_POST['emailupd'];
        $genderupd = $_POST['genderupd'];
        $dobupd = $_POST['dobupd'];
        $statusupd = $_POST['statusupd'];
        $heightupd = $_POST['heightupd'];
        $weightupd = $_POST['weightupd'];
        $mobileupd = $_POST['mobileupd'];
        $emobileupd = $_POST['emobileupd'];
        $addressupd = $_POST['addressupd'];
        $stateupd = $_POST['stateupd'];

        $sql = "UPDATE `patient` SET `p_name`='$nameupd',`p_email`='$emailupd',`p_gender`='$genderupd',`p_dob`='$dobupd',`p_status`='$statusupd',
                `p_height`='$heightupd',`p_weight`='$weightupd',`p_contact`='$mobileupd',`p_econtact`='$emobileupd',`p_address`='$addressupd',
                `p_state`='$stateupd' WHERE p_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }


    //--------- Get UserID For Update -----------

    if(isset($_POST['id1']) && isset($_POST['id1']) !=""){

        $pid = $_POST['id1'];

        $psql = "SELECT p_name FROM patient WHERE p_id='$pid'";
        $result = mysqli_query($conn,$psql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["p_name"];

        $sql = "SELECT * FROM users WHERE u_name = '$name'";
        
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


    //--------- Update User ---------------

    if(isset($_POST['hidden_user_idupd1'])){

        $hidden_user_idupd1 = $_POST['hidden_user_idupd1'];
        $unameupd = $_POST['unameupd'];
        $pwdupd = $_POST['pwdupd'];

        $psql = "SELECT * FROM patient WHERE p_id='$hidden_user_idupd1'";
        $result = mysqli_query($conn,$psql);
        $row = mysqli_fetch_assoc($result);
        $name = $row["p_name"];

        $sql = "SELECT u_name FROM `users` WHERE u_name='$name'";
        $result = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_assoc($result);
        $user = $row1["u_name"];

        if($user!=''){
            $sql = "UPDATE `users` SET `u_username`='$unameupd',`u_password`='$pwdupd' WHERE u_name='$name'";
            mysqli_query($conn,$sql);
        }

        else{

            $u_type = "Patient";
            $mobile = $row["p_contact"];
            $email = $row["p_email"];
            $dob = $row["p_dob"];
            $address = $row["p_address"];
            $state = $row["p_state"];
            
            $usql = "INSERT INTO `users`(`u_type`,`u_name`, `u_username`, `u_password`, `u_mobile`, `u_email`, `u_dob`, `u_address`, `u_state`) 
                     VALUES ('$u_type','$name','$unameupd','$pwdupd','$mobile','$email','$dob','$address','$state')";
            mysqli_query($conn,$usql);
        }
        
    }


?>