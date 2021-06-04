<div class="right-section col-sm-3">
            <div class="right-section container">
                <div class="search-engine row">
                    <div class="search-engine-form">
                        <form class="search-bar" action="">
                            <input type="text" placeholder="Search.." name="search2">
                            <button type="submit"><img src="frontend\assets\images\magnifying-glass.svg" alt="" class=""></button>
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
                            <article class="">THIS IS AN EVENTS</article>
                        </div>
                    </div>
                </div>
            </div>
        </div>