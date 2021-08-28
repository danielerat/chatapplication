<?php

define("DB_SERVER", "localhost");
define("DB_USER", "danielerat");
define("DB_PASS", "dbpassword");
define("DB_NAME", "chatapplication");

//Creating and Confirming Database Connection
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    //Confirm Database Connection
    if(mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
    // Return True The Connection If it Succeeded
    return $connection;
  }


  function db_disconnect($connection) {
  //If There is A Connection Then Close it
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }

  function db_escape($connection, $string) {
    //Escape data To be Inputted In A Database
    return mysqli_real_escape_string($connection, $string);
  }

// Check if the Query Did Execute Correctly
  function confirm_result_set($result_set) {
   //If there was no Result Set Then
    if (!$result_set) {
    	exit("Database query failed.");
    }
  }

?>
