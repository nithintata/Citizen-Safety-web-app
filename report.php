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
      $uid = $_SESSION["userUid"]; $bor = $_POST["boarding"]; $des = $_POST["destination"];
      $num = $_POST["vehicleNum"]; $veh = $_POST["vehtype"]; $latlng = $_POST["latlng"];
      $query = "INSERT INTO report(name, userUid, boarding, destination, vehicleNum, vehtype, latlng)
                VALUES ('$file', '$uid', '$bor', '$des', '$num', '$veh','$latlng')";
      if(mysqli_query($conn, $query))
      {
           echo '<script>alert("Image Inserted into Database")</script>';
      }
 }
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Problem Reporting</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:500px;">
                <h3 align="center">Report a Problem</h3>
                <br />
                <form method="post" enctype="multipart/form-data">
                     <label>Upload Image </label>
                     <input type="file" name="image" id="image" />
                     <br />
                     <input type="text" name="boarding" placeholder="Boarding Place" autofocus required><br>
                     <input type="text" name="destination" placeholder="Destination Place" required><br>
                     <input type="text" name="vehicleNum" placeholder="Enter Vehicle number" required><br>
                     <input type="text" name="vehtype" placeholder="Enter vehicle type" required><br>
                     <input type="hidden" id="pos" name="latlng" value="<?php echo $_SESSION['lat'].','.$_SESSION['long']; ?>">
                     <input type="submit" onclick="getLocation();" name="insert" id="insert" value="Report" class="btn btn-info" />
                </form>
                <br />
                <br />
                <table class="table table-bordered">
                     <tr>
                          <th>Image</th>
                     </tr>
                <?php
                $query = "SELECT * FROM report ORDER BY id DESC";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result))
                {
                     echo '
                          <tr>
                               <td>
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'" style = "height: 100px; width:100px" class="img-thumnail" />
                               </td>
                          </tr>
                     ';
                }
                ?>
                </table>
           </div>
      </body>
 </html>
<!------------------------------------->

<!-------------------------------------------->
 <script>
 $(document).ready(function(){
      $('#insert').click(function(){
           var image_name = $('#image').val();
           if(image_name == '')
           {
                alert("Please Select Image");
                return false;
           }
           else
           {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                {
                     alert('Invalid Image File');
                     $('#image').val('');
                     return false;
                }
           }
      });
 });
 </script>
