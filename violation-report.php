<?php
require 'header.php';
require 'includes/dbh.inc.php';
// $connect = mysqli_connect("localhost", "root", "", "testing");
if ($_SESSION['userNum'] == '') {
  header("Location: ./complete-profile.php");
  exit();
}

if(isset($_POST["insert"]))
 {
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $uid = $_SESSION["userUid"]; $type = $_POST["type"]; $cat = $_POST["category"];
      $place = $_POST["place"]; $description = $_POST["description"]; $latlng = $_POST['latlng'];
      $query = "INSERT INTO violation(name, userUid, type, category, place, description, latlng)
                VALUES ('$file', '$uid', '$type', '$cat', '$place', '$description', '$latlng')";
      if(mysqli_query($conn, $query))
      {
           echo '<script>alert("Reported Sucessfully")</script>';
      }
 }
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Violation Reporting</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:500px;">
                <h3 align="center">Report a Violation</h3>
                <br />
                <form method="post" enctype="multipart/form-data">
                     <label>Upload Image </label>
                     <input type="file" name="image" id="image" />
                     <br />
                     <select name="type" >
                        <option value="">Select Violation Type</option>
                        <option value="Traffic Violations">Traffic Violations</option>
                        <option value="Happening Crimes">Happening Crimes</option>
                        <option value="Crime against Woman">Crime against Woman</option>
                        <option value="Violations by police">Violations by police</option>
                        <option value="Suggestions for better policing">Suggestions for better policing</option>
                        <option value="Report GoodWork by Police">Report GoodWork by Police</option>



                     </select><br>

                     <select name="category" >
                        <option value="">Select violation Category</option>
                        <option value="Traffic">Traffic</option>
                        <option value="Crimes">Crimes</option>
                        <option value="Woman">Woman</option>
                     </select><br>

                     <input type="text" name="place" placeholder="Place of incident" required><br>
                     <input type="hidden" name="latlng" value="<?php echo $_SESSION['lat'].','.$_SESSION['long']; ?>">
                     <textarea type="text" rows = "3" cols = "50" name="description" placeholder="Short Description" required></textarea><br>
                     <input type="submit" name="insert" id="insert" value="Report" class="btn btn-info" />
                </form>
                <br />
                <br />

           </div>
      </body>
 </html>
