<?php
  session_start();
  if(!empty($_POST['latitude']) && !empty($_POST['longitude'])) {
    $_SESSION['lat'] = $_POST['latitude'];
    $_SESSION['long'] = $_POST['longitude'];
  }
  
?>
