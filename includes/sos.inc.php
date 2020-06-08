<?php
require 'dbh.inc.php';
if (isset($_POST['contacts'])) {
  $user = $_POST['userUid'];
  $con1 = $_POST['con1'];
  $con2 = $_POST['con2'];
  $con3 = $_POST['con3'];
  $con4 = $_POST['con4'];
  $sql = "SELECT * FROM contacts WHERE userUid LIKE '$user'";
  $check = mysqli_query($conn, $sql);
  if (mysqli_num_rows($check) > 0) {
    $sql = "UPDATE contacts SET con1='$con1', con2='$con2', con3='$con3', con4='$con4' WHERE userUid LIKE '$user'";
    if (mysqli_query($conn, $sql)) {
      header("Location: ../index.php?q=updated");
      exit();
    }
  }
  
  $sql = "INSERT INTO contacts(userUid, con1, con2, con3, con4)
          VALUES('$user', '$con1', '$con2', '$con3', '$con4')";
  $query = mysqli_query($conn, $sql);
  if ($query) {
    header("Location: ../index.php?q=added");
    exit();
  }
}

 ?>
