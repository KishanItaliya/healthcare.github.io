<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }

    $sql = "SELECT * FROM laboratory_test";
    $result = mysqli_query($conn,$sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laboratory Test</title>
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
            <li style="background-color: #ffffff;"><a href="laboratory_test.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-flask"></i> Laboratory Test</a></li>
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Laboratory Test
            </button>
        </div>
        <br/>
        <h2>Laboratory Test Report</h2>

        <div id="records_content"> </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD LABORATORY TEST</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Test Name:</label>          
                        <input type="text" class="form-control" id="name" placeholder="Enter Test Name" name="">  
                    </div>

                    <div class="form-group">
                        <label for="cost">Test Cost:</label>          
                        <input type="number" class="form-control" id="cost" placeholder="Enter Test Cost" name="">  
                    </div>

                    <div class="form-group">
                        <label for="duration">Test Duration:</label>          
                        <input type="text" class="form-control" id="duration" placeholder="Enter Test Duration" name="">  
                    </div>

                    <div class="form-group">
                        <label for="sample">Sample Required:</label>          
                        <input type="text" class="form-control" id="sample" placeholder="Enter Sample" name="">  
                    </div>
                    
                    <div class="form-group">
                        <label for="desc">Description:</label>
                        <textarea class="form-control" id="desc" placeholder="Enter Description..." name="" rows="3"></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addTest()">Save</button>
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
                    <h4 class="modal-title">UPDATE LABORATORY TEST</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="upd_test_name">Test Name:</label>          
                        <input type="text" class="form-control" id="upd_test_name" placeholder="Enter Test Name" name="test">  
                    </div>

                    <div class="form-group">
                        <label for="upd_test_cost">Test Cost:</label>          
                        <input type="number" class="form-control" id="upd_test_cost" placeholder="Enter Test Cost" name="test_cost">  
                    </div>

                    <div class="form-group">
                        <label for="upd_test_duration">Test Duration:</label>          
                        <input type="text" class="form-control" id="upd_test_duration" placeholder="Enter Test Duration" name="test_duration">  
                    </div>

                    <div class="form-group">
                        <label for="upd_test_sample">Sample Required:</label>          
                        <input type="text" class="form-control" id="upd_test_sample" placeholder="Enter Sample" name="test_sample">  
                    </div>
                    
                    <div class="form-group">
                        <label for="upd_test_desc">Description:</label>
                        <textarea class="form-control" id="upd_test_desc" placeholder="Enter Description..." name="desc" rows="3"></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateTest()">Update</button>
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
                url: "laboratory_test_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                } 
            });
        }

         //----------Add Laboratory Test------------

         function addTest(){
            var testname = $('#name').val();
            var testcost = $('#cost').val();
            var testduration = $('#duration').val();
            var testsample = $('#sample').val();
            var testdescription = $('#desc').val();

            //alert(testname+testcost+testduration+testsample+testdescription);
            $.ajax({
                url: "laboratory_test_db.php",
                type: "POST",
                data: {testname:testname,
                        testcost:testcost,
                        testduration:testduration,
                        testsample:testsample,
                        testdescription:testdescription
                      },
                success: function(data,status){
                    readRecords();
                }
            });
        }

        //----------Delete Laboratory Test------------

        function DeleteTest(deleteid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "laboratory_test_db.php",
                    type: "POST",
                    data: {deleteid:deleteid},
                    success: function(data,status){
                        readRecords();
                    }
                });
            }
        }

        //----------Update Laboratory Test----------
        function GetTest(id){
            $('#hidden_user_id').val(id);

            $.post("laboratory_test_db.php",{id:id},function(data,status){

                var user = JSON.parse(data);
                $('#upd_test_name').val(user.lab_t_name); 
                $('#upd_test_cost').val(user.lab_t_cost); 
                $('#upd_test_duration').val(user.lab_t_duration);
                $('#upd_test_sample').val(user.lab_t_sample); 
                $('#upd_test_desc').val(user.lab_t_description);  
            });

            $('#updateModal').modal("show");

        }

        function updateTest(){
           
            var testnameupd = $('#upd_test_name').val();
            var testcostupd = $('#upd_test_cost').val();
            var testdurationupd = $('#upd_test_duration').val();
            var testsampleupd = $('#upd_test_sample').val();
            var testdescriptionupd = $('#upd_test_desc').val();
            var hidden_user_idupd = $('#hidden_user_id').val();

            $.post("laboratory_test_db.php",{
                hidden_user_idupd:hidden_user_idupd,
                testnameupd:testnameupd,
                testcostupd:testcostupd,
                testdurationupd:testdurationupd,
                testsampleupd:testsampleupd,
                testdescriptionupd:testdescriptionupd
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
                url: 'laboratory_test_search.php',
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