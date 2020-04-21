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
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Cost</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

            $sql = "SELECT * FROM patient WHERE p_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
            $row1 = $stmt->fetch();
            $patient = $row1['p_name'];

            $pid = $row1['p_id'];
            $sql = "SELECT * FROM medicine WHERE p_id='$pid'";
            $result = mysqli_query($conn,$sql);

            $number = 1;
            
            while($row = mysqli_fetch_array($result)){

                
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
        else{
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
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
