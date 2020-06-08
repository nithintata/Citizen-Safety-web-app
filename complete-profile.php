<?php
 require 'header.php';
 if(isset($_SESSION['userUid'])){?>
<head>
<style>
main{background-color: #ccc;height: 1000px;padding-top: 50px;}
.form-content{width: 40%;margin: auto;font-size: 20px;
              background-color: white;padding: 30px 20px;}
 h3{text-align: center;font-weight: bold;}
 #signup{margin-left: 40px;}
 #signup input[type=text],#signup input[type=password],#signup input[type=email]{margin: 10px 0px;width: 60%;}
 #signup input[type=date],#signup input[type=number]{margin: 10px 0px;width: 40%;height: 30px; font-size: 15px;}
 #action{padding-top: 15px;margin-left: 50%;}
 h5{color: red;text-align: center;font-weight: bold;font-size: 20px;}
 #success{color: green;font-weight: bold;}
 #signup a{margin-left: 40px;font-size: 16px;text-decoration: none;}
 #signup #s{margin-left: 120px;}
 label{padding:5px 0px;}
 form button{font-size: 16px;padding: 5px 10px;background-color: #1b3f51;color: white;
             cursor: pointer;margin-top: 15px;}
 form a{text-decoration: none;color: rgb(85,26,139);}
 form a:hover{color: red;}
 button:hover{opacity: 0.7;}
 span{color:red;}
 @media(max-width:1000px){
   .form-content{width: 100%;}
   main{height: auto;}
   #signup{margin: 0px;}
   #signup input[type=text],#signup input[type=password],#signup input[type=email]{margin: 0px;width: 80%;padding: 0px 5px;}
 }

</style>
</head>

<main>
  <br><br>
  <div class="form-content">
  <h3>Complete Your Profile</h3><br>
  <?php

  if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyfields") {
      echo "<br><h5>! Fill in all the fields</h5>";
    }
  }
  elseif (isset($_GET['update'])) {
    if ($_GET["update"] == "success") {
      echo '<h5 id="success">Profile updated Sucessfully !</h5>';
      header("Location: ./index.php");
      exit();
    }
  }


  ?>
  <form id="signup" action="includes/profile.inc.php" method="post">
    <label style="padding:10px 0px;">Full Name <span> *</span> :</label><br>
    <input type="text" name="userName" placeholder="Enter Your Full Name" autofocus required><br>
    <label>Mobile Number<span> *</span> :</label><br>
    <input type="number" name="userNum" placeholder="Enter your mobile number" required><br>
    <label>Date of Birth<span> *</span> :</label><br>
    <input type="date" name="userDOB" placeholder="Enter your Birth date" required><br>
    <label>Occupation<span> *</span> :</label><br>
    <input type="text" name="occupation" placeholder="Occupation"><br>
    <label>Gender<span> *</span> :</label><br><br>
    <input type="radio" name="gender" value="male"> Male
    <input type="radio" name="gender" value="female"> Female
    <input type="radio" name="gender" value="prefer not to say"> Prefer not to say<br><br>
    <label>Aadhaar Number<span> *</span> :</label><br>
    <input type="number" name="aadhaar" placeholder="Enter your aadhaar number"><br>
    <label>Permanent Address<span> *</span> :</label><br>
    <textarea type="text" rows = "3" cols = "50" name="address" required></textarea><br>
    <input type="hidden" value="<?php echo $_SESSION['userUid']; ?>" name = "user">
    <button type="submit" name="complete-profile">Complete my Profile</button>

  </form>

</div>
</main>

<?php
  }
    else {
      header("Location: ../login/");
      exit();
    }?>
<?php
 require 'footer.php';
?>
