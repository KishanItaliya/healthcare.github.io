<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $sql = "SELECT * FROM test";
    $result = mysqli_query($conn,$sql);

    $user = $_SESSION["patient"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="wrapper">

        <div class="sidebar">
        <h2><a href="index.php" style="color:#ffffff;text-decoration: none;">Patient</a></h2>
        <ul>
            <li><a href="appointment_book_form.php" id="ba"><i class="fa fa-calendar-plus-o"></i> Book Appointment</a></li>
            <li><a href="appointment_report.php" id="va"><i class="fa fa-address-card"></i> View Appointment</a></li>
            <li  style="background-color: #ffffff;"><a href="test_display.php" id="th" style="color: #0d1d52;text-decoration: none;" ><i class="fa fa-flask"></i> Test History</a></li>
            <li><a href="medicine_display.php" id="mp"><i class="fa fa-medkit"></i> Medicine Purchases</a></li>
            <li><a href="prescription_display.php" id="dp"><i class="fa fa-sticky-note"></i> Doctor Prescription</a></li>
        </ul> 
        
        </div>

        <div class="main_content">
            
            <nav class="navbar navbar-light bg-white justify-content-end">
                <a class="navbar-brand">Hello <b><?php echo $user ?></b></a>

                <div class="logout-box">
                    <input type="text" class="logout-text" name="" value="Logout" disabled>
                    <a class="logout-btn" href="../../index.php">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="search-box">
                    <input type="text" id="search" class="search-text" name="search" placeholder="Type to search">
                    <a class="search-btn" href="#">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </div>
            
            </nav> 
            
            <div class="container">

                <br/>
                <div class="back-box" id="back_btn">
                    <a class="back-btn" href="test_display.php">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>

                <div id="title"><br/><h2>Patient Test Report</h2></div>
                <input type="hidden" name="" id="hidden_user_id">
                <div id="records_content"> </div> 
            </div>
        </div>

        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#back_btn').hide();
            readRecords();
        });

        function readRecords(){
            var readrecord = "readrecord";

            $.ajax({
                url: "test.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                   
                } 
            });
        }

        //---------- View Test History----------

        function ViewTest(id){
             var testid = id;
             
             $.ajax({
                url: "test_view.php",
                type: "POST",
                data: {testid:testid},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#back_btn').show();
                } 
            }); 

         }  


    </script>
</body>
</html>