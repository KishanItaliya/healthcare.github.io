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
  <title>Doctor Schedule</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/styles.css">
  
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2><a href="../index.php" style="color:#ffffff;text-decoration: none;">Admin</a></h2>
        <ul>
            <li><a href="../Appointment/appointment_approve.php"><i class="fa fa-calendar-plus-o"></i> Appointment</a></li>
            <li><a href="../DoctorFees/doctor_fees.php"><i class="fa fa-usd"></i> Doctor Fees</a></li>
            <li style="background-color: #ffffff;"><a href="doctor_schedule.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-address-card"></i> Doctor Schedule</a></li>
            <li><a href="../LaboratoryTest/laboratory_test.php"><i class="fa fa-flask"></i> Laboratory Test</a></li>
            <li><a href="../Doctor/doctor.php"><i class="fa fa-user-plus"></i> Doctor</a></li>
            <li><a href="../PatientTest/patient_test.php"><i class="fa fa-flask"></i> Patient Test</a></li>
            <li><a href="../Medicine/patient_medicine.php"><i class="fa fa-medkit"></i> Medicine</a></li>
            <li><a href="../Prescription/prescription.php"><i class="fa fa-pencil-square-o"></i> Prescription</a></li>
            <li><a href="../Patient/patient.php"><i class="fa fa-user-plus"></i> Patient</a></li>
            <li><a href="../Users/users.php"><i class="fa fa-user"></i> Users</a></li>
        </ul> 
        
    </div>
    <div class="main_content">
        <nav class="navbar navbar-light bg-white justify-content-end">
            <a class="navbar-brand">Hello Admin</a>

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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Schedule
            </button>
        </div>
        <br/>
        <h2>Doctors Schedule Report</h2>

        <div id="records_content"> </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD DOCTORS SCHEDULE</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="doctorname">Select Doctor:</label>
                        <select class="form-control" id="doctorname" name="">
                            <option selected disabled>Please Select</option>
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
                        <label for="day">Select Day:</label>
                        <select class="form-control" id="day" name="">
                            <option selected disabled>Please Select</option>
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Sunday</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="time">Select Timeslot:</label>
                        <select class="form-control" id="time" name="">
                            <option selected disabled>Please Select</option>
                            <option>10:00-12:00 AM</option>
                            <option>12:00-02:00 PM</option>
                            <option>02:00-04:00 PM</option>
                            <option>04:00-06:00 PM</option>
                            <option>06:00-08:00 PM</option>
                            <option>08:00-10:00 PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="desc">Description:</label>
                        <textarea class="form-control" id="desc" placeholder="Enter Description..." name="desc"></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addSchedule()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
            </div>
        </div>

        <!-- The Update Modal -->
        <div class="modal" id="updateModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">UPDATE DOCTORS SCHEDULE</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="upd_day">Select Day:</label>
                        <select class="form-control" id="upd_day" name="">
                            <option selected disabled>Please Select</option>
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                            <option>Sunday</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="upd_time">Select Timeslot:</label>
                        <select class="form-control" id="upd_time" name="">
                            <option selected disabled>Please Select</option>
                            <option>10:00-12:00 AM</option>
                            <option>12:00-02:00 PM</option>
                            <option>02:00-04:00 PM</option>
                            <option>04:00-06:00 PM</option>
                            <option>06:00-08:00 PM</option>
                            <option>08:00-10:00 PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="upd_desc">Description:</label>
                        <textarea class="form-control" id="upd_desc" placeholder="Enter Description..." name="desc"></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateSchedule()">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" name="" id="hidden_user_id">
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
                url: "doctor_schedule_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                } 
            });
        }

         //----------Add Schedule------------

         function addSchedule(){
            var doctorname = $('#doctorname').val();
            var day = $('#day').val();
            var timeslot = $('#time').val();
            var description = $('#desc').val();

            $.ajax({
                url: "doctor_schedule_db.php",
                type: "POST",
                data: {doctorname:doctorname,day:day,timeslot:timeslot,description:description},
                success: function(data,status){
                    readRecords();
                }
            });
        }

        //----------Delete Schedule------------

        function DeleteSchedule(deleteid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "doctor_schedule_db.php",
                    type: "POST",
                    data: {deleteid:deleteid},
                    success: function(data,status){
                        readRecords();
                    }
                });
            }
        }

        //----------Update Schedule----------
        function GetSchedule(id){
            $('#hidden_user_id').val(id);

            $.post("doctor_schedule_db.php",{id:id},function(data,status){

                var user = JSON.parse(data);
                $('#upd_day').val(user.sdl_day); 
                $('#upd_time').val(user.sdl_timeslot); 
                $('#upd_desc').val(user.sdl_description); 
            });

            $('#updateModal').modal("show");

        }

        function updateSchedule(){
           
            var dayupd = $('#upd_day').val();
            var timeupd = $('#upd_time').val();
            var descupd = $('#upd_desc').val();
            var hidden_user_idupd = $('#hidden_user_id').val();

            $.post("doctor_schedule_db.php",{
                hidden_user_idupd:hidden_user_idupd,
                dayupd:dayupd,
                timeupd:timeupd,
                descupd:descupd
            },
            function(data,status){
                $('#updateModal').modal("hide"); 
                readRecords();
            }
            
            );

            
        }

        //------------ For Search -----------------

        $('#search').keyup(function(){
            $.ajax({
                url: 'doctor_schedule_search.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#records_content').html(result);
                }
            });
        });          


</script>

</body>
</html>