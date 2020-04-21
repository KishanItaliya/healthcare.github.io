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
                    <th>Test Name</th>
                    <th>Test Cost</th>
                    <th>Test Duration</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

            $sql = "SELECT * FROM laboratory_test WHERE lab_t_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
            

            
            $number = 1;

            while($row = $stmt->fetch()){    

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
        else{
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
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
