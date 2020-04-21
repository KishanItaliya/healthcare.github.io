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
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';


            $sql = "SELECT * FROM users WHERE u_name LIKE BINARY :s";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('s',$search);
            $stmt->execute();
            
            $number = 1;

            while($row = $stmt->fetch()){

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
        else{
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
        }
        $data.= '</table>';
        echo $data;
    }
    
?>
