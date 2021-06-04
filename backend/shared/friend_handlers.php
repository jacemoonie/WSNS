<?php

if(is_get_request()){
    // IF GET ACTION AND ID PARAMETERS
    if(isset($_GET['action']) && isset($_GET['id'])){
        // ASSIGN TO VARIABLE 
        $user_id = $_GET['id'];
        $my_id = $_SESSION['userLoggedIn'];

        // IF GET SEND REQUEST ACTION
        if($_GET['action'] == 'send_req'){

            $loadFromFriend->make_pending_friends($my_id, $user_id);
        }
        // IF GET CANCEL REQUEST OR IGNORE REQUEST ACTION
        else if($_GET['action'] == 'cancel_req' || $_GET['action'] == 'ignore_req'){
            $loadFromFriend->cancel_or_ignore_friend_request($my_id, $user_id);
        }
        // IF GET ACCEPT REQUEST ACTION
        elseif($_GET['action'] == 'accept_req'){

            $loadFromFriend->make_friends($my_id, $user_id);
        }
        // IF GET UNFRIEND REQUEST ACTION
        elseif($_GET['action'] == 'unfriend_req'){
            $loadFromFriend->delete_friends($my_id, $user_id);
        }
        else{
            redirect_to(url_for('profile'));
        }
    }
}
?>