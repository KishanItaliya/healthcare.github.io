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
  <link rel="stylesheet" href="../css/styles.css">
  <!--<script type="text/javascript">
     window.history.forward();
  </script>-->
  
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2><a href="../index.php" style="color:#ffffff;text-decoration: none;">Doctor</a></h2>
        <ul>
            <li style="background-color: #ffffff;"><a href="appointment.php" style="color: #0d1d52;text-decoration: none;"><i class="fa fa-calendar-plus-o"></i> My Appointments</a></li>
            <li><a href="#"><i class="fa fa-user"></i> My account</a></li>
        </ul> 
        
    </div>

    <div class="main_content">
        
        <nav class="navbar navbar-light bg-white justify-content-end">
            <a class="navbar-brand">HMS</a>

            <div class="logout-box">
                <input type="text" class="logout-text" name="" value="Logout" disabled>
                <a class="logout-btn" href="../index.php">
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

            
            <div id="title"><br/><h2>Appointment Listing Page</h2></div>
            <input type="hidden" name="" id="hidden_user_id">
            <div id="records_content"> </div>
            <div id="buttons">
                <br/>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                       
                            <input type="hidden" id="pid" name="patientID" value="'.$id.'">
                            <input type="submit" name="btn" value="Add Prescription" class="btn btn-primary" id="ap"> 
                            <input type="submit" name="btn" value="View Prescription History" class="btn btn-primary" id="vp"> 
                            <input type="submit" name="btn" value="View Test History" class="btn btn-primary" id="vt"> 
                            <input type="submit" name="btn" value="View Medicine History" class="btn btn-primary" id="vm">                         
                      
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
            $('#buttons').hide();
            $('#back_btn').hide();
            readRecords();
        });

        function readRecords(){
            var readrecord = "readrecord";

            $.ajax({
                url: "appointment_db.php",
                type: "POST",
                data: {readrecord:readrecord},
                success: function(data,status){
                   $('#records_content').html(data);
                   
                } 
            });
        }

        
        //----------View Appointment----------
        function ViewAppointment(id){
            var hidden_user_idupd = $('#hidden_user_id').val(id);
            var id = hidden_user_idupd.val();

            $.ajax({
                url: "appointment_view.php",
                type: "POST",
                data: {id:id},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').show();
                    $('#back_btn').hide();
                } 
            });


            
        }

        //---------- Add Prescription ----------
        function AddPrescription(id){
            var hidden_user_idupd = $('#hidden_user_id').val(id);
            var id = hidden_user_idupd.val();
            alert(id);
            $.ajax({
                url: "add_prescription.php",
                type: "POST",
                data: {id:id},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                } 
            });
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

         //---------- Add Prescription ----------

         $('#ap').click(function(){
            //$('#records_content').load("add_prescription.php");

            var id = $('#hidden_user_id').val();
            $.ajax({
                url: "add_prescription.php",
                type: "POST",
                data: {id:id},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').hide();
                    $('#back_btn').show();
                } 
            });

            $('#back_btn').click(function(){
                ViewAppointment(id);
            });

           
         });      


         //---------- View Prescription History----------
         
         $('#vp').click(function(){
            //$('#records_content').load("add_prescription.php");

            var id = $('#hidden_user_id').val();
            $.ajax({
                url: "prescription_report.php",
                type: "POST",
                data: {id:id},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').hide();
                    $('#back_btn').show();
                } 
            });

            $('#back_btn').click(function(){
                ViewAppointment(id);
            });

           
         });   

         function ViewPrescription(id){
             var preid = id;
             
             $.ajax({
                url: "view_prescription.php",
                type: "POST",
                data: {preid:preid},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').hide();
                    $('#back_btn').show();
                } 
            });  
         }  

         //---------- View Test History----------
         
         $('#vt').click(function(){
            //$('#records_content').load("add_prescription.php");

            var id = $('#hidden_user_id').val();
            $.ajax({
                url: "test.php",
                type: "POST",
                data: {id:id},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').hide();
                    $('#back_btn').show();
                } 
            });

            $('#back_btn').click(function(){
                ViewAppointment(id);
            });

           
         });  

         function ViewTest(id){
             var testid = id;
             
             $.ajax({
                url: "test_view.php",
                type: "POST",
                data: {testid:testid},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').hide();
                    $('#back_btn').show();
                } 
            });  
         }  

         //---------- View Medicine History----------
         
         $('#vm').click(function(){
            //$('#records_content').load("add_prescription.php");

            var id = $('#hidden_user_id').val();
            $.ajax({
                url: "medicine.php",
                type: "POST",
                data: {id:id},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').hide();
                    $('#back_btn').show();
                } 
            });

            $('#back_btn').click(function(){
                ViewAppointment(id);
            });

           
         });  

         function ViewMedicine(id){
             var medicineid = id;
             
             $.ajax({
                url: "medicine_view.php",
                type: "POST",
                data: {medicineid:medicineid},
                success: function(data,status){
                    $('#records_content').html(data);
                    $('#title').html('');
                    $('#buttons').hide();
                    $('#back_btn').show();
                } 
            });  
         }  

         //------------ For Search -----------------
         /*
        $('#search').keyup(function(){
            $.ajax({
                url: 'appointment_search.php',
                type: 'post',
                data: {search: $(this).val()},
                success: function(result){
                    $('#records_content').html(result);
                }
            });
        });*/            

</script>

</body>
</html>