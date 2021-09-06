<?php
  
  session_start();
  
  if (isset($_GET["guess"]))
  {
    $correct = $_SESSION["captcha"];
  
    $guess = $_GET["guess"];
  
    if ($guess == $correct)
    {
      $_SESSION["captchapassed"] = true;
      echo "Correct captcha. Redirecting...";
      header("refresh:3, url=auth.php");
      exit();
    }
  }
  
?>

<img src="captcha.php">

<form action="captcha-test-re.php">
  <br>
  Please enter the captcha:
  <br>
  <input type=text name="guess" autocomplete="off">
  <input type=submit>
</form>
 