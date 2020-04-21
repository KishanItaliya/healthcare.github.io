<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $sql = "SELECT * FROM appointment";
    $result = mysqli_query($conn,$sql);
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
    <div class="container frs">
        <div class="header">
            <h2 align="left"><b>Appointment Report</b></h2>
            <hr>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>Sr.No.</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Patient Contact</th>
                    <th>Fees</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            $pid=$row['p_id'];
                            $sname = "SELECT * FROM patient WHERE p_id=$pid";
                            $tmp = mysqli_query($conn,$sname);
                            $patient = mysqli_fetch_array($tmp);
                            
                            $did=$row['d_id'];
                            $sname = "SELECT d_name FROM doctor WHERE d_id=$did";
                            $tmp = mysqli_query($conn,$sname);
                            $doctor = mysqli_fetch_array($tmp);
                ?>
                            <tr>
                                <td><?php echo $row["a_id"]; ?></td>
                                <td><?php echo $patient["p_name"]; ?></td>
                                <td><?php echo $doctor["d_name"]; ?></td>
                                <td><?php echo $row["a_date"]; ?></td>
                                <td><?php echo $row["a_timeslot"]; ?></td>
                                <td><?php echo $patient["p_contact"]; ?></td>
                                <td><?php echo $row["a_fees"]; ?></td>
                                <td><?php echo $row["a_status"]; ?></td>
                                <td>
                                <form action="appointment_view.php" method="post">
                                    <input type="hidden" id="pid" name="patientID" value="<?php echo $row['a_id']; ?>">
                                    <input type="submit" value="View" class="btn btn-primary">
                                   
                                </form>
                                </td>
                            </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>