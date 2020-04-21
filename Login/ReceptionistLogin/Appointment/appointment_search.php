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

            $sql = "SELECT * FROM patient WHERE p_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
            $row = $stmt->fetch();

            $pid = $row['p_id'];
            $sql = "SELECT * FROM appointment WHERE p_id='$pid'";
            $result = mysqli_query($conn,$sql);
            
            while($row1 = mysqli_fetch_array($result)){

                
                $did = $row1['d_id'];
                $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
                $tmp = mysqli_query($conn,$sql);
                $doctor = mysqli_fetch_array($tmp);

                $data .= '<tr>
                        <td>'.$row1['a_id'].'</td>
                        <td>'.$row['p_name'].'</td> 
                        <td>'.$doctor['d_name'].'</td> 
                        <td>'.$row1['a_date'].'</td> 
                        <td>'.$row1['a_timeslot'].'</td>  
                        <td>'.$row['p_contact'].'</td>  
                        <td>'.$row1['a_fees'].'</td>  
                        <td>'.$row1['a_status'].'</td> 
                    
                        <td><button onclick="ConfirmAppointment('.$row1['a_id'].')" 
                             class="btn btn-success">Confirm</button>
                        </td>

                        <td><button onclick="DeleteAppointment('.$row1['a_id'].')" 
                             class="btn btn-danger">Delete</button>
                        </td>
                      </tr>';

               
            }
        }
        else{
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
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
