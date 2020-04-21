<?php
    
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);
    

    if(isset($_POST["medicineid"])){
        
        $m_id = $_POST['medicineid'];
        $sql = "SELECT * FROM medicine WHERE m_id='$m_id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $medicines = $row["medicines"];
        $medicines = str_replace(",", "<br/>",$medicines);

        $id=$row['p_id'];
        $sname = "SELECT p_name FROM patient WHERE p_id=$id";
        $tmp = mysqli_query($conn,$sname);
        $pname = mysqli_fetch_array($tmp);
        $patient = $pname["p_name"];

        $data = '<div class="container form-horizontal">

                    <div>
                        <br/>
                        <h2 align="left">Medicine Details of <b>'.$patient.'</b></h2>
                        <hr>
                    </div>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Name:</label>
                        <div class="col-sm-10">          
                            '.$patient.'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Date:</label>
                        <div class="col-sm-10">          
                            '.$row["m_date"].'
                        </div>
                    </div></br>
    
                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Medicines:</label>
                        <div class="col-sm-10">           
                            '.$medicines.'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Cost:</label>
                        <div class="col-sm-10">          
                            '.$row["m_cost"].'
                        </div>
                    </div></br>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <form action="medicine_print.php" method="post">
                                <input type="hidden" id="mid" name="medicineID" value="'.$row['m_id'].'">
                                <input type="submit" value="Print Receipt" class="btn btn-primary">                           
                            </form>
                        </div>
                        </div>
                    </div>';
        echo $data;
    }
    
?>


    
