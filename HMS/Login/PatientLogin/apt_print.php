<?php
    session_start();
     
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $a_id = $_POST['aptID'];
    $user = $_SESSION["patient"];

    
    $sql = "SELECT * FROM appointment WHERE a_id='$a_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $pid = $row['p_id'];

    $sname = "SELECT * FROM patient WHERE p_id=$pid";
    $tmp = mysqli_query($conn,$sname);
    $patient = mysqli_fetch_array($tmp);

    $did=$row['d_id'];
    $sname = "SELECT d_name FROM doctor WHERE d_id=$did";
    $tmp = mysqli_query($conn,$sname);
    $doctor = mysqli_fetch_array($tmp);
    
?>
<script>
    
</script>
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
        <label class="control-label col-sm-6" for="date" align="right">Patient:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $user ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Doctor:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $doctor['d_name'] ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Date:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row['a_date']; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Time:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row['a_timeslot'] ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Contact:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $patient['p_contact'] ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Fees:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row['a_fees']; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Status:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row['a_status']; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Address:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $patient['p_address']; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Description:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row['a_description']; ?>
        </div>
        </div></br>

        
</div>

<script type="text/javascript">

    
    window.print();
    
    window.onafterprint = function(event){
        window.location.href = "appointment_report.php";
    }

    

</script>