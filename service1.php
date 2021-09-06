<?php

  // Initiates a session
  
  session_start();
  
  // If pin isn't created yet, redirect back to pin1.php
  
  if (!isset ($_SESSION["pinpass"]))
  {
    echo "Pin needed.";
    header("refresh:3; url=pin1.php");
    exit();
  }
  
  // Include myfunctions.php file to call its functions
    
  include("myfunctions.php");

?>

<style>
  form {
    border: #ccc solid 2px;
    margin: auto;
    width: 50%;
    margin-top: 100px;
    padding: 15px;
  }
    
  #account,
  #amount {
    display: none;
  }
</style>
<form action="service2.php">
  <select name="choice" id="choice">
    <option value="LT">List Transactions</option>
    <option value="LA">List Accounts</option>
    <option value="C">Clear</option>
    <option value="D">Deposit</option>
    <option value="W">Withdraw</option>
  </select>
  <br>    
  <div id="account">
    Enter account: 
    <br>
    <input type="text" name="account" autocomplete="off">
  </div>
  <div id="amount">
    Enter amount: 
    <br>
    <input type="text" name="amount" autocomplete="off">
  </div>
  <input type="submit">
</form>
<script>
  var ptrMenu = document.getElementById("choice");
  ptrMenu.addEventListener("change", choose);
    
  var ptrAccount = document.getElementById("account");
  var ptrAmount = document.getElementById("amount");
    
  function choose()
  {
    if (this.value == "LT") 
    {
      ptrAccount.style.display = "none";
      ptrAmount.style.display = "none";
    }      
    if (this.value == "LA") 
    {
      ptrAccount.style.display = "none";
      ptrAmount.style.display = "none";
    }
    if (this.value == "C") 
    {
      ptrAccount.style.display = "block";
      ptrAmount.style.display = "none";
    }
    if (this.value == "D")
    {
      ptrAccount.style.display = "block";
      ptrAmount.style.display = "block";
    }  
    if (this.value == "W")
    {
      ptrAccount.style.display = "block";
      ptrAmount.style.display = "block";
    }
  }
</script>
