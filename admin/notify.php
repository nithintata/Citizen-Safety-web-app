<?php

require '../includes/dbh.inc.php';

if (isset($_POST['notify'])) {
  $a = $_POST['title']; $b = $_POST['cat']; $c = $_POST['place']; $d=$_POST['details'];
  $sql= "INSERT INTO notify(title, category, place, description)
         VALUES('$a', '$b', '$c', '$d')";

  $query = mysqli_query($conn, $sql);

  if ($query) {
     echo "<script>alert('Notified Sucessfully')</script>";
  }
}



 ?>

<form action="index.php" method="post">
  <label>Title</label><br>
  <input type="text" name = "title" autofocus required><br>
  <label>category</label><br>
  <input type="text" name = "cat" autofocus required><br>
  <label>Place</label><br>
  <input type="text" name = "place" autofocus required><br>
  <label>Description</label><br>
  <textarea name="details" rows="3" cols="50"></textarea><br>
  <input type="submit" name="notify" value="Notify">
</form>
