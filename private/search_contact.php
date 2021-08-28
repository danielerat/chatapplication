<?php
require_once("initialize.php");
require_login();
$searchTerm = $_GET["searchTerm"] ?? "";
$contacts = seach_contact($searchTerm);
$result = '';
if (mysqli_num_rows($contacts) == 0) {
    $result .= "<h5 class='text-center mt-5 text-warning'>No Contact found</h5>";
} else {
    // Display All Contacts  
    while ($data = mysqli_fetch_assoc($contacts)) {
        $lastmsg = array("sent_by" => $_SESSION['user_id'], "sent_to" => $data['unique_id']);
        $latest = find_latest_messages($lastmsg);
        $result .= "<a class='list-group-item text-white proton' onclick=\"user_description('" . $data['unique_id'] . "');keepfindingtext('" . $data['unique_id'] . "')\" href='#'> 
        <div class='media'>";
        if ($data['online_status'] == 'true') {
            $result .= "<span class='online-status'></span>";
        }

        $result .= "<img src='assets/images/avatar/" . $data['avatar'] . "' alt='user' width='60' height='60' class='rounded-pill' >";

        $result .= "<div class='media-body ml-1'>
                        <div class='d-flex align-items-end justify-content-between mb-1'>
                            <h6 class='mb-0 text-truncate text-nowrap'>" . $data['first_name'] . ' ' . $data['last_name'] . "</h6>";
        $result .= "<small class='small font-weight-bold'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                                    fill='currentColor' class='bi bi-check-all' viewBox='0 0 16 16'>
                                    <path d='M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z' /></svg>
                                     " . get_time_portion($data["last_login"]) . "
                    </small>";
        $result .= "</div>
                        <p class='font-italic mb-0 small text-truncate text-nowrap ltsmsg'>";
        $result .= $latest["msg"] . "</p>
                    </div>
                </div>
            </a>";
    }
}
echo $result;
mysqli_free_result($contacts);
