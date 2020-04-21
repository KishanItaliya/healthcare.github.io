<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Patient</title>
	<link rel="stylesheet" href="styles.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Patient</h2>
        <ul>
            <li><a href="appointment_book_form.php" id="ba"><i class="fa fa-calendar-plus-o"></i> Book Appointment</a></li>
            <li><a href="appointment_report.php" id="va"><i class="fa fa-address-card"></i> View Appointment</a></li>
            <li><a href="test.php" id="th"><i class="fa fa-flask"></i> Test History</a></li>
            <li><a href="medicine.php" id="mp"><i class="fa fa-medkit"></i> Medicine Purchases</a></li>
            <li><a href="prescription_report.php" id="dp"><i class="fa fa-sticky-note"></i> Doctor Prescription</a></li>
        </ul> 
        
    </div>

    <div class="main_content">

        <nav class="navbar navbar-light bg-white justify-content-end">
          <a class="navbar-brand">HMS</a>

          <div class="logout-box">
              <input type="text" class="logout-text" name="" value="Logout" disabled>
              <a class="logout-btn" href="../HMS/index.php">
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

        <div>Welcome!! Have a nice day.</div>  
        <input type="hidden" name="" id="hidden_user_id">
            <div id="records_content"> </div>
    </div>
 
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">

</script>
</body>
</html>