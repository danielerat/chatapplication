<?php
require("private/initialize.php");

$usr = find_user_by_username($_GET['username']);
$da = $usr['username'] ?? "fuck";
print_r($da);
