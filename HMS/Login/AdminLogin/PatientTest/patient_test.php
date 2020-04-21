<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
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
            <li><a href="../LaboratoryTest/laboratory_test.php"><i class="fa fa-flask"></i> Laboratory Test</a></li>
            <li><a href="../Doctor/doctor.php"><i class="fa fa-user-plus"></i> Doctor</a></li>
            <li style="background-color: #ffffff;"><a href="patient_test.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-flask"></i> Patient Test</a></li>
            <li><a href="../Medicine/patient_medicine.php"><i class="fa fa-medkit"></i> Medicine</a></li>
            <li><a href="../Prescription/prescription.php"><i class="fa fa-pencil-square-o"></i> Prescription</a></li>
            <li><a href="../Patient/patient.php"><i class="fa fa-user-plus"></i> Patient</a></li>
            <li><a href="../Users/users.php"><i class="fa fa-user"></i> Users</a></li>
        </ul> 
        
    </div>
    <div class="main_content">
        <nav class="navbar navbar-light bg-white justify-content-end">
            <a class="navbar-brand">HMS</a>

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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Patient Test
            </button>
        </div>
        <br/>
        <h2>Patient Test Report</h2>

        <div id="records_content"> </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD PATIENT TEST</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="patientname">Select Patient:</label>
                        <select class="form-control" id="patientname" name="">
                            <option selected disabled>Please Select</option>
                            <?php 
                                $sql = "SELECT p_name FROM patient";
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $patientname = $row['p_name'];
                                    echo "<option>$patientname</option>";
                                }
                            ?>    
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="testname">Select Test:</label>
                        <select class="form-control" id="testname" name="">
                            <option selected disabled>Please Select</option>
                            <?php 
                                $sql = "SELECT lab_t_name FROM laboratory_test";
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $testname = $row['lab_t_name'];
                                    echo "<option>$testname</option>";
                                }
                            ?>    
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cost">Cost:</label>         
                        <select class="form-control" id="cost" name="cost">
                            <option selected disabled>Please Select</option>
                        </select>   
                    </div>

                    <div class="form-group">
                        <label for="c_date">Collection Date:</label>          
                        <input type="date" class="form-control" id="c_date" placeholder="Enter Collection Date" name="">  
                    </div>

                    <div class="form-group">
                        <label for="d_date">Delivery Date:</label>          
                        <input type="date" class="form-control" id="d_date" placeholder="Enter Delivery Date" name="">  
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
                    <h4 class="modal-title">UPDATE PATIENT TEST</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="upd_testname">Select Test:</label>
                        <select class="form-control" id="upd_testname" name="testname" value="test">
                            <option selected disabled>Please Select</option>
                            <?php 
                                $sql = "SELECT lab_t_name FROM laboratory_test";
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $testname = $row['lab_t_name'];
                                    echo "<option>$testname</option>";
                                }
                            ?>    
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="upd_cost">Cost:</label>     
                        <select class="form-control" id="upd_cost" name="">
                            <option selected disabled>Please Select</option> 
                        </select>  
                    </div>

                    <div class="form-group">
                        <label for="upd_c_date">Collection Date:</label>          
                        <input type="date" class="form-control" id="upd_c_date" placeholder="Enter Collection Date" name="">  
                    </div>

                    <div class="form-group">
                        <label for="upd_d_date">Delivery Date:</label>          
                        <input type="date" class="form-control" id="upd_d_date" placeholder="Enter Delivery Date" name="">  
                    </div>
                    
                    <div class="form-group">
                        <label for="upd_desc">Description:</label>
                        <textarea class="form-control" id="upd_desc" placeholder="Enter Description..." name="" rows="3"></textarea>
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
                url: "patient_test_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                } 
            });
        }

         //----------Add Patient Test------------

         function addTest(){
            var patientname = $('#patientname').val();
            var testname = $('#testname').val();
            var testcost = $('#cost').val();
            var testcdate = $('#c_date').val();
            var testddate = $('#d_date').val();
            var testdescription = $('#desc').val();

            //alert(testname+testcost+testduration+testsample+testdescription);
            $.ajax({
                url: "patient_test_db.php",
                type: "POST",
                data: { patientname:patientname,
                        testname:testname,
                        testcost:testcost,
                        testcdate:testcdate,
                        testddate:testddate,
                        testdescription:testdescription
                      },
                success: function(data,status){
                    readRecords();
                }
            });
        }

        //----------Delete Patient Test------------

        function DeleteTest(deleteid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "patient_test_db.php",
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
                url: 'patient_test_search.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#records_content').html(result);
                }
            });
        });         

        //----------Update Patient Test----------

        function GetTest(id){
            $('#hidden_user_id').val(id);

            $.post("patient_test_db.php",{id:id},function(data,status){

                var user = JSON.parse(data);
                $('#upd_testname').val(user.t_name); 
                $('#upd_c_date').val(user.t_c_date);
                $('#upd_d_date').val(user.t_d_date); 
                $('#upd_desc').val(user.t_description);  
            });

            $('#updateModal').modal("show");

        }

        function updateTest(){
           
            var testnameupd = $('#upd_testname').val();
            var testcostupd = $('#upd_cost').val();
            var testcdateupd = $('#upd_c_date').val();
            var testddateupd = $('#upd_d_date').val();
            var testdescriptionupd = $('#upd_desc').val();
            var hidden_user_idupd = $('#hidden_user_id').val();

            $.post("patient_test_db.php",{
                hidden_user_idupd:hidden_user_idupd,
                testnameupd:testnameupd,
                testcostupd:testcostupd,
                testcdateupd:testcdateupd,
                testddateupd:testddateupd,
                testdescriptionupd:testdescriptionupd
            },
            function(data,status){
                $('#updateModal').modal("hide"); 
                readRecords();
            }
            
            );

            
        }

    //---------- For Test Cost (Create Cookie) ----------------

    $("#testname").change(function(){
    var test = document.getElementById("testname").value;

      createCookie("test",test, "1"); 

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
            url: 'test_cost.php',
            type: 'post',
            data: {search: $(this).val()},
            success: function(result){
            $('#cost').html(result);
            }
          });
  });

    

    $("#upd_testname").change(function(){
        var testupd = document.getElementById("upd_testname").value;

        createCookie("testupd",testupd, "1"); 

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
            url: 'test_cost_upd.php',
            type: 'post',
            data: {search: $(this).val()},
            success: function(result){
            $('#upd_cost').html(result);
            }
        });
    });


    

    
</script>

</body>
</html>