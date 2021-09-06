<?php

  /* pin1.php makes, emails, sends, stores, and submits
  a random pin; a personal identity test */
  
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

  $ucid = $_SESSION["ucid"];
  echo "Hey there $ucid!";
  
  // Creates random 4 digit pin and stores it

  $pin = mt_rand(1000, 9999);
  $_SESSION["pin"] = $pin;
  
  // Emails pin to my email
  
  $to = "svt25@njit.edu";
  $message = "Pin is $pin";
  $subject = "PIN";
  mail($to, $message, $subject);
  
  // Displays pin in browser

  echo "<br>This is your pin: $pin";

?>

<style>
  form {
    margin: auto;
    width: 50%;
    border: #ccc solid 2px;
    margin-top: 100px;
    padding: 15px;
  }
</style>
<form action="pin2.php">
  Enter PIN:
  <br>
  <input type=text name="pin" autocomplete="off">
  <br>
  <input type=submit>
</form>
