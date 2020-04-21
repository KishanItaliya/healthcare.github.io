<?php
  session_start();
  $user = $_SESSION["patient"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Book an Appointment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css">

  <style>

  .wrapper .main_content .search-box{
  background: #2f3640;
  height: 40px;
  border-radius: 40px;
  padding: 10px;
}

.wrapper .main_content .search-box .search-btn{
  color: #e84118;
  float: right;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #2f3640;
  display: flex;
  justify-content: center;
  align-items: center;
}

.wrapper .main_content .search-box .search-text{
  border: none;
  background: none;
  outline: none;
  float: left;
  padding: 0;
  color: white;
  font-size: 16px;
  transition: 0.4s;
  line-height: 20px;
  width: 200px;
  padding: 0 6px;
}

.wrapper .main_content .logout-box{
  background: #2f3640;
  height: 40px;
  border-radius: 40px;
  padding: 10px;
  margin-right: 10px;
}

.wrapper .main_content .logout-box .logout-btn{
  color: #e84118;
  float: right;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #2f3640;
  display: flex;
  justify-content: center;
  align-items: center;
}

.wrapper .main_content .logout-box .logout-text{
  border: none;
  background: none;
  outline: none;
  float: left;
  padding: 0;
  color: white;
  font-size: 16px;
  transition: 0.4s;
  line-height: 20px;
  width: 0px;
}

.wrapper .main_content .logout-box:hover >  .logout-text{
  width: 65px;
  padding: 0 6px;
}

.wrapper .main_content .navbar{
  position: sticky;
  top: 0;
}

.wrapper .main_content .container .back-box{
  background: #2f3640;
  height: 40px;
  border-radius: 40px;
  padding: 10px;
  margin-right: 10px;
  width: 40px;
}

.wrapper .main_content .container .back-box .back-btn{
  color: #e84118;
  float: right;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #2f3640;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
}



</style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2><a href="index.php" style="color:#ffffff;text-decoration: none;">Patient</a></h2>
        <ul>
            <li style="background-color: #ffffff;"><a href="appointment_book_form.php" style="color: #0d1d52;text-decoration: none;" id="ba"><i class="fa fa-calendar-plus-o"></i> Book Appointment</a></li>
            <li><a href="appointment_report.php" id="va"><i class="fa fa-address-card"></i> View Appointment</a></li>
            <li><a href="test_display.php" id="th"><i class="fa fa-flask"></i> Test History</a></li>
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
    readRecords();
  });

  function readRecords(){
    var readrecord = "readrecord";

    $.ajax({
        url: "appointment_book_form_db.php",
        type: "POST",
        data: {readrecord:readrecord},
        success: function(data,status){
           $('#records_content').html(data);
           
        } 
    });
}

function ChangeTimeslot(){
  $("#doctor").change(function(){
    var selectedValue = document.getElementById("doctor").value;
    var day = document.getElementById("date").value;
    var pname = document.getElementById("pname").value;
      createCookie("tmp",selectedValue, "1"); 
      createCookie("tmp1",day,"1");
      createCookie("tmp2",pname,"1");

    // Function to create the cookie 
    function createCookie(name, value, days) { 
        var expires; 
      
        if (days) { 
          var date = new Date(); 
          date.setTime(date.getTime() + (days * 60 * 60 * 1000)); 
          expires = "; expires=" + date.toGMTString(); 
        } 
        else { 
          expires = ""; 
        } 
      
    document.cookie = escape(name) + "=" +  
        escape(value) + expires + "; path=/"; 
    } 
    $.ajax({
      url: 'appointment_book_timeslot.php',
      type: 'post',
      data: {search: $(this).val()},
      success: function(result){
        $('#timeslot').html(result);
      }
    });
  });
}
  
  function ChangeTimeslot1(){
    $("#date").change(function(){
    var selectedValue = document.getElementById("doctor").value;
    var day = document.getElementById("date").value;
    var pname = document.getElementById("pname").value;
      createCookie("tmp",selectedValue, "1"); 
      createCookie("tmp1",day,"1");
      createCookie("tmp2",pname,"1");

    // Function to create the cookie 
    function createCookie(name, value, days) { 
        var expires; 
      
        if (days) { 
          var date = new Date(); 
          date.setTime(date.getTime() + (days * 60 * 60 * 1000)); 
          expires = "; expires=" + date.toGMTString(); 
        } 
        else { 
          expires = ""; 
        } 
      
    document.cookie = escape(name) + "=" +  
        escape(value) + expires + "; path=/"; 
    } 

    $.ajax({
      url: 'appointment_book_timeslot.php',
      type: 'post',
      data: {search: $(this).val()},
      success: function(result){
        $('#timeslot').html(result);
      }
    });
    });
  }

</script>

</body>
</html>
