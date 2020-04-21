<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    extract($_POST);
    $user = $_SESSION["patient"];
    
    if(isset($_POST["testid"])){

        $t_id = $_POST['testid'];
        $sql = "SELECT * FROM patient_test WHERE t_id='$t_id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);

        $data = '<div class="container frs form-horizontal">

                    <div>
                        <br/>
                        <h2 align="left">Test Details of <b>'.$user.'</b></h2>
                        <hr>
                    </div>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Name:</label>
                        <div class="col-sm-10">          
                            '.$user.'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Date:</label>
                        <div class="col-sm-10">          
                            '.$row["t_c_date"].'
                        </div>
                    </div></br>
    
                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Delivery:</label>
                        <div class="col-sm-10">          
                            '.$row["t_d_date"].'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Cost:</label>
                        <div class="col-sm-10">          
                            '.$row["t_cost"].'
                        </div>
                    </div></br>

                    <div class="row">
                        <label class="control-label col-sm-2" for="date">Description:</label>
                        <div class="col-sm-10" style="width:400px;">          
                            '.$row["t_description"].'
                        </div>
                    </div></br>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <form action="test_print.php" method="post">
                                <input type="hidden" id="tid" name="testID" value="'.$row['t_id'].'">
                                <input type="submit" value="Print Receipt" class="btn btn-primary">                           
                            </form>
                        </div>
                        </div>
                    </div>';

        echo $data;
    }
    
?>
    
