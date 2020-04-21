<?php
   
   $conn = mysqli_connect("localhost","root","","hms");
   if(!$conn){
       die("ERROR:".mysqli_connect_error());
   }

   extract($_POST);
   
   if(isset($_POST["readrecord"])){
    $data = '<table class="table text-center table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Contact</th>
                    <th>Fees</th>
                    <th>Status</th>
                    <th>Confirm</th>
                    <th>Delete</th>
                </tr>';

    $sql = "SELECT * FROM appointment";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){


        while($row = mysqli_fetch_assoc($result)){

            $pid=$row['p_id'];
            $sname = "SELECT * FROM patient WHERE p_id=$pid";
            $tmp = mysqli_query($conn,$sname);
            $patient = mysqli_fetch_array($tmp);
                            
            $did=$row['d_id'];
            $sname = "SELECT d_name FROM doctor WHERE d_id=$did";
            $tmp = mysqli_query($conn,$sname);
            $doctor = mysqli_fetch_array($tmp);
            
            $data .= '<tr>
                        <td>'.$row['a_id'].'</td>
                        <td>'.$patient['p_name'].'</td> 
                        <td>'.$doctor['d_name'].'</td> 
                        <td>'.$row['a_date'].'</td> 
                        <td>'.$row['a_timeslot'].'</td>  
                        <td>'.$patient['p_contact'].'</td>  
                        <td>'.$row['a_fees'].'</td>  
                        <td>'.$row['a_status'].'</td> 
                    
                        <td><button onclick="ConfirmAppointment('.$row['a_id'].')" 
                             class="btn btn-success">Confirm</button>
                        </td>

                        <td><button onclick="DeleteAppointment('.$row['a_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>
                      </tr>';
        }
    }
    $data.= '</table>';
    echo $data;
}

    //----------Add Patient Appointment------------

    if(isset($_POST["patientname"]) && isset($_POST["date"]) && isset($_POST["doctorname"]) && 
        isset($_POST["timeslot"]) && isset($_POST["fees"]) && isset($_POST["contact"]) && 
        isset($_POST["address"])  && isset($_POST["description"])){

        $dsql = "SELECT d_id FROM doctor WHERE d_name='$doctorname'";
        $result = mysqli_query($conn,$dsql);
        $row = mysqli_fetch_assoc($result);
        $did = $row["d_id"];

        $psql = "SELECT p_id FROM patient WHERE p_name='$patientname'";
        $result = mysqli_query($conn,$psql);
        $row = mysqli_fetch_assoc($result);
        $pid = $row["p_id"];

        $sql = "INSERT INTO `appointment`(`d_id`, `p_id`, `a_date`, `a_timeslot`, `a_fees`,`a_description`,`a_status`) 
                VALUES ('$did','$pid','$date','$timeslot','$fees','$description','Pending')";

        mysqli_query($conn,$sql);

        if($pid==""){
            $ptsql = "INSERT INTO patient (p_name,p_contact,p_address) 
                VALUES('$patientname','$contact','$address')";
            
            mysqli_query($conn,$ptsql);
        }
    }

   //----------Delete Patient Appointment-------------

   if(isset($_POST["deleteid"])){
        $userid = $_POST["deleteid"];
        $sql = "DELETE FROM appointment WHERE a_id='$userid'";
        mysqli_query($conn,$sql);
    }

//----------Confirm Patient Appointment-------------

    if(isset($_POST["updateid"])){
        $aid = $_POST["updateid"];
        $sql = "UPDATE appointment SET a_status='Confirmed' WHERE a_id='$aid'";
        mysqli_query($conn,$sql);
    }


?>