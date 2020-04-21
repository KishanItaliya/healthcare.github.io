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
    $tslot = "SELECT * FROM timeslot WHERE time_id='$id2'";
    $result2 = mysqli_query($conn,$tslot);
    $row = mysqli_fetch_assoc($result2);
    
    $monday = $row['Monday'];
    $tuesday = $row['Tuesday'];
    $wednesday = $row['Wednesday'];
    $thursday = $row['Thursday'];
    $friday = $row['Friday'];
    $saturday = $row['Saturday'];
    $sunday = $row['Sunday'];

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
        

      if($d=="Monday")
        $final=$row['Monday'];
      else if($d=="Tuesday")
        $final=$row['Tuesday'];
      else if($d=="Wednesday")
        $final=$row['Wednesday'];
      else if($d=="Thursday")
        $final=$row['Thursday'];
      else if($d=="Friday")
        $final=$row['Friday'];
      else if($d=="Saturday")
        $final=$row['Saturday'];
      else if($d=="Sunday")
        $final=$row['Sunday'];
      else 
        $final="";

        echo "<option>$final  $d</option>";

?>