<?php
    session_start();
    $user = $_SESSION["receptionist"];
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
        <h2><a href="../index.php" style="color:#ffffff;text-decoration: none;">Hospital</a></h2>
        <ul>
            <li style="background-color: #ffffff;"><a href="appointment_approve.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-calendar-plus-o"></i> Book Appointment</a></li>
            <li><a href="../Patient/patient.php" id="pa"><i class="fa fa-user-plus"></i> Patient</a></li>
        </ul> 
        
    </div>
    <div class="main_content">
        
        <nav class="navbar navbar-light bg-white justify-content-end">
            <a class="navbar-brand">Hello <b><?php echo $user ?></b></a>

            <div class="logout-box">
                <input type="text" class="logout-text" name="" value="Logout" disabled>
                <a class="logout-btn" href="../../../index.php">
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
        <div class="d-flex justify-content-start">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Appointment
            </button>
        </div>
        <br/>
        <h2>Appointment Listing Page</h2>

        <div id="records_content"> </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD APPOINTMENT</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Patient Name:</label>
                        <input type="text" name="" id="patientname" class="form-control" placeholder="Patient Name">
                    </div>

                    <div class="form-group">
                        <label>Date:</label>          
                        <input type="date" class="form-control" id="date" placeholder="Enter Date" name="date">  
                    </div>

                    <div class="form-group">
                        <label for="doctorname">Doctor Name:</label>
                        <select class="form-control" id="doctorname" name="">
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

                    <div class="form-group">
                        <label for="time">Timeslot:</label>
                        <select class="form-control" id="time" name="time">
                            <option selected disabled>Please Select</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Fees:</label>          
                        <input type="text" class="form-control" id="fees" placeholder="Enter Fees" name="fees">  
                    </div>

                    <div class="form-group">
                        <label>Contact No:</label>
                        <input type="text" name="" id="contact" class="form-control" placeholder="Contact Number">
                    </div>

                    <div class="form-group">
                        <label for="state">State:</label>          
                        <select class="form-control" id="state" name="state">
                            <option selected disabled>Please Select</option>
                            <option>Andhra Pradesh</option>
                            <option>Arunachal Pradesh</option>
                            <option>Assam</option>+
                            <option>Bihar</option>
                            <option>Chhattisgarh</option>
                            <option>Goa</option>
                            <option>Gujarat</option>
                            <option>Haryana</option>
                            <option>Himachal Pradesh</option>
                            <option>Jharkhand</option>
                            <option>Karnataka</option>
                            <option>Kerala</option>
                            <option>Madhya Pradesh</option>
                            <option>Maharashtra</option>
                            <option>Manipur</option>
                            <option>Meghalaya</option>
                            <option>Mizoram</option>
                            <option>Nagaland</option>
                            <option>Odisha</option>
                            <option>Panjab</option>
                            <option>Rajasthan</option>
                            <option>Sikkim</option>
                            <option>Tamil Nadu</option>
                            <option>Telangana</option>
                            <option>Tripura</option>
                            <option>Uttar Pradesh</option>
                            <option>Uttrakhand</option>
                            <option>West Bengal</option>
                        </select>  
                    </div>

                    <div class="form-group">
                        <label>Address:</label>
                        <textarea class="form-control" id="address" placeholder="Enter Address..." name="address"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Description:</label>
                        <textarea class="form-control" id="desc" placeholder="Enter Description..." name="desc"></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
            </div>
        </div>
        
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
            var state = $('#state').val();

            $.ajax({
                url: "appointment_approve_db.php",
                type: "POST",
                data: {patientname:patientname,date:date,doctorname:doctorname,timeslot:timeslot,state:state,
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