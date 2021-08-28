<?php


require_once("private/initialize.php");
header("Content-Type: application/json; charset=UTF-8");

if (is_get_request()) {
    if ($_GET['api_name'] == "get_user") {
        $user_name = $_GET['username'] ?? "";

        if (has_presence($user_name)) {

            if ($_GET['username'] === "--all") {
                $data = api_find_all_users($user_name);
                while ($row = mysqli_fetch_assoc($data)) {
                    $result[] = $row;
                }
                mysqli_free_result($data);
                echo json_encode($result);
            } else if ($_GET['username'] === "--online") {
                $data = api_get_online_users();
                while ($row = mysqli_fetch_assoc($data)) {
                    $result[] = $row;
                }
                mysqli_free_result($data);
                echo json_encode(array("online_users" => $result));
            } else if ($_GET['username'] !== "--all") {
                $data = api_find_user_by_username($user_name);
                if ($data > 1) {
                    // User Found
                    echo json_encode($data);
                } else {
                    // User Not Found
                    $err = api_message("Oupsy", "User Was Not Fount");
                    echo json_encode($err);
                }
            } else {
                $err =  api_message("Failed !", "You Really Need To Check The Documentation !");
                echo json_encode($err);
            }
        } else {
            $err =  api_message("Failed !", "You Really Need To Check The Documentation !");
            echo json_encode($err);
        }
    }
}





// GET GROUPS
if (is_get_request()) {
    if ($_GET['api_name'] == "get_group") {
        $group_id = $_GET['id'] ?? "";

        if (has_presence($group_id)) {

            if ($_GET['id'] === "--all") {
                $data = api_get_all_groups();
                while ($row = mysqli_fetch_assoc($data)) {
                    $result[] = $row;
                }

                echo json_encode($result);
            } else if ($_GET['id'] !== "--all") {
                $data = api_get_group_by_id($group_id);
                if ($data > 1) {
                    $usr = find_group_users($data["groupid"]);
                    while (($row = mysqli_fetch_assoc($usr))) {
                        $us[] = $row['username'];
                    }
                    mysqli_free_result($usr);
                    $data[] = array("user" => $us);


                    echo json_encode($data);
                } else {
                    // User Not Found
                    $err = api_message("Oupsy", "Group Was Not Fount !!!");
                    echo json_encode($err);
                }
            } else {
                $err =  api_message("Failed !", "You Really Need To Check The Documentation !");
                echo json_encode($err);
            }
        } else {
            $err =  api_message("Failed !", "You Really Need To Check The Documentation !");
            echo json_encode($err);
        }
    }
}

// // GET ONLINE USERS
// if (is_get_request()) {
//     if ($_GET['api_name'] == "get_online_usesr") {
//         $group_id = $_GET['id'] ?? "";

//         if (has_presence($group_id)) {

//             if ($_GET['id'] === "--all") {
//                 $data = api_get_all_groups();
//                 while ($row = mysqli_fetch_assoc($data)) {
//                     $result[] = $row;
//                 }

//                 echo json_encode($result);
//             } else if ($_GET['id'] !== "--all") {
//                 $data = api_get_group_by_id($group_id);
//                 if ($data > 1) {
//                     $usr = find_group_users($data["groupid"]);
//                     while (($row = mysqli_fetch_assoc($usr))) {
//                         $us[] = $row['username'];
//                     }
//                     mysqli_free_result($usr);
//                     $data[] = array("user" => $us);


//                     echo json_encode($data);
//                 } else {
//                     // User Not Found
//                     $err = api_message("Oupsy", "Group Was Not Fount !!!");
//                     echo json_encode($err);
//                 }
//             } else {
//                 $err =  api_message("Failed !", "You Really Need To Check The Documentation !");
//                 echo json_encode($err);
//             }
//         } else {
//             $err =  api_message("Failed !", "You Really Need To Check The Documentation !");
//             echo json_encode($err);
//         }
//     }
// }



















// Change Themes
if (is_post_request()) {


    if ($_POST['api_name'] == "change_theme") {
        $theme = $_POST['theme'] ?? 404;
        $usr = find_user_by_username(($_POST['username']) ?? "");
        $user = $usr['username'] ?? "";
        if ($theme > 3 || $theme < 1) {
            $err =  api_message("Failed !", "Unknown Theme");
            echo json_encode($err);
            exit;
        } elseif (!has_presence($user)) {
            $err =  api_message("Failed !", "Unknown User ");
            echo json_encode($err);
            exit;
        } else {
            $data = update_theme($theme, $user);
            if ($data) {
                $err = api_message("Success", "Theme Updated Successfully!");
                echo json_encode($err);
            }
        }
    }
}




// // Change Themes
// if (is_post_request()) {

//     if ($_POST['api_name'] == "change_theme") {
//         $theme = $_POST['theme'] ?? 404;
//         $usr = find_user_by_username(($_POST['username']) ?? "");
//         $user = $usr['username'] ?? "";
//         if ($theme > 3 || $theme < 1) {
//             $err =  api_message("Failed !", "Unknown Theme");
//             echo json_encode($err);
//             exit;
//         } elseif (!has_presence($user)) {
//             $err =  api_message("Failed !", "Unknown User ");
//             echo json_encode($err);
//             exit;
//         } else {
//             $data = update_theme($theme, $user);
//             if ($data) {
//                 $err = api_message("Success", "Theme Updated Successfully!");
//                 echo json_encode($err);
//             }
//         }
//     }
// }




// Update  User
// if (is_post_request()) {

//     if ($_POST['api_name'] == "update_user") {
//         $id = update_user($_POST);
//         if (!has_presence($id)) {
//             $err =  api_message("Failed !", "User Update Failed , no required");
//             echo json_encode($err);
//             exit;
//         } elseif (!has_presence($msg_id)) {
//             $err =  api_message("Failed !", "You Need to provide the id of the message ");
//             echo json_encode($err);
//             exit;
//         } else {
//             $data = edit_message($msg_id, $text);
//             if ($data) {
//                 $err = api_message("Success", "Message Updated!");
//                 echo json_encode($err);
//             }
//         }
//     }
// }
// Edit  Message
if (is_post_request()) {

    if ($_POST['api_name'] == "edit_msg") {
        $text = $_POST['msg'] ?? "";
        $id = find_message_by_id(($_POST['id']) ?? "");
        $msg_id = $id['msg_id'] ?? "";
        if (!has_presence($text)) {
            $err =  api_message("Failed !", "You nees to Provide A message");
            echo json_encode($err);
            exit;
        } elseif (!has_presence($msg_id)) {
            $err =  api_message("Failed !", "You Need to provide the id of the message ");
            echo json_encode($err);
            exit;
        } else {
            $data = edit_message($msg_id, $text);
            if ($data) {
                $err = api_message("Success", "Message Updated!");
                echo json_encode($err);
            }
        }
    }
}





// DELETE  Message
if (is_post_request()) {

    if ($_POST['api_name'] == "delete_msg") {
        $id = $_POST['id'] ?? "";
        if (!has_presence($id)) {
            $err =  api_message("Failed !", "You nees to Provide A Message ID");
            echo json_encode($err);
            exit;
        } else {
            $data = delete_message($id);
            print_r($data);
            if ($data > 0) {
                $err = api_message("Success", "Message Deleted!");
                echo json_encode($err);
            } else {
                $err = api_message("Error", "Unknown MSG id !");
                echo json_encode($err);
            }
        }
    }
}
