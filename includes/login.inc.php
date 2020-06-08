<?php

if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];
  if (empty($mailuid) || empty($password)) {
    header("Location: ../login.php?error=emptyfields");
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false) {
          header("Location: ../login.php?error=wrongpassword");
          exit();
        }
        elseif ($pwdCheck == true) {
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidUsers'];
          $_SESSION['userEmail'] = $row['emailUsers'];
          $_SESSION['userName'] = '';
          $_SESSION['userNum'] = '';
          $_SESSION['userDOB'] = '';
          $_SESSION['occupation'] = '';
          $_SESSION['gender'] = '';
          $_SESSION['aadhaar'] = '';
          $_SESSION['address'] = '';
          header("Location: ../index.php?error=loginsuccess");
          exit();
        }
        else {
          header("Location: ../login.php?error=wrongpassword");
          exit();
        }
      }
      else {
        header("Location: ../login.php?error=nouser");
        exit();
      }

    }
  }

}
else {
  header("Location: ../login.php");
  exit();
}
