<?php $pageTitle="Events | WeLink";
include 'backend\shared\main_header_functionality.php';
include 'backend\modal\successMsg.php'; 

if(!isset($_GET['event'])){
    $eventID = "";
}else{
    $eventID = h($_GET['event']);
    $eventData = $loadFromEvent->eventData($eventID);
    // var_dump($eventData);
    if(empty($eventID)){
        redirect_to(url_for("home"));
    }

}
if(is_post_request()){

    //CREATE EVENT
    if(isset($_POST['eventBy'])){
        $eventBy = $_POST['eventBy'];
        $eventName = $_POST['eventName'];
        $eventDescription = $_POST['eventDescription'];
        $eventDate = $_POST['eventDate'];

         //upload file picture
         if(isset($_FILES['eventfileToUpload']) && $_FILES['eventfileToUpload']['size'] !== 0){
            $newfilename = "eventPic".$createEvent;
            $errors= array();
            $file_name = $_FILES['eventfileToUpload']['name'];
            $file_size =$_FILES['eventfileToUpload']['size'];
            $file_tmp =$_FILES['eventfileToUpload']['tmp_name'];
            $file_type=$_FILES['eventfileToUpload']['type'];
            $tmp = explode('.', $file_name);
            $file_ext = strtolower(end($tmp));

            $expensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$expensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"frontend/eventImage/".$newfilename.".".$file_ext);
                $linkImage = "frontend/eventImage/".$newfilename.".".$file_ext;
                
            }

            else{
            print_r($errors);
            }
        }else{
            $linkImage= "frontend\assets\images\defaultPic.svg";
        }

        //INSERT EVENT INTO DB
        $createEvent = $loadFromUser->create("events",array("eventBy"=>$eventBy,"eventName"=>$eventName,"eventDescription"=>$eventDescription,"eventDate"=>$eventDate,"eventImage"=>$linkImage));
        
        if($createEvent!= false){
            echo 
            '<script>
                $(document).ready(function() {
                    $("#eventCreated").modal("show");

                    var loadTimer = setInterval(() => {
                        window.location.href = "http://localhost/WSNS/events/"+'.$createEvent.';
                    }, 3000);
                       
                });
            </script>'; 
        }else{
            echo "FAILED TO CREATE EVENT";
        }
        
        
    }else{
        echo "FAILED";
    }

    //UPDATE EVENT
    if(isset($_POST['editEvent'])){

        $eventID = $_POST['editEvent'];
        $eventData = $loadFromEvent->eventData($eventID);
        $eventName = $_POST['editeventName'];
        $eventDescription = $_POST['editeventDescription'];
        $eventDate = $_POST['editeventDate'];

        //upload file picture
        if(isset($_FILES['editeventfileToUpload']) && $_FILES['editeventfileToUpload']['size'] !== 0){
            $newfilename = "eventPic".$eventID;
            $errors= array();
            $file_name = $_FILES['editeventfileToUpload']['name'];
            $file_size =$_FILES['editeventfileToUpload']['size'];
            $file_tmp =$_FILES['editeventfileToUpload']['tmp_name'];
            $file_type=$_FILES['editeventfileToUpload']['type'];
            $tmp = explode('.', $file_name);
            $file_ext = strtolower(end($tmp));

            $expensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$expensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"frontend/eventImage/".$newfilename.".".$file_ext);
                $linkImage = "frontend/eventImage/".$newfilename.".".$file_ext;
            }

            else{
                echo 
                '<script>
                $("span#image-date-err").html('.$errors.');
                </script>';
           
            }
        }else{
            $linkImage = $eventData->eventImage;
        }

        //UPDATE EVENT
        $updateEvent = $loadFromEvent->update("events",$eventID,array("eventBy"=>$user_id,"eventName"=>$eventName,"eventDescription"=>$eventDescription,"eventDate"=>$eventDate,"eventImage"=>$linkImage));
        if($updateEvent == false){
            echo "FAILED TO UPDATE";
        }else{
            echo 
            '<script>
                $(document).ready(function() {
                    $("#eventUpdated").modal("show");

                    var loadTimer = setInterval(() => {
                        window.location.href = "http://localhost/WSNS/events/"+'.$eventID.';
                    }, 3000);
                       
                });
            </script>';   
        }
       
    }
    
}
?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="e-p-id" data-eid="<?php echo $eventID ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php';?>
        <div class="message-section col-sm-4"> 
           <div class="message-section container">
               <div class="message-header container">
                   <h2 class="">Event</h2>
                   <a href="<?php echo url_for("event/compose") ?>" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#createEventModal"><img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class=""></a>
                   <?php include 'backend\modal\createEvent.php'; ?>
                </div>
                <div class="messages-list-container">
                    <ul class="msg-user-add">

                    </ul>
                </div>
           </div>
        </div>
        <div class="right-section right-msg col-sm-5">
            <?php if(!isset($_GET['event'])):?>
            <div class="no-msg-container">
                <div class="n-msg-wrapper">
                    <h2 class="">You don't have an event selected</h2>
                    <p class="">Choose one from your existing event or create a new one.</p>
                    <a href="<?php echo url_for("messages/compose") ?>" class="n-msg Button" role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#createEventModal">Create new event</a>
                    <?php include 'backend\modal\createEvent.php'; ?>
                </div>
            </div>
            <?php elseif(isset($_GET['event'])) :?>
             <section class="chatMessageContainer" aria-labelledBy="detail header" aria-header='section header' role="region">
                 <div class="chat-header-top">
                    <div class="chat-header-left">
                        <a href="<?php echo url_for($eventData->eventName) ;?>" class="chat-header-image-wrapper">
                            <img src="<?php echo url_for($eventData->eventImage) ;?>" alt="<?php echo $eventData->eventName; ?>" class="">
                        </a>
                        <div class="chat-header-name-wrapper group">
                            <h3 class=""><?php echo $eventData->eventName; ?></h3>
                            <span class="chat-header-username">ID : 
                            <?php echo $eventData->eventID; ?>
                            </span>
                        </div>
                        <div class="event-delete-btn ">
                            <svg data-eventid= "<?php echo $eventData->eventID; ?>" id="delete-event" viewBox="0 0 24 24" class="event-del del-icon"><g><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path><path d="M10 17.75c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75zm4 0c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75z"></path></g></svg>    
                        </div>
                        <?php include 'backend\modal\deleteModal.php'; ?>
                    </div>
                 </div> 
                 <div class="chatPageContainer">
                     <div class="mainChatContainer">
                         <div class="event-details">
                             <div class="event-show-wrap">
                                 <div class="user-info" data-userid="<?php echo $user_id ;?>" data-eventid="<?php echo $eventData->eventID;?>"></div>
                                 <form action="<?php echo url_for("events/".$eventID);?> " method="POST" enctype="multipart/form-data" class="event">
                                    <input type="hidden" name="editEvent" value="<?php echo $eventData->eventID?>">
                                        <div class="create-group-wrapper">
                                            <div class="mb-3 event">
                                                <div class="event-pic">
                                                    <img id="editeventprofilePic" src="<?php echo url_for($eventData->eventImage); ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="mt-3 px-4"> 
                                                    <div class="d-flex flex-row align-items-center mt-2">
                                                    <span class="err-msg" id="image-date-err"></span> 
                                                        <div class="ml-3"> 
                                                            Select image to upload:
                                                            <input type="file" name="editeventfileToUpload" id="editeventfileToUpload">
                                                            <input type="button" id="editeventremove-pic" value = "Remove">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <span class="err-msg" id="event-name-err"></span>
                                                <label for="editeventName" class="form-label">Event Name</label>
                                                <input class="form-control" name="editeventName" id="editeventName" rows="3" autocomplete="off" required value="<?php echo $eventData->eventName;?>"></input>
                                            </div>
                                            <div class="mb-3">
                                                <span class="err-msg" id="event-desc-err"></span>
                                                <label for="editeventDescription" class="form-label">Description</label>
                                                <textarea class="form-control" name="editeventDescription" id="editeventDescription" autocomplete="off" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <span class="err-msg" id="event-date-err"></span>
                                                <label for="editeventDate" class="form-label">Event Date</label>
                                                <input type="date" id="editeventDate" name="editeventDate" required value="<?php echo $eventData->eventDate;?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn createEvent-cancel" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary createEvent-submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                     </div>
                 </div> 
             </section>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="<?php echo url_for('frontend\assets\js\event.js'); ?>"></script>
<?php include 'backend\loadJsFiles.php'; ?>
<script>
    $uid = $(".u-p-id").data("uid");
    $eid = $(".e-p-id").data("eid");
    // $eventDescription = "<?php// echo $eventData->eventDescription; ?>";
    $(document).ready(function(){
    
        // $("textarea#editeventDescription").html($eventDescription);

        $(document).on("click",".msg-user-name-wrap",function(){
            var eventId = $(this).data("eventid");
            if(eventId !="" && eventId != undefined){
                window.location.href = "http://localhost/WSNS/events/"+eventId;
            }
            
        })
        //LOAD RECENT CHAT
        function loadEventList(){
            $.post("http://localhost/WSNS/backend/ajax/fetchEventList.php",{userIdLoadEventList:$uid,loadEventid:$eid},function(data){
                console.log(data);
                $('ul.msg-user-add').html(data);
                // alert(data);
            })
        }

        loadEventList();
    })
</script>
