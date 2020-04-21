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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
  <link rel="stylesheet" href="../styles.css">
  
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2><a href="../index.php" style="color:#ffffff;text-decoration: none;">Admin</a></h2>
        <ul>
            <li style="background-color: #ffffff;"><a href="appointment_approve.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-calendar-plus-o"></i> Appointment</a></li>
            <li><a href="../DoctorFees/doctor_fees.php"><i class="fa fa-usd"></i> Doctor Fees</a></li>
            <li><a href="../DoctorSchedule/doctor_schedule.php"><i class="fa fa-address-card"></i> Doctor Schedule</a></li>
            <li><a href="../LaboratoryTest/laboratory_test.php"><i class="fa fa-flask"></i> Laboratory Test</a></li>
            <li><a href="../PatientTest/patient_test.php"><i class="fa fa-flask"></i> Patient Test</a></li>
            <li><a href="../Medicine/patient_medicine.php"><i class="fa fa-medkit"></i> Medicine</a></li>
            <li><a href="../Prescription/prescription.php"><i class="fa fa-pencil-square-o"></i> Prescription</a></li>
            <li><a href="../Users/users.php"><i class="fa fa-user"></i> Users</a></li>
        </ul> 
        
    </div>
    <div class="main_content">
        
        <nav class="navbar navbar-light bg-white justify-content-end">
            <a class="navbar-brand">HMS</a>

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
                <a class="back-btn" href="#">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
            </div>

        <div>
          <br/>
          <h2 align="left"><b>Book Your Appointment</b></h2>
          <hr>
        </div>

        <form class="form-horizontal" action="appointment_db.php" method="POST">
          
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" id="pname" placeholder="Enter Your Name" name="pname" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="date">Date:</label>
            <div class="col-sm-10">          
              <input type="date" class="form-control" id="date" placeholder="Enter Date" name="date" required>  
            </div>
          </div>
  
          <div class="form-group">
            <label class="control-label col-sm-2" for="doctor">Doctor:</label>
            <div class="col-sm-10">
              <select class="form-control" id="doctor" name="doctor">
              <option selected disabled>Select Doctor</option>
                <?php 
                  $conn = mysqli_connect("localhost","root","","hms");
                  if(!$conn){
                    die("ERROR:".mysqli_connect_error());
                  }
                  $sql = "SELECT d_name FROM doctor";
                  $result = mysqli_query($conn,$sql);
                  while($row = mysqli_fetch_assoc($result)){
                  $name = $row['d_name'];
                  echo "<option>$name</option>";
                  }
                ?>    
              </select>
            </div>
          </div>
    
          <div class="form-group">
            <label class="control-label col-sm-2" for="timeslot">Timeslot:</label>
            <div class="col-sm-10">
              <select class="form-control" id="timeslot" name="timeslot"> 
              </select>       
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="fees">Fees</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" id="fees" value="150" name="fees" disabled>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="contact">Contact No.</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" id="contact" placeholder="Enter Contact No." name="contact">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="address">Address</label>
            <div class="col-sm-10">          
              <textarea class="form-control" id="address" placeholder="Enter Address..." name="address" rows="2"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="desc">Description</label>
            <div class="col-sm-10">          
              <textarea class="form-control" id="desc" placeholder="Enter Description..." name="desc" rows="2"></textarea>
            </div>
          </div>

          <!--<div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                  </div>
                </div>
              </div>-->

          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" style="margin-left:590px; margin-right:10px;">Book Appointment</button>
              <button type="reset" class="btn btn-danger">Reset</button>
            </div>
          </div>
        </form>
        
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
                url: "appointment_approve_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                } 
            });
        }

         //----------Add Appointment------------

         function addRecord(){
            var patientname = $('#patientname').val();
            var date = $('#date').val();
            var doctorname = $('#doctorname').val();
            var timeslot = $('#time').val();
            var fees = $('#fees').val();
            var contact = $('#contact').val();
            var address = $('#address').val();
            var description = $('#desc').val();

            $.ajax({
                url: "appointment_approve_db.php",
                type: "POST",
                data: {patientname:patientname,date:date,doctorname:doctorname,timeslot:timeslot,
                       fees:fees,contact:contact,address:address,description:description},
                success: function(data,status){
                    readRecords();
                }
            });
        }

        //----------Delete Appointment------------

        function DeleteAppointment(deleteid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "appointment_approve_db.php",
                    type: "POST",
                    data: {deleteid:deleteid},
                    success: function(data,status){
                        readRecords();
                    }
                });
            }
        }

        //----------Confirm Appointment------------

        function ConfirmAppointment(updateid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "appointment_approve_db.php",
                    type: "POST",
                    data: {updateid:updateid},
                    success: function(data,status){
                        readRecords();
                    }
                });
            }
        }

        //------------ For Search -----------------

        $('#search').keyup(function(){
            $.ajax({
                url: 'appointment_search.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#records_content').html(result);
                }
            });
        });          

        //---------- For Timeslot (Create Cookie) ----------------

        $("#doctorname").change(function(){
            var selectedValue = document.getElementById("doctorname").value;
            var day = document.getElementById("date").value;
            var pname = document.getElementById("patientname").value;
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
                url: 'appointment_timeslot.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#time').html(result);
                }
            });
        });

        //---------- For Timeslot (Create Cookie) ----------------

        $("#date").change(function(){
            var selectedValue = document.getElementById("doctorname").value;
            var day = document.getElementById("date").value;
            var pname = document.getElementById("patientname").value;
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
                url: 'appointment_timeslot.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#time').html(result);
                }
            });
        });

</script>

</body>
</html>