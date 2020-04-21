<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Users</title>
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
            <li><a href="../DoctorSchedule/doctor_schedule.php"><i class="fa fa-address-card"></i> Doctor Schedule</a></li>
            <li><a href="../LaboratoryTest/laboratory_test.php"><i class="fa fa-flask"></i> Laboratory Test</a></li>
            <li><a href="../Doctor/doctor.php"><i class="fa fa-user-plus"></i> Doctor</a></li>
            <li><a href="../PatientTest/patient_test.php"><i class="fa fa-flask"></i> Patient Test</a></li>
            <li><a href="../Medicine/patient_medicine.php"><i class="fa fa-medkit"></i> Medicine</a></li>
            <li><a href="../Prescription/prescription.php"><i class="fa fa-pencil-square-o"></i> Prescription</a></li>
            <li><a href="../Patient/patient.php"><i class="fa fa-user-plus"></i> Patient</a></li>
            <li style="background-color: #ffffff;"><a href="users.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-user"></i> Users</a></li>
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New User
            </button>
        </div>
        <br/>
        <h2>Users Report</h2>

        <div id="records_content"> </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD NEW USER</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="category">Select Category:</label>
                        <select class="form-control" id="category" name="category">
                            <option selected disabled>Please Select</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Patient">Patient</option>
                            <option value="Receptionist">Receptionist</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user">Select User:</label>
                        <select class="form-control" id="user" name="user">
                            <option selected disabled>Please Select</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="uname">Username:</label>          
                        <input type="text" class="form-control" id="uname" placeholder="Enter Username" name="uname">  
                    </div>

                    <div class="form-group">
                        <label for="pwd">Password:</label>          
                        <input type="password" class="form-control" id="pwd" placeholder="Enter Password" name="pwd">  
                    </div>

                    <div class="form-group">
                        <label for="cpwd">Confirm Password:</label>          
                        <input type="password" class="form-control" id="cpwd" placeholder="Enter Confirm Password" name="cpwd">  
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addUser()">Save</button>
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
                    <h4 class="modal-title">UPDATE NEW USER</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="upd_uname">Username:</label>          
                        <input type="text" class="form-control" id="upd_uname" placeholder="Enter Username" name="upd_uname">  
                    </div>

                    <div class="form-group">
                        <label for="upd_pwd">Password:</label>          
                        <input type="password" class="form-control" id="upd_pwd" placeholder="Enter Password" name="upd_pwd">  
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateUser()">Update</button>
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
                url: "users_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                } 
            });
        }

         //----------Add User------------

         function addUser(){
            var category = $('#category').val(); 
            var user = $('#user').val();
            var uname = $('#uname').val();
            var pwd = $('#pwd').val();
            var cpwd = $('#cpwd').val();
           
            if(pwd==cpwd){

                    /*var profile = $('#pic').val().split('.').pop().toLowerCase();

                    if(jQuery.inArray(profile,['gif','png','jpg','jpeg']) == -1){
                        
                        alert('Invalid Image File');
                        $('#pic').val('');
                        return false;
                    }*/
                
                $.ajax({
                    url: "users_db.php",
                    type: "POST",
                    data: { category:category,
                            user:user,
                            uname:uname,
                            pwd:pwd
                            //profile:profile
                          },
                    success: function(data,status){
                        readRecords();
                    }
                });
            }
            else {
                alert("Password & Confirmed Password does not match. Otherwise You have not selected pic");
            }
            
        }

        //----------Delete User------------

        function DeleteUser(deleteid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "users_db.php",
                    type: "POST",
                    data: {deleteid:deleteid},
                    success: function(data,status){
                        readRecords();
                    }
                });
            }
        }

        //------------ For Search -----------------

        $('#search').keyup(function(){
            $.ajax({
                url: 'users_search.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#records_content').html(result);
                }
            });
        });         

        //----------Update Users----------

        function GetUser(id){
            $('#hidden_user_id').val(id);

            $.post("users_db.php",{id:id},function(data,status){

                var user = JSON.parse(data);
                $('#upd_uname').val(user.u_username); 
                $('#upd_pwd').val(user.u_password); 
            });

            $('#updateModal').modal("show");

        }

        function updateUser(){
           
            var unameupd = $('#upd_uname').val();
            var pwdupd = $('#upd_pwd').val();
            var hidden_user_idupd = $('#hidden_user_id').val();

            $.post("users_db.php",{
                hidden_user_idupd:hidden_user_idupd,
                unameupd:unameupd,
                pwdupd:pwdupd
            },
            function(data,status){
                $('#updateModal').modal("hide"); 
                readRecords();
            }
            
            );

            
        }

        $("#category").change(function(){
            var category = $('#category').val();
            
            $.ajax({
                url: 'user_category.php',
                type: 'post',
                data: {category:category},
                success: function(result){
                $('#user').html(result);
                }
            });
        });

</script>

</body>
</html>