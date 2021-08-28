<?php

require_once("initialize.php");



$errors = "";
$id = $_POST['msg_id'] ?? "";
if ($id == '') {
    $errors = 'Error No id Data!';
}

if (!empty($errors)) {
    if (is_ajax_request()) {
        $result_array = array('errors' => $errors);
        echo json_encode($result_array);
    }
    exit;
}

if (is_ajax_request() && empty($errors)) {
    if (delete_message($id)) {
        echo json_encode(array('deleted' => "Success"));
    } else {
        $errors = "Error Deleting Data! Please Try again";
        echo json_encode(array('errors' => $errors));
    }
}
