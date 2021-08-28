<?php
require_once("initialize.php");
$errors = [];

$group["groupid"] = generate_uid();
$group['group_name'] = $_POST['name'] ?? '';
$group["creator"] = $_SESSION['user_id'] ?? '';
$group["members"] = 0;

$members = 1;
if (isset($_POST['checklist'])) {
    $members += (int)(sizeof($_POST['checklist']));
}
if ($members >= 2) {
    $group["members"] = $members;
}

$group['avatar'] = rand(1, 17) . ".svg";
//Check if really there was a file uploaded otherwise it will just get a random name and assign it to the user profile
if ((has_presence($_FILES['user_avatar']['name']) && has_presence($_FILES['user_avatar']['type'])) && $_FILES['user_avatar']['error'] != 4) {
    $result = upload_image("../");
    if ($result["uploadStatus"] == true && isset($result["filename"])) {
        $group['avatar'] = $result["filename"];
    } elseif ($result["uploadStatus"] == false) {
        $err = $result['errors'];
        foreach ($err as $error) {
            $errors[] = $err;
        }
    }
}

if (is_blank($group['group_name'])) {
    $errors[] = "Group Must Have A name";
}
if (is_blank($group['creator'])) {
    $errors[] = "There Should Be at least one Admin";
}
if (is_blank($group['members']) || $group['members'] < 2) {
    $errors[] = "Group Members Should be More than one";
}

if (is_ajax_request()) {

    if (!empty($errors)) {
        $result_array = array('Errors' => $errors);
        echo json_encode($result_array);
        exit;
    }
    // Validations
    // if there were no errors, try to login
    if (empty($errors)) {
        $error_creating_group = "Error Creating the group {$group['group_name']}";
        $update_user = create_group($group);
        if ($update_user === true) {

            $addmembers = create_group_members($group["groupid"], $_POST['checklist']);
            if ($addmembers === true) {
                echo "true";
                exit;
            }
        } else {
            $errors[] = $error_creating_group;
            $result_array = array('Errors' => $errors);
            echo json_encode($result_array);
        }
    }
}
