<?php

require_once("initialize.php");



$errors = "";

$id = $_POST['them'] ?? "";

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
    if (update_theme($id, $_SESSION['username'])) {
        echo json_encode(array('Update' => "Success"));
    } else {
        $errors = "Error Changing Theme";
        echo json_encode(array('errors' => $errors));
    }
}
