<?php
    $id = $_POST['patientID'];
?>

<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $sql = "SELECT * FROM appointment WHERE a_id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    $pid=$row['p_id'];
    $sname = "SELECT * FROM patient WHERE p_id=$pid";
    $tmp = mysqli_query($conn,$sname);
    $patient = mysqli_fetch_array($tmp);

    $did=$row['d_id'];
    $sname = "SELECT d_name FROM doctor WHERE d_id=$did";
    $tmp = mysqli_query($conn,$sname);
    $doctor = mysqli_fetch_array($tmp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Appointment Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/report.css">
</head>
<body>
    <div class="container frs form-horizontal">
        <div class="header">
            <h2 align="left">Your Appointment ID is <?php echo "$id"; ?></h2>
            <hr>
        </div>
        <div class="row">
        <label class="control-label col-sm-2" for="date">Status:</label>
        <div class="col-sm-10">          
            <?php echo $row["a_status"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-2" for="date">Patient:</label>
        <div class="col-sm-10">          
            <?php echo $patient["p_name"]; ?>
        </div>
        </div></br>
    
        <div class="row">
        <label class="control-label col-sm-2" for="date">Doctor:</label>
        <div class="col-sm-10">          
            <?php echo $doctor["d_name"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-2" for="date">Date:</label>
        <div class="col-sm-10">          
            <?php echo $row["a_date"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-2" for="date">Timeslot:</label>
        <div class="col-sm-10">          
            <?php echo $row["a_timeslot"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-2" for="date">Fees:</label>
        <div class="col-sm-10">          
            <?php echo $row["a_fees"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-2" for="date">Contact No.:</label>
        <div class="col-sm-10">          
            <?php echo $patient["p_contact"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-2" for="date">Address:</label>
        <div class="col-sm-10">          
            <?php echo $patient["p_address"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-2" for="date">Description:</label>
        <div class="col-sm-10">          
            <?php echo $patient["p_description"]; ?>
        </div>
        </div></br>

        <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
        <form action="appointment_print.php" method="post">
            <input type="hidden" id="pid" name="patientID" value="<?php echo $row['a_id']; ?>">
            <input type="submit" value="Print Receipt" class="btn btn-primary">                          
        </form>
        </div>
        </div>
    </div>
</body>
</html>