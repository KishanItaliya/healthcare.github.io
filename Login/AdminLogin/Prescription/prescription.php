<?php
    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prescription</title>
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
            <li style="background-color: #ffffff;"><a href="prescription.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-pencil-square-o"></i> Prescription</a></li>
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Prescription
            </button>
        </div>
        <br/>
        <h2>Doctors Prescription Report</h2>

        <div id="records_content"> </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD PRESCRIPTION</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="appointment">Select Appointment:</label>
                        <select class="form-control" id="appointment" name="">
                            <option selected disabled>Please Select</option>
                            <?php 
                                $sql = "SELECT a_id FROM appointment ORDER BY a_id ASC";
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                                    $ID = $row['a_id'];
                                    echo "<option>$ID</option>";
                                }
                            ?>    
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Date:</label>          
                        <input type="date" class="form-control" id="date" placeholder="Enter Date" name="">  
                    </div>
                    
                    <div class="form-group">
                        <label for="presc">Prescription:</label>
                        <textarea class="form-control" id="presc" placeholder="Enter Prescription..." name="" rows="3"></textarea>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addPrescription()">Save</button>
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
                    <h4 class="modal-title">UPDATE PRESCRIPTION</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="upd_date">Date:</label>          
                        <input type="date" class="form-control" id="upd_date" placeholder="Enter Date" name="">  
                    </div>
                    
                    <div class="form-group">
                        <label for="upd_presc">Prescription:</label>
                        <textarea class="form-control" id="upd_presc" placeholder="Enter Prescription..." name="" rows="3"></textarea>
                    </div>



                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updatePrescription()">Update</button>
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
                url: "prescription_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                } 
            });
        }

         //----------Add Prescription------------

         function addPrescription(){
            var ID = $('#appointment').val();
            var date = $('#date').val();
            var prescription = $('#presc').val();

            //alert(testname+testcost+testduration+testsample+testdescription);
            $.ajax({
                url: "prescription_db.php",
                type: "POST",
                data: { ID:ID,
                        date:date,
                        prescription:prescription
                      },
                success: function(data,status){
                    readRecords();
                }
            });
        }

        //----------Delete Prescription ------------

        function DeletePrescription(deleteid){
            var conf = confirm("Are You Sure?");
            if(conf==true){
                $.ajax({
                    url: "prescription_db.php",
                    type: "POST",
                    data: {deleteid:deleteid},
                    success: function(data,status){
                        readRecords();
                    }
                });
            }
        }

        //----------Update Prescription ----------

        function GetPrescription(id){
            $('#hidden_user_id').val(id);

            $.post("prescription_db.php",{id:id},function(data,status){

                var user = JSON.parse(data);
                $('#upd_date').val(user.pre_date); 
                $('#upd_presc').val(user.prescription); 
            });

            $('#updateModal').modal("show");

        }

        function updatePrescription(){
           
            var dateupd = $('#upd_date').val();
            var prescriptionupd = $('#upd_presc').val();
            var hidden_user_idupd = $('#hidden_user_id').val();

            $.post("prescription_db.php",{
                hidden_user_idupd:hidden_user_idupd,
                dateupd:dateupd,
                prescriptionupd:prescriptionupd
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
                url: 'prescription_search.php',
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