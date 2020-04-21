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
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Edit</th>
                    <th>Create</th>
                    <th>Delete</th>
                </tr>';


            $sql = "SELECT * FROM patient WHERE p_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
           
            while($row = $stmt->fetch()){

                $data .= '<tr>
                        <td>'.$row["p_id"].'</td>
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
        else{
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

            $sql = "SELECT * FROM patient";
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
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
