<?php
include '../includes/dbh.inc.php';
$id = $_GET['q'];
$sql = "SELECT * FROM violation WHERE id like '$id'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $uid = $row['userUid'];
  $place = $row['place'];
  $type = $row['type'];
  $category = $row['category'];
  $image = $row['name'];
  $description = $row['description'];
  $latlng = $row['latlng'];
}

 $query = "SELECT * FROM profiles WHERE userUid like '$uid'";
 $result = mysqli_query($conn, $query);
 while($row = mysqli_fetch_assoc($result)) {

   $fname = $row['userName'];
   $num = $row['userNum'];
   $dob = $row['userDOB'];
   $occu = $row['occupation'];
   $gender = $row['gender'];
   $aadhaar = $row['aadhaar'];
   $address = $row['address'];

 }

 ?>


<div style="color: #444;font-size:36px; margin-bottom: 30px;text-align: center;"><b>Admin Panel</b></div>
<table style = "width: 60%; margin: auto">
<tr>
<td style = "width : 30%">
<p style="color: #444;font-size:28px;"><b>User Information</b></p>

<p><b>Username :</b> <?php  echo $uid;    ?></p>
<p><b>Full Name : </b><?php  echo $fname;    ?></p>
<p><b>Mobile Number : </b><?php  echo $num;    ?></p>
<p><b>Gender : </b><?php  echo $gender;    ?></p>
<p><b>D.O.B : </b><?php  echo $dob;    ?></p>
<p><b>Occupation : </b><?php  echo $occu;    ?></p>
<p><b>Aadhaar : </b><?php  echo $aadhaar;    ?></p>
<p><b>Address : </b><?php  echo $address;    ?></p>
</td>

<td style = "width : 30%">
<p style="color: #444;font-size:28px;"><b>Report Details</b></p>

<p><b>Type :</b> <?php  echo $type;    ?></p>
<p><b>Place : </b><?php  echo $place;    ?></p>
<p><b>Category : </b><?php  echo $category;    ?></p>
<p><b>Description : </b><?php  echo $description;    ?></p>
<p><b>Position :</b></p>
<a href="https://maps.google.com/maps?f=q&t=m&q=<?php echo $latlng; ?>">Click Me</a>
</td>

<td>
<p style="color: #444;font-size:28px;"><b>Image : </b></p>
<img src="data:image/jpeg;base64,<?php echo base64_encode($image) ?>" style = "height: 300px; width:300px" class="img-thumnail" />
</td>
</tr>
</table>
