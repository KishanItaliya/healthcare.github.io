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
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0){

        $number = 1;

        while($row = mysqli_fetch_assoc($result)){    
            
            

            $data .= '<tr>
                        <td>'.$number.'</td>
                        <td>'.$row["u_name"].'</td>
                        <td>'.$row["u_mobile"].'</td>
                        <td>'.$row["u_email"].'</td>  
                        <td>'.$row["u_dob"].'</td>   
                        
                        <td><button onclick="GetUser('.$row['u_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeleteUser('.$row['u_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
                    $number++;
        }
    }
    $data.= '</table>';
    echo $data;
}

    //---------- Add User ------------

    if(isset($_POST["user"]) && isset($_POST["uname"]) && isset($_POST["pwd"])
        && isset($_POST["category"])){
        
        //$file = addslashes(file_get_contents($_FILES["profile"]["tmp"])); 
        
        if($category=="Patient"){
            $sql = "SELECT * FROM patient WHERE p_name='$user'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);
            $mobile = $row["p_contact"];
            $email = $row["p_email"];
            $dob = $row["p_dob"];
            $address = $row["p_address"];
            $state = $row["p_state"];
        }

        else if($category=="Doctor"){
            $sql = "SELECT * FROM doctor WHERE d_name='$user'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);
            $mobile = $row["d_mobile"];
            $email = $row["d_email"];
            $dob = $row["d_dob"];
            $address = $row["d_address"];
            $state = $row["d_state"];
        }

        else{
            $mobile = "123-456";
            $email = "xyzhospital@gmail.com";
            $dob = "2005-10-19";
            $address = "Near Street Howkings";
            $state = "Mumbai";
        }

        $sql = "SELECT u_name FROM `users` WHERE u_name='$user'";
        $result = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_assoc($result);
        $us = $row1["u_name"];


        if($us==''){
            $sql = "INSERT INTO `users`(`u_type`,`u_name`, `u_username`, `u_password`, `u_mobile`, `u_email`, `u_dob`, `u_address`, `u_state`) 
                VALUES ('$category','$uname','$uname','$pwd','$mobile','$email','$dob','$address','$state')";
            mysqli_query($conn,$sql);
        }

        else{
            $sql = "UPDATE `users` SET `u_username`='$uname',`u_password`='$pwd' WHERE u_name='$us'";
            mysqli_query($conn,$sql);
        }
        
        
        
           
    }

   //---------- Delete User -------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM users WHERE u_id='$userid'";
        mysqli_query($conn,$sql);
    }

    //--------- Get UserID For Update -----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $uid = $_POST['id'];
        $sql = "SELECT * FROM users WHERE u_id = '$uid'";
        
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

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $unameupd = $_POST['unameupd'];
        $pwdupd = $_POST['pwdupd'];
        $mobileupd = $_POST['mobileupd'];
        $emailupd = $_POST['emailupd'];
        $dobupd = $_POST['dobupd'];
        $addressupd = $_POST['addressupd'];
        $stateupd = $_POST['stateupd'];

        $sql = "UPDATE `users` SET `u_username`='$unameupd',`u_password`='$pwdupd',`u_mobile`='$mobileupd',
                `u_email`='$emailupd',`u_dob`='$dobupd',`u_address`='$addressupd',`u_state`='$stateupd'
                 WHERE u_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }

    

?>