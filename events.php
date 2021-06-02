<?php $pageTitle="Events | WeLink";
 Include_once 'backend\initialize.php';  
?>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php' ?>
        <div class="message-section col-sm-4"> 
           <div class="message-section container">
               <div class="message-header row">
                   <h2 class="">Events</h2>
                   <img src="frontend\assets\images\plus-sign.png" alt="" class="">
                   <img src="frontend\assets\images\settings.png" alt="" class="notification-setting-icon">
               </div>
               <div class="message-search-engine row">
                    <div class="message-search-engine-form">
                        <form class="message-search-bar" action="">
                            <input type="text" placeholder="Search.." name="search2">
                            <button type="submit"><img src="frontend\assets\images\magnifying-glass.svg" alt="" class=""></button>
                        </form>
                    </div>
                </div>
                <div class="messages-list">
                    <div class="message">
                        <div class="user-photo col-3">
                            <img src="frontend\assets\images\defaultPic.svg" alt="" class="">
                        </div>
                        <div class="group-name-details col-8">
                            <span class="group-name">Name</span>
                            <div class="group-description">
                                <article class="description">
                                    This is the description.
                                </article>
                            </div>
                        </div>
                        <div class="group-edit-btn">
                            <img src="frontend\assets\images\edit-button.png" alt="" class="">
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <?php include 'backend\modal\eventsEditModal.php' ?>
    </div>
</div>

<?php include 'backend\loadJsFiles.php'; ?>