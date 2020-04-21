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


            $sql = "SELECT * FROM doctor WHERE d_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
           
            while($row = $stmt->fetch()){

                $data .= '<tr>
                        <td>'.$row["d_id"].'</td>
                        <td>'.$row["d_name"].'</td>
                        <td>'.$row["d_mobile"].'</td>
                        <td>'.$row["d_email"].'</td>  
                        <td>'.$row["d_dob"].'</td>   
                        
                        <td><button onclick="GetDoctor('.$row['d_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td><button onclick="GetUser('.$row['d_id'].')" 
                             class="btn btn-success">LoginID</button>
                        </td>

                        <td>
                             <button onclick="DeleteDoctor('.$row['d_id'].')" 
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

            $sql = "SELECT * FROM doctor";
            $result = mysqli_query($conn,$sql);
    
            if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_assoc($result)){    
            
                    $data .= '<tr>
                        <td>'.$row['d_id'].'</td>
                        <td>'.$row["d_name"].'</td>
                        <td>'.$row["d_mobile"].'</td>
                        <td>'.$row["d_email"].'</td>  
                        <td>'.$row["d_dob"].'</td>   
                        
                        <td><button onclick="GetDoctor('.$row['d_id'].')" 
                             class="btn btn-warning">Edit</button>
                        </td>

                        <td><button onclick="GetUser('.$row['d_id'].')" 
                             class="btn btn-success">LoginID</button>
                        </td>

                        <td>
                             <button onclick="DeleteDoctor('.$row['d_id'].')" 
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
