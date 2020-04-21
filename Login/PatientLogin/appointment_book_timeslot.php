<?php


    $doctor = $_COOKIE["tmp"];
    $date = $_COOKIE["tmp1"];
    $patient = $_COOKIE["tmp2"];

    $conn = mysqli_connect("localhost","root","","hms");
    if(!$conn){
        die("ERROR:".mysqli_connect_error());
    }
    
    $sqlid = "SELECT d_id From doctor WHERE d_name='$doctor'";
    $result = mysqli_query($conn,$sqlid);
    $id1 = mysqli_fetch_assoc($result);
    $id2 = $id1['d_id'];

   
    
    $month1 = substr($date,5,6);
    $month = substr($month1,0,2);
    $day = substr($date,8,9);

    if($month=="01"){
        $sum = $day;
      }
      else if($month=="02"){
        $sum = 31+$day;
      }
      else if($month=="03"){
        $sum = 31+29+$day;
      }
      else if($month=="04"){
        $sum = 31+29+31+$day;
      }
      else if($month=="05"){
        $sum = 31+29+31+30+$day;
      }
      else if($month=="06"){
        $sum = 31+29+31+30+31+$day;
      }
      else if($month=="07"){
        $sum = 31+29+31+30+31+30+$day;
      }
      else if($month=="08"){
        $sum = 31+29+31+30+31+30+31+$day;
      }
      else if($month=="09"){
        $sum = 31+29+31+30+31+30+31+31+$day;
      }
      else if($month=="10"){
        $sum = 31+29+31+30+31+30+31+31+30+$day;
      }
      else if($month=="11"){
        $sum = 31+29+31+30+31+30+31+31+30+31+$day;
      }
      else if($month=="12"){
        $sum = 31+29+31+30+31+30+31+31+30+31+30+$day;
      }

      $tmp = 2+($sum%7);

      if($tmp=="0")
        $d="Sunday";
      else if($tmp=="1")
        $d="Monday";
      else if($tmp=="2")
        $d="Tuesday";
      else if($tmp=="3")
        $d="Wednesday";
      else if($tmp=="4")
        $d="Thursday";
      else if($tmp=="5")
        $d="Friday";
      else if($tmp=="6")
        $d="Saturday";
      else{
        if($tmp>=7){
          $tmp=$tmp%7;
              if($tmp=="0")
                $d="Sunday";
              else if($tmp=="1")
                $d="Monday";
              else if($tmp=="2")
                $d="Tuesday";
              else if($tmp=="3")
                $d="Wednesday";
              else if($tmp=="4")
                $d="Thursday";
              else if($tmp=="5")
                $d="Friday";
              else if($tmp=="6")
                $d="Saturday";
        }  

      }
        
      $sql = "SELECT sdl_timeslot FROM schedule WHERE sdl_day='$d' AND d_id='$id2'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      $timeslot = $row["sdl_timeslot"];

      if($timeslot =="10:00-12:00 AM")
      {
          echo "<option>10:00-10:30 $d</option>
                <option>10:30-11:00 $d</option>
                <option>11:00-11:30 $d</option>
                <option>11:30-12:00 $d</option>";
      }
      else if($timeslot =="12:00-02:00 PM")
      {
          echo "<option>12:00-12:30 $d</option>
                <option>12:30-01:00 $d</option>
                <option>01:00-01:30 $d</option>
                <option>01:30-02:00 $d</option>";
      }
      else if($timeslot =="02:00-04:00 PM")
      {
          echo "<option>02:00-02:30 $d</option>
                <option>02:30-03:00 $d</option>
                <option>03:00-03:30 $d</option>
                <option>03:30-04:00 $d</option>";
      }
      else if($timeslot =="04:00-06:00 PM")
      {
          echo "<option>04:00-04:30 $d</option>
                <option>04:30-05:00 $d</option>
                <option>05:00-05:30 $d</option>
                <option>05:30-06:00 $d</option>";
      }
      else if($timeslot =="06:00-08:00 PM")
      {
          echo "<option>06:00-06:30 $d</option>
                <option>06:30-07:00 $d</option>
                <option>07:00-07:30 $d</option>
                <option>07:30-08:00 $d</option>";
      }
      else if($timeslot =="08:00-10:00 PM")
      {
          echo "<option>08:00-08:30 $d</option>
                <option>08:30-09:00 $d</option>
                <option>09:00-09:30 $d</option>
                <option>09:30-10:00 $d</option>";
      }
    
      else{
          echo "<option>Doctor Not Available</option>";
      }
      

?>