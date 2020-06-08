<?php
require 'vendor/autoload.php';
use Twilio\Rest\Client;

require '../includes/dbh.inc.php';

$account_sid = $_ENV["ACCOUNT_SID"];
$auth_token = $_ENV["AUTH_TOKEN"];

if (isset($_POST['help'])) {
  $user = $_POST['userUid'];
  $lat = $_POST['lat'];
  $long = $_POST['long'];
  $sql = "SELECT * FROM contacts WHERE userUid LIKE '$user'";
  $result = mysqli_query($conn, $sql);
  if ($row = mysqli_fetch_assoc($result)) {
    $con1 = $row['con1'];
    $con2 = $row['con2'];
    $con3 = $row['con3'];
    $con4 = $row['con4'];
    $twilio_number = "+12528882832";
    $body = "Help Me! My position:https://maps.google.com/maps?f=q&t=m&q=".$lat.",".$long;
    $arr = array($con1, $con2, $con3, $con4);
    for ($i=0; $i < 4; $i++) {
      if ($arr[$i] != '') {
        $twilio = new Client($account_sid, $auth_token);
        $msg = $twilio->messages->create($arr[$i], // to
                                   array(
                                       "body" => $body,
                                       "from" => $twilio_number
                                   )
                          );
      }
    }





if($msg->sid){
      header("Location: ../index.php?q=success");
      exit();
    }


  }

  else {
    header("Location: ../index.php?q=nocontacts");
    exit();
  }
}

else {
  header("Location: ../index.php");
  exit();
}
