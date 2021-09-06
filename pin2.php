<?php

  // Initiates a session

  session_start();
  
  /* Barrier code test; makes sure you're logged in
  and authenticated */ 
  
  if (!isset ($_SESSION["logged"]))
  {
    echo "Please login first.";
    header("refresh:3; url=auth.php");
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
  
  // call safe function to sanitize and trim inputted pin
  
  $pin = safe("pin");
  
  // If pin hasn't been created, redirect back to pin1.php
  
  if (!isset ($_SESSION["pin"]))
  {
    header("refresh:3; url=pin1.php");
    exit();
  }
  
  $correct = $_SESSION["pin"];
  $pin = $_GET["pin"];
  
  /* If the randomly generated pin is equal to the inputted
  pin, redirect to service1.php; if not, redirect back to pin1.php*/
  
  if ($correct == $pin) 
  {
    $_SESSION["pinpass"] = true;
    echo "<br><br>Correct pin. Redirecting to service1.php";
    header("refresh:3; url=service1.php");
    exit("...");  
  } 
  else 
  {
    echo "<br><br>Incorrect pin. Redirecting to pin1.php";
    header("refresh:3; url=pin1.php");
    exit("...");
  }
  
?>