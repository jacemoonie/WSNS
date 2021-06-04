<div class="nav-bar-section col-sm-3">
            <div class="nav-bar container row">
                <div class="nav-bar-content col-sm">
                    <div class="nav-bar-icon row ">
                        <img src="<?php echo url_for('frontend\assets\images\link-icon.svg');?>" alt="" class="">
                    </div>
                    <div class="nav-bar row">
                        <div class="sidenav">
                            <a href="<?php echo url_for('dashboard');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\activeHome.svg');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Dashboard
                                </span>
                            </a>
                            <a href="<?php echo url_for('admin_profile');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\profileIcon.png');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Profile
                                </span>
                            </a>
                            <a href="<?php echo url_for('announcement');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\speaker-announce.svg');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Announcement
                                </span>
                            </a>
                            <a href="<?php echo url_for('users');?>">
                                <span class="nav-icon">
                                    <img src="<?php echo url_for('frontend\assets\images\user-friends-solid.svg');?>" alt="" class="">
                                </span>
                                <span class="nav-title">
                                Users
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