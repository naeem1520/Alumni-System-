		  <nav class="navbar navbar-subnav navbar-static-top subnavMobile" role="navigation">
            <div class="container-fluid whiteBar">

              

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div  id="subnav">

                <i class="fa fa-bars" id="mobileNavbar"></i>
                    <ul class="nav navbar-nav navbarLinks" id="profileNavbar">
                        <li>
                        
                        <?php if($_GET['groupID'])
                        {
                            echo '<a href="'.BASE_URL.'group/'.$_GET['groupID'].'">';
                        }
                        else
                        {
                            echo '<a href="'.BASE_URL.$username.'">';
                        }    
                       ?>
                       <span class="countNumber" id="updatesCount"></span> <span class="boxUpdates">Updates</span></a>
                        </li>
                        <li>
                        <?php if($_GET['groupID'])
                        {
                            echo '<a href="'.BASE_URL.'group/'.$_GET['groupID'].'/members"><span class="countNumber" id="membersCount"></span> <span class="commonMembers">Members</span>';
                        }
                        else
                        {
                            echo '<a href="'.BASE_URL.'friends/'.$username.'"><span class="countNumber" id="friendsCount"></span> <span class="commonFriends">Friends</span>';
                        }    
                       ?>
                        </a>
                        </li>
                        <?php if(empty($_GET['groupID']))
                        {
                        echo '<li><a href="'.BASE_URL.'followers/'.$username.'"><span class="countNumber" id="friendsCount"></span> <span class="commonFollowers">Followers</span></a></li>';
                         }
                         ?>


                        <li>
                        
                        <?php if($_GET['groupID'])
                        {
                            echo '<a href="'.BASE_URL.'group/'.$_GET['groupID'].'/photos"><span class="commonPhotos">Photos</span></a>';
                        }
                        else
                        {
                            echo '<a href="'.BASE_URL.'photos/'.$username.'"><span class="countNumber" id="photosCount"></span> <span class="commonPhotos">Photos</span></a>';
                        }    
                       ?>
                      
                        </li>
                        <?php if(empty($_GET['groupID'])){ ?>
                        <li><a href="<?php echo BASE_URL.'groups/'.$username; ?>" class="commonGroups"> Groups</a></li>
                        <?php } else { ?>
                        <li><a href="<?php echo BASE_URL.'createGroup.php'; ?>" class="commonCreateGroup"> Create Group</a></li>
                        <?php } ?>
                        <li id="facebookButton" style="display:none" class="socialList">
                        <a href="#" title="Facebook" class='social' id="facebookButtonURL" target="_blank">
                        <i class="fa fa-facebook-official socialIcon"></i>
                        </a>
                        </li>
                        <li id="twitterButton" style="display:none" class="socialList">
                        <a href="#" title="Twitter" class='social' id="twitterButtonURL" target="_blank">
                        <i class="fa fa-twitter twitter socialIcon"></i>
                        </a>
                        </li>

                        <li id="googleButton" style="display:none" class="socialList">
                        <a href="#" title="Google Plus" class='social' id="googleButtonURL" target="_blank">
                        <i class="fa fa-google-plus googlePlus socialIcon"></i>
                        </a>
                        </li>

                        <li id="instagramButton" style="display:none" class="socialList">
                        <a href="#" title="Instagram" class='social' id="instagramButtonURL" target="_blank">
                        <i class="fa fa-instagram instagram socialIcon"></i>
                        </a>
                        </li>
                    </ul>
                    <span class="leftButton" id="upArrow"><i class="fa fa-chevron-up"></i></span>
                    <?php if(empty($groupID) && $username) { ?>
                    <span id="friendButton" class="rightButton">
                     
                     </span>
                   <?php } else { ?>
                    <span id="joinButton" class="rightButton">
                     
                     </span>
                   <?php } ?>
                </div>

                <!-- /.navbar-collapse -->
                </div>
        </nav>