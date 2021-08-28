<?php
// Subjects

use function PHPSTORM_META\sql_injection_subst;

function find_all_subjects($options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM subjects ";
    if ($visible) {
        $sql .= "WHERE visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_subject_by_id($id, $options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true";
    }
    // echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

function validate_subject($subject)
{
    $errors = [];

    // menu_name
    if (is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
        $errors[] = "Visiblmee must be true or false.";
    }

    return $errors;
}

function insert_subject($subject)
{
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
        return $errors;
    }

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_online_status($status)
{
    global $db;
    if (is_logged_in()) {
        $sql = "UPDATE online_status SET ";
        $sql .= "online_status='" . db_escape($db, $status['online_status']) . "', ";
        $sql .= "last_login='" . db_escape($db, $status['last_login']) . "' ";
        $sql .= " WHERE user_id='" . db_escape($db, $_SESSION['user_id']) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        // For UPDATE statements, $result is true/false
        if ($result) {
            return true;
        } else {
            // UPDATE failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }
}

function delete_subject($id)
{
    global $db;

    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Pages

function find_all_contacts()
{
    global $db;
    $sql = "
    SELECT 
    users.unique_id, users.first_name, users.last_name,users.username, 
    users.avatar, online_status.last_login, online_status.online_status 
    FROM chatapplication.users INNER JOIN chatapplication.online_status 
    ON users.unique_id=online_status.user_id WHERE NOT unique_id =\"{$_SESSION['user_id']}\" ";
    $sql .= "ORDER BY online_status.last_login;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
function find_all_groups($user)
{
    global $db;
    $sql = "
    SELECT 
    groupid,group_name,creator,members, avatar 
    FROM groups WHERE groups.groupid in (SELECT DISTINCT groupid FROM group_members WHERE unique_id=\"" . db_escape($db, $user) . "\") ;";
    //$sql .= "ORDER BY online_status.online_status DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
function seach_contact($searchTerm)
{
    global $db;
    $sql = "
    SELECT 
    users.unique_id, users.first_name, users.last_name, 
    users.avatar, online_status.last_login, online_status.online_status 
    FROM chatapplication.users INNER JOIN chatapplication.online_status 
    ON users.unique_id=online_status.user_id WHERE NOT unique_id =\"{$_SESSION['user_id']}\" AND (first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%');";
    //$sql .= "ORDER BY online_status.online_status DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_contact_by_id($id)
{
    global $db;
    $sql = "
    SELECT 
    users.username, users.first_name,users.email, users.last_name, 
    users.avatar, online_status.last_login, online_status.online_status 
    FROM chatapplication.users INNER JOIN chatapplication.online_status 
    ON users.unique_id=online_status.user_id WHERE unique_id =\"" . db_escape($db, $id) . "\" LIMIT 1;";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $data;
}
function find_page_by_id($id, $options = [])
{
    global $db;
    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; // returns an assoc. array
}

//   function validate_page($page) {
//     $errors = [];

//     // subject_id
//     if(is_blank($page['subject_id'])) {
//       $errors[] = "Subject cannot be blank.";
//     }

//     // menu_name
//     if(is_blank($page['menu_name'])) {
//       $errors[] = "Name cannot be blank.";
//     } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
//       $errors[] = "Name must be between 2 and 255 characters.";
//     }
//     $current_id = $page['id'] ?? '0';
//     if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
//       $errors[] = "Menu name must be unique.";
//     }


//     // position
//     // Make sure we are working with an integer
//     $postion_int = (int) $page['position'];
//     if($postion_int <= 0) {
//       $errors[] = "Position must be greater than zero.";
//     }
//     if($postion_int > 999) {
//       $errors[] = "Position must be less than 999.";
//     }

//     // visible
//     // Make sure we are working with a string
//     $visible_str = (string) $page['visible'];
//     if(!has_inclusion_of($visible_str, ["0","1"])) {
//       $errors[] = "Visible must be true or false.";
//     }

//     // content
//     if(is_blank($page['content'])) {
//       $errors[] = "Content cannot be blank.";
//     }

//     return $errors;
//   }

//   function insert_page($page) {
//     global $db;

//     $errors = validate_page($page);
//     if(!empty($errors)) {
//       return $errors;
//     }

//     $sql = "INSERT INTO pages ";
//     $sql .= "(subject_id, menu_name, position, visible, content) ";
//     $sql .= "VALUES (";
//     $sql .= "'" . db_escape($db, $page['subject_id']) . "',";
//     $sql .= "'" . db_escape($db, $page['menu_name']) . "',";
//     $sql .= "'" . db_escape($db, $page['position']) . "',";
//     $sql .= "'" . db_escape($db, $page['visible']) . "',";
//     $sql .= "'" . db_escape($db, $page['content']) . "'";
//     $sql .= ")";
//     $result = mysqli_query($db, $sql);
//     // For INSERT statements, $result is true/false
//     if($result) {
//       return true;
//     } else {
//       // INSERT failed
//       echo mysqli_error($db);
//       db_disconnect($db);
//       exit;
//     }
//   }

//   function update_page($page) {
//     global $db;

//     $errors = validate_page($page);
//     if(!empty($errors)) {
//       return $errors;
//     }

//     $sql = "UPDATE pages SET ";
//     $sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "', ";
//     $sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
//     $sql .= "position='" . db_escape($db, $page['position']) . "', ";
//     $sql .= "visible='" . db_escape($db, $page['visible']) . "', ";
//     $sql .= "content='" . db_escape($db, $page['content']) . "' ";
//     $sql .= "WHERE id='" . db_escape($db, $page['id']) . "' ";
//     $sql .= "LIMIT 1";

//     $result = mysqli_query($db, $sql);
//     // For UPDATE statements, $result is true/false
//     if($result) {
//       return true;
//     } else {
//       // UPDATE failed
//       echo mysqli_error($db);
//       db_disconnect($db);
//       exit;
//     }

//   }

function delete_page($id)
{
    global $db;

    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_pages_by_subject_id($subject_id, $options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}







// QUERIES TO WORK WITH THE ADMIN TABLE

// Find all admins, ordered last_name, first_name
function find_all_admins()
{
    global $db;

    $sql = "SELECT * from users ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}




function find_admin_by_id($id)
{
    global $db;
    $sql = "SELECT * from users ";
    $sql .= "WHERE user_id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result); //CHECK if the query worked
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}

function  find_user_by_username($username)
{
    global $db;
    $sql = "SELECT * from users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}

function  find_user_by_id($username)
{
    global $db;
    $sql = "SELECT unique_id,first_name,last_name,username,email,avatar from users ";
    $sql .= "WHERE unique_id='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}



function  find_message_by_id($id)
{
    global $db;
    $sql = "SELECT * from messages ";
    $sql .= "WHERE msg_id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}


function  find_user_theme($username)
{
    global $db;
    $sql = "SELECT theme from themes ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}



//   FUnction To select Group Description
function  find_group_by_id($id)
{
    global $db;
    $sql = "SELECT groups.groupid, groups.group_name, groups.creator, groups.members, groups.avatar, groups.creationdate, users.username FROM groups INNER JOIN users ON users.unique_id=groups.creator WHERE ";
    $sql .= " groups.groupid='" . db_escape($db, $id) . "'";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}










// Function To check if a user belongs to a group
function  find_group_membership($username, $groupid)
{
    global $db;
    $sql = "SELECT groupid FROM group_members ";
    $sql .= "WHERE unique_id='" . db_escape($db, $username) . "' ";
    $sql .= "and groupid='" . db_escape($db, $groupid) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}

// Find All Users From A group
function  find_group_users($groupid)
{
    global $db;
    $sql = "SELECT users.username,users.unique_id as id,users.first_name,users.last_name,users.avatar,group_members.unique_id FROM chatapplication.users  INNER JOIN chatapplication.group_members ON users.username=group_members.unique_id ";
    $sql .= " WHERE group_members.groupid='" . db_escape($db, $groupid) . "'; ";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result; // returns an assoc. array
}

// pass the username password email ... to this function as an array
// It makes all the possible tests and return Errors in an array
// If error is empty then everything is alright
function validate_admin($admin, $option = [])
{
    // We added added a parameter to change the behavior of our validation
    // if the password was sent with option of false then , then password is not require
    $password_required = $option['password_required'] ?? true;
    $errors = [];
    //Validate Form Name
    if (is_blank($admin['first_name'])) { // Check if it's empty first
        $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "First name must be between 2 and 255 characters.";
    }

    // Validata Form Last Name
    if (is_blank($admin['last_name'])) { // Check if it's empty first
        $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Last name must be between 2 and 255 characters.";
    }

    //Validate if an email is valid
    if (is_blank($admin['email'])) { // Check if it's empty first
        $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
        $errors[] = "Email name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
        $errors[] = "Email must be a valid format.";
    }

    //validate username
    if (is_blank($admin['username'])) { // Check if it's empty first
        $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 5, 'max' => 255))) {
        $errors[] = "Username must be between 5 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
        $errors[] = "Username not allowed. Try another.";
    }


    // validate passwords
    if ($password_required) {
        if (is_blank($admin['password'])) { // Check if it's empty first
            $errors[] = "Password cannot be blank.";
        } elseif (!has_length($admin['password'], array('min' => 8))) {
            $errors[] = "Password must contain 8 or more characters";
        } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 uppercase letter";
        } elseif (!preg_match('/[a-z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 lowercase letter";
        } elseif (!preg_match('/[0-9]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 number";
        } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 symbol";
        }

        if (is_blank($admin['confirm_password'])) {
            $errors[] = "Confirm password cannot be blank.";
        } elseif ($admin['password'] !== $admin['confirm_password']) {
            $errors[] = "Password and confirm password must match.";
        }
    }


    // Validata Form image
    if (is_blank($admin['avatar'])) { // Check if it's empty first
        $errors[] = "Please Select An Image";
    }

    return $errors;
}

// Inserting data in the admin table
// Check if the validation function is all alright
// if everything is okay ant there is no error then
// It hases the password with the BCRYPT algo then insert the data
function insert_admin($admin)
{
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
        return $errors;
        // if all forms has no error then data can proceeed
    }

    // Encrypting the password for the user so that nobody can see shit
    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
    // db_escape simply uses mysl_real_escapre_string on all outside data
    $sql = "INSERT INTO users ";
    $sql .= "(unique_id,first_name, last_name, username, email, hashed_password,avatar) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['unique_id']) . "',";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db, $admin['avatar']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {

        $sql = "INSERT INTO online_status ";
        $sql .= "(user_id,last_login,online_status) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $admin['unique_id']) . "',";
        $sql .= "'" . db_escape($db, "000000") . "',";
        $sql .= "'" . db_escape($db, "false") . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);
        if ($result) {
            // If Data was inserted correctly in the database
            return true;
        }
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


// Update a User From the Admin Table , pass in all the data in an array
function update_user($admin)
{
    global $db;
    /*
      We Don't always need to update the password , let's wok on the field
      We wan to do it in a way that if the password was sent then it's okay
      we update it , otherwise , we don't
    */

    // if the password field is not blank then we know thta it was sent
    $password_sent = !is_blank($admin['password']);

    // Make Checks on all data And make sure they are all good to go
    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
        return $errors;
    }
    // Grabs the password , Encrypt it and set it ready for our database
    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if ($password_sent) {
        $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "',";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    if (!($admin["avatar"] == "update")) {
        $sql .= ", avatar='" . db_escape($db, $admin['avatar']) . "' ";
    }
    $sql .= "WHERE unique_id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";


    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_admin($admin)
{
    global $db;

    $sql = "DELETE from users ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}



function delete_message($id)
{
    global $db;

    $sql = "DELETE from messages ";
    $sql .= "WHERE msg_id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);
    // For DELETE statements, $result is true/false
    if ($result) {
        return $result;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


function update_theme($theme, $admin)
{
    global $db;

    $sql = "UPDATE themes set  ";
    $sql .= " theme='" . db_escape($db, $theme) . "' ";
    $sql .= "WHERE username='" . db_escape($db, $admin) . "' ";
    $sql .= "LIMIT 1;";

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        // Update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}



function edit_message($id, $msg)
{
    global $db;

    $sql = "UPDATE messages set  ";
    $sql .= " msg='" . db_escape($db, $msg) . "' ";
    $sql .= "WHERE msg_id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1;";

    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        // Update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}






//Function To send Messaged
function send_message_to($msg)
{
    global $db;
    $sql = "INSERT INTO messages ";
    $sql .= "(sent_by, sent_to, msg) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $msg['sent_by']) . "',";
    $sql .= "'" . db_escape($db, $msg['sent_to']) . "',";
    $sql .= "'" . db_escape($db, $msg['msg']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//Function To find chat messages Messaged
function find_chat_messages($msg)
{
    global $db;
    $sql = "SELECT * FROM  messages where (";
    $sql .= " sent_by='" .   $msg['sent_by'] . "' AND ";
    $sql .= " sent_to='" .  $msg['sent_to'] . "') OR (";
    $sql .= " sent_by='" .   $msg['sent_to'] . "' AND ";
    $sql .= " sent_to='" .  $msg['sent_by'] . "') ";
    $sql .= "order by msg_id,text_time ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

//Function To find chat messages Messaged
function find_group_messages($msg)
{
    global $db;
    $sql = "   ";
    $sql = "SELECT    messages.msg_id,messages.sent_by,messages.sent_to,messages.msg,messages.text_time, users.first_name, users.last_name ";
    $sql .= " FROM chatapplication.messages INNER JOIN chatapplication.users ON ";
    $sql .= " messages.sent_by=users.unique_id ";
    $sql .= " WHERE sent_to='" . $msg['sent_to'] . "'";
    $sql .= " order by msg_id,text_time ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}



function find_latest_messages($msg)
{
    global $db;
    $sql = "SELECT msg FROM `messages` WHERE (";
    $sql .= " sent_by='" .   $msg['sent_by'] . "' AND ";
    $sql .= " sent_to='" .  $msg['sent_to'] . "') OR (";
    $sql .= " sent_by='" .   $msg['sent_to'] . "' AND ";
    $sql .= " sent_to='" .  $msg['sent_by'] . "') ";
    $sql .= "ORDER BY msg_id DESC LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if (empty($data)) {
        return array("msg" => "No Message Yet");
    } else {
        return $data;
    }
}
function find_unread_messages($msg)
{
    global $db;
    $sql = "SELECT count(msg) as unread FROM `messages` WHERE (";
    $sql .= " sent_by='" .   $msg['sent_to'] . "' AND ";
    $sql .= " sent_to='" .  $msg['sent_by'] . "') ";
    $sql .= "AND delivered='false' LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if (empty($data)) {
        return array("msg" => "No Message Yet");
    } else {
        return $data;
    }
}

function update_message_afterread($msg)
{
    global $db;
    $sql = "UPDATE messages SET ";
    $sql .= "delivered='true' ";
    $sql .= " WHERE ";
    $sql .= "(sent_by='" . db_escape($db, $msg['sent_to']) . "' AND ";
    $sql .= "sent_to='" . db_escape($db, $msg['sent_by']) . "') AND delivered='false';";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function create_group($group)
{
    global $db;
    $sql = "INSERT INTO groups ";
    $sql .= "(groupid, group_name, creator,members,avatar) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $group['groupid']) . "',";
    $sql .= "'" . db_escape($db, $group['group_name']) . "',";
    $sql .= "'" . db_escape($db, $group['creator']) . "',";
    $sql .= "'" . db_escape($db, $group['members']) . "',";
    $sql .= "'" . db_escape($db, $group['avatar']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function create_group_members($groupid, $members)
{
    global $db;
    $sql = "INSERT INTO group_members ";
    $sql .= "(groupid, unique_id) ";
    $sql .= "VALUES ";
    foreach ($members as $value) {
        $sql .= "('" . db_escape($db, $groupid) . "','" . db_escape($db, $value) . "'),";
    }
    $sql .= "('" . db_escape($db, $groupid) . "','" . db_escape($db, $_SESSION['username']) . "');";
    //Remove the last , from the contructed strin lol i know i am lazy so what 
    //     $sql=substr("$sql", 0, -1);
    //    $sql.=";";

    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}




// Api Functions Implementation

function  api_find_user_by_username($username)
{
    global $db;
    $sql = "SELECT `unique_id`, `first_name`, `last_name`, `username`, `email`, `avatar` from users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}


function  api_find_all_users()
{
    global $db;
    $sql = "SELECT `unique_id`, `first_name`, `last_name`, `username`, `email`, `avatar` from users ";
    $sql .= "WHERE  1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result; // returns an assoc. array
}


//   API function to get Groups
function  api_get_group_by_id($id)
{
    global $db;
    $sql = "SELECT groups.groupid, groups.group_name, groups.creator, groups.members, groups.avatar, groups.creationdate, users.username as admin FROM groups INNER JOIN users ON users.unique_id=groups.creator WHERE ";
    $sql .= " groups.id='" . db_escape($db, $id) . "'";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $data = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $data; // returns an assoc. array
}


//   API function to get All Groups
function  api_get_all_groups()
{
    global $db;
    $sql = "SELECT groups.groupid, groups.group_name, groups.creator, groups.members, groups.avatar, groups.creationdate, users.username as admin FROM groups INNER JOIN users ON users.unique_id=groups.creator WHERE 1";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result; // returns an assoc. array
}


function  api_get_online_users()
{
    global $db;
    $sql = "SELECT users.unique_id,users.first_name,users.last_name, users.username,users.email ,online_status.last_login,online_status.online_status FROM `users` INNER JOIN online_status ON online_status.user_id=users.unique_id WHERE online_status='true';";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result; // returns an assoc. array
}
