<div class="nav-bar-section col-sm-3">
            <div class="nav-bar container row">
                <div class="nav-bar-content col-sm">
                    <div class="nav-bar-icon row ">
                        <img src="<?php echo url_for('frontend\assets\images\link-icon.svg');?>" alt="" class="">
                    </div>
                    <div class="nav-bar row">
                        <div class="sidenav">
                            <a href="<?php echo url_for('home');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\activeHome.svg');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Home
                                </span>
                            </a>
                            <a href="<?php echo url_for('notification');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\activeNotification.svg');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Notification
                                </span>
                                <span id="noti-counter" class="noti-counter">
                                    <?php echo $loadFromNotification->notiCounter($user_id); ?>
                                </span>
                            </a>
                            <a href="<?php echo url_for('messages');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\messageIcon.svg');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Messages
                                </span>
                            </a>
                            <a href="<?php echo url_for('group');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\group-icon.png');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Group
                                </span>
                            </a>
                            <a href="<?php echo url_for('events');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\calendar.png');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Events
                                </span>
                            </a>
                            <a href="<?php echo url_for('friend');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\friend.png');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Friend
                                </span>
                            </a>
                            <a href="<?php echo url_for('profile');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\profileIcon.png');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Profile
                                </span>
                            </a>
                            <a href="<?php echo url_for('logout');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\logout.png');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Log out
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="nav-bar-user-info row">
                        <div class="user-photo col">
                            <img src="<?php echo url_for($user->profileImage); ?>" alt="<?php  echo $user->firstName.' '.$user->lastName;?>" class="">
                        </div>
                        <div class="user-name-username col">
                            <div class="user-name row"><?php  echo $user->firstName.' '.$user->lastName;?></div>
                            <div class="user-username row">@<?php  echo $user->username;?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>