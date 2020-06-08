<?php


 if (isset($_POST['login-submit'])) {
   if ($_POST['pwd'] == 'nithin210') {
     $_SESSION['admin'] = 'admin';
     header("Location: index.php");
     exit();
   }
   else {
     header("Location: admin-login.php?error=wrongpassword");
     exit();
   }
 }
?>

<head>
<style>
main{background-color: #ccc;height: 1000px;padding-top: 50px;}
.form-content{width: 40%;margin: auto;font-size: 20px;
              background-color: white;padding: 20px;padding-top: 10px;}
 h3{text-align: center;}
 #signup{margin-left: 40px;}
 #signup input[type=text],#signup input[type=password],#signup input[type=email]{margin: 10px 0px;width: 60%;}
 #action{padding-top: 15px;margin-left: 50%;}
 h5{color: red;text-align: center;}
 #success{color: green;}
 #signup a{margin-left: 40px;font-size: 16px;text-decoration: none;}
</style>
<style>
   *{box-sizing: border-box;}
   body{font-family: verdana;}
   #action{padding-top: 15px;margin-left: 50%;}
   input[type=text],input[type=password],input[type=email]{padding: 5px;font-size: 16px;}
   form button{font-size: 16px;padding: 5px 10px;background-color: #1b3f51;color: white;
               cursor: pointer;}
   form button a{text-decoration: none;color: white;}
   button:hover{opacity: 0.7;}
</style>
</head>

<main>
  <br><br>
  <div class="form-content">
  <h3>Admin Log In</h3>
  <?php
  if (isset($_GET["error"])) {

    if ($_GET["error"] == "wrongpassword") {
      echo "<h5>Wrong Password!</h5>";
    }

  }

  ?>
  <form id="signup" action="admin-login.php" method="post">
    <img src="../logo1.png" style="height: 200px;width: 200px;position: absolute;top:170; right:480;">
    <label style="padding:10px 0px;">Username :</label><br>
    <input type="text" name="mailuid" placeholder="Enter a username" value = "admin" required><br>
    <label>password :</label><br>
    <input type="password" name="pwd" placeholder="Enter a password" autofocus required><br>
    <button type="submit" name="login-submit">Submit</button>
  </form>

</div>
</main>
