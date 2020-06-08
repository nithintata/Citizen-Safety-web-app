<?php
$servername = 'localhost';
$dBUsername = "root";
$dBPassword = "";
$dBName = "login";

$conn = mysqli_connect($servername, $dBUsername,$dBPassword,$dBName);

if (!$conn) {
  // code...
  die("Connection Failed : ".mysqli_connect_error());
}
