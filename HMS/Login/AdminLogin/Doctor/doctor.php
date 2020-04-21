<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doctor</title>
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
            <li style="background-color: #ffffff;"><a href="doctor.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-user-plus"></i> Doctor</a></li>
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New Doctor
            </button>
        </div>
        <br/>
        <h2>Doctor Report</h2>

        <div id="records_content"> </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD NEW DOCTOR</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Name:</label>          
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">  
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>          
                        <input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email">  
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

                    <div class="form-group">
                        <label for="gender">Select Gender:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option selected disabled>Please Select</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>          
                        <input type="date" class="form-control" id="dob" placeholder="Enter Date of Birth" name="dob">  
                    </div>

                    <div class="form-group">
                        <label for="status">Marital Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option selected disabled>Please Select</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Divorced</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile:</label>          
                        <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile No." name="mobile">  
                    </div> 

                    <div class="form-group">
                        <label for="state">State:</label>          
                        <select class="form-control" id="state" name="state">
                            <option selected disabled>Please Select</option>
                            <option>Andhra Pradesh</option>
                            <option>Arunachal Pradesh</option>
                            <option>Assam</option>
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
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" placeholder="Enter Address..." name="address"></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addDoctor()">Save</button>
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
                    <h4 class="modal-title">UPDATE NEW DOCTOR</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                <div class="form-group">
                        <label for="upd_name">Name:</label>          
                        <input type="text" class="form-control" id="upd_name" placeholder="Enter Name" name="upd_name">  
                    </div>

                    <div class="form-group">
                        <label for="upd_email">Email:</label>          
                        <input type="email" class="form-control" id="upd_email" placeholder="Enter Email Address" name="upd_email">  
                    </div>

                    <div class="form-group">
                        <label for="upd_gender">Select Gender:</label>
                        <select class="form-control" id="upd_gender" name="upd_gender">
                            <option selected disabled>Please Select</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="upd_dob">Date of Birth:</label>          
                        <input type="date" class="form-control" id="upd_dob" placeholder="Enter Date of Birth" name="upd_dob">  
                    </div>

                    <div class="form-group">
                        <label for="upd_status">Marital Status:</label>
                        <select class="form-control" id="upd_status" name="upd_status">
                            <option selected disabled>Please Select</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Divorced</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="upd_mobile">Mobile:</label>          
                        <input type="text" class="form-control" id="upd_mobile" placeholder="Enter Mobile No." name="upd_mobile">  
                    </div> 

                    <div class="form-group">
                        <label for="upd_state">State:</label>          
                        <select class="form-control" id="upd_state" name="upd_state">
                            <option selected disabled>Please Select</option>
                            <option>Andhra Pradesh</option>
                            <option>Arunachal Pradesh</option>
                            <option>Assam</option>
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
                        <label for="upd_address">Address:</label>
                        <textarea class="form-control" id="upd_address" placeholder="Enter Address..." name="upd_address"></textarea>
                    </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateDoctor()">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" name="" id="hidden_user_id">
                </div>

            </div>
            </div>
        </div>

        <!-- The Update Modal -->
        <div class="modal" id="updateModalID">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">CREATE PATIENT ID</h4>
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
                    <input type="hidden" name="" id="hidden_user_id1">
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
                url: "doctor_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                } 
            });
        }

         //----------Add Doctor------------

         function addDoctor(){
            var name = $('#name').val(); 
            var email = $('#email').val();
            var uname = $('#uname').val();
            var pwd = $('#pwd').val();
            var cpwd = $('#cpwd').val();
            var gender = $('#gender').val();
            var dob = $('#dob').val();
            var status = $('#status').val();
            var mobile = $('#mobile').val();
            var address = $('#address').val();
            var state = $('#state').val();

            alert(name+email+gender+dob+status+mobile+state+address);

            if(pwd==cpwd){
            
                $.ajax({
                    url: "doctor_db.php",
                    type: "POST",
                    data: { name:name,
                            email:email,
                            uname:uname,
                            pwd:pwd,
                            gender:gender,
                            dob:dob,
                            status:status,
                            mobile:mobile,
                            address:address,
                            state:state
                          },
                        success: function(data,status){
                        readRecords();
                        }
                });
            }
            else {
                alert("Password & Confirmed Password does not match.");
            }
        }

        //----------Delete Doctor------------

        function DeleteDoctor(deleteid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "doctor_db.php",
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
                url: 'doctor_search.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#records_content').html(result);
                }
            });
        });

        //----------Update Doctor----------

        function GetDoctor(id){
            $('#hidden_user_id').val(id);

            $.post("doctor_db.php",{id:id},function(data,status){

                var user = JSON.parse(data);
                $('#upd_name').val(user.d_name); 
                $('#upd_email').val(user.d_email); 
                $('#upd_gender').val(user.d_gender); 
                $('#upd_dob').val(user.d_dob); 
                $('#upd_status').val(user.d_status);  
                $('#upd_mobile').val(user.d_mobile); 
                $('#upd_address').val(user.d_address);
                $('#upd_state').val(user.d_state); 
            });

            $('#updateModal').modal("show");

        }

        function updateDoctor(){
           
            var nameupd = $('#upd_name').val();
            var emailupd = $('#upd_email').val();
            var genderupd = $('#upd_gender').val();
            var dobupd = $('#upd_dob').val();
            var statusupd = $('#upd_status').val();
            var mobileupd = $('#upd_mobile').val();
            var addressupd = $('#upd_address').val();
            var stateupd = $('#upd_state').val();
            var hidden_user_idupd = $('#hidden_user_id').val();

            $.post("doctor_db.php",{
                hidden_user_idupd:hidden_user_idupd,
                nameupd:nameupd,
                emailupd:emailupd,
                genderupd:genderupd,
                dobupd:dobupd,
                statusupd:statusupd,
                mobileupd:mobileupd,
                addressupd:addressupd,
                stateupd:stateupd
            },
            function(data,status){
                $('#updateModal').modal("hide"); 
                readRecords();
            }
            
            );

            
        }

        //---------- Retrieve UserId ---------------

        function GetUser(id){
            $('#hidden_user_id1').val(id);

            $.post("doctor_db.php",{id1:id},function(data,status){

                var user = JSON.parse(data);
                $('#upd_uname').val(user.u_username); 
                $('#upd_pwd').val(user.u_password); 
            });

            $('#updateModalID').modal("show");

        }    

        function updateUser(){
           
            var unameupd = $('#upd_uname').val();
            var pwdupd = $('#upd_pwd').val();
            var hidden_user_idupd1 = $('#hidden_user_id1').val();

            $.post("doctor_db.php",{
                hidden_user_idupd1:hidden_user_idupd1,
                unameupd:unameupd,
                pwdupd:pwdupd
            },
            function(data,status){
                $('#updateModalID').modal("hide"); 
                readRecords();
            }
            
            );

            
        }     

</script>

</body>
</html>