<?php
    session_start();

    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $pre_id = $_POST["prescriptionID"];
    $user = $_SESSION["patient"];

    $sql = "SELECT * FROM prescription WHERE pre_id='$pre_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $aid = $row["a_id"];
    $pid=$row["p_id"];

    $sql = "SELECT d_id FROM appointment WHERE a_id='$aid'";
    $result1 = mysqli_query($conn,$sql);
    $row1 = mysqli_fetch_assoc($result1);
    $did = $row1["d_id"];

    
    $sname = "SELECT p_name FROM patient WHERE p_id='$pid'";
    $tmp = mysqli_query($conn,$sname);
    $pname = mysqli_fetch_assoc($tmp);

    $sql = "SELECT d_name FROM doctor WHERE d_id='$did'";
    $result2 = mysqli_query($conn,$sql);
    $row2 = mysqli_fetch_assoc($result2);
    $doctor = $row2["d_name"];
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/report.css">

<div class="Container frs form-horizontal" align="center">
    <div class="header">
        <img src="LOGO1.png" alt="Hospital Logo">
        <hr>
    </div>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">ID:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $aid; ?>
        </div>
        </div></br>


        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Name:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $user ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Doctor:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $doctor; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Date:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row["pre_date"]; ?>
        </div>
        </div></br>
    
        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Prescription:</label>
        <div class="col-sm-6" align="left">          
            <?php 
                $medicines = $row["prescription"];
                $medicines = str_replace(",", "<br/>",$medicines); 
                echo $medicines; 
            ?>
        </div>
        </div></br>

</div>

<script type="text/javascript">

    
    window.print();
    
    window.onafterprint = function(event){
        window.location.href = "prescription_display.php";
    }

    

</script>