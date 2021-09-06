<?php
    
    // Initiates a session

    session_start();
    
    // Barrier code test to ensure captcha was passed
    
    if (!isset ($_SESSION["captchapassed"])) 
    {
      echo "Captcha not passed.";
      header("refresh:3; url=captcha-test-re.php");
      exit();
    }

    // Error reporting code to display any syntax or runtime errors

    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
    ini_set('display_errors' , 1);
    
    // Include myfunctions.php file to call its functions
    
    include("myfunctions.php");
    
    // Connect to MySQL using my database credentials from account.php
    
    include ("account.php");
    
    // Code to establish the database connection

    $db = mysqli_connect($hostname, $username, $password, $project);

    if (mysqli_connect_errno())
    {
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	    exit();
    }
    
    print "Successfully connected to MySQL.<br>";

    mysqli_select_db($db, $project); 

    // Code for reentrant sticky authentication

    if (isset($_GET["ucid"]) && isset($_GET["password"]))
    {
      $gooddata = true;
  
      $ucid = safe("ucid");
      $password = safe("password");
      
      // if $gooddata is false, this means the ucid is invalid
    
      if (!$gooddata)
      {
        echo "<br><br>Invalid input.<br>";
      }
      
      /* Call authenticate function and redirect to pin1.php if
      credentials are correct. If not, remain on this page. */
      
      if (authenticate($ucid, $password, $db))
      {
        $_SESSION["logged"] = true;
        $_SESSION["ucid"] = $ucid;
        echo "<br>Valid credentials. Redirecting to pin1.php.";
        header("refresh:3; url=pin1.php");
        exit("...");
      }
      else
      {
        echo "<br>Invalid credentials.";
      }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>auth.php Page</title>
  <style>
    form {
      margin: auto;
      width: 400px;
      border: #ccc solid 2px;
      margin-top: 100px;
      padding: 15px;
    }
  </style>
</head>
<body>
  <form action="auth.php">
    Enter UCID:
    <br>
    <input type="text" name="ucid" id="ucid" autocomplete="off">
    <br>
    Enter password:
    <br>
    <input type="text" name="password" id="password" autocomplete="off">
    <br>
    <input type="submit">
  </form>
</body>
</html>