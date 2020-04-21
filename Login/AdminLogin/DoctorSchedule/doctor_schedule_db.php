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
                    <th>Day</th>
                    <th>Timeslot</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM schedule";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){    
            
            $did = $row["d_id"]; 
    
            $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
            $result1 = mysqli_query($conn,$sql);
            $row1 = mysqli_fetch_assoc($result1);
            $doctor = $row1["d_name"];

            $data .= '<tr>
                        <td>'.$row['sdl_id'].'</td>
                        <td>'.$doctor.'</td>  
                        <td>'.$row['sdl_day'].'</td> 
                        <td>'.$row['sdl_timeslot'].'</td>  
                        
                        <td><button onclick="GetSchedule('.$row['sdl_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td>
                             <button onclick="DeleteSchedule('.$row['sdl_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>

                      </tr>';
        }
    }
    $data.= '</table>';
    echo $data;
}

    //----------Add Doctor Schedule------------

    if(isset($_POST["doctorname"]) && isset($_POST["day"]) && isset($_POST["timeslot"]) 
        && isset($_POST["description"])){

        $dsql = "SELECT d_id FROM doctor WHERE d_name='$doctorname'";
        $result = mysqli_query($conn,$dsql);
        $row = mysqli_fetch_assoc($result);
        $did = $row["d_id"];
        
        $sql = "INSERT INTO `schedule`(`d_id`, `sdl_day`, `sdl_timeslot`, `sdl_description`) 
                VALUES ('$did','$day','$timeslot','$description')";
        mysqli_query($conn,$sql);
           
    }

   //----------Delete Patient Appointment-------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM schedule WHERE sdl_id='$userid'";
        mysqli_query($conn,$sql);
    }

    //---------Get ScheduleID For Update-----------

    if(isset($_POST['id']) && isset($_POST['id']) !=""){

        $sdlid = $_POST['id'];
        $sql = "SELECT * FROM schedule WHERE sdl_id = '$sdlid'";
        
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


    //--------- Update Schedule ---------------

    if(isset($_POST['hidden_user_idupd'])){

        $hidden_user_idupd = $_POST['hidden_user_idupd'];
        $dayupd = $_POST['dayupd'];
        $timeupd = $_POST['timeupd'];
        $descupd = $_POST['descupd'];

        $sql = "UPDATE `schedule` SET `sdl_day`='$dayupd',`sdl_timeslot`='$timeupd',
                `sdl_description`='$descupd' WHERE sdl_id='$hidden_user_idupd'";
        mysqli_query($conn,$sql);
    }

    

?>