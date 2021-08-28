<?php

require_once("initialize.php");
  

function del_admin_funny($admin) {
    global $db;

    $sql = "DELETE from users ";
    $sql .= "WHERE id='" . db_escape($db, $admin). "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  $errors ="";
  $id= $_POST['id'] ?? "";
  if($id == '') { $errors= 'Error No id Data!'; }

  if(!empty($errors)) {
    if(is_ajax_request()) {
      $result_array = array('errors' => $errors);
      echo json_encode($result_array);
    }
    exit;
  }

  if(is_ajax_request() && empty($errors)) {
       if(del_admin_funny($id)){
         echo json_encode(array('deleted' => "Success"));
       }else
       {
           $errors="Error Deleting Data! Please Try again";
        echo json_encode(array('errors' => $errors));
       }
  } 

?>
