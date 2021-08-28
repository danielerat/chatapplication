<?php
require_once("initialize.php");
require_login();

$id = $_GET["chat"] ?? "";
$msg = array('sent_by' => $_SESSION['user_id'], 'sent_to' => $id);
$chat = find_group_messages($msg);
$result = "";
//In case There Is No message , Display This
if (mysqli_num_rows($chat) == 0) {
    $result .= "<h5 class='nochatfound'>No Chat found with this conversation</h5>";
}
// If there is Message Dispaly This
else {
    $today = "0";
    while ($data = mysqli_fetch_assoc($chat)) {

        if ($today != get_date_portion($data['text_time'])) {
            $today = get_date_portion($data['text_time']);
            $result .= " <div class='date_separator'
            style='margin: 0px auto; clear:both;'>" .
                $today .
                "</div><hr><br>";
        }

        $me = ($data['sent_by'] == $_SESSION['user_id']) ? 'me' : '';
        $result .= "<li class='" . $me . "'>";
        // If The Text If From Me, then Don't Display The sender Name
        if (empty($me)) {
            $result .= "<div class='group_sender'>
                        <span>" . $data['first_name'] . " " . $data['last_name'] . "</span>
                    </div>";
        }
        $result .= "
        <div>" . $data['msg'] . "</div>
            <span class='deltime  '> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                    fill='currentColor' class='bi bi-check-all' viewBox='0 0 16 16'>
                    <path
                        d='M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z' />
                </svg>" . get_time_portion($data['text_time']) . "</span>
        </li><br>";
    }
}
echo $result;
// Free up the Result After Using Them
mysqli_free_result($chat);
