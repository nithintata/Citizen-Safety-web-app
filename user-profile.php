<?php
  require 'includes/dbh.inc.php';
  $uname = $_SESSION['userUid'];
  if ($_SESSION['userNum'] == '') {
  $sql = "SELECT * FROM profiles WHERE userUid like '$uname'";
  $result = mysqli_query($conn, $sql);
  if ($row = mysqli_fetch_assoc($result)) {

      $_SESSION['userName'] = $row['userName'];
      $_SESSION['userNum'] = $row['userNum'];
      $_SESSION['userDOB'] = $row['userDOB'];
      $_SESSION['occupation'] = $row['occupation'];
      $_SESSION['gender'] = $row['gender'];
      $_SESSION['aadhaar'] = $row['aadhaar'];
      $_SESSION['address'] = $row['address'];
  }
}

  $sql = "SELECT * FROM contacts WHERE userUid like '$uname'";
  $result = mysqli_query($conn, $sql);
  $c1 = ''; $c2 = ''; $c3 = ''; $c4 = '';
  if ($row = mysqli_fetch_assoc($result)) {
    $c1 = $row['con1'];
    $c2 = $row['con2'];
    $c3 = $row['con3'];
    $c4 = $row['con4'];
  }
?>
<style>
     * {box-sizing: border-box}
     main{background-color: #ccc;height: 1000px;}
    .main-content{width: 60%;margin: auto;
                 background-color: white;padding: 20px;padding-top: 10px;}
    .main-content::after{content: "";clear: both;display: table;}
    .col-one {float: left;border: none;background-color: #f1f1f1;width: 20%;height: auto;position: sticky;top: 0;}
    .col-one button {display: block;background-color: white;color: black;padding: 18px 16px;width: 100%;border: 1px solid black;
                  outline: none;text-align: left;cursor: pointer;transition: 0.3s;font-size: 20px;}
    .col-one button:hover {background-color: #1b3f51;opacity: 0.6;color: white;}
    .col-one button.active {background-color: #1b3f51;color: white;}
    .col-two {float: left;padding: 0px 20px;width: 80%;border-left: none;height: 1000px;}
    .submit-button {background-color: #1b3f51; padding : 10px; border-radius: 5px; color: white;
    cursor: pointer; border: none; font-size: 15px;margin: 5px;}
    .icon_home {width: 130px; height: 140px; margin: auto;}
    #user-contacts input[type = 'text']{border: none;}
    #user-contacts input[type = 'text']:hover {border: 1px solid blue;}
    .notification-box{border: 1px solid black; box-shadow: 5px 10px #1b3f51;animation-name: slide;
      animation-duration: 2s;padding: 15px;margin-left: 100px;margin-bottom: 25px;background-color: #fff;}
      .notification-box:hover{z-index: 3;transform: scale(1.07); cursor: pointer;}

   @keyframes slide {
  0%   {margin-top: 100px;}

  100% {margin-top: 0px;}
}
</style>

<br><br>
  <!-- Check if the user is completed his profile or not  -->

<!--  <div class="col-one">
    <button class="tablinks" onclick="openId(event, 'Profile')" id="defaultOpen"><i class="fa fa-user-o"></i> Profile</button>
    <button class="tablinks" onclick="openId(event, 'Dashboard')" ><i class="fa fa-address-card-o"></i> Dashboard</button>
    <button class="tablinks" onclick="openId(event, 'notifications')" ><i class="fa fa-address-card-o"></i> Notifications</button>
    <button class="tablinks" onclick="document.getElementById('los').click();"><i class="fa fa-sign-out"></i> Logout</button>
  </div>-->

  <div id="Profile" class="col-two">
    <div style="color: #444;font-size:36px;"><b>Profile</b></div>
    <p style="color: #444;font-size:28px;"><b>Account Information</b></p>
    <!-- Reminder for profile completion-->
    <?php
      if ($_SESSION['userNum'] == '') {
        echo '<p style = "color:red;">You must complete your profile to address a issue</p>
             <p><a href="complete-profile.php">Complete Your Profile</a></p>';
      }
   ?>

    <p><b>Username :</b> <?php  echo $_SESSION['userUid'];    ?></p>
    <p><b>E-mail : </b><?php  echo $_SESSION['userEmail'];    ?></p>
    <p><b>Full Name : </b><?php  echo $_SESSION['userName'];    ?></p>
    <p><b>Mobile Number : </b><?php  echo $_SESSION['userNum'];    ?></p>
    <p><b>Gender : </b><?php  echo $_SESSION['gender'];    ?></p>
    <p><b>D.O.B : </b><?php  echo $_SESSION['userDOB'];    ?></p>
    <p><b>Occupation : </b><?php  echo $_SESSION['occupation'];    ?></p>
    <p><b>Aadhaar : </b><?php  echo $_SESSION['aadhaar'];    ?></p>
    <p><b>Address : </b><?php  echo $_SESSION['address'];    ?></p>

    <!-- Retreive contacts for SOS messaging -->
   <p style="color: #444;font-size:28px;"><b>Emergency Contacts</b></p>
    <form id = "user-contacts" action="includes/sos.inc.php" method="post">
      <label><b> Contact1 :</b> </label>
      <input type="text" name="con1" required value="<?php echo $c1; ?>"><br>
      <label><b> Contact2 :</b> </label>
      <input type="text" name="con2" value="<?php echo $c2; ?>"><br>
      <label><b> Contact3 : </b></label>
      <input type="text" name="con3" value="<?php echo $c3; ?>"><br>
      <label><b> Contact4 :</b> </label>
      <input type="text" name="con4" value="<?php echo $c4; ?>"><br>
      <input type = "hidden" value="<?php echo $_SESSION['userUid']; ?>" name = "userUid">
      <input type="submit" name="contacts" class = "submit-button" value="Update">
    </form>

  </div>

  <div id="Dashboard" class="col-two">
    <h3>Dashboard</h3>
    <p>Here goes dashboard</p>
    <p><b>Your Position :</b></p>
    <p>Latitude : <?php  echo $_SESSION['lat'];    ?></p>
    <p>Longitude : <?php  echo $_SESSION['long'];    ?></p>
    <p><b>Report a Problem Here</b></p>
    <?php
      if ($_SESSION['userNum']== '') {
        echo '<p style = "color:red;">You must complete your profile to address a issue</p>
             <p><a href="complete-profile.php">Complete Your Profile</a></p>';
      }
   ?>

    <div class="img-set" style="width:80%; margin:auto;">
    <p><a href="report.php"><img class="icon_home" src="https://cdn4.iconfinder.com/data/icons/business-glyph-6/614/1038_-_Online_Protection-512.png" alt="Women Safety" style="float: left;"></a></p>
    <p style="float: right;margin-right:90px;"><a href="violation-report.php"><img class="icon_home" src="https://cdn1.iconfinder.com/data/icons/media-1-2/32/Notes-Report-File-512.png" alt="Report a Violation" ></a></p>
    </div>
    <form action="sms/sms.php" method="post">
      <input type="hidden" name = "userUid" value="<?php echo $_SESSION['userUid']; ?>">
      <input type="hidden" name = "lat" value="<?php echo $_SESSION['lat']; ?>">
      <input type="hidden" name = "long" value="<?php echo $_SESSION['long']; ?>">

      <input type="submit" style="padding-left: : 150px; border: none; background-image:url('sos.jpg');background-size: 130px 150px;" class="icon_home" name = "help" value="">
    </form>





  </div>

  <div id="notifications" class="col-two">
    <?php
    $query = "SELECT * FROM notify ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $tle = $row['title']; $place = $row['place']; $des = $row['description'];
        $cat = $row['category'];
        echo '
        <div class="notification-box">
        <p style="text-align: right;">'.date("Y/m/d").'</p>
        <p>Title: '.$tle.'</p>
        <p>Place: '.$place.'</p>
        <p>Category: '.$cat.'</p>
        <p>Description: '.$des.'</p>
        </div>

        ';
      }

     ?>

  </div>

  <div id = "timer" class="col-two">
      <?php require 'timer.php'; ?>
  </div>

  <div id="usage-tips" class="col-two">
<p><b>SOS</b></p>
<p>With our SOS option, you can alert all your emergency contacts, and the police with one tap. Those contacts would receive your customised text along with your
  instantaneous location. Don’t play around with this button as repeated unwanted triggering can be penalised.</p>
<p><b>Report</b></p>
<p>Be a responsible citizen and report any crime or violation happenings around you. You can also credit any defence department through this.</p>
<p><b>Travel Safe</b></p>
<p>If you have any disturbances in your travel, you can report your journey details to the nearest control room and the corresponding team can take action.</p>
<p><b>Notifications</b></p>
<p>Real time updates and tips from the city’s police department to keep you safe and feel at home</p>

<p><b>Help Me Timer</b></p>
<p>You can set for an Emergency help message to be triggered after specific time duration. Just set the time in the timer and tap on start timer. You can reset the timer as per your requirement.</p>
<p><b>SOS Snooze</b></p>
<p>With SOS Snooze!, you can set the emergency SOS message on snooze. Once you send an
emergency help message, it will be sent again and again at an interval set in Snooze.</p>

<p><b>My Account</b></p>
<p>In my account section, you can view and edit your account details</p>
<p><b>Usage Tips </b></p>
<p>Your complete guide to all the functionalities of our app</p>
<p><b>Logout</b></p>
<p>Logout from your Account. </p>
<p><b>Contact Us</b></p>
<p>Contact our helpline to get support and answers to your queries</p>

  </div>

<script>

function openId(evt, Name) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("col-two");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace("active", "");
  }
  document.getElementById(Name).style.display = "block";
  evt.currentTarget.className += " active";
}
  document.getElementById("defaultOpen").click();
</script>


<?php

?>
