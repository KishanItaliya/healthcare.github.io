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

            $data = '<table class="table table-bordered text-center table-striped table-fixed">
                <tr>
                    <th>Sr.No.</th>
                    <th>Doctor Name</th>
                    <th>Day</th>
                    <th>Timeslot</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

            $sql = "SELECT * FROM doctor WHERE d_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
            $row1 = $stmt->fetch();
            $doctor = $row1["d_name"];

            $did = $row1['d_id'];
            $sql = "SELECT * FROM schedule WHERE d_id='$did'";
            $result = mysqli_query($conn,$sql);
            
            while($row = mysqli_fetch_assoc($result)){    
            
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
        else{
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
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
