<?php
if (isset($_POST['complete-profile'])) {
  session_start();
  require 'dbh.inc.php';
  $uid = $_POST['user'];
  $name = $_POST['userName'];
  $num = $_POST['userNum'];
  $dob = $_POST['userDOB'];
  $occu = $_POST['occupation'];
  $gender = $_POST['gender'];
  $aadhaar = $_POST['aadhaar'];
  $address = $_POST['address'];


   $sql = "INSERT INTO profiles(userUid, userName, userNum, userDOB, occupation, gender, aadhaar, address)
            VALUES ('$uid', '$name', '$num', '$dob', '$occu', '$gender', '$aadhaar', '$address')";
   if (mysqli_query($conn, $sql)) {
     $_SESSION['userName'] = $name;
     $_SESSION['userDOB'] = $dob;
     $_SESSION['occupation'] = $occu;
     $_SESSION['gender'] = $gender;
     $_SESSION['aadhaar'] = $aadhaar;
     $_SESSION['address'] = $address;
     header("Location: ../complete-profile.php?update=success");
     exit();
   }

}

else {
  header("Location: ../complete-profile.php?");
  exit();
}
