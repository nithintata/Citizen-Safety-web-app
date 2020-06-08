<?php
  session_start();
?>
<head>
<meta charset="utf-8">
<meta name="description" content="This is a login system.">
<meta name=viewport content="width=device-width, initial-scale=1">
<title>Main Page</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
   *{box-sizing: border-box;}
   body{font-family: verdana;}
   img{width: 200px;height: 70px;}
   nav{}
   nav ul {list-style-type: none;}
   nav ul li a{text-decoration: none;color: black;padding: 10px;float: left;margin: 10px 20px 10px 0px;}
   nav ul li a:hover{background-color: #1b3f51;color: white;}
   nav ul li img{float: left;}
   .navtop{margin-left: 250px;}
   #action{padding-top: 15px;margin-left: 50%;}
   input[type=text],input[type=password],input[type=number],input[type=email]{padding: 5px;font-size: 16px;}
   nav:after{content: "";clear: both;display: table;}
   form button{font-size: 16px;padding: 5px 10px;background-color: #1b3f51;color: white;
               cursor: pointer;}
   form button a{text-decoration: none;color: white;}
   button:hover{opacity: 0.7;}
   #lout{float: right;margin-right: 20px;margin-top: 10px;}
   h5{color: red;}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--Geo Location Tracking -->
<script>
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
}

function showPosition(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $.ajax({
        type:'POST',
        url:'location.php',
        data:'latitude='+latitude+'&longitude='+longitude,
    });
}
</script>

</head>

<header>
<nav>
  <ul>
    <li><img src="./logo1.png" alt="logo"></li>
    <div class="navtop">
    <li><a href="./">Home</a></li>
    <li><a href="admin/admin-login.php">Admin</a></li>
    <li><a href="#">Contact</a></li></div>
  </ul>
  <div id="action">
    <?php
    if (isset($_SESSION['userUid'])) {
      echo '<form id="lout" action="includes/logout.inc.php" method="post">
        <button type="submit" id="los" name="logout-submit">Logout</button>
      </form>';

    }
    else {
      /*echo '<form action="includes/login.inc.php" method="post">
        <input type="text" name="mailuid" placeholder="username" required autofocus>
        <input type="password" name="pwd" placeholder="password" required>
        <button type="submit" name="login-submit">Login</button>
        <button><a href="signup.php">Sign Up</a></button>
      </form>';
      if (isset($_GET['error']) == "wrongpassword") {
        echo "<h5>Wrong Username or Password Combination!</h5>";
      }*/
      echo '<a href = "../login/signup.php">Sign Up</a><a href = "../login/login.php"> Login</a>';
    }

     ?>

  </div>
</nav>
</header>
