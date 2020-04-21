<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);
    $user = $_SESSION["patient"];

    if(isset($_POST["preid"])){

        $pre_id = $_POST["preid"];
        $sql = "SELECT * FROM prescription WHERE pre_id='$pre_id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $aid = $row["a_id"];

        $medicines = $row["prescription"];
        $medicines = str_replace(",", "<br/>",$medicines);

        $sql = "SELECT d_id FROM appointment WHERE a_id='$aid'";
        $result1 = mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_assoc($result1);
        $did = $row1["d_id"];

        $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
        $result2 = mysqli_query($conn,$sql);
        $row2 = mysqli_fetch_assoc($result2);
        $doctor = $row2["d_name"];

        $data = '<div class="container frs form-horizontal">
                    <div>
                        <br/>
                        <h2 align="left">Prescription Details of <b>'.$user.'</b></h2>
                        <hr>
                    </div>

                <div class="row">
                    <label class="control-label col-sm-2" for="date">ID:</label>
                    <div class="col-sm-10">          
                        '.$aid.'
                    </div>
                </div>
                </br>

                <div class="row">
                    <label class="control-label col-sm-2" for="date">Name:</label>
                    <div class="col-sm-10">          
                        '.$user.'
                    </div>
                </div>
                </br>

                <div class="row">
                    <label class="control-label col-sm-2" for="date">Doctor:</label>
                    <div class="col-sm-10">          
                        '.$doctor.'
                    </div>
                </div>
                </br>

                <div class="row">
                    <label class="control-label col-sm-2" for="date">Date:</label>
                    <div class="col-sm-10">          
                        '.$row["pre_date"].'
                    </div>
                </div>
                </br>

                <div class="row">
                    <label class="control-label col-sm-2" for="date">Prescription:</label>
                    <div class="col-sm-10">          
                        '.$medicines.'
                    </div>
                </div>
                </br>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <form action="print_prescription.php" method="post">
                            <input type="hidden" id="mid" name="prescriptionID" value="'.$row['pre_id'].'">
                            <input type="submit" value="Print Receipt" class="btn btn-primary">                           
                        </form>
                    </div>
                </div>
                </div>';

        echo $data;
    }
?>
