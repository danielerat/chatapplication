<?php
require_once("initialize.php");
$errors=[];
$admin['first_name'] = $_POST['firstname'] ?? '';
$admin['last_name'] = $_POST['lastname'] ?? '';
$admin['username'] = $_POST['username'] ?? '';
$admin['email'] = $_POST['email'] ?? '';
$admin['password'] = $_POST['password'] ?? '';
$admin['confirm_password'] = $_POST['confirm_password'] ?? '';
$admin['avatar'] ="update";
$admin['id']=$_SESSION["user_id"];
//Check if really there was a file uploaded otherwise it will just get a random name and assign it to the user profile
   if((has_presence($_FILES['user_avatar']['name']) && has_presence($_FILES['user_avatar']['type'])) && $_FILES['user_avatar']['error']!=4){
     $result=upload_image("../");
     if($result["uploadStatus"]==true && isset($result["filename"])){
         $admin['avatar']=$result["filename"];
     }
     elseif($result["uploadStatus"]==false){
         $err = $result;
         foreach ($err as $error){
             $errors[]=$im;
         }
     }
 }

if(is_blank($admin['first_name'])) { $errors[] = "First Name cannot be blank.";}
if(is_blank($admin['last_name'])) { $errors[] = "Last Name cannot be blank.";}
if(is_blank($admin['username'])) { $errors[] = "Username cannot be blank.";}
if(is_blank($admin['email'])) { $errors[] = "Email cannot be blank.";}

if(is_ajax_request()) {
    
    if(!empty($errors)) {
        $result_array = array('Errors' => $errors);
        echo json_encode($result_array);
        exit;
    }
    // Validations
    // if there were no errors, try to login
    if(empty($errors)){
        $login_failure_msg="User Update Error";

        $update_user = update_user($admin);
      
        if($update_user === true) {
            echo "true";
            exit;
        } else {
            $errors[] = $login_failure_msg;
            $_SESSION['authErrors'] = $errors;
            $result_array = array('Errors' => $errors);
             echo json_encode($result_array);
        }
     }
}