<?php
     $t_id = $_POST['testID'];
?>

<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $sql = "SELECT * FROM patient_test WHERE t_id='$t_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    
    $id=$row['p_id'];
    $sname = "SELECT p_name FROM patient WHERE p_id=$id";
    $tmp = mysqli_query($conn,$sname);
    $pname = mysqli_fetch_array($tmp);
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
        <label class="control-label col-sm-6" for="date" align="right">Name:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $pname["p_name"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Date:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row["t_c_date"]; ?>
        </div>
        </div></br>
    
        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Delivery:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row["t_d_date"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Cost:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row["t_cost"]; ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Description:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row["t_description"]; ?>
        </div>
        </div></br>

        
</div>

<script type="text/javascript">

    
    window.print();
    
    window.onafterprint = function(event){
        window.location.href = "appointment.php";
    }

    

</script>