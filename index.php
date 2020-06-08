<?php
 require 'header.php';
?>
<style>
   main{background-color: #ccc;height: auto;}
   .main-content{width: 50%;margin: auto;
                 background-color: white;padding: 20px;padding-top: 10px;}
</style>
<style>

  .sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: white;
    overflow-x: hidden;
    transition: 0.5s;
    padding-bottom: 60px;
    }

    .sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
    text-align:center;
    }

    .sidebar a:hover {
    color: #f1f1f1;
    }

    .sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 40px;
    }

    .openbtn {
    font-size: 20px;
    cursor: pointer;
    background-color: #1b3f51;
    color: white;
    padding: 10px 15px;
    border: none;
    text-decoration: none;
    }

    .openbtn:hover {
    background-color: #444;
    }

    #menu {

    padding: 16px;
    text-align:left
    }

    #main_btn {
        width : 40%;
        margin: auto;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
    .sidebar {padding-top: 15px;}
    .sidebar a {font-size: 18px;}
    }

    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<main>
<br><br>
<div class="main-content">
  <div class='w3-containertop'>

      <div id="menu">
         <?php  if (isset($_SESSION['userUid'])) {
           ?><button class="openbtn" onclick="openNav()">☰ Menu</button>
         <?php } ?>


      </div>

  </div>
  <div class="col-one" >
  <div id="mySidebar" class="sidebar">
    <img src="logo1.png">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <br><br>
      <button class="tablinks">Change Language</button>
      <button class="tablinks" onclick="openId(event, 'Dashboard')" id="defaultOpen">Dashboard</button>
      <button class="tablinks" onclick="openId(event, 'notifications')">Notifications</button>
      <button class="tablinks" onclick="openId(event, 'timer')" >Help ME Timer</button>
      <button class="tablinks">SOS Snooze<label style="float:right;" class="switch"><input type="checkbox">
       <span class="slider round"></span></label></button>
      <button class="tablinks" onclick="openId(event, 'Profile')">My Account</button>
      <button class="tablinks" onclick="openId(event, 'usage-tips')">Usage Tips</button>
      <button class="tablinks" onclick="document.getElementById('los').click();">Logout</button>
      <button class="tablinks" >Contact Us</button>
  </div>
</div>
  <?php
     if (isset($_SESSION['userUid'])) {

       require 'user-profile.php';
     }
     else {
       echo '<p style="text-align: center;font-size: 24px;">You are logged Out!</p>';
     }   ?>
</div>
</main>
<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("menu").style.display = "none";
    }
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("menu").style.display = 'block';
        document.getElementById("menu").style.marginLeft = "0";
    }
</script>
<?php
 require 'footer.php';
?>
