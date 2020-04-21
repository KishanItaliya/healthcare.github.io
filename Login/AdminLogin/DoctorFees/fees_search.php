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
                    <th>Fees</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

            $sql = "SELECT * FROM doctor WHERE d_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
            $row1 = $stmt->fetch();

            
            $did = $row1["d_id"];
            $sql = "SELECT * FROM doctor_fees WHERE d_id='$did'";
            $result = mysqli_query($conn,$sql);

                $number = 1;

                while($row = mysqli_fetch_assoc($result)){  
            
                    $data .= '<tr>
                        <td>'.$number.'</td>
                        <td>'.$row1["d_name"].'</td>  
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
        else{
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
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
