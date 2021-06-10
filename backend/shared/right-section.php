<div class="right-section col-sm-3">
            <div class="right-section container">
                <div class="search-engine row">
                    <div class="search-engine-form">
                    <form action="" class="" role="search" aria-label="Search people">
                        <div class="s-wrapper">
                            <div class="s-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"/></g></svg>
                            </div>
                            <div class="s-bar">
                                <input type="text" aria-label="Search query" placeholder="Search query" role="combox" class="s-user" autocomplete="off">
                            </div>
                        </div>
                        <div class="s-wrapper-user-container">
                            <ul class="s-result-user" style="overflow-y:auto,height:90%;"> 
                            </ul>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="right-section-announcement row">
                    <div class="announcement-header container">
                       <span class="header">Annoucement</span>
                       <span class="speaker-icon"><img src="frontend\assets\images\speaker-announce.svg" alt="" class=""></span> 
                    </div>
                    <div class="annoucement-post container">
                        <div class="announcement-post-content"> 
                            <?php $announce->showAnnouncement();?>
                        </div>
                    </div>
                </div>
                <div class="right-section-event row">
                    <div class="event-header">
                        <span class="event-header">Events</span>
                    </div>
                    <div class="event-post container">
                        <div class="event-post-content">
                        <?php $loadFromEvent->showEvent();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>