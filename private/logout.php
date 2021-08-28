<pre>
<?php
require_once("initialize.php");
print_r($_SESSION);

$logout= array("online_status"=>"false", "last_login"=>convert_to_time(time()));
echo update_online_status($logout);

unset($_SESSION['username']);

session_destroy(); //remove All sessions
// or you could use
// $_SESSION['username'] = NULL;

//Send Back to login after logout
redirect_to('../index.php');
?></pre>
