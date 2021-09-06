<?php

  // Initiates a session
  
  session_start();
  
  // Barrier code test for verified pin
  
  if (!isset ($_SESSION["pinpass"]))
  {
    echo "Pin needed.";
    header("refresh:3; url=pin1.php");
    exit();
  }
  
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
  
  // Get value of ucid, choice, account, and amount

  $ucid = $_SESSION["ucid"];
  $choice = safe("choice");
  
  /* Switch statement to carry out service chosen by the user,
  correct function called based on user's choice */
  
  switch($choice)
  {
    case "LT":
      echo "<br><br>Listing transactions..."; list_transactions($ucid, $db);
      break;
    case "LA":
      echo "<br><br>Listing accounts..."; list_accounts($ucid, $db);
      break;
    case "C":
      $account = safe("account");
      echo "<br><br>Clearing account..."; clear($ucid, $account, $db);
      break;
    case "D":
      $goodamount = true;
      $account = safe("account");
      $amount = safeAmount("amount");
      if (!$goodamount)
      {
        echo "<br><br>Invalid amount. Try again.";
        header("refresh:3; url=service1.php");
        exit("...");
      }
      else
      {
        echo "<br><br>Depositing amount..."; perform_transactions($ucid, $account, $amount, $db);
      }
      break;
    case "W":
      $goodamount = true;
      $account = safe("account");
      $amount = safeAmount("amount");
      if (!$goodamount)
      {
        echo "<br><br>Invalid amount. Try again.";
        header("refresh:3; url=service1.php");
        exit("...");
      }
      else
      {
        $amount = -$amount;
        echo "<br><br>Withdrawing amount... $amount"; perform_transactions($ucid, $account, $amount, $db);
      }
      break;
    default:
      echo "<br>Not available.";
  }

?>

<br><a href="service1.php">Back to service1.php</a>
<br><a href="logout-path.php">Logout</a>