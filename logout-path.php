<?php

  include("config.php");
  
  session_set_cookie_params(0, "$path", "web.njit.edu");
  session_start();
  
  if (!isset ($_SESSION["logged"])) 
  {
    echo "Please login first.";
    header("refresh:3; url=auth.php");
    exit();
  }
  
  $sid = session_id();
  echo "<br>Session on $path started with session id: $sid.";
  
  $_SESSION = array();
  session_destroy();
  setcookie("PHPSESSID", "", time()-3600, $path, "", 0, 0);
  
  echo "<br><br>Session terminated.";
  echo "<br><br>Log out successful. See you next time! (*^-^)/";

?>