<?php
    session_start();
    
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $m_id = $_POST['medicineID'];
    $user = $_SESSION["patient"];

    $sql = "SELECT * FROM medicine WHERE m_id='$m_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

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
            <?php echo $user ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Date:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row["m_date"]; ?>
        </div>
        </div></br>
    
        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Medicines:</label>
        <div class="col-sm-6" align="left">          
            <?php 
                $medicines = $row["medicines"];
                $medicines = str_replace(",", "<br/>",$medicines); 
                echo $medicines; 
            ?>
        </div>
        </div></br>

        <div class="row">
        <label class="control-label col-sm-6" for="date" align="right">Cost:</label>
        <div class="col-sm-6" align="left">          
            <?php echo $row["m_cost"]; ?>
        </div>
        </div></br>

        
</div>

<script type="text/javascript">

    
    window.print();
    
    window.onafterprint = function(event){
        window.location.href = "medicine_display.php";
    }

    

</script>