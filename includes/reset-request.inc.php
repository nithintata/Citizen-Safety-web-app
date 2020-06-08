<?php
if (isset($_POST['reset-request-submit'])) {

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);
  $url = "localhost/login/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
  $expires = date("u") + 1800;
  require 'dbh.inc.php';
  $userEmail = $_POST['email'];
  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt,  $sql)) {
    echo "There Was an Error";
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO pwdReset(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires
) VALUES(?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  echo "There Was an Error";
  exit();
}
else {
  $hashedToken = password_hash($token, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
  mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

date_default_timezone_set('Asia/Kolkata');
             require_once("PHPMailer_5.2.4/class.phpmailer.php");


             $Mail = new PHPMailer();
               $Mail->IsSMTP(); // Use SMTP
               $Mail->Host        = "smtp.gmail.com"; // Sets SMTP server
               $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
               $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
               $Mail->SMTPSecure  = "ssl"; //Secure conection
               $Mail->Port        = 465; // set the SMTP port
               $Mail->Username    = 'destructerdavid@gmail.com'; // SMTP account username
               $Mail->Password    = $_ENV["SMTP_PASSWORD"]; // SMTP account password
               $Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
               $Mail->CharSet     = 'UTF-8';
               $Mail->Encoding    = '8bit';
               $Mail->Subject     = 'Reset Your Password for Legal Suvidha';
               $Mail->ContentType = 'text/html; charset=utf-8\r\n';
               $Mail->Username        = 'destructerdavid@gmail.com';
               $Mail->FromName    = 'Nithin Testing';
               $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line

               $Mail->AddAddress($userEmail); // To:
               $Mail->isHTML( TRUE );
               $Mail->Body='<p>we received a password reset request.The link to reset your password is</p>';
               $Mail->Body.='<p>Here is your Password reset link : <br>';
               $Mail->Body.='<a href="' . $url . '">' . $url . '</a></p>';
               echo 'hi';
               ob_start();
               if($Mail->Send()) {
                ob_get_clean();
                header("Location: ../reset-password.php?reset=success");
              }
               else {echo "<script>alert('message could not be sent');</script>";}
             $Mail->SmtpClose();

}
else {
  header("Location: ../index.php");
  exit();
}
