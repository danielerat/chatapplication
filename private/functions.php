<?php

// Functions for encoding the url either using url encode or rawurlencode
function u($string = "")
{
    return urlencode($string);
}

function raw_u($string = "")
{
    return rawurlencode($string);
}


// Function h is for htmlspecialchars to encode html codes
function h($string = "")
{
    return htmlspecialchars($string);
}

// Function to redirect a user to any page
function redirect_to($location)
{
    header("Location: " . $location);
    exit;
}
// Function to check if a request if a post request
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

// Function Check If a request is a get request
function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

//Custom Sweetalert For Displaying Authenticarion erros 
function sweetalerterr($msg, $text)
{
    $val = "<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        showCloseButton: true,
        timer: 4000,";
    $val .= "title: '{$text}',";
    $val .= '
        html:"<ul class=\"text-danger\">';
    foreach ($msg as $error) {
        $val .= "<li>" . h($error) . "</li>";
    };
    $val .= '</ul>"';
    $val .= "})</script>";
    return $val;
}
function display_errors($errors = array())
{
    $output = '';
    if (!empty($errors)) {
        $output = sweetalerterr($errors, "Please Fix The Following");
    }
    return $output;
}



function display_session_message()
{
    // Check if there is a session message and if there is a message in it
    // If there is , then what it will do , it's remove the session and put the message
    if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        if (!is_blank($msg)) {
            $val = "<script>
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
        icon: 'success',
        title: '" . h($msg) . "'
        })
          </script>";
            return $val;
        }
    }
}

function display_session_authErrors()
{
    // Check if there is a session message and if there is a message in it
    // If there is , then what it will do , it's remove the session and put the message
    if (isset($_SESSION['authErrors']) && $_SESSION['authErrors'] != '') {
        $msg = $_SESSION['authErrors'];
        unset($_SESSION['authErrors']);
        if ($msg) {
            $val = sweetalerterr($msg, "Error Trying To login");
            return  $val;
        }
    }
}





//Image Upload function
function image_validation_check($target_file)
{
    $error = [];
    $mp = 0;
    $imageFileType = strtolower(pathinfo($_FILES["user_avatar"]["name"], PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["user_avatar"]["tmp_name"]);
    if ($check !== false) {
    } else {
        $error[] = "File is not an image.";
    }
    //  Check if file already exists
    //     if (file_exists($target_file)) {
    //         $error[]= "Sorry, file already exists.";
    //         $uploadOk = 0;
    //     }

    // Check file size
    if ($_FILES["user_avatar"]["size"] > 10000000) {
        $error[] =  "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $error[] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    return $error;
}
function upload_image($back = "")
{
    $newName = uniqid() . "-" . time();
    $filename   = $back . "assets/images/avatar/" . $newName; // 5dab1961e93a7-1571494241
    $imageFileType = strtolower(pathinfo($_FILES["user_avatar"]["name"], PATHINFO_EXTENSION));
    $target_file = $filename . "." . $imageFileType;
    $errors = image_validation_check($target_file);

    // If there was an error with the file then return the  errors 
    if (!empty($errors)) {
        $sucessUpload = array("uploadStatus" => "false", "errors" => $errors);
        return $sucessUpload;
    } else {
        if (move_uploaded_file($_FILES["user_avatar"]["tmp_name"], $target_file)) {
            $sucessUpload = array("uploadStatus" => "true", "filename" => "$newName" . "." . "$imageFileType");
            return $sucessUpload;
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }
    $sucessUpload = array("uploadStatus" => "false", "errors" => $errors);
    return $sucessUpload;
}


//Function To Generate User Id 
//uses The php uniqid and prepend a random number and time  
function generate_uid()
{
    return uniqid(rand() . time());
}

//function to Convert A time Stamp to time 
function convert_to_time($timestamp)
{
    $date = date("d F Y H:i:s",  $timestamp);
    return $date;
}


// Functions to display Appropriate themes



//Get The Time portion from the timestamp (Hour:Minutes)
function get_time_portion($time)
{
    return date('H:i', strtotime($time));
}


//Get The Date portion from the timestamp(Month Day)
function get_date_portion($time)
{
    return date('M d', strtotime($time));
}


//Get The Date portion from the timestamp(Month Day)
function get_online_format($time)
{
    return date('M d, H:i', strtotime($time));
}




// Check is a request was made with Ajax
function is_ajax_request()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}



// Display Api Error

function api_message($msg, $err)
{
    $err = array(
        "status" => $msg,
        "message" => $err
    );
    return $err;
}
