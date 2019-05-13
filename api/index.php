<?php

require '../config.php';
require 'Slim/Slim.php';
require 'apiFunctions/wallFunctions.php';
require 'apiFunctions/wallExpand.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->post('/login','login'); /* User login */
$app->post('/signup','signup'); /* User Signup  */
$app->post('/publicLabelData','publicLabelData'); /* User public label data */
$app->post('/userDetails','userDetails'); /* User Details */
$app->post('/publicUserDetails','publicUserDetails'); /* User Details */
$app->post('/usernameEmailCheck','usernameEmailCheck'); /* SignUp Check */
$app->post('/changePassword','changePassword'); /* Change Password */
$app->post('/resetPassword','resetPassword'); /* reset password code */
$app->post('/verifyCode','verifyCode'); /* Verify code */
$app->post('/resetPasswordCode','resetPasswordCode'); /* reset password code */
$app->post('/tour','tour'); /* Tour Update */
$app->post('/usernameUpdate','usernameUpdate'); /* Username Updated */
$app->post('/welcomeFriends','welcomeFriends'); /* Welcome Users */
$app->post('/updateSettings','updateSettings'); /* Update Settings  */
$app->post('/socialSettings','socialSettings'); /* Social Settings  */
$app->post('/forgot','forgot'); /* forgot password  */

$app->post('/userGroupSearch','userGroupSearch'); /* userGroupSearch Check */
$app->post('/feedImageUpload','feedImageUpload'); /* News Feed Image Upload  */
$app->post('/profileImageUpload','profileImageUpload'); /* Profile Pic & Background  Image Upload  */
$app->post('/saveBGPosition','saveBGPosition'); /* Save Background Position  */

$app->post('/friendsList','friendsList'); /* Friends List */
$app->post('/publicFriendsList','publicFriendsList'); /* Friends List */
$app->post('/followersList','followersList'); /* Followers List */
$app->post('/addFriend','addFriend'); /* Add Frind  */
$app->post('/removeFriend','removeFriend'); /* Remove Friend  */
$app->post('/photosList','photosList'); /* User Photos List */
$app->post('/deletePhoto','deletePhoto'); /* Delete Photo */

$app->post('/notificationCreatedUpdate','notificationCreatedUpdate'); /* Notification Time Update  */
$app->post('/notifications','notifications'); /* Notifications List  */
$app->post('/notificationsNewCount','notificationsNewCount'); /* New Notifications Count  */

$app->post('/profileViewed','profileViewed'); /* Profile View Create  */
$app->post('/profileViewedList','profileViewedList'); /* Profile view list ### */
$app->post('/publicProfileViewedList','publicProfileViewedList'); /* Profile view list ### */

$app->get('/conversationSingle/:user_one/:conversation_uid','conversationSingle'); /* get impage upload list  */

$app->post('/conversations','conversations'); /* Conversations List */
$app->post('/conversationReplies','conversationReplies'); /* Converstion Replies   */
$app->post('/conversationReplyInsert','conversationReplyInsert'); /* Converstion Reply Insert   */
$app->post('/conversationDelete','conversationDelete'); /* Converstion Reply Insert   */
$app->post('/conversationsNewCount','conversationsNewCount'); /* New conversations Count  */

$app->post('/createGroup','createGroup');/* Create Group  */
$app->post('/groupAdd','groupAdd');/* Add Group  */
$app->post('/groupRemove','groupRemove');/* Remove Group  */
$app->post('/groupDelete','groupDelete');/* Delete Group  */
$app->post('/groupNewsFeed','groupNewsFeed');/* groups newsfeed List  */
$app->post('/groupsList','groupsList'); /* User Group List*/
$app->post('/publicGroupsList','publicGroupsList'); /* User Group List*/
$app->post('/groupDetails','groupDetails'); /* Group complete details  */
$app->post('/groupFollowers','groupFollowers'); /* Group Followers  */
$app->post('/groupUpdate','groupUpdate'); /* Update Group  */
$app->post('/groupEditCheck','groupEditCheck'); /* Group edit check  */
$app->post('/groupPhotosList','groupPhotosList'); /* Group Photos List  */

$app->post('/webcamImageCreate','webcamImageCreate'); /*Webcam Compress  */
$app->post('/getWebcamImage','getWebcamImage'); /*Webcam Compress  */
$app->post('/userNewsFeed','userNewsFeed');/* userNewsFeed List  */
$app->post('/publicUserNewsFeed','publicUserNewsFeed');/* public userNewsFeed List  */
$app->post('/friendsNewsFeed','friendsNewsFeed');/* friendsNewsFeed List  */
$app->post('/deleteNewsFeed','deleteNewsFeed');/* NewsFeed delete  */
$app->post('/updateNewsFeed','updateNewsFeed'); /* NewsFeed update */
$app->post('/status','status'); /* NewsFeed status */
$app->post('/publicStatus','publicStatus'); /* NewsFeed public status */
$app->post('/likeUsers','likeUsers'); /* Total User likes  */
$app->post('/userLikeUnlike','userLikeUnlike'); /* like unlike  */
$app->post('/userShareUnshare','userShareUnshare'); /* share unshare  */
$app->post('/advertisements','advertisements'); /* Advertisments  */

$app->post('/comments','comments'); /* comments list  */
$app->post('/commentUpdate','commentUpdate'); /* comments Update */
$app->post('/commentDelete','commentDelete'); /* comments Delete */
$app->post('/commentUpload','commentUpload'); /* Comment Position  */
$app->run();

/************************* USER LOGIN *************************************/
/* ### User login ### */
function login() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    try {
        $db = getDB();
        $sql = "SELECT uid,notification_created,username, userid,name,profile_pic,tour FROM users WHERE (userid=:username or email=:username) and password=:password AND verified='1' AND status='1' ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $data->username, PDO::PARAM_STR);
        $password=md5($data->password);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $mainCount=$stmt->rowCount();
        $login = $stmt->fetchAll(PDO::FETCH_OBJ);
        if(!empty($login))
        {
            $uid=$login[0]->uid;
            $key=SITE_KEY.$uid;
            $login[0]->token = md5($key);
            $notification_created=$login[0]->notification_created;
            if($mainCount==1)
            {
                $photos_query = $db->query("SELECT id FROM user_uploads WHERE uid_fk='$uid' and group_id_fk='0'");
                $photos_count=$photos_query->rowCount();/* Photos Count */
                $updates_query = $db->query("SELECT msg_id FROM messages WHERE uid_fk='$uid' and group_id_fk='0'");
                $updates_count=$updates_query->rowCount();/* Updates Count */
                $time=time();
                $updates_query = $db->query("UPDATE users SET last_login='$time',photos_count='$photos_count',updates_count='$updates_count' WHERE uid='$uid'");
                
                if(empty($notification_created))
                {
                    /*Last login update */
                    $db->query("UPDATE users SET notification_created='$time' WHERE uid='$uid'") or die(mysqli_error($this->db));
                }
            }
        }
        $db = null;
        /* Username Modification*/
        if($login[0]->name)
        {
            $name=htmlCode($login[0]->name);
        }
        else
        {
            $name=$login[0]->username;
        }
        
        $login[0]->name = $name;
        /* Profile Pic Modification*/
        if($login)
        {
            $login[0]->profile_pic = profilePic($login[0]->profile_pic);
            $login[0]->configurations = configurations();
        }
        
        echo '{"login": ' . json_encode($login) . '}';
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### User registration ### */
function signup() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $email=$data->email;
    $username=$data->username;
    $password=$data->password;
    $id = $data->id;
    
    try {
        
        $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
        $emain_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
        $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);
        
        
        if (strlen(trim($username))>0 && strlen(trim($password))>0 && strlen(trim($email))>0 && $emain_check>0 && $username_check>0 && $password_check>0)
        {
            $db = getDB();
            $sql = "SELECT uid FROM users WHERE username=:username or email=:email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $username,PDO::PARAM_STR);
            $stmt->bindParam("email", $email,PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $created=time();
            if($mainCount==0)
            {
                $status='1';
                if(SMTP_CONNECTION > 0)
                {
                    $status='0';
                }
                /*Inserting user values*/
                $email_active_code=md5($email.time());
                $sql1="INSERT INTO users(username,password,email,last_login,email_activation,status, userid)VALUES(:username,:password,:email,:created,:email_activation,:status, :id)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("username", $username,PDO::PARAM_STR);
                $password=md5($password);
                $stmt1->bindParam("password", $password,PDO::PARAM_STR);
                $stmt1->bindParam("email", $email,PDO::PARAM_STR);
                $stmt1->bindParam("created", $created);
                $stmt1->bindParam("status", $status);
                $stmt1->bindParam("email_activation", $email_active_code);
                $stmt1->bindParam("id", $id);
                $stmt1->execute();
                
                
                
                $stmt2 = $db->prepare("SELECT uid,notification_created,username,name,profile_pic,tour FROM users WHERE username=:username");
                $stmt2->bindParam("username", $data->username,PDO::PARAM_STR);
                $stmt2->execute();
                $signup = $stmt2->fetchAll(PDO::FETCH_OBJ);
                $uid=$signup[0]->uid;
                
        if($uid>0)
        {
                $sql3 = "INSERT INTO friends(friend_one,friend_two,role,created)VALUES(:uid,:uid,:me,:created)";
                $stmt3 = $db->prepare($sql3);
                $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                $time=time();
                
                $stmt3->bindParam("created", $time, PDO::PARAM_STR);
                $me='me';
                $stmt3->bindParam("me", $me, PDO::PARAM_STR);
                $stmt3->execute();
	    } 
                
                if(SMTP_CONNECTION > 0)
                {
                    $applicationName=SITE_NAME;
                    $to=$email;
                    $resetSignupUrl=BASE_URL."verify.php?code=".$email_active_code;
                    $subject ='Please Confirm Your '.$applicationName.' Email Address';
                    $body="Hello,<br/> <br/>Your email address ".$email." has been associated with a ".$applicationName." account. Click the following link or copy and paste it into your browser to confirm.<br/> <br/><a href='".$resetSignupUrl."'>Click here to verify your email</a><br/> <br/>Support,<br/>".$applicationName.'<br/>'.BASE_URL;
                    sendMail($to,$subject,$body);
                }
                $finalStatus='1';
            }
            else
            {
                $finalStatus='0';
            }
            $db = null;
            echo '{"signup": [{"status":"'.$finalStatus.'"}]}';
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Internal User Configurations ### */
function configurations() {
    $sql = "SELECT language_labels,applicationName,applicationDesc,forgot,newsfeedPerPage,friendsPerPage,photosPerPage,groupsPerPage,notificationPerPage, uploadImage,bannerWidth, profileWidth,gravatar,friendsWidgetPerPage,upload FROM configurations WHERE con_id='1' ";
    try {
        $db = getDB();
        $stmt = $db->query($sql);
        $configuration = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $configuration;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### internal Language Labels ### */
function internalLanguageCheck() {
    try {
        $db = getDB();
        $sql = "SELECT language_labels FROM configurations WHERE con_id='1'";
        $stmt = $db->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return  $data[0]->language_labels;
        
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* ### internal Language Labels ### */
function internalNotificationLabels() {
    try {
        $db = getDB();
        $sql = "SELECT feedPosted,notiIsFollowingGroup,notiLiked,notiFollowingYou,notiShared,notiStatus,notiCommented FROM language_labels WHERE labelID='1'";
        $stmt = $db->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $data[0];
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}





/* ### Public Language Labels ### */
function publicLabelData() {
    
    try {
        $db = getDB();
        
        $sql1 = "SELECT language_labels FROM configurations WHERE con_id='1'";
        $stmt1 = $db->query($sql1);
        $lData = $stmt1->fetchAll(PDO::FETCH_OBJ);
        $labelData="";
        if($lData[0]->language_labels)
        {
            $sql = "SELECT * FROM language_labels WHERE labelID='1' ";
            $stmt = $db->query($sql);
            $labelData = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        $db = null;
        echo '{"labelData": ' . json_encode($labelData) . '}';
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/* ### Get User Details ### */
function userDetails() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $session_id=$data->uid;
    
    /* Public Username Check */
    if($data->public_username)
    {
        $uid=internalUsernameDetails($data->public_username);
    }
    else if($data->msgID)
    {
        $uid=internalStatusUID($data->msgID);
    }
    else
    {
        $uid=$data->uid;
    }
    
    $sql = "SELECT uid,userid,tour,username,name,emailNotifications,bio,email,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,profile_pic_status,profile_bg_position,verified,notification_created,photos_count,facebookProfile,twitterProfile,googleProfile,instagramProfile,gender,emailNotifications FROM users WHERE uid=:uid AND status='1'";
    try {
        $key=md5(SITE_KEY.$session_id);
        if($key==$data->token)
        {
            $db = getDB();
            if($uid>0)
            {
                $stmt = $db->prepare($sql);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                
                /* Username Modification*/
                if($userDetails[0]->name)
                {
                    $name=$userDetails[0]->name;
                }
                else
                {
                    $name=$userDetails[0]->username;
                }
                
                //$userDetails[0]->name = nameFilter(htmlCode($name),16);
                $userDetails[0]->name = htmlCode($name);
                $userDetails[0]->bio = nameFilter(htmlCode($userDetails[0]->bio),60);
                $sessionUserData=internalUserDetails($session_id);
                $userDetails[0]->sessionName=$sessionUserData[0]->name;
                //$userDetails[0]->notificationCount=internalNotificationsCount($uid,$userDetails[0]->notification_created);
                /* Profile Pic Modifiaction */
                
                if($userDetails)
                {
                    $userDetails[0]->profile_pic = profilePic($userDetails[0]->profile_pic);
                    /* Profile Background Modifiaction */
                    if($userDetails[0]->profile_bg)
                    {
                        $profile_bg=backgroundPic($userDetails[0]->profile_bg);
                    }
                    else
                    {
                        $profile_bg='';
                    }
                    
                    $userDetails[0]->profile_bg = $profile_bg;
                    $userDetails[0]->role=internalFriendsCheck($session_id,$uid);
                }
                $db = null;
                echo '{"userDetails": ' . json_encode($userDetails) . '}';
            }
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Get User Details ### */
function publicUserDetails() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $session_id=$data->uid;
    
    /* Public Username Check */
    if($data->public_username)
    {
        $uid=internalUsernameDetails($data->public_username);
    }
    else if($data->msgID)
    {
        
        $uid=internalStatusUID($data->msgID);
        
    }
    else
    {
        $uid=$data->uid;
    }
    $sql = "SELECT uid,userid,tour,username,name,bio,email,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,profile_pic_status,profile_bg_position,verified,notification_created,photos_count,facebookProfile,twitterProfile,googleProfile,instagramProfile,gender FROM users WHERE uid=:uid AND status='1'";
    try {
        
        $db = getDB();
        if($uid>0)
        {
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            /* Username Modification*/
            if($userDetails[0]->name)
            {
                $name=$userDetails[0]->name;
            }
            else
            {
                $name=$userDetails[0]->username;
            }
            
            
            //$userDetails[0]->name = nameFilter(htmlCode($name),16);
            $userDetails[0]->name = htmlCode($name);
            $userDetails[0]->bio = nameFilter(htmlCode($userDetails[0]->bio),60);
            $sessionUserData=internalUserDetails($session_id);
            $userDetails[0]->sessionName=htmlCode($sessionUserData[0]->name);
            
            /* Profile Pic Modifiaction */
            
            if($userDetails)
            {
                $userDetails[0]->profile_pic = profilePic($userDetails[0]->profile_pic);
                
                /* Profile Background Modifiaction */
                if($userDetails[0]->profile_bg)
                {
                    $profile_bg=backgroundPic($userDetails[0]->profile_bg);
                }
                else
                {
                    $profile_bg='';
                }
                
                $userDetails[0]->profile_bg = $profile_bg;
                $userDetails[0]->role=internalFriendsCheck($session_id,$uid);
            }
            $db = null;
            echo '{"userDetails": ' . json_encode($userDetails) . '}';
        }
        
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Get User Details ### */
function internalNotificationCreated($uid) {
    
    $sql = "SELECT notification_created FROM users WHERE uid=:uid AND status='1'";
    try {
        if($uid>0)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $userDetails[0]->notification_created;
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### Get User Details ### */
function internalUserDetails($uid) {
    
    
    $sql = "SELECT uid,username,name,bio,email,profile_pic,profile_bg,group_count,emailNotifications FROM users WHERE uid=:uid AND status='1'";
    try {
        
        if($uid>0)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            /* Username Modification*/
            if($userDetails[0]->name)
            $name=$userDetails[0]->name;
            else
                $name=$userDetails[0]->username;
            
            //$userDetails[0]->name = nameFilter(htmlCode($name),16);
            $userDetails[0]->name = htmlCode($name);
            
            $userDetails[0]->bio = nameFilter($userDetails[0]->bio,60);
            
            if(count($userDetails)){
                /* Profile Pic Modifiaction */
                $userDetails[0]->profile_pic = profilePic($userDetails[0]->profile_pic);
            }
            $db = null;
            
            return $userDetails;
        }
        else
        {
            $userDetails='';
            return $userDetails;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Change Password ### */
function changePassword()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $oldPassword=$data->oldPassword;
    $newPassword=$data->newPassword;
    $confirmPassword=$data->confirmPassword;
    
    try {
        $key=md5(SITE_KEY.$uid);
        if($key==$data->token)
        {
            if($newPassword==$confirmPassword && strlen($newPassword)>0 && strlen($oldPassword)>0 && strlen($confirmPassword)>0)
            {
                $db = getDB();
                
                $sql = "SELECT uid FROM users WHERE uid=:uid AND password=:md5_oldPassword";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $md5_oldPassword=md5($oldPassword);
                $stmt->bindParam("md5_oldPassword", $md5_oldPassword);
                
                $stmt->execute();
                
                $count=$stmt->rowCount();
                
                if($count>0)
                {
                    $sql1="UPDATE users SET password=:md5_newPassword WHERE uid=:uid";
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                    $md5_newPassword=md5($newPassword);
                    $stmt1->bindParam("md5_newPassword", $md5_newPassword);
                    $stmt1->execute();
                    echo '{"changePassword": [{"status":"1"}]}';
                    
                }
                else
                {
                    echo '{"changePassword": [{"status":"0"}]}';
                }
                
            }
            $db = null;
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Intro Tour Check ### */
function tour() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql = "UPDATE users SET tour='1' WHERE uid=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"tour": [{"status":"1"}]}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Username Check ###  */
function usernameUpdate() {
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $username=$data->username;
    
    $sql = "SELECT uid FROM users WHERE username=:username";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token && $uid > 0)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $username,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==0)
            {
                $time=time();
                $sql1 = "UPDATE users SET username=:username WHERE uid =:uid";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("username", $username,PDO::PARAM_STR);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->execute();
                
                /* set username session */
                $_SESSION['username']=$username;
                
                
                $db = null;
                echo '{"usernameUpdate": [{"status":"1"}]}';
            }
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Username Check ### */
function usernameEmailCheck() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $usernameEmail=$data->usernameEmail;
    $type=$data->type;
    $valid=0;
    
    try {
        $db = getDB();
        
        if($type)
        {
            if(filter_var($usernameEmail, FILTER_VALIDATE_EMAIL))
            {
                $sql = "SELECT uid FROM users WHERE email=:usernameEmail";
                $valid=1;
            }
        }
        else
        {
            if(preg_match('/^[a-zA-Z0-9]{3,}$/', $usernameEmail))
            {
                $sql = "SELECT uid FROM users WHERE username=:usernameEmail";
                $valid=1;
                
            }
            
        }
        
        if($valid)
        {
            $stmt = $db->prepare($sql);
            $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            
            
            if($count == 0)
            echo '{"usernameEmailCheck": [{"status":"1"}]}';
            else
            echo '{"usernameEmailCheck": []}';
        }
        $db = null;
        
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### Username  Check ###
function usernameDetails() {
$request = \Slim\Slim::getInstance()->request();
$data = json_decode($request->getBody());
$sql = "SELECT uid FROM users WHERE username=:username AND status='1'";
try {
$key=md5(SITE_KEY.$data->uid);
if($key==$data->token)
{
$db = getDB();
$stmt = $db->prepare($sql);
$stmt->bindParam("username", $data->username);
$stmt->execute();
$usernameDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
$db = null;
echo '{"usernameDetails": ' . json_encode($usernameDetails) . '}';
}

} catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}
*/

/* ### internal Username Details ### */
function internalUsernameDetails($username) {
    $sql = "SELECT uid FROM users WHERE username=:username AND status='1'";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $username,PDO::PARAM_STR);
        $stmt->execute();
        $usernameDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usernameDetails[0]->uid;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* ### Reset Password ### */
function resetPassword()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $code=$data->code;
    $npassword=$data->npassword;
    $cpassword=$data->cpassword;
    try {
        if(strlen($code)>0 && strlen($npassword)>0 && strlen($cpassword)>0 && $npassword==$cpassword )
        {
            $db = getDB();
            $sql = "SELECT uid FROM users WHERE forgot_code=:code";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("code", $code,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count>0)
            {
                
                $sql2 = "UPDATE users SET password=:password,forgot_code='' WHERE forgot_code=:code";
                $stmt2= $db->prepare($sql2);
                $password=md5($npassword);
                $stmt2->bindParam("password", $password);
                $stmt2->bindParam("code", $code);
                $stmt2->execute();
                
                
                
                echo '{"resetPassword": [{"status":"1"}]}';
            }
            else
            echo '{"resetPassword": [{"status":"0"}]}';
            $db = null;
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}

/* ### Reset Password Code ### */
function resetPasswordCode()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $code=$data->code;
    
    try {
        if(strlen($code)>0)
        {
            $db = getDB();
            $sql = "SELECT uid FROM users WHERE forgot_code=:code";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("code", $code,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            echo '{"resetPasswordCode": [{"status":"'.$count.'"}]}';
            $db = null;
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}

/* ### Verify Code ### */
function verifyCode()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $code=$data->code;
    
    try {
        if(strlen($code)>0)
        {
            $db = getDB();
            $sql = "SELECT uid FROM users WHERE email_activation=:code";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("code", $code,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            
            $sql1 = "UPDATE users SET email_activation='',status='1' WHERE email_activation=:code";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("code", $code,PDO::PARAM_STR);
            $stmt1->execute();
            
            echo '{"verifyCode": [{"status":"'.$count.'"}]}';
            $db = null;
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}

/* ### Forgot ### */
function forgot()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $usernameEmail=$data->usernameEmail;
    
    try {
        if(strlen($usernameEmail)>0)
        {
            $db = getDB();
            $sql = "SELECT uid FROM users WHERE (username=:usernameEmail OR email=:usernameEmail) AND status='1'";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $userData = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            if($count>0)
            {
                $sql1 = "SELECT email,name,username FROM users WHERE uid=:uid";
                $stmt1 = $db->prepare($sql1);
                $uid=$userData[0]->uid;
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->execute();
                $userDataEmail = $stmt1->fetchAll(PDO::FETCH_OBJ);
                $email=$userDataEmail[0]->email;
                
                if($userDataEmail[0]->name)
                {
                    $name=htmlCode($userDataEmail[0]->name);
                }
                else
                {
                    $name=$userDataEmail[0]->username;
                }
                
                $cData=configurations();
                $forgotKey=$cData[0]->forgot;
                $active_code=md5($email.$forgotKey.time());
                
                $sql2 = "UPDATE users SET forgot_code=:active_code WHERE uid=:uid";
                $stmt2= $db->prepare($sql2);
                $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt2->bindParam("active_code", $active_code);
                $stmt2->execute();
                echo '{"forgot": [{"status":"1"}]}';
                
                $applicationName=SITE_NAME;
                
                if(SMTP_CONNECTION > 0)
                {
                    $to=$email;
                    $emailName=$name;
                    $resetPasswordUrl=BASE_URL."resetPassword/".$active_code;
                    $subject ='Somebody request a new password for your '.$applicationName.' account';
                        $body="Hello ".$emailName.",<br/> <br/>Somebody recenlty asked to reset your ".$applicationName." password. <br/><br/><a href='".$resetPasswordUrl."'>Click here to change your password.</a><br/><br/>Support<br/>".$applicationName.'<br/>'.BASE_URL;
                    sendMail($to,$subject,$body);
                }
                
            }
            else
            {
                echo '{"forgot": [{"status":"0"}]}';
            }
            $db = null;
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### User Settings ### */
function updateSettings()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $full_name=$data->full_name;
    $aboutme=$data->about_me;
    $gender=$data->gender;
    $emails=$data->emails;
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token && strlen($full_name)>0 && strlen($aboutme)>0 && strlen($gender)>0 && strlen($emails)>0)
        {
            $db = getDB();
            $sql = "UPDATE users SET name=:full_name,bio=:aboutme,gender=:gender,emailNotifications=:emailNotifications WHERE uid=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("full_name", $full_name,PDO::PARAM_STR);
            $stmt->bindParam("aboutme", $aboutme,PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("gender", $gender,PDO::PARAM_STR);
            $stmt->bindParam("emailNotifications", $emails,PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"settings": [{"status":"1"}]}';
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### User Social Settings ### */
function socialSettings()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $facebook=$data->facebook;
    $twitter=$data->twitter;
    $google=$data->google;
    $instagram=$data->instagram;
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql = "UPDATE users SET facebookProfile=:facebook,twitterProfile=:twitter,googleProfile=:google,instagramProfile=:instagram  WHERE uid=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("facebook", $facebook,PDO::PARAM_STR);
            $stmt->bindParam("twitter", $twitter,PDO::PARAM_STR);
            $stmt->bindParam("google", $google,PDO::PARAM_STR);
            $stmt->bindParam("instagram", $instagram,PDO::PARAM_STR);
            $stmt->execute();
            $db = null;
            echo '{"settings": [{"status":"1"}]}';
            return true;
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/* ### User Group Search ### */
function userGroupSearch()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $searchword=$data->searchword;
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql = "(SELECT name as name,username,uid as id,bio as aboutme, 'user' as type, profile_pic FROM users WHERE status='1' AND username LIKE :searchword OR status='1' AND name LIKE :searchword ORDER BY uid DESC)
            UNION
            (SELECT group_name as name,'' as username, group_id as id, group_desc as aboutme,   'group' as type, group_pic as profile_pic FROM groups WHERE group_name LIKE :searchword or group_desc LIKE :searchword ORDER BY group_id ) LIMIT 8";
            $stmt = $db->prepare($sql);
            $q = "%".$searchword."%";
            $stmt->bindParam("searchword", $q,PDO::PARAM_STR);
            $stmt->execute();
            $userGroupSearchCount=$stmt->rowCount();
            $userGroupSearch = $stmt->fetchAll(PDO::FETCH_OBJ);
            if($userGroupSearch)
            {
                
                for($z=0;$z<$userGroupSearchCount;$z++)
                {
                    if($userGroupSearch[$z]->name)
                    {
                        //$userGroupSearch[$z]->name=nameFilter(htmlCode($userGroupSearch[$z]->name),16);
                        $userGroupSearch[$z]->name=htmlCode($userGroupSearch[$z]->name);
                    }
                    else
                    {
                        //$userGroupSearch[$z]->name=nameFilter($userGroupSearch[$z]->username,16);
                        $userGroupSearch[$z]->name=htmlCode($userGroupSearch[$z]->username);
                    }
                    
                    $userGroupSearch[$z]->profile_pic=profilePic($userGroupSearch[$z]->profile_pic);
                    $userGroupSearch[$z]->aboutme=nameFilter(htmlCode($userGroupSearch[$z]->aboutme),30);
                    
                }
                echo '{"userGroupSearch": ' . json_encode($userGroupSearch) . '}';
            }
            $db = null;
            
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}




/* ### User Share Unshare  ###*/
function userShareUnshare()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $msgid=$data->msg_id;
    $type=$data->type;
    try {
        $key=md5(SITE_KEY.$uid);
        if($key==$data->token && $uid > 0)
        {
            $db = getDB();
            if($type=='Share')
            {
                $sql = "SELECT share_id FROM message_share WHERE  uid_fk=:uid and msg_id_fk=:msgid";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->execute();
                $count=$stmt->rowCount();
                
                if($count==0)
                {
                    $sql1="SELECT uid_fk FROM messages WHERE msg_id=:msgid";
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt1->execute();
                    $message_uid = $stmt1->fetchAll(PDO::FETCH_OBJ);
                    $ouid=$message_uid[0]->uid_fk;
                    $time=time();
                    
                    $sql2="INSERT INTO message_share (msg_id_fk,uid_fk,ouid_fk,created) VALUES(:msgid,:uid,:ouid,:time)";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt2->bindParam("ouid", $ouid,PDO::PARAM_INT);
                    $stmt2->bindParam("time", $time);
                    $stmt2->execute();
                    
                    $sql3="UPDATE messages SET share_count=share_count+1 WHERE msg_id=:msgid";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt3->execute();
                    echo '{"userShareUnshare": [{"status":"1"}]}';
                }
            }
            else
            {
                $sql = "SELECT share_id FROM message_share WHERE  uid_fk=:uid and msg_id_fk=:msgid";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->execute();
                $count=$stmt->rowCount();
                if($count>0)
                {
                    $sql2="DELETE FROM message_share WHERE msg_id_fk=:msgid and uid_fk=:uid";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt2->execute();
                    $sql3="UPDATE messages SET share_count=share_count-1 WHERE msg_id=:msgid";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt3->execute();
                    echo '{"userShareUnshare": [{"status":"1"}]}';
                }
            }
            $db = null;
        }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* ### Like Unlike Message ###*/
function userLikeUnlike()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $msgid=$data->msg_id;
    $type=$data->type;
    $reactionType=$data->reactionType;
    try {
        $key=md5(SITE_KEY.$uid);
        if($key==$data->token && $uid > 0 )
        {
            $db = getDB();
            if($type=='Like')
            {
                $sql = "SELECT like_id FROM message_like WHERE  uid_fk='$uid' and msg_id_fk=:msgid";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt->execute();
                $count=$stmt->rowCount();
                if($count==0)
                {
                    $sql1="SELECT uid_fk FROM messages WHERE msg_id=:msgid";
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt1->execute();
                    $message_uid = $stmt1->fetchAll(PDO::FETCH_OBJ);
                    $ouid=$message_uid[0]->uid_fk;
                    $time=time();
                    
                    $sql2="INSERT INTO message_like (msg_id_fk,uid_fk,ouid_fk,created,reactionType) VALUES(:msgid,:uid,:ouid,:created,:reactionType)";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt2->bindParam("ouid", $ouid,PDO::PARAM_INT);
                    $stmt2->bindParam("created", $time);
                    $stmt2->bindParam("reactionType", $reactionType,PDO::PARAM_INT);
                    $stmt2->execute();
                    
                    $sql3="UPDATE messages SET like_count=like_count+1 WHERE msg_id=:msgid";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt3->execute();
                    echo '{"userLikeUnlike": [{"status":"1"}]}';
                }
            }
            else
            {
                $sql = "SELECT like_id FROM message_like WHERE  uid_fk='$uid' and msg_id_fk=:msgid";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt->execute();
                $count=$stmt->rowCount();
                if($count>0)
                {
                    $sql2="DELETE FROM message_like WHERE msg_id_fk=:msgid and uid_fk=:uid";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt2->execute();
                    $sql3="UPDATE messages SET like_count=like_count-1 WHERE msg_id=:msgid";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam("msgid", $msgid, PDO::PARAM_INT);
                    $stmt3->execute();
                    echo '{"userLikeUnlike": [{"status":"1"}]}';
                }
            }
            $db = null;
        }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### Like Users ### */
function likeUsers()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $msgid=$data->msg_id;
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $sql = "SELECT like_id FROM message_like WHERE msg_id_fk=:msgid LIMIT 1";
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count>0)
            {
                $sql1 = "SELECT U.uid,U.username,U.name, U.profile_pic FROM message_like M, users U WHERE U.uid=M.uid_fk AND M.msg_id_fk=:msgid AND U.status='1'";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("msgid", $msgid, PDO::PARAM_INT);
                
                $stmt1->execute();
                $likeUsers = $stmt1->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                if(count($likeUsers))
                {
                    for($z=0;$z<count($likeUsers);$z++)
                    {
                        
                        if(empty($likeUsers[$z]->name))
                        $likeUsers[$z]->name=$likeUsers[$z]->username;
                        
                        $likeUsers[$z]->profile_pic=profilePic($likeUsers[$z]->profile_pic);
                        
                    }
                }
                echo '{"likeUsers": ' . json_encode($likeUsers) . '}';
            }
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function internalLikeUsers($msgid)
{
    $sql = "SELECT like_id FROM message_like WHERE msg_id_fk=:msgid LIMIT 1";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
        $stmt->execute();
        $count=$stmt->rowCount();
        
        if($count>0)
        {
            $sql1 = "SELECT U.uid, U.username,U.name, U.profile_pic FROM message_like M, users U WHERE U.uid=M.uid_fk AND M.msg_id_fk=:msgid AND U.status='1' LIMIT 3";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("msgid", $msgid, PDO::PARAM_INT);
            
            $stmt1->execute();
            $likeUsers = $stmt1->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            
            if(count($likeUsers))
            {
                for($z=0;$z<count($likeUsers);$z++)
                {
                    
                    if(empty($likeUsers[$z]->name))
                    {
                        $likeUsers[$z]->name=$likeUsers[$z]->username;
                    }
                    
                    $likeUsers[$z]->profile_pic=profilePic($likeUsers[$z]->profile_pic);
                }
                
                
            }
            
            return $likeUsers;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/* ### Share Validate Check ### */
function internalShareCheck($uid,$msgid)
{
    $sql = "SELECT share_id FROM message_share WHERE  uid_fk=:uid and msg_id_fk=:msgid ";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
        $stmt->execute();
        $count=$stmt->rowCount();
        if($count)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Like User Validate Check ### */
function internalLikeCheck($uid,$msgid)
{
    $sql = "SELECT like_id,reactionType FROM message_like WHERE  uid_fk=:uid and msg_id_fk=:msgid";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
        $stmt->execute();
        $likeCheckData=$stmt->fetch(PDO::FETCH_OBJ);
        
        return $likeCheckData;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/* ### Status Updates ### */
function internalMessageDetails($msgid)
{
    $sql = "SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count,M.uploads, U.username,U.name,U.profile_pic,U.emailNotifications,U.email FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid and M.msg_id=:msgid ";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
        $stmt->execute();
        $messageDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $messageDetailsCount=count($messageDetails);
        
        for($z=0;$z<$messageDetailsCount;$z++)
        {
            $messageDetails[$z]->profile_pic=profilePic($messageDetails[$z]->profile_pic);
            
            if(empty($messageDetails[$z]->name))
            {
                $messageDetails[$z]->name=$messageDetails[$z]->username;
            }
            
            
        }
        return $messageDetails;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### INTERNAL Image Upload ### */
function internalImageUpload($uid, $image,$group_id,$conversationImage)
{
    $ids = 0;
    if(empty($group_id))
    {
        $group_id='0';
    }
    
    $image_type=0;
    if($conversationImage)
    {
        $image_type=1;
    }
    
    try {
        
        if($uid > 0)
        {
            $db = getDB();
            
            if($group_id < 1 && $image_type<1)
            {
                $sql1 = "UPDATE users SET photos_count=photos_count+1 WHERE uid=:uid";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->execute();
            }
            
            $sql = "INSERT INTO user_uploads (image_path,uid_fk,group_id_fk,image_type)VALUES(:image ,:uid,:group_id,:image_type)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("image_type", $image_type,PDO::PARAM_STR);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            return $ids;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* ### INTERNAL Comment Upload ### */
function internalCommentUpload($uid, $image)
{
    $sql = "INSERT INTO user_uploads (image_path,uid_fk,image_type)VALUES(:image ,:uid,:image_type)";
    try {
        if($uid>0)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $image_type='0';
            $stmt->bindParam("image", $image,PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("image_type", $image_type,PDO::PARAM_STR);
            $stmt->execute();
            
            $sql1 = "SELECT id FROM user_uploads WHERE image_path=:image and uid_fk=:uid";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("image", $image,PDO::PARAM_INT);
            $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt1->execute();
            $getUploadImage = $stmt1->fetchAll(PDO::FETCH_OBJ);
            
            $db = null;
            return $getUploadImage;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* ### INTERNAL get Image Upload ### */
function internalGetUploadImage($uid,$image)
{
    
    try {
        $db = getDB();
        
        if($image)
        {
            $sql = "SELECT id,image_path from user_uploads WHERE image_path=:image ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
        }
        else
        {
            $sql = "SELECT id,image_path FROM user_uploads WHERE uid_fk=:uid ORDER BY id desc";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        $getUploadImage = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $getUploadImage;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Background Image Upload  ## */
function internalProfileBackgroundUpload($uid, $image)
{
    try {
        if($uid > 0)
        {
            $db = getDB();
            $sql = "UPDATE users SET profile_bg=:image WHERE uid=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            
            $sql1 = "INSERT INTO user_uploads (image_path,uid_fk,image_type) VALUES (:image,:uid,:image_type)";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("image", $image, PDO::PARAM_STR);
            $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
            $image_type='2';
            $stmt1->bindParam("image_type", $image_type);
            $stmt1->execute();
            
            $sql2 = "SELECT uid,profile_bg FROM users WHERE uid=:uid";
            $stmt2 = $db->prepare($sql2);
            $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt2->execute();
            
            $profileBGImageUpload = $stmt2->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $profileBGImageUpload;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* ### Profile Image Upload ### ...................................... */
function internalProfilePicUpload($uid, $image)
{
    
    try {
        if($uid > 0)
        {
            $db = getDB();
            $sql = "UPDATE users SET profile_pic=:image,profile_pic_status=:status WHERE uid=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->execute();
            
            
            $sql1 = "INSERT INTO user_uploads (image_path,uid_fk,image_type) VALUES (:image,:uid,:status)";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("image", $image, PDO::PARAM_STR);
            $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
            $status='2';
            $stmt1->bindParam("status", $status);
            $stmt1->execute();
            
            $sql2 = "SELECT uid,profile_pic FROM users WHERE uid=:uid";
            $stmt2 = $db->prepare($sql2);
            $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt2->execute();
            
            $profileBGImageUpload = $stmt2->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            
            return $profileBGImageUpload;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### Group Background Image Upload  ## */
function internalGroupBackgroundUpload($uid, $image,$groupID)
{
    try {
        if($uid > 0)
        {
            $db = getDB();
            $sql = "UPDATE groups SET group_bg=:image WHERE  group_id=:groupID AND uid_fk=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("groupID", $groupID);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->execute();
            
            $sql1 = "INSERT INTO user_uploads(image_path,uid_fk,group_id_fk,image_type) VALUES (:image,:uid,:groupID,:image_type)";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("image", $image, PDO::PARAM_STR);
            $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt1->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $image_type='2';
            $stmt1->bindParam("image_type", $image_type);
            $stmt1->execute();
            
            $sql2 = "SELECT group_id,group_bg FROM groups WHERE  group_id=:groupID AND uid_fk=:uid";
            $stmt2 = $db->prepare($sql2);
            $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt2->bindParam("groupID", $groupID,  PDO::PARAM_INT);
            $stmt2->execute();
            
            $profileBGImageUpload = $stmt2->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $profileBGImageUpload;
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}


/* ### Group Profile Pic Upload ### ...................................... */
function internalGroupPicUpload($uid, $image,$groupID)
{
    
    try {
        if($uid > 0)
        {
            $db = getDB();
            $sql = "UPDATE groups SET group_pic=:image WHERE group_id=:groupID AND uid_fk=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $stmt->execute();
            
            
            $sql1 = "INSERT INTO user_uploads (image_path,uid_fk,group_id_fk,image_type) VALUES (:image,:uid,:groupID,:status)";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("image", $image, PDO::PARAM_STR);
            $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt1->bindParam("groupID", $groupID,PDO::PARAM_INT);
            $status='1';
            $stmt1->bindParam("status", $status);
            $stmt1->execute();
            
            $sql2 = "SELECT group_id,group_pic FROM groups WHERE group_id=:groupID AND uid_fk=:uid";
            $stmt2 = $db->prepare($sql2);
            $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt2->bindParam("groupID", $groupID,PDO::PARAM_INT);
            $stmt2->execute();
            
            $profileBGImageUpload = $stmt2->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            
            return $profileBGImageUpload;
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Upload Image Path ### */
function internalGetImagePath($id)
{
    $sql = "SELECT image_path FROM user_uploads WHERE id=:id ";
    try {
        if(strlen($id)>0)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id", $id,PDO::PARAM_INT);
            $stmt->execute();
            $internalGetImagePath = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return BASE_URL.UPLOAD_PATH.$internalGetImagePath[0]->image_path;
        }
        else
        {
            return '';
        }
        
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/**************************** FRIENDS Functions ***********************************/

/* ### Friend List ### .............................................*/
function welcomeFriends()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    $sql = "SELECT U.username,U.name, U.uid, U.bio, U.profile_pic FROM users U WHERE U.status=:status AND U.uid<>:uid AND verified='1'  ORDER BY RAND()  LIMIT 5 ";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $data->uid,PDO::PARAM_INT);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->execute();
            $welcomeFriends = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $welcomeFriendsCount=count($welcomeFriends);
            for($z=0;$z<$welcomeFriendsCount;$z++)
            {
                $welcomeFriends[$z]->role=internalFriendsCheck($data->uid,$welcomeFriends[$z]->uid);
                $welcomeFriends[$z]->profile_pic=profilePic($welcomeFriends[$z]->profile_pic);
                if(empty($welcomeFriends[$z]->name))
                {
                    $welcomeFriends[$z]->name=$welcomeFriends[$z]->username;
                }
            }
            
            $db = null;
            echo '{"welcomeFriends": ' . json_encode($welcomeFriends) . '}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}


/* ### Friend List ### */
function friendsList()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $page=$data->page;
    $rowsPerPage=$data->rowsPerPage;
    
    
    if($page)
    {
        //$page=$page+1;
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    $public_uid=$data->uid;
    $username=$data->username;
    
    /* Public Username Check */
    if($data->username)
    {
        $public_uid=internalUsernameDetails($data->username);
    }
    else
    {
        $public_uid=$data->uid;
    }
    
    $sql = "SELECT '' as status,U.username,U.name, U.uid,  U.profile_pic FROM users U, friends F WHERE U.status='1' AND U.uid=F.friend_two AND F.friend_one=:uid AND F.role='fri' ORDER BY F.friend_id DESC LIMIT $con";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $public_uid,PDO::PARAM_INT);
            $stmt->execute();
            $friendsList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $friendsListCount=count($friendsList);
            for($z=0;$z<$friendsListCount;$z++)
            {
                $friendsList[$z]->role=internalFriendsCheck($data->uid,$friendsList[$z]->uid);
                $friendsList[$z]->profile_pic=profilePic($friendsList[$z]->profile_pic);
                if(empty($friendsList[$z]->name))
                {
                    $friendsList[$z]->name=$friendsList[$z]->username;
                }
                
            }
            echo '{"friendsList": ' . json_encode($friendsList) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Friend List ### */
function publicFriendsList()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $page=$data->page;
    $rowsPerPage=$data->rowsPerPage;
    
    
    if($page)
    {
        //$page=$page+1;
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    $public_uid=$data->uid;
    $username=$data->username;
    
    /* Public Username Check */
    if($data->username)
    {
        $public_uid=internalUsernameDetails($data->username);
    }
    else
    {
        $public_uid=$data->uid;
    }
    
    $sql = "SELECT '' as status,U.username,U.name, U.uid,  U.profile_pic FROM users U, friends F WHERE U.status='1' AND U.uid=F.friend_two AND F.friend_one=:uid AND F.role='fri' ORDER BY F.friend_id DESC LIMIT $con";
    try {
        
        
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("uid", $public_uid,PDO::PARAM_INT);
        $stmt->execute();
        $friendsList = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $friendsListCount=count($friendsList);
        for($z=0;$z<$friendsListCount;$z++)
        {
            $friendsList[$z]->role=internalFriendsCheck($data->uid,$friendsList[$z]->uid);
            $friendsList[$z]->profile_pic=profilePic($friendsList[$z]->profile_pic);
            if(empty($friendsList[$z]->name))
            {
                $friendsList[$z]->name=$friendsList[$z]->username;
            }
            
        }
        echo '{"friendsList": ' . json_encode($friendsList) . '}';
        
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/* ### Friend List ### */
function followersList()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $page=$data->page;
    $rowsPerPage=$data->rowsPerPage;
    
    
    if($page)
    {
        //$page=$page+1;
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    $public_uid=$data->uid;
    $username=$data->username;
    
    /* Public Username Check */
    if($data->username)
    {
        $public_uid=internalUsernameDetails($data->username);
    }
    else
    {
        $public_uid=$data->uid;
    }
    
    $sql = "SELECT '' as status,U.username,U.name, U.uid,  U.profile_pic FROM users U, friends F WHERE U.status='1' AND U.uid=F.friend_one AND F.friend_two=:uid AND F.role='fri' ORDER BY F.friend_id DESC LIMIT $con";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $public_uid,PDO::PARAM_INT);
            $stmt->execute();
            $friendsList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $friendsListCount=count($friendsList);
            for($z=0;$z<$friendsListCount;$z++)
            {
                $friendsList[$z]->role=internalFriendsCheck($data->uid,$friendsList[$z]->uid);
                $friendsList[$z]->profile_pic=profilePic($friendsList[$z]->profile_pic);
                if(empty($friendsList[$z]->name))
                {
                    $friendsList[$z]->name=$friendsList[$z]->username;
                }
                
            }
            echo '{"followersList": ' . json_encode($friendsList) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/* ### Friend Valid Check ### */
function internalFriendsCheck($uid,$fid)
{
    $sql = "SELECT role FROM friends WHERE friend_one=:uid AND friend_two=:fid";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("uid", $uid);
        $stmt->bindParam("fid", $fid);
        $stmt->execute();
        $friendsCheck = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $friendsCheck[0]->role;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/* ### Add Follow Friend ### */
function addFriend()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $fid=$data->fid;
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token && $uid > 0)
        {
            
            $db = getDB();
            $role="fri";
            $time=time();
            $sql = "SELECT friend_id FROM friends WHERE friend_one=:uid AND friend_two=:fid AND role=:role";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("fid", $fid,PDO::PARAM_INT);
            $stmt->bindParam("role", $role,PDO::PARAM_STR);
            $stmt->execute();
            
            $count=$stmt->rowCount();
            if($count==0 && $uid>0 && $fid>0 && $uid!=$fid)
            {
                $sql1 ="INSERT INTO friends(friend_one,friend_two,role,created) VALUES (:uid,:fid,:role,:time)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->bindParam("fid", $fid,PDO::PARAM_INT);
                $stmt1->bindParam("role", $role,PDO::PARAM_STR);
                $stmt1->bindParam("time", $time);
                $stmt1->execute();
                $sql2="UPDATE users SET friend_count=friend_count+1 WHERE uid=:uid";
                $stmt2 = $db->prepare($sql2);
                $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt2->execute();
                
                $db = null;
                echo '{"friend": [{"status":"1"}]}';
                
                
                $mainUserDetails=internalUserDetails($uid);
                $mainUser=$mainUserDetails[0]->name;
                $mainUsername=$mainUserDetails[0]->username;
                
                $followUserDetails=internalUserDetails($fid);
                $to=$followUserDetails[0]->email;
                
                $followName=$followUserDetails[0]->name;
                $followUser=$followUserDetails[0]->username;
                $messageUid=$followUserDetails[0]->uid;
                $emailNotifications=$followUserDetails[0]->emailNotifications;
                $applicationName=SITE_NAME;
                if(SMTP_CONNECTION > 0 && $uid!=$fid && $emailNotifications > 0)
                {
                    $friendLink=BASE_URL.$mainUsername;
                    $subject =$mainUser.' is now following you on '.$applicationName;
                    $body="Hello ".$followName.",<br/> <br/>".$mainUser." is now following you on ".$applicationName.". <br/><br/><a href='".$friendLink."'>Profile Link</a><br/><br/>Support
                    <br/>".$applicationName."<br/>".BASE_URL."<br/><br/>
                    You are receiving this because you are subscribed to notifications on our website.
                    <a href='".BASE_URL."settings.php'>Edit your email alerts</a>";
                    
                    sendMail($to,$subject,$body);
                    
                }
                
                
                
            }
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* Remove Unfollow Friend */
function removeFriend()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $fid=$data->fid;
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $role="fri";
            $time=time();
            $sql = "SELECT friend_id FROM friends WHERE friend_one=:uid AND friend_two=:fid AND role=:role";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("fid", $fid,PDO::PARAM_INT);
            $stmt->bindParam("role", $role,PDO::PARAM_STR);
            $stmt->execute();
            
            $count=$stmt->rowCount();
            if($count==1)
            {
                $sql1 ="DELETE FROM friends WHERE friend_one=:uid AND friend_two=:fid";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->bindParam("fid", $fid,PDO::PARAM_INT);
                $stmt1->execute();
                $sql2="UPDATE users SET friend_count=friend_count-1 WHERE uid=:uid";
                $stmt2 = $db->prepare($sql2);
                $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt2->execute();
                
                $db = null;
                echo '{"friend": [{"status":"1"}]}';
            }
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/************************** Profile Functions ***********************/

/*Profile Views Create*/
function profileViewed()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $view_uid=internalUsernameDetails($data->public_username);
    
    if($uid != $view_uid && $uid>0 && $view_uid>0)
    {
        $sql = "SELECT uid_fk FROM profile_views WHERE uid_fk=:uid AND view_uid_fk=:view_uid";
        try {
            $key=md5(SITE_KEY.$data->uid);
            if($key==$data->token && $uid > 0)
            {
                $db = getDB();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->bindParam("view_uid", $view_uid,PDO::PARAM_INT);
                $stmt->execute();
                $count=$stmt->rowCount();
                
                if($count>0)
                {
                    $s1="UPDATE profile_views SET created=:time WHERE uid_fk=:uid AND view_uid_fk=:view_uid ORDER BY created DESC";
                    $stmt1 = $db->prepare($s1);
                    $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt1->bindParam("view_uid", $view_uid,PDO::PARAM_INT);
                    $time=time();
                    $stmt1->bindParam("time", $time);
                    $stmt1->execute();
                }
                else
                {
                    $s2="INSERT INTO profile_views (uid_fk,view_uid_fk,created) VALUES (:uid,:view_uid,:time)";
                    
                    $stmt2 = $db->prepare($s2);
                    $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                    $time=time();
                    $stmt2->bindParam("time", $time);
                    $stmt2->bindParam("view_uid", $view_uid,PDO::PARAM_INT);
                    $stmt2->execute();
                    
                }
                $db = null;
                echo '{"friend": [{"status":"1"}]}';
            }
            
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
}

/*Profile Views List*/
function profileViewedList()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $page=$data->page;
    $rowsPerPage=$data->rowsPerPage;
    
    if($page)
    {
        //$page=$page+1;
        $offset=($page-1)* $rowsPerPage;
        $con= $offset.",".$rowsPerPage;
    }
    
    if($data->username)
    {
        $public_uid=internalUsernameDetails($data->username);
    }
    else
    {
        $public_uid=$data->uid;
    }
    
    
    $sql = "SELECT U.uid,U.username,U.profile_pic,U.name FROM profile_views P,users U WHERE P.view_uid_fk=:uid AND P.uid_fk=U.uid AND U.status='1' ORDER BY P.created DESC LIMIT $con";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $public_uid,PDO::PARAM_INT);
            
            $stmt->execute();
            
            $profileViewedList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $count=$stmt->rowCount();
            for($z=0;$z<$count;$z++)
            {
                $profileViewedList[$z]->role=internalFriendsCheck($data->uid,$profileViewedList[$z]->uid);
                $profileViewedList[$z]->profile_pic=profilePic($profileViewedList[$z]->profile_pic);
                if(empty($profileViewedList[$z]->name))
                {
                    $profileViewedList[$z]->name=$profileViewedList[$z]->username;
                }
            }
            
            $db = null;
            echo '{"profileViewedList": ' . json_encode($profileViewedList) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/*Profile Views List*/
function publicProfileViewedList()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $page=$data->page;
    $rowsPerPage=$data->rowsPerPage;
    
    if($page)
    {
        //$page=$page+1;
        $offset=($page-1)* $rowsPerPage;
        $con= $offset.",".$rowsPerPage;
    }
    if($data->username)
    {
        $public_uid=internalUsernameDetails($data->username);
    }
    else
    {
        $public_uid=$data->uid;
    }
    
    
    $sql = "SELECT U.uid,U.username,U.profile_pic,U.name FROM profile_views P,users U WHERE P.view_uid_fk=:uid AND P.uid_fk=U.uid AND U.status='1' ORDER BY P.created DESC LIMIT $con";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("uid", $public_uid,PDO::PARAM_INT);
        
        $stmt->execute();
        
        $profileViewedList = $stmt->fetchAll(PDO::FETCH_OBJ);
        $count=count($profileViewedList);
        for($z=0;$z<$count;$z++)
        {
            $profileViewedList[$z]->role=internalFriendsCheck($data->uid,$profileViewedList[$z]->uid);
            $profileViewedList[$z]->profile_pic=profilePic($profileViewedList[$z]->profile_pic);
            if(empty($profileViewedList[$z]->name))
            {
                $profileViewedList[$z]->name=$profileViewedList[$z]->username;
            }
        }
        
        $db = null;
        echo '{"profileViewedList": ' . json_encode($profileViewedList) . '}';
        
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/**************************** CONVERSATION Functions *********************/



/* Conversation Create */
function internalConversationCreate($user_one,$message_user)
{
    /* Message user id */
    $user_two=internalUsernameDetails($message_user);
    try {
        $db = getDB();
        if($user_one!=$user_two)
        {
            if($user_one>0 && $user_two>0 )
            {
                $sql= "SELECT c_id FROM conversation WHERE (user_one=:user_one and user_two=:user_two) or (user_one=:user_two and user_two=:user_one)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("user_one", $user_one,PDO::PARAM_INT);
                $stmt->bindParam("user_two", $user_two,PDO::PARAM_INT);
                $stmt->execute();
                $conversation = $stmt->fetchAll(PDO::FETCH_OBJ);
                
                if(count($conversation)==0)
                {
                    $time=time();
                    $ip=$_SERVER['REMOTE_ADDR'];
                    $sql1 = "INSERT INTO conversation(user_one,user_two,ip,time) VALUES (:user_one,:user_two,:ip,:time)";
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam("user_one", $user_one,PDO::PARAM_INT);
                    $stmt1->bindParam("user_two", $user_two,PDO::PARAM_INT);
                    $stmt1->bindParam("ip", $ip);
                    $stmt1->bindParam("time", $time);
                    $stmt1->execute();
                    
                    $sql2="SELECT c_id FROM conversation WHERE user_one=:user_one ORDER BY c_id DESC LIMIT 1";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("user_one", $user_one,PDO::PARAM_INT);
                    $stmt2->execute();
                    $conversation2 = $stmt2->fetchAll(PDO::FETCH_OBJ);
                    return $conversation2[0]->c_id;
                }
                else
                {
                    return  $conversation[0]->c_id;
                }
                $db = null;
            }
        }
        
    }
    catch(PDOException $e)
    {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/*conversation Count Check*/
function conversationsNewCount()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql="SELECT conversation_count FROM users WHERE uid=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt->execute();
            $conversationCount = $stmt->fetchAll(PDO::FETCH_OBJ);
            $conversationsNewCount= $conversationCount[0]->conversation_count;
            echo '{"conversationsNewCount": [{"count":"'.$conversationsNewCount.'"}]}';
            
        }
    }
    catch(PDOException $e)
    {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}
/*Conversations*/
function conversationSingle($user_one,$conversation_uid)
{
    $sql = "SELECT u.uid,c.c_id,u.username,u.email,c.time
    FROM conversation c, users u
    WHERE CASE
    WHEN c.user_one = :user_one
    THEN c.user_two = u.uid
    WHEN c.user_two = :user_one
    THEN c.user_one= u.uid
    END
    AND (
    c.user_one =:user_one
    OR c.user_two =:user_one
    ) AND u.status='1' AND u.uid=:conversation_uid ";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_one", $uid,PDO::PARAM_INT);
        $stmt->bindParam("conversation_uid", $conversation_uid,PDO::PARAM_INT);
        
        $stmt->execute();
        
        $conversationSingle = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;
        echo '{"conversationSingle": ' . json_encode($conversationSingle) . '}';
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function conversationDelete()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $c_id=$data->cid;
    
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql = "SELECT c_id FROM conversation WHERE c_id = :c_id and (user_one=:uid or user_two=:uid)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("c_id", $c_id,PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count>0)
            {
                
                $sql1 = "SELECT read_status,user_id_fk FROM conversation_reply WHERE c_id_fk=:c_id  ORDER BY cr_id DESC LIMIT 1";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("c_id", $c_id,PDO::PARAM_INT);
                $stmt1->execute();
                $conversationRead = $stmt1->fetchAll(PDO::FETCH_OBJ);
                
                if($conversationRead[0]->read_status == 1 )
                {
                    $nuid=$conversationRead[0]->user_id_fk;
                    $sql2 = "SELECT if(user_one = :nuid,user_two,user_one) AS uid FROM conversation WHERE c_id = :c_id";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("c_id", $c_id,PDO::PARAM_INT);
                    $stmt2->bindParam("nuid", $nuid,PDO::PARAM_INT);
                    $stmt2->execute();
                    $conversation = $stmt2->fetchAll(PDO::FETCH_OBJ);
                    $o_uid=$conversation[0]->uid;
                    
                    $sql3 = "UPDATE users SET conversation_count=conversation_count-1 WHERE uid=:o_uid";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam("o_uid", $o_uid,PDO::PARAM_INT);
                    $stmt3->execute();
                    
                }
                
                $sql41 = "SELECT U.image_path,U.id FROM conversation_reply R, user_uploads U WHERE R.uploads=U.id AND R.c_id_fk =:c_id";
                $stmt41 = $db->prepare($sql41);
                $stmt41->bindParam("c_id", $c_id,PDO::PARAM_INT);
                $stmt41->execute();
                $uploadData = $stmt41->fetchAll(PDO::FETCH_OBJ);
                $uploadDataCount = $stmt41->rowCount();
                
                for($i=0; $i<$uploadDataCount; $i++)
                {
                    $upload_id=$uploadData[$i]->id;
                    $final_image="../".UPLOAD_PATH.$uploadData[$i]->image_path;
                    unlink($final_image);
                    $sql4 = "DELETE FROM `user_uploads` WHERE id =:upload_id";
                    $stmt4 = $db->prepare($sql4);
                    $stmt4->bindParam("upload_id", $upload_id,PDO::PARAM_INT);
                    $stmt4->execute();
                }
                
                $sql4 = "DELETE FROM `conversation_reply` WHERE c_id_fk =:c_id";
                $stmt4 = $db->prepare($sql4);
                $stmt4->bindParam("c_id", $c_id,PDO::PARAM_INT);
                $stmt4->execute();
                
                $sql5 = "DELETE FROM `conversation` WHERE c_id =:c_id";
                $stmt5 = $db->prepare($sql5);
                $stmt5->bindParam("c_id", $c_id,PDO::PARAM_INT);
                $stmt5->execute();
                
            }
            echo '{"conversationDelete": [{"status":"1"}]}';
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
    
    
}

/* Converstaions */
function conversations()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $last_time=$data->last_time;
    $conversation_uid=$data->conversation_uid;
    
    /* More Records*/
    $morequery="";
    if($last_time)
    {
        $morequery=" and c.time<'".$last_time."' ";
    }
    /* More Button End*/
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql = "SELECT DISTINCT u.uid,c.c_id,u.name,u.profile_pic,u.username,u.email,c.time
            FROM conversation c, users u, conversation_reply r
            WHERE CASE
            WHEN c.user_one = :user_one
            THEN c.user_two = u.uid
            WHEN c.user_two = :user_one
            THEN c.user_one= u.uid
            END
            AND (
            c.user_one =:user_one
            OR c.user_two =:user_one
            ) AND u.status=:status AND c.c_id=r.c_id_fk AND u.uid<>:conversation_uid
            $morequery ORDER BY c.time DESC LIMIT 15";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("user_one", $uid,PDO::PARAM_INT);
            $stmt->bindParam("conversation_uid", $conversation_uid);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->execute();
            $conversations = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $count=count($conversations);
            for($z=0;$z<$count;$z++)
            {
                /* TimeAgo */
                $n_time=$conversations[$z]->time;
                $conversations[$z]->timeAgo=date("c", $n_time);
                
                /*Username Check*/
                if(empty($conversations[$z]->name))
                {
                    $conversations[$z]->name=$conversations[$z]->username;
                    
                }
                /*ProfilePic Check*/
                $conversations[$z]->profile_pic=profilePic($conversations[$z]->profile_pic);
                $conversations[$z]->lastReply=internalConversationLast($conversations[$z]->c_id);
                
            }
            
            $db = null;
            echo '{"conversations": ' . json_encode($conversations) . '}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

function conversationReplyInsert()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $c_id=$data->c_id;
    $reply=$data->reply;
    $lat=$data->lat;
    $lang=$data->lang;
    $uploads=$data->uploads;
    $time=time();
    $ip=$_SERVER['REMOTE_ADDR'];
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token && $uid > 0 && $c_id > 0)
        {
            $db = getDB();
            $sql = "INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk,lat,lang,uploads) VALUES (:uid,:reply,:ip,:time,:c_id,:lat,:lang,:uploads)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("c_id", $c_id,PDO::PARAM_INT);
            $stmt->bindParam("reply", $reply,PDO::PARAM_STR);
            $stmt->bindParam("ip", $ip);
            $stmt->bindParam("time", $time);
            $stmt->bindParam("lat", $lat,PDO::PARAM_STR);
            $stmt->bindParam("lang", $lang,PDO::PARAM_STR);
            $stmt->bindParam("uploads", $uploads,PDO::PARAM_STR);
            $stmt->execute();
            
            $sql1 = "UPDATE conversation SET time='$time' WHERE c_id='$c_id'";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("c_id", $c_id,PDO::PARAM_INT);
            $stmt1->bindParam("time", $time);
            $stmt1->execute();
            
            $sql2 = "SELECT if(user_one = :uid,user_two,user_one) AS uid FROM conversation WHERE c_id = :c_id";
            $stmt2 = $db->prepare($sql2);
            $stmt2->bindParam("c_id", $c_id,PDO::PARAM_INT);
            $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt2->execute();
            $cUsers = $stmt2->fetchAll(PDO::FETCH_OBJ);
            $o_uid=$cUsers[0]->uid; /* Converstions Original User */
            if($o_uid!=$uid)
            {
                $sql3 = "SELECT read_status FROM conversation_reply WHERE c_id_fk=:c_id and user_id_fk=:uid ORDER BY cr_id DESC LIMIT 1,1";
                $stmt3 = $db->prepare($sql3);
                $stmt3->bindParam("c_id", $c_id,PDO::PARAM_INT);
                $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt3->execute();
                $cReply = $stmt3->fetchAll(PDO::FETCH_OBJ);
                if($cReply[0]->read_status==0 || $cReply[0]->read_status=='' )
                {
                    $sql4 = "UPDATE users SET conversation_count=conversation_count+1 WHERE uid=:o_uid";
                    $stmt4 = $db->prepare($sql4);
                    $stmt4->bindParam("o_uid", $o_uid,PDO::PARAM_INT);
                    $stmt4->execute();
                }
                
                $sql5 = "SELECT R.cr_id,R.time,R.reply,R.lat,R.lang,R.uploads,U.uid,U.username,U.email,U.name,U.profile_pic FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid and R.c_id_fk=:c_id ORDER BY R.cr_id DESC LIMIT 1";
                $stmt5 = $db->prepare($sql5);
                $stmt5->bindParam("c_id", $c_id,PDO::PARAM_INT);
                $stmt5->execute();
                $conversationReply = $stmt5->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                
                if($conversationReply){
                    
                    $conversationReply[0]->reply=htmlCode($conversationReply[0]->reply);
                    /* TimeAgo */
                    $n_time=$conversationReply[0]->time;
                    $conversationReply[0]->timeAgo=date("c", $n_time);
                    
                    /*Upload Image */
                    $uploadPaths=array();
                    
                    if($conversationReply[0]->uploads)
                    {
                        $s = explode(",", $conversationReply[0]->uploads);
                        $conversationReply[0]->uploadCount=count($s);
                        
                        /* Upload Paths */
                        foreach($s as $a)
                        {
                            array_push($uploadPaths,internalGetImagePath($a));
                        }
                        
                        $conversationReply[0]->uploadPaths=$uploadPaths;
                        
                    }
                    else
                    {
                        $conversationReply[0]->uploadCount='';
                        $conversationReply[0]->uploadPaths='';
                    }
                    
                    /*Username Check*/
                    if(empty($conversationReply[0]->name))
                    {
                        $conversationReply[0]->name=$conversationReply[0]->username;
                    }
                    /*ProfilePic Check*/
                    $profile_pic=profilePic($conversationReply[0]->profile_pic);
                    $conversationReply[0]->profile_pic=$profile_pic;
                }
                
                echo '{"conversationReply": ' . json_encode($conversationReply) . '}';
                
                if(SMTP_CONNECTION > 0 && ($cReply[0]->read_status==0 || $cReply[0]->read_status=='' ))
                {
                    
                    $mainUserData=internalUserDetails($uid);
                    $mailName=$mainUserData[0]->name;
                    $sentUsername=$mainUserData[0]->username;
                    
                    $conversationUserDetails=internalUserDetails($o_uid);
                    $to=$conversationUserDetails[0]->email;
                    $emailName=$conversationUserDetails[0]->name;
                    $messageUid=$conversationUserDetails[0]->uid;
                    $emailNotifications=$conversationUserDetails[0]->emailNotifications;
                    $applicationName=SITE_NAME;
                    
                    if($uid!=$messageUid && $emailNotifications > 0)
                    {
                        $messageLink=BASE_URL."messages/".$sentUsername;
                        $subject =$mailName.' messaged you on '.$applicationName;
                        $body="Hello ".$emailName.",<br/> <br/> ".$mailName." messaged you on ".$applicationName.".<br/><br/> <a href='".$messageLink."'>Reply</a><br/><br/>Support
                        <br/>".$applicationName.'<br/>'.BASE_URL.'<br/><br/>
                        You are receiving this because you are subscribed to notifications on our website.
                        <a href="'.BASE_URL.'settings.php">Edit your email alerts</a>';
                        
                        sendMail($to,$subject,$body);
                        
                    }
                    
                }
                
            }
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}

function internalConversationLast($c_id)
{
    
    try {
        
        if($c_id > 0)
        {
            $db = getDB();
            $sql = "SELECT R.reply,R.user_id_fk,R.read_status FROM conversation_reply R WHERE R.c_id_fk=:c_id ORDER BY R.cr_id DESC LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("c_id", $c_id, PDO::PARAM_INT);
            $stmt->execute();
            $conversationLastReply = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            $conversationLastReply->reply=htmlCode(nameFilter($conversationLastReply->reply, 15));
            return $conversationLastReply;
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}



/*Conversation Replies*/
function conversationReplies()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $last=$data->last;
    $message_user=$data->message_user;
    /* Conversation User ID */
    $conversation_uid=internalUsernameDetails($message_user);
    /* Conversation ID */
    
    if($conversation_uid != $uid)
    {
        $otherUserData=internalUserDetails($conversation_uid);
        $otherName=$otherUserData[0]->name;
    }
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $c_id=internalConversationCreate($uid,$message_user);
            
            $db = getDB();
            $sql = "SELECT R.cr_id, U.conversation_count FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid AND U.status='1' AND R.c_id_fk=:c_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("c_id", $c_id,PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            $second_count=$count-10;
            $squery='';
            
            if($second_count && $count>10)
            {
                $x_count=$second_count.',';
            }
            
            /* More Records*/
            $morequery="";
            if($last)
            {
                $morequery=" and R.cr_id<'".$last."' ";
                $x_count='';
            }
            
            $sql1 = "SELECT R.cr_id,R.time,R.reply,R.user_id_fk FROM conversation_reply R WHERE R.c_id_fk=:c_id ORDER BY R.cr_id DESC LIMIT 1";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam("c_id", $c_id,PDO::PARAM_INT);
            $stmt1->execute();
            $conversationData = $stmt1->fetchAll(PDO::FETCH_OBJ);
            $o_uid=$conversationData[0]->user_id_fk;
            
            
            if($conversation_uid)
            {
                if($o_uid!=$uid)
                {
                    
                    $sql2 = "UPDATE conversation_reply SET read_status='0' WHERE c_id_fk=:c_id ORDER BY cr_id DESC LIMIT 1";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("c_id", $c_id,PDO::PARAM_INT);
                    $stmt2->execute();
                    $sql3 = "SELECT conversation_count from users WHERE uid=:uid";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt3->execute();
                    $conversationCountData = $stmt3->fetchAll(PDO::FETCH_OBJ);
                    $conversation_count=$conversationCountData[0]->conversation_count;
                    
                    if($conversation_count>0)
                    {
                        $sql4 = "UPDATE users SET conversation_count=conversation_count-1 WHERE uid=:uid";
                        $stmt4 = $db->prepare($sql4);
                        $stmt4->bindParam("uid", $uid, PDO::PARAM_INT);
                        $stmt4->execute();
                    }
                }
            }
            
            $sql5 = "SELECT R.c_id_fk,R.cr_id,R.time,R.reply,R.lat,R.lang,R.uploads,U.uid,U.username,U.name,U.profile_pic,U.conversation_count FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid and R.c_id_fk=:c_id $morequery ORDER BY R.cr_id ASC LIMIT $x_count 10";
            $stmt5 = $db->prepare($sql5);
            $stmt5->bindParam("c_id", $c_id,PDO::PARAM_INT);
            $stmt5->execute();
            $conversationReplies = $stmt5->fetchAll(PDO::FETCH_OBJ);
            if(count($conversationReplies))
            {
                
                for($z=0;$z<count($conversationReplies);$z++)
                {
                    /* TimeAgo */
                    $n_time=$conversationReplies[$z]->time;
                    $conversationReplies[$z]->timeAgo=date("c", $n_time);
                    $conversationReplies[$z]->message=ucfirst($conversationReplies[$z]->reply);
                    
                    $conversationReplies[$z]->reply=htmlCode($conversationReplies[$z]->reply);
                    /*Username Check*/
                    if(empty($conversationReplies[$z]->name))
                    {
                        $conversationReplies[$z]->name=$conversationReplies[$z]->username;
                    }
                    
                    /*Upload Image */
                    $uploadPaths=array();
                    
                    if($conversationReplies[$z]->uploads)
                    {
                        $s = explode(",", $conversationReplies[$z]->uploads);
                        $conversationReplies[$z]->uploadCount=count($s);
                        
                        /* Upload Paths */
                        foreach($s as $a)
                        {
                            array_push($uploadPaths,internalGetImagePath($a));
                        }
                        
                        $conversationReplies[$z]->uploadPaths=$uploadPaths;
                        
                    }
                    else
                    {
                        $conversationReplies[$z]->uploadCount='';
                        $conversationReplies[$z]->uploadPaths='';
                    }
                    /*ProfilePic Check*/
                    $profile_pic=profilePic($conversationReplies[$z]->profile_pic);
                    $conversationReplies[$z]->profile_pic=$profile_pic;
                    $conversationReplies[$z]->otherName=$otherName;
                }
                echo '{"conversationReplies": ' . json_encode($conversationReplies) . '}';
            }
            else
            {
                echo '{"conversationReplies": [{"c_id_fk":"'.$c_id.'","otherName":"'.$otherName.'"}]}';
            }
            $db = null;
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/********************************* ADMIN Configurations *****************************/



/* Advertisments*/
function advertisements()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    $sql = "SELECT a_title,a_desc,a_url,a_img,ad_code,ad_type FROM advertisments WHERE status='1' ORDER BY a_id DESC";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->execute();
            $advertisements = $stmt->fetchAll(PDO::FETCH_OBJ);
            $advertisementsCount=$stmt->rowCount();
            $db = null;
            for($z=0; $z<$advertisementsCount; $z++)
            {
                $advertisements[$z]->a_img=BASE_URL.UPLOAD_PATH.$advertisements[$z]->a_img;
            }
            
            echo '{"advertisements": ' . json_encode($advertisements) . '}';
            
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}





/********************************* GROUP Functions *****************************/

/* Create Group */
function createGroup()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $group_name=$data->groupName;
    $group_desc=$data->groupDesc;
    
    try {
        $key=md5(SITE_KEY.$uid);
        if($key==$data->token && $uid > 0 )
        {
            $db = getDB();
            $sql="SELECT group_id FROM groups WHERE group_name=:group_name ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("group_name", $group_name,PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==0)
            {
                $time=time();
                $ip=$_SERVER['REMOTE_ADDR'];
                
                $sql1="INSERT INTO groups(group_name,group_desc,uid_fk,group_created,group_ip) VALUES (:group_name,:group_desc,:uid,:time,:ip)";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("group_name", $group_name,PDO::PARAM_STR);
                $stmt1->bindParam("group_desc", $group_desc,PDO::PARAM_STR);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->bindParam("time", $time);
                $stmt1->bindParam("ip", $ip);
                $stmt1->execute();
                
                $sql2="SELECT group_id FROM groups WHERE uid_fk=:uid ORDER BY group_id DESC LIMIT 1";
                $stmt2 = $db->prepare($sql2);
                $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt2->execute();
                $groupDetails = $stmt2->fetchAll(PDO::FETCH_OBJ);
                $group_id=$groupDetails[0]->group_id;
                if($group_id)
                {
                    
                    $sql3="INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES (:uid,:group_id,:time)";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt3->bindParam("group_id", $group_id,PDO::PARAM_INT);
                    $stmt3->bindParam("time", $time);
                    $stmt3->execute();
                    
                    $sql4="UPDATE groups SET group_count=group_count+1 WHERE group_id=:group_id";
                    $stmt4 = $db->prepare($sql4);
                    $stmt4->bindParam("group_id", $group_id,PDO::PARAM_INT);
                    $stmt4->execute();
                    
                    $sql5="UPDATE users SET group_count=group_count+1 WHERE uid=:uid";
                    $stmt5 = $db->prepare($sql5);
                    $stmt5->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt5->execute();
                    
                }
                
                
                echo '{"group": [{"groupID":"'.$group_id.'"}]}';
            }
            else
            {
                echo '{"group": [{"groupID":"0"}]}';
            }
            
        }
        $db = null;
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* Group Details*/
function groupDetails()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $group_id=$data->group_id;
    $uid=$data->uid;
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql = "SELECT group_id,group_name,uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position FROM groups WHERE group_id=:groupid AND status=:status";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("groupid", $group_id,PDO::PARAM_INT);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->execute();
            
            $groupDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            if($groupDetails){
                $groupDetails[0]->group_pic=groupPic($groupDetails[0]->group_pic);
                $groupDetails[0]->group_bg=backgroundPic($groupDetails[0]->group_bg);
                $groupDetails[0]->groupStatus=internalGroupStatusCheck($data->uid, $data->group_id);
                $groupDetails[0]->groupCheck=internalGroupCheck($uid,$group_id);
                $groupDetails[0]->group_desc = nameFilter(htmlCode($groupDetails[0]->group_desc),60);
                $db = null;
                echo '{"groupDetails": ' . json_encode($groupDetails) . '}';
            }
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* Internal Group Details*/
function internalGroupDetails($groupid)
{
    
    $sql = "SELECT group_id,group_name,uid_fk as group_owner_id,group_created,group_desc,group_pic,group_bg,group_count,group_updates,group_bg_position FROM groups WHERE group_id=:groupid AND status=:status";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("groupid", $groupid,PDO::PARAM_INT);
        $status='1';
        $stmt->bindParam("status", $status);
        $stmt->execute();
        $groupDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($groupDetails[0]->group_pic || $groupDetails[0]->group_bg)
        {
            $groupDetails[0]->group_pic=groupPic($groupDetails[0]->group_pic);
            $groupDetails[0]->group_bg=backgroundPic($groupDetails[0]->group_bg);
        }
        return $groupDetails;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}


/* Internal Group Owner*/
function internalGroupOwner($groupid)
{
    
    $sql = "SELECT uid_fk  FROM groups WHERE group_id=:groupid AND status=:status";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("groupid", $groupid,PDO::PARAM_INT);
        $status='1';
        $stmt->bindParam("status", $status);
        $stmt->execute();
        $groupDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        return $groupDetails[0]->uid_fk;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}



/* Group Check*/
function internalGroupStatusCheck($uid,$groupid)
{
    $sql = "SELECT status FROM group_users WHERE group_id_fk=:groupid AND uid_fk=:uid";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("groupid", $groupid,PDO::PARAM_INT);
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
        $stmt->execute();
        $groupStatusCheck = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $groupStatusCheck;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/*Group Followers*/
function groupFollowers()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $group_id=$data->group_id;
    $page=$data->page;
    $session_id=$data->uid;
    
    $rowsPerPage=$data->rowsPerPage;
    
    if($page)
    {
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    $sql = "SELECT U.username,U.bio, U.uid, G.status,U.name, U.profile_pic FROM users U, group_users G WHERE U.status=:status AND U.uid=G.uid_fk AND G.group_id_fk=:group_id ORDER BY G.group_user_id DESC LIMIT $con";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $stmt = $db->prepare($sql);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $groupFollowers = $stmt->fetchAll(PDO::FETCH_OBJ);
            $groupFollowersCount=count($groupFollowers);
            $db = null;
            for($z=0;$z<$groupFollowersCount;$z++)
            {
                $groupFollowers[$z]->role=internalFriendsCheck($session_id,$groupFollowers[$z]->uid);
                $groupFollowers[$z]->profile_pic=profilePic($groupFollowers[$z]->profile_pic);
                if(empty($groupFollowers[$z]->name))
                {
                    $groupFollowers[$z]->name=$groupFollowers[$z]->username;
                }
            }
            
            
            echo '{"groupFollowers": ' . json_encode($groupFollowers) . '}';
        }
        
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/*Group Valid Check*/
function groupEditCheck()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $group_id=$data->group_id;
    $uid=$data->uid;
    
    $sql = "SELECT group_id FROM groups WHERE uid_fk=:uid AND group_id=:group_id";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $groupEditCheck = $stmt->rowCount();
            
            $groupDetails=internalGroupDetails($group_id);
            
            $db = null;
            
            
            $groupDetails[0]->editCheck=$groupEditCheck;
            
            
            echo '{"groupEditCheck": ' . json_encode($groupDetails) . '}';
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/*Group Valid Check*/
function internalGroupCheck($uid,$group_id)
{
    $sql = "SELECT group_user_id FROM group_users WHERE uid_fk=:uid AND group_id_fk=:group_id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
        $stmt->execute();
        $groupCheck = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        return $groupCheck[0]->group_user_id;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* Group Photos List */
function groupPhotosList()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $page=$data->page;
    
    $rowsPerPage=$data->rowsPerPage;
    $group_id=$data->group_id;
    
    if($page)
    {
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    $sql = "SELECT id,image_path,uid_fk as uid FROM user_uploads WHERE  group_id_fk=:group_id ORDER BY id DESC LIMIT $con";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $groupPhotosList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $groupPhotosListCount=count($groupPhotosList);
            
            for($z=0;$z<$groupPhotosListCount;$z++)
            {
                $groupPhotosList[$z]->image_path=BASE_URL.UPLOAD_PATH.$groupPhotosList[$z]->image_path;
                $groupPhotosList[$z]->group_owner_id=internalGroupOwner($group_id);
            }
            
            $db = null;
            echo '{"groupPhotosList": ' . json_encode($groupPhotosList) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/*Group Photos count*/
function groupPhotosCheckCount($uid,$group_id)
{
    
    
    try {
        $db = getDB();
        $sql = "SELECT id FROM user_uploads WHERE uid_fk=:uid and group_id_fk=:group_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
        $stmt->execute();
        $count=$stmt->rowCount();
        $groupPhotosCheckCount = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db = null;
        echo '{"groupPhotosCheckCount": ' . json_encode($count) . '}';
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}

/*Group Valid Check
function groupFollowerCheck($uid,$group_id)
{

$sql = "SELECT F.uid_fk FROM groups G,group_users F WHERE G.group_id=F.group_id_fk AND F.uid_fk=:uid AND F.group_id_fk=:group_id";
try {
$db = getDB();
$stmt = $db->prepare($sql);
$stmt->bindParam("uid", $uid, PDO::PARAM_INT);
$stmt->bindParam("group_id", $group_id);
$stmt->execute();
$groupFollowerCheck = $stmt->fetchAll(PDO::FETCH_OBJ);
$db = null;
echo '{"groupFollowerCheck": ' . json_encode($groupFollowerCheck) . '}';


} catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

}
*/
/*Group count
function groupCheckCount($uid,$group_id)
{

$sql = "SELECT group_user_id FROM group_users WHERE uid_fk=:uid AND group_id_fk=:group_id AND status=:status";
try {
$db = getDB();
$stmt = $db->prepare($sql);
$stmt->bindParam("uid", $uid, PDO::PARAM_INT);
$stmt->bindParam("group_id", $group_id);
$status='1';
$stmt->bindParam("status", $status);
$stmt->execute();
$count=$stmt->rowCount();
$db = null;
echo '{"groupCheckCount": ' . json_encode($count) . '}';


} catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}


$query=mysqli_query($this->db,"SELECT group_user_id FROM group_users WHERE uid_fk=:uid AND group_id_fk='$group_id' AND status='1'") or die(mysqli_error($this->db));
$num=mysqli_num_rows($query);
return $num;
}

*/


/*Group Updates
function groupUpdates()
{

$request = \Slim\Slim::getInstance()->request();
$update = json_decode($request->getBody());
$lastid=$data->lastid;
$moreCheck=$data->moreCheck;
$perpage=$data->perpage;
$group_id=$data->group_id;


if($moreCheck)
{
$perpage=$perpage+1;
}


$morequery="";
if($lastid)
{
$morequery=" and M.created<'".$lastid."' ";
}


$sql = "SELECT
DISTINCT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
FROM messages M, users U, group_users G
WHERE U.status=:status AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status=:status AND M.group_id_fk=:group_id $morequery ORDER BY created DESC LIMIT $perpage";
try {
$db = getDB();
$stmt = $db->prepare($sql);
$status="1";
$stmt->bindParam("status", $status);
$stmt->bindParam("group_id", $group_id);
$stmt->execute();

$db = null;


if($moreCheck)
{
$data=$stmt->rowCount();
}
else
{
$data = $stmt->fetchAll(PDO::FETCH_OBJ);
}
echo '{"groupUpdates": ' . json_encode($data) . '}';


} catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

}
*/


/*Group Add Friend */
function groupAdd()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $group_id=$data->group_id;
    
    try {
        
        $key=md5(SITE_KEY.$uid);
        
        if($key==$data->token && $uid > 0)
        {
            
            $db = getDB();
            $sql="SELECT group_user_id FROM group_users WHERE uid_fk=:uid AND group_id_fk=:group_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            
            if($count==0)
            {
                $s1="INSERT INTO group_users(uid_fk,group_id_fk,created) VALUES (:uid,:group_id,:time)";
                $stmt1 = $db->prepare($s1);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $time=time();
                $stmt1->bindParam("time", $time);
                $stmt1->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt1->execute();
                
                $s2="UPDATE groups SET group_count=group_count+1 WHERE group_id=:group_id";
                $stmt2 = $db->prepare($s2);
                $stmt2->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt2->execute();
                
                $s3="UPDATE users SET group_count=group_count+1 WHERE uid=:uid";
                $stmt3 = $db->prepare($s3);
                $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt3->execute();
                
                echo '{"group": [{"groupID":"'.$group_id.'"}]}';
            }
            $db = null;
            
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}



/*Group Remove Friend*/
function groupRemove()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $group_id=$data->group_id;
    
    $sql="SELECT group_user_id FROM group_users WHERE uid_fk=:uid AND group_id_fk=:group_id";
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            {
                
                $s1="DELETE FROM group_users WHERE uid_fk=:uid AND group_id_fk=:group_id";
                $stmt1 = $db->prepare($s1);
                $stmt1->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->execute();
                
                $s2="UPDATE groups SET group_count=group_count-1 WHERE group_id=:group_id";
                $stmt2 = $db->prepare($s2);
                $stmt2->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt2->execute();
                
                $s3="UPDATE users SET group_count=group_count-1 WHERE uid=:uid";
                $stmt3 = $db->prepare($s3);
                $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt3->execute();
                
                
                echo '{"group": [{"groupID":"'.$group_id.'"}]}';
                
            }
            $db = null;
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/*Group Save/Update */
function groupUpdate()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $group_id=$data->group_id;
    $group_name=$data->name;
    $group_desc=$data->desc;
    
    
    $sql = "UPDATE groups SET group_name=:group_name,group_desc=:group_desc WHERE group_id=:group_id and uid_fk=:uid";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token && strlen($group_name)>0 && strlen($group_desc))
        {
            
            $db = getDB();
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam("group_name", $group_name,PDO::PARAM_STR);
            $stmt->bindParam("group_desc", $group_desc,PDO::PARAM_STR);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"group": [{"groupID":"'.$group_id.'"}]}';
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/*Group Delete */
function groupDelete()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $group_id=$data->group_id;
    
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $sql="SELECT group_id FROM groups WHERE uid_fk=:uid AND group_id=:group_id";
            
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count==1)
            {
                
                $s1="DELETE FROM messages WHERE group_id_fk=:group_id";
                $stmt1 = $db->prepare($s1);
                $stmt1->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt1->execute();
                
                $s2="DELETE FROM group_users WHERE group_id_fk=:group_id";
                $stmt2 = $db->prepare($s2);
                $stmt2->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt2->execute();
                
                $s3="DELETE FROM user_uploads WHERE group_id_fk=:group_id";
                $stmt3 = $db->prepare($s3);
                $stmt3->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt3->execute();
                
                $s4="DELETE FROM groups WHERE group_id=:group_id";
                $stmt4 = $db->prepare($s4);
                $stmt4->bindParam("group_id", $group_id,PDO::PARAM_INT);
                $stmt4->execute();
                
                echo '{"group": [{"status":"1"}]}';
                
            }
            $db = null;
            
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/*Group List*/
function groupsList()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    
    $page=$data->page;
    
    $rowsPerPage=$data->rowsPerPage;
    //$otherGroups=$data->otherGroups;
    $otherGroups=0;
    
    if($page)
    {
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    /* Public Username Check */
    if($data->username)
    {
        $uid=internalUsernameDetails($data->username);
    }
    else
    {
        $uid=$data->uid;
    }
    
    
    if($otherGroups)
    {
        $sql="SELECT DISTINCT G.group_id, G.uid_fk as group_owner_id, G.group_name, G.group_pic, G.group_desc FROM groups G WHERE G.status='1' AND G.group_id<>:otherGroups ORDER BY RAND() DESC LIMIT $con";
    }
    else
    {
        $sql="SELECT DISTINCT G.group_id, G.uid_fk as group_owner_id, G.group_name, G.group_pic,G.group_bg, G.group_desc FROM groups G, group_users F WHERE G.status='1' AND F.status='1' AND G.group_id=F.group_id_fk AND F.uid_fk=:uid ORDER BY F.created DESC LIMIT $con";
    }
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $status=time();
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $groupsList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            
            $groupsListCount=count($groupsList);
            
            for($z=0;$z<$groupsListCount;$z++)
            {
                $groupsList[$z]->group_desc=nameFilter(htmlCode($groupsList[$z]->group_desc),60);
                $groupsList[$z]->group_pic=groupPic($groupsList[$z]->group_pic);
                $groupsList[$z]->groupCheck=internalGroupCheck($data->uid,$groupsList[$z]->group_id);
                $groupsList[$z]->group_bg=backgroundPic($groupsList[$z]->group_bg);
            }
            
            echo '{"groupsList": ' . json_encode($groupsList) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}


/*Public Group List*/
function publicGroupsList()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    $page=$data->page;
    $rowsPerPage=$data->rowsPerPage;
    //$otherGroups=$data->otherGroups;
    $otherGroups=0;
    
    if($page)
    {
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    /* Public Username Check */
    if($data->username)
    {
        $uid=internalUsernameDetails($data->username);
    }
    else
    {
        $uid=$data->uid;
    }
    
    if($otherGroups)
    {
        $sql="SELECT DISTINCT G.group_id, G.uid_fk as group_owner_id, G.group_name, G.group_pic, G.group_desc FROM groups G WHERE G.status='1' AND G.group_id<>:otherGroups ORDER BY RAND() DESC LIMIT $con";
    }
    else
    {
        $sql="SELECT DISTINCT G.group_id, G.uid_fk as group_owner_id, G.group_name, G.group_pic,G.group_bg, G.group_desc FROM groups G, group_users F WHERE G.status='1' AND F.status='1' AND G.group_id=F.group_id_fk AND F.uid_fk=:uid ORDER BY F.created DESC LIMIT $con";
    }
    
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $status=time();
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
        $stmt->execute();
        $groupsList = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $groupsListCount=count($groupsList);
        for($z=0;$z<$groupsListCount;$z++)
        {
            $groupsList[$z]->group_desc=nameFilter(htmlCode($groupsList[$z]->group_desc),60);
            $groupsList[$z]->group_pic=groupPic($groupsList[$z]->group_pic);
            $groupsList[$z]->groupCheck=internalGroupCheck($data->uid,$groupsList[$z]->group_id);
            $groupsList[$z]->group_bg=backgroundPic($groupsList[$z]->group_bg);
        }
        echo '{"groupsList": ' . json_encode($groupsList) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/************************* PHOTOS Functions *************************************/
/* Webcam Image Create */
function webcamImageCreate()
{
    $request = \Slim\Slim::getInstance()->request();
    $x = $request->post();
    $uid=$_POST['uid'];
    $token=$_POST['token'];
    $group_id=$_POST['group_id'];
    try
    {
        $key=md5(SITE_KEY.$uid);
        if($key==$token)
        {
            $invalid = "iVBORw0KGgoAAAANSUhEUgAAAUAAAADwCAYAAABxLb1rAAAG+UlEQVR4Xu3UgREAIAgDMdl/aPFc48MGTbnOfXccAQIEggJjAIOti0yAwBcwgB6BAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToCAAfQDBAhkBQxgtnrBCRAwgH6AAIGsgAHMVi84AQIG0A8QIJAVMIDZ6gUnQMAA+gECBLICBjBbveAECBhAP0CAQFbAAGarF5wAAQPoBwgQyAoYwGz1ghMgYAD9AAECWQEDmK1ecAIEDKAfIEAgK2AAs9ULToDAAoCVvV4Lh4uLAAAAAElFTkSuQmCC";
            
            
            if ($_POST['type'] == "pixel")
            {
                $image = $_POST['image'];
                $filter_image = str_replace("data:image/png;base64,", "", $image);
                // input is in format 1,2,3...|1,2,3...|...
                if($filter_image == $invalid)
                {
                    $im = "";
                    echo "false";
                }
                else
                {
                    $im = imagecreatetruecolor(320, 240);
                    foreach (explode("|", $_POST['image']) as $y => $csv) {
                        foreach (explode(";", $csv) as $x => $color) {
                            imagesetpixel($im, $x, $y, $color);
                        }
                    }
                }
            } else {
                // input is in format: data:image/png;base64,...
                $image = $_POST['image'];
                $filter_image = str_replace("data:image/png;base64,", "", $image);
                if($filter_image == $invalid)
                {
                    $im = "";
                    echo "false";
                }
                else
                    $im = imagecreatefrompng($_POST['image']);
            }
            
            if($im)
            {
                
                $filename=time().$uid.".jpg";
                if(empty($conversationImage))
                {
                    $conversationImage='';
                }
                internalImageUpload($uid,$filename,$group_id,$conversationImage);
                //imagejpeg($im);
                
                $upload_path='../'.UPLOAD_PATH;
                imagejpeg($im, $upload_path.$filename);
                $imageID=internalGetUploadImage($uid,$filename);
                $fullImagePath=BASE_URL.UPLOAD_PATH.$filename;
                //echo '{"webcam": [{"imageName":"'.$fullImagePath.'", "imageID":"'.$imageID[0]->id.'" }]}';
                imagedestroy($im);
                echo "<img src='".$fullImagePath."'  class='webcam_preview' id='".$imageID[0]->id."'/>";
            }
            
            
        }
        
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getWebcamImage()
{
    
}

/*Save background position*/
function saveBGPosition()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $type=$data->type;
    $position=$data->position;
    $group_id=$data->group_id;
    try {
        $key=md5(SITE_KEY.$uid);
        if($key==$data->token)
        {
            $db = getDB();
            if($type=='u')
            {
                
                $sql="UPDATE users SET profile_bg_position=:position WHERE uid=:uid";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->bindParam("position", $position, PDO::PARAM_STR);
                $stmt->execute();
                echo '{"saveBGPosition": [{"status":"1"}]}';
                
            }
            else
            {
                $sql1="SELECT group_id FROM groups WHERE group_id=:group_id AND uid_fk=:uid";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->bindParam("group_id", $group_id);
                $stmt1->execute();
                $num=$stmt1->rowCount();
                if($num>0)
                {
                    $sql2="UPDATE groups SET group_bg_position=:position WHERE group_id=:group_id AND uid_fk=:uid";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt2->bindParam("group_id", $group_id);
                    $stmt2->bindParam("position", $position);
                    $stmt2->execute();
                    echo '{"saveBGPosition": [{"status":"1"}]}';
                }
            }
            $db = null;
            
        }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* ### Profile Image Upload ### */
function profileImageUpload()
{
    $request = \Slim\Slim::getInstance()->request();
    $x = $request->post();
    $bgSave='';
    try
    {
        $uid=$_POST['uid'];
        $user_token=$_POST['user_token'];
        $key=md5(SITE_KEY.$uid);
        if($key == $user_token)
        {
            $upload_path='../'.UPLOAD_PATH;
            
            $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
            $group_id=$_POST['groupID'];
            $imageType=$_POST['imageType'];
            
            if(empty($group_id))
            {
                $group_id='';
            }
            $v='';
            $i=1;
            
            if(strlen($_FILES['photoimg']['name']) && $uid > 0)
            {
                $filename = stripslashes($_FILES['photoimg']['name']);
                $size=filesize($_FILES['photoimg']['tmp_name']);
                //get the extension of the file in a lower case format
                $ext = getExtension($filename);
                $ext = strtolower($ext);
                if(in_array($ext,$valid_formats))
                {
                    $configurations=configurations();
                    $uploadImage=$configurations[0]->uploadImage;
                    //$uploadImageSize;
                    if($size<(1024*$uploadImage))
                    {
                        
                        if($imageType)
                        {
                            $actual_image_name = 'user'.$uid.'_'.time().$i.".".$ext;
                            $newwidth=$configurations[0]->profileWidth;
                        }
                        else
                        {
                            $actual_image_name = 'bg'.$uid.'_'.time().$i.".".$ext;
                            $newwidth=$configurations[0]->bannerWidth;
                        }
                        $uploadedfile=$_FILES['photoimg']['tmp_name'];
                        $filename=compressImage($ext,$uploadedfile,$upload_path,$actual_image_name,$newwidth);
                        //if(move_uploaded_file($_FILES['photoimg']['tmp_name'], $upload_path.$actual_image_name))
                        if($filename)
                        {
                            
                            if($imageType)
                            {
                                if($group_id)
                                $newdata=internalGroupPicUpload($uid,$actual_image_name,$group_id);
                                else
                                    $newdata=internalProfilePicUpload($uid,$actual_image_name);
                                
                            }
                            else{
                                
                                if($group_id)
                                {
                                    $newdata=internalGroupBackgroundUpload($uid,$actual_image_name,$group_id);
                                    $bgSave='<div id="g" class="bgSave wallbutton " >Save Cover</div>';
                                }
                                else
                                {
                                    $newdata=internalProfileBackgroundUpload($uid,$actual_image_name);
                                    $bgSave='<div id="u" class="bgSave wallbutton" >Save Cover</div>';
                                }
                                
                            }
                            if($newdata)
                            {
                                if($imageType)
                                echo '<img src="'.BASE_URL.UPLOAD_PATH.$actual_image_name.'"   alt="people" class="profilePic" />';
                                else
                                    echo $bgSave.'<img src="'.BASE_URL.UPLOAD_PATH.$actual_image_name.'"   alt="cover" id="profileBG" class="profileBG headerimage ui-corner-all" />';
                            }
                        }
                        else
                        {
                            echo "Fail upload fail.";
                        }
                    }
                    else
                    {
                        echo '<span class="imgList">You have exceeded the size limit!</span>';
                        
                    }
                    
                }
                else
                {
                    echo '<span class="imgList">Unknown extension!</span>';
                }
                $i=$i+1;
            }
        }
        
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* ### Feed Image Upload ### */
function feedImageUpload()
{
    $request = \Slim\Slim::getInstance()->request();
    $x = $request->post();
    
    
    try
    {
        $uploadUid=$_POST['update_uid'];
        $token=$_POST['update_token'];
        $key=md5(SITE_KEY.$uploadUid);
        
        
        if($key==$token)
        {
            $upload_path='../'.UPLOAD_PATH;
            $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
            $group_id=$_POST['group_id'];
            $conversationImage=$_POST['conversationImage'];
            if(empty($group_id))
            {
                $group_id='';
            }
            if(empty($conversationImage))
            {
                $conversationImage='';
            }
            
            $v='';
            $i=1;
            
            $user_id=(string)$x['update_uid'];
            if($user_id > 0)
            {
                foreach ($_FILES['photos']['name'] as $name => $value)
                {
                    $filename = stripslashes($_FILES['photos']['name'][$name]);
                    $size=filesize($_FILES['photos']['tmp_name'][$name]);
                    //get the extension of the file in a lower case format
                    $ext = getExtension($filename);
                    $ext = strtolower($ext);
                    if(in_array($ext,$valid_formats))
                    {
                        $configurations=configurations();
                        $uploadImage=$configurations[0]->uploadImage;
                        //$uploadImageSize;
                        if($size<(1024*$uploadImage))
                        {
                            
                            $actual_image_name = 'user'.$user_id.'_'.time().$i.".".$ext;
                            $uploadedfile=$_FILES['photos']['tmp_name'][$name];
                            $newwidth=$configurations[0]->upload;
                            $filename=compressImage($ext,$uploadedfile,$upload_path,$actual_image_name,$newwidth);
                            //if(move_uploaded_file($_FILES['photos']['tmp_name'][$name], $upload_path.$actual_image_name))
                            if($filename)
                            {
                                internalImageUpload($user_id,$actual_image_name,$group_id,$conversationImage);
                                $newdata=internalGetUploadImage($uid,$actual_image_name);
                                
                                if($newdata)
                                {
                                    if(empty($v))
                                    $v=$newdata[0]->id;
                                    else
                                        $v=$v.','.$newdata[0]->id;
                                    
                                    echo '<img src="'.BASE_URL.UPLOAD_PATH.$actual_image_name.'"  class="preview" id="'.$v.'"/>';
                                }
                            }
                            else
                            {
                                echo "Fail upload fail.";
                            }
                            
                        }
                        else
                        {
                            echo '<span class="imgList">You have exceeded the size limit!</span>';
                            
                        }
                    }
                    else
                    {
                        echo '<span class="imgList">Unknown extension!</span>';
                    }
                    $i=$i+1;
                }
            }
            
            
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/* ### Comment Upload ### */
function commentUpload()
{
    $request = \Slim\Slim::getInstance()->request();
    $x = $request->post();
    
    try
    {
        $uid=$_POST['uid'];
        $token=$_POST['user_token'];
        $key=md5(SITE_KEY.$uid);
        if($key == $token)
        {
            
            $upload_path='../'.UPLOAD_PATH;
            
            $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
            $imageType=$_POST['imageType'];
            
            
            
            
            if(strlen($_FILES['photoimg']['name']) && $uid > 0)
            {
                $filename = stripslashes($_FILES['photoimg']['name']);
                $size=filesize($_FILES['photoimg']['tmp_name']);
                //get the extension of the file in a lower case format
                $ext = getExtension($filename);
                $ext = strtolower($ext);
                if(in_array($ext,$valid_formats))
                {
                    
                    $configurations=configurations();
                    $uploadImage=$configurations[0]->uploadImage;
                    //$uploadImageSize;
                    if($size<(1024*$uploadImage))
                    {
                        $actual_image_name = 'comment'.$uid.'_'.time().$i.".".$ext;
                        $uploadedfile=$_FILES['photoimg']['tmp_name'];
                        $newwidth=$configurations[0]->profileWidth;
                        $filename=compressImage($ext,$uploadedfile,$upload_path,$actual_image_name,$newwidth);
                        
                        if($filename)
                        {
                            $newdata=internalCommentUpload($uid,$actual_image_name);
                            if($newdata)
                            {
                                $id=$newdata[0]->id;
                                echo '<img src="'.BASE_URL.UPLOAD_PATH.$actual_image_name.'"   class="commentPreview" id="'.$id.'"/>';
                            }
                        }
                        else
                        {
                            echo "Fail upload fail.";
                        }
                    }
                    else
                    {
                        echo '<span class="imgList">You have exceeded the size limit!</span>';
                        
                    }
                    
                }
                else
                {
                    echo '<span class="imgList">Unknown extension!</span>';
                }
                $i=$i+1;
            }
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/*User Photos List*/
function photosList()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $page=$data->page;
    $rowsPerPage=$data->rowsPerPage;
    $photos_of=$data->photos_of;
    $public_uid=internalUsernameDetails($data->public_username);
    
    if($page)
    {
        $offset=($page-1)* $rowsPerPage;
        $con=$offset.",".$rowsPerPage;
    }
    else
    {
        $con=$rowsPerPage;
    }
    
    if($photos_of)
    {
        $sql="SELECT id,image_path,uid_fk as uid,group_id_fk as group_id FROM user_uploads WHERE  uid_fk=:uid AND group_id_fk='0' AND image_type='2' ORDER BY id DESC LIMIT $con";
    }
    else
    {
        $sql="SELECT id,image_path,uid_fk as uid,group_id_fk as group_id FROM user_uploads WHERE  uid_fk=:uid AND group_id_fk='0' AND image_type='0' ORDER BY id DESC LIMIT $con";
    }
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $public_uid, PDO::PARAM_INT);
            $stmt->execute();
            $photosList = $stmt->fetchAll(PDO::FETCH_OBJ);
            $photosListCount=count($photosList);
            
            for($z=0;$z<$photosListCount;$z++)
            {
                $photosList[$z]->image_path=BASE_URL.UPLOAD_PATH.$photosList[$z]->image_path;
            }
            
            $db = null;
            echo '{"photosList": ' . json_encode($photosList) . '}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}




/* Delete Photo */
function deletePhoto()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $pid=$data->pid;
    $group_id=$data->group_id;
    $photo_uid=$data->photo_uid;
    $group_owner_id=internalGroupOwner($group_id);
    
    try {
        $key=md5(SITE_KEY.$uid);
        if($key==$data->token)
        {
            $db = getDB();
            if($group_owner_id==$uid)
            {
                $uid=$photo_uid;
            }
            
            if(empty($group_id))
            {
                $sql1 = "UPDATE users SET photos_count=photos_count-1 WHERE uid=:uid";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->execute();
            }
            
            $sql = "SELECT id,image_path FROM user_uploads U WHERE id=:pid AND uid_fk=:uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("pid", $pid, PDO::PARAM_INT);
            $stmt->execute();
            $count=$stmt->rowCount();
            
            if($count>0)
            {
                
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                $final_image="../".UPLOAD_PATH.$data[0]->image_path;
                
                unlink($final_image);
                
                $sql1 = "SELECT uploads,msg_id FROM messages WHERE uid_fk=:uid AND uploads!=0 AND  uploads LIKE :searchID";
                $stmt1 = $db->prepare($sql1);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $searchID="%".$pid."%";
                $stmt1->bindParam("searchID", $searchID, PDO::PARAM_STR);
                $stmt1->execute();
                $photoResult = $stmt1->fetchAll(PDO::FETCH_OBJ);
                $msgid=$photoResult[0]->msg_id;
                $str = $photoResult[0]->uploads;
                
                $tmp = explode(",", $str);
                $key = array_search($pid, $tmp);
                if($key){
                    $tmp[$key] = null;
                }
                $tmp = array_filter($tmp);
                $newSet = implode(",",$tmp);
                $newSet=(string)$newSet;
                
                if($newSet==$str)
                {
                    $pattern = '/(\,)?'.$pid.'(\,)?/i';
                    $newSet=preg_replace($pattern, '', $str);
                }
                
                if(strlen($newSet)==0){$newSet='';}
                
                $sql2="UPDATE messages SET uploads=:newSet WHERE msg_id=:msgid and uid_fk=:uid";
                $stmt2 = $db->prepare($sql2);
                $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt2->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt2->bindParam("newSet", $newSet, PDO::PARAM_STR);
                $stmt2->execute();
                
                $sql3="DELETE FROM user_uploads WHERE id=:pid AND uid_fk=:uid";
                $stmt3 = $db->prepare($sql3);
                $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt3->bindParam("pid", $pid, PDO::PARAM_INT);
                $stmt3->execute();
                
                
                $db = null;
                echo '{"deletePhoto": [{"status":"1"}]}';
            }
            
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}

/*Group Image Upload*/
function groupImageUpload()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $update = json_decode($request->getBody());
    $uid=$data->uid;
    $image=$data->image;
    $groupID=$data->groupID;
    
    $q="UPDATE groups SET group_pic=:image WHERE  group_id=:groupID AND uid_fk=:uid";
    $q1="INSERT INTO user_uploads(image_path,uid_fk,group_id_fk,image_type) VALUES (:image,:uid,:groupID,:status)";
    $q2 = "SELECT group_id,group_pic FROM groups WHERE  group_id=:groupID AND uid_fk=:uid";
    
    try {
        if($uid > 0 && $groupID > 0)
        {
            $db = getDB();
            $stmt = $db->prepare($q);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt1 = $db->prepare($q1);
            $stmt1->bindParam("image", $image, PDO::PARAM_STR);
            $status='2';
            $stmt1->bindParam("status", $status);
            $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt1->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $stmt1->execute();
            
            $stmt2 = $db->prepare($q2);
            $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt2->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $stmt2->execute();
            
            $groupImageUpload = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"groupImageUpload": ' . json_encode($groupImageUpload) . '}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/*Group Background Image Upload */
function groupBGImageUpload()
{
    $request = \Slim\Slim::getInstance()->request();
    $update = json_decode($request->getBody());
    $uid=$data->uid;
    $image=$data->image;
    $groupID=$data->groupID;
    
    $q="UPDATE groups SET group_bg=:image WHERE  group_id=:groupID AND uid_fk=:uid";
    $q1="INSERT INTO user_uploads(image_path,uid_fk,group_id_fk,image_type) VALUES (:image,:uid,:groupID,:status)";
    $q2 = "SELECT group_id,group_bg FROM groups WHERE  group_id=:groupID AND uid_fk=:uid";
    
    try {
        if($uid > 0 && $groupID > 0)
        {
            $db = getDB();
            $stmt = $db->prepare($q);
            $stmt->bindParam("image", $image, PDO::PARAM_STR);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt1 = $db->prepare($q1);
            $stmt1->bindParam("image", $image, PDO::PARAM_STR);
            $status='2';
            $stmt1->bindParam("status", $status);
            $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt1->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $stmt1->execute();
            
            $stmt2 = $db->prepare($q2);
            $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt2->bindParam("groupID", $groupID, PDO::PARAM_INT);
            $stmt2->execute();
            
            $groupBGImageUpload = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"groupBGImageUpload": ' . json_encode($groupBGImageUpload) . '}';
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}

/* Profile Picuture */
function backgroundPic($backgroundPic)
{
    if($backgroundPic)
    {
        $backgroundPic=BASE_URL.UPLOAD_PATH.$backgroundPic;
    }
    else
    {
        $backgroundPic=BASE_URL.'wall_icons/defaultBG.png';
    }
    
    return $backgroundPic;
}

/* Profile Picuture */
function profilePic($profilePic)
{
    if($profilePic)
    {
        $profile_pic=BASE_URL.UPLOAD_PATH.$profilePic;
    }
    else
    {
        $profile_pic=BASE_URL.'wall_icons/default.png';
    }
    
    return $profile_pic;
}

/* Group Profile Picuture */
function groupPic($profilePic)
{
    if($profilePic)
    {
        $profile_pic=BASE_URL.UPLOAD_PATH.$profilePic;
    }
    else
    {
        $profile_pic=BASE_URL.'wall_icons/defaultGroup.png';
    }
    
    return $profile_pic;
}


/************************* NOTIFICATIONS *************************************/

/*Notification Last Login Update*/
function notificationCreatedUpdate()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    
    $sql = "UPDATE users SET notification_created=:time WHERE uid=:uid";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $time=time();
            $stmt->bindParam("time", $time);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $db = null;
            echo '{"notificationCreatedUpdate": [{"status":"1"}]}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/*Group Valid Check*/
function internalReaction($msg_id)
{
    
    
    if($msg_id>0)
    {
        $db = getDB();
        $sql = "SELECT reactionType FROM message_like WHERE msg_id_fk=:msg_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msg_id", $msg_id, PDO::PARAM_INT);
        
        $stmt->execute();
        $reactionType = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $reactionType->reactionType;
    }
    
    
    
}


/*Notifications*/
function notifications()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    $uid=$data->uid;
    $lastid=$data->notification_created;
    $notifications_perpage=$data->notifications_perpage;
    
    
    
    $morequery="";
    if($lastid)
    {
        $morequery=" and S.created<'".$lastid."' ";
        $morequery_friend=" and F.created<'".$lastid."' ";
        $morequery_group=" and X.created<'".$lastid."' ";
        $morequery_group_status=" and M.created<'".$lastid."' ";
    }
    
    
    $sql = "(SELECT DISTINCT M.msg_id as msg_id, U.username,S.uid_fk, S.ouid_fk as ouid_fk , M.group_id_fk,M.message, S.created, '0' as type
    FROM
    messages M, users U, friends F,message_share S
    WHERE
    F.friend_one=:uid AND
    U.uid = F.friend_one AND
    U.status=:status AND
    F.friend_two != S.ouid_fk AND
    S.uid_fk  = F.friend_two AND
    M.uid_fk = S.ouid_fk AND F.role=:fri AND
    S.msg_id_fk = M.msg_id AND S.uid_fk<>:uid $morequery GROUP BY M.msg_id)
    UNION
    (SELECT DISTINCT '0' as msg_id, U.username,F.friend_one as uid_fk, '0' as ouid_fk , '0' as group_id_fk, '0' as message, F.created, '3' as type
    FROM users U, friends F
    WHERE F.friend_two=:uid AND U.uid = F.friend_one AND U.status=:status AND F.role=:fri $morequery_friend)
    UNION
    (SELECT
    DISTINCT '0' as msg_id,U.username, X.uid_fk as uid_fk, '0' as ouid_fk , X.group_id_fk as group_id_fk, '0' as message, X.created, '4' as type
    FROM users U, groups G, group_users X
    WHERE G.uid_fk=U.uid AND G.group_id=X.group_id_fk AND U.uid=:uid AND X.uid_fk<>:uid AND X.status=:status AND U.status=:status $morequery_group)
    UNION
    (SELECT
    DISTINCT M.msg_id as msg_id, U.username,M.uid_fk as uid_fk, '0' as ouid_fk , M.group_id_fk as group_id_fk, M.message as message, M.created, '5' as type
    FROM users U, messages M,group_users G
    WHERE G.uid_fk=U.uid AND G.group_id_fk=M.group_id_fk AND U.uid=:uid AND M.uid_fk<>G.uid_fk AND G.status=:status AND U.status=:status $morequery_group_status)
    UNION
    (SELECT DISTINCT M.msg_id  as msg_id, U.username,S.uid_fk, S.ouid_fk as ouid_fk, M.group_id_fk,M.message, S.created, '1' as type
    FROM
    messages M, users U, friends F,message_like S
    WHERE
    F.friend_one=:uid AND
    U.uid = F.friend_one AND
    U.status=:status AND
    F.friend_two != S.ouid_fk AND
    S.uid_fk  = F.friend_two AND
    M.uid_fk = S.ouid_fk AND F.role=:fri AND
    S.msg_id_fk = M.msg_id AND S.uid_fk<>S.ouid_fk AND S.uid_fk<>:uid  $morequery  GROUP BY M.msg_id)
    UNION
    (SELECT DISTINCT M.msg_id  as msg_id,U.username, S.uid_fk, M.uid_fk as ouid_fk, M.group_id_fk,M.message, S.created, '2' as type
    FROM
    messages M, users U, friends F,comments S
    WHERE
    F.friend_one=:uid AND
    U.uid = F.friend_one AND
    U.status=:status AND
    F.friend_two != S.uid_fk AND
    M.uid_fk =:uid AND F.role=:fri AND
    S.msg_id_fk = M.msg_id  AND S.uid_fk<>:uid  $morequery  GROUP BY M.msg_id)
    ORDER BY created DESC LIMIT $notifications_perpage";
    
    
    try {
        
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $stmt = $db->prepare($sql);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $fri='fri';
            $stmt->bindParam("fri", $fri);
            $stmt->execute();
            $notifications = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $db = null;
            $notificationsCount=count($notifications);
            
            $notiPostIn=" posted in";
            $notiFollowingGroup=" is following your Group.";
            $notiFollowingYou=" is following you.";
            $notiCommented=" commented";
            $notiLiked=" liked";
            $notiShared=" shared";
            
            /* Language labels */
            if(internalLanguageCheck())
            {
                $data=internalNotificationLabels();
                $notiPostIn=$data->feedPosted;
                $notiFollowingGroup=$data->notiIsFollowingYou;
                $notiFollowingYou=$data->notiFollowingYou;
                $notiCommented=$data->notiCommented;
                $notiLiked=$data->notiLiked;
                $notiShared=$data->notiShared;
            }
            
            
            for($z=0;$z<$notificationsCount;$z++)
            {
                $notifications[$z]->message='<span class="notificationContent">'.htmlCode($notifications[$z]->message).'';
                /* */
                $n_type=$notifications[$z]->type;
                
                $notifications[$z]->reactionType='0';
                
                if($n_type=='5')
                {
                    $groupData=internalGroupDetails($notifications[$z]->group_id_fk);
                    $n_type= $notiPostIn.'<b>'.$groupData[0]->group_name.'</b> Group';
                }
                else if($n_type=='4')
                {
                    $groupData=internalGroupDetails($notifications[$z]->group_id_fk);
                    $n_type=$notiFollowingGroup.' <b>'.$groupData[0]->group_name.'</b>';
                }
                else if($n_type=='3')
                {
                    $n_type=$notiFollowingYou;
                }
                else if($n_type=='2')
                {
                    $n_type=$notiCommented;
                }
                else if($n_type=='1')
                {
                    $n_type= $notiLiked;
                    $notifications[$z]->reactionType=internalReaction($notifications[$z]->msg_id);
                }
                else
                {
                    $n_type= $notiShared;
                }
                
                
                /*  */
                $uid=$data->uid;
                $message_uid=$notifications[$z]->ouid_fk;
                
                $finalMessage=' status: '.nameFilter($notifications[$z]->message,40);
                
                if($notifications[$z]->msg_id)
                {
                    if($uid == $message_uid)
                    {
                        $notificationMessage= "<b>Your</b>".$finalMessage;
                    }
                    else
                    {
                        if($message_uid)	{
                            $userData=internalUserDetails($message_uid);
                        $notificationMessage=  "<b>".ucfirst($userData[0]->name)."</b>'s".$finalMessage; }
                    }
                }
                else
                    $notificationMessage='';
                
                $notifications[$z]->message=$n_type.' '.$notificationMessage;
                $notifications[$z]->notification_userDetails=internalUserDetails($notifications[$z]->uid_fk);
                
                $n_time=$notifications[$z]->created;
                $notifications[$z]->timeAgo=date("c", $n_time);
            }
            
            echo '{"notifications": ' . json_encode($notifications) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/*Notifications Count Check*/
function notificationsNewCount()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    
    
    $sql = "(SELECT DISTINCT M.msg_id, S.uid_fk, S.ouid_fk, M.group_id_fk,M.message, S.created, '0' as type
    FROM
    messages M, users U, friends F,message_share S
    WHERE
    F.friend_one=:uid AND
    U.uid = F.friend_one AND
    U.status=:status AND
    F.friend_two != S.ouid_fk AND
    S.uid_fk  = F.friend_two AND
    M.uid_fk = S.ouid_fk AND F.role=:fri AND
    S.msg_id_fk = M.msg_id AND S.uid_fk<>:uid AND S.created>:created GROUP BY M.msg_id)
    UNION
    (SELECT DISTINCT '1' as msg_id, F.friend_one as uid_fk, '1' as ouid_fk , '1' as group_id_fk, '1' as message, F.created, '3' as type
    FROM users U, friends F
    WHERE F.friend_two=:uid AND U.uid = F.friend_one AND U.status=:status AND F.role=:fri AND F.created>:created )
    UNION
    (SELECT DISTINCT M.msg_id, S.uid_fk, S.ouid_fk, M.group_id_fk,M.message, S.created, '1' as type
    FROM
    messages M, users U, friends F,message_like S
    WHERE
    F.friend_one=:uid AND
    U.uid = F.friend_one AND
    U.status=:status AND
    F.friend_two != S.ouid_fk AND
    S.uid_fk  = F.friend_two AND
    M.uid_fk = S.ouid_fk AND F.role=:fri AND
    S.msg_id_fk = M.msg_id AND S.uid_fk<>S.ouid_fk AND S.uid_fk<>:uid AND S.created>:created GROUP BY M.msg_id)
    UNION
    (SELECT
    DISTINCT '0' as msg_id, X.uid_fk as uid_fk, '0' as ouid_fk , X.group_id_fk as group_id_fk, '0' as message, X.created, '4' as type
    FROM users U, groups G, group_users X
    WHERE G.uid_fk=U.uid AND G.group_id=X.group_id_fk AND U.uid=:uid AND X.uid_fk<>:uid AND X.status=:status AND U.status=:status AND X.created>:created)
    UNION
    (SELECT
    DISTINCT M.msg_id as msg_id, M.uid_fk as uid_fk, '0' as ouid_fk , M.group_id_fk as group_id_fk, M.message as message, M.created, '5' as type
    FROM users U, messages M,group_users G
    WHERE G.uid_fk=U.uid AND G.group_id_fk=M.group_id_fk AND U.uid=:uid AND M.uid_fk<>G.uid_fk AND G.status=:status AND U.status=:status AND M.created>:created)
    UNION
    (SELECT DISTINCT M.msg_id, S.uid_fk, M.uid_fk as ouid_fk, M.group_id_fk,M.message, S.created, '2' as type
    FROM
    messages M, users U, friends F,comments S
    WHERE
    F.friend_one=:uid AND
    U.uid = F.friend_one AND
    U.status=:status AND
    F.friend_two != S.uid_fk AND
    M.uid_fk = :uid AND F.role=:fri AND
    S.msg_id_fk = M.msg_id  AND S.uid_fk<>:uid AND S.created>:created GROUP BY M.msg_id)
    ORDER BY created DESC";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $created=internalNotificationCreated($uid);
            
            $db = getDB();
            $stmt = $db->prepare($sql);
            $status='1';
            $stmt->bindParam("status", $status);
            $stmt->bindParam("created", $created);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $fri='fri';
            $stmt->bindParam("fri", $fri);
            $stmt->execute();
            $notificationsCount = $stmt->rowCount();
            $db = null;
            
            echo '{"notificationsNewCount": [{"count":"'.$notificationsCount.'"}]}';
            //return $notificationsCount;
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/************************* NEWS FEED *************************************/

function internalStatusUID($msgID)
{
    
    try {
        $db = getDB();
        $sql="SELECT uid FROM messages M, users U WHERE  M.uid_fk=U.uid and M.msg_id=:msgID AND U.status='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msgID", $msgID, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        
        if($count>0)
        {
            $messageDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $messageDetails[0]->uid;
        }
        
        $db = null;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* Single Status Message */
function status()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $msgID=$data->msgID;
    $uid=$data->uid;
    
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $sql = "SELECT M.lat, M.lang, M.group_id_fk,M.msg_id, M.uid_fk, M.message, M.created,M.uploads,M.like_count,M.comment_count,M.share_count, U.username,U.name,U.profile_pic FROM messages M, users U WHERE  M.uid_fk=U.uid and M.msg_id=:msgID AND U.status='1'";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("msgID", $msgID, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
            
            if($count>0)
            {
                
                $NewsFeedResult = $stmt->fetchAll(PDO::FETCH_OBJ);
                
                if($NewsFeedResult)
                {
                    $n_time=$NewsFeedResult[0]->created;
                    $NewsFeedResult[0]->timeAgo=date("c", $n_time);
                    
                    /* Start End */
                    $originalMessage=$NewsFeedResult[0]->message;
                    $NewsFeedResult[0]->message=htmlCode($NewsFeedResult[0]->message);
                    
                    
                    if($NewsFeedResult[0]->name)
                    {
                        $name=$NewsFeedResult[0]->name;
                    }
                    else
                    {
                        $name=$NewsFeedResult[0]->username;
                    }
                    
                    $NewsFeedResult[0]->name = $name;
                    /* Profile Pic Modifiaction */
                    $NewsFeedResult[0]->profile_pic = profilePic($NewsFeedResult[0]->profile_pic);
                    $friendsNewsFeed[$z]->message=ucfirst($NewsFeedResult[0]->message);
                    /*Like and Share Check */
                    $likeCheckData=internalLikeCheck($uid,$NewsFeedResult[0]->msg_id);
                    $NewsFeedResult[0]->likeCheck=$likeCheckData->like_id;
                    $NewsFeedResult[0]->likeCheckReaction=$likeCheckData->reactionType;
                    $NewsFeedResult[0]->shareCheck=internalShareCheck($uid,$NewsFeedResult[0]->msg_id);
                    /* Message Details*/
                    $NewsFeedResult[0]->messageDetails=internalMessageDetails($NewsFeedResult[0]->msg_id);
                    $NewsFeedResult[0]->shareUserDetails=internalUserDetails($NewsFeedResult[0]->share_uid);
                    $NewsFeedResult[0]->likeUserDetails=internalUserDetails($NewsFeedResult[0]->like_uid);
                    $NewsFeedResult[0]->groupDetails=internalGroupDetails($NewsFeedResult[0]->group_id_fk);
                    /* Like Users*/
                    $NewsFeedResult[0]->likeUsers=internalLikeUsers($NewsFeedResult[0]->msg_id);
                    
                    
                    /* Comment Count */
                    $commentCount=count(internalComments($NewsFeedResult[0]->msg_id,'0'));
                    $NewsFeedResult[0]->commentCount=$commentCount;
                    if($commentCount>2)
                    {
                        $second_count=$commentCount-2;
                        $NewsFeedResult[0]->comments=internalComments($NewsFeedResult[0]->msg_id,$second_count);
                    }
                    else
                    {
                        $NewsFeedResult[0]->comments=internalComments($NewsFeedResult[0]->msg_id,'0');
                    }
                    
                    
                    if(textlink($originalMessage))
                    {
                        $link =textLink($originalMessage);
                        $em = new wallExpand($link);
                        $site = $em->get_site();
                        if($site != "")
                        {
                            
                            $code = $em->get_iframe();
                            if($code == "")
                            {
                                $code = $em->get_embed();
                                if($code == "")
                                {
                                    $codesrc=$em->get_thumb("medium");
                                }
                            }
                            if($codesrc)
                            {
                                $NewsFeedResult[0]->embed='<a href="'.$codesrc.'" data-lightbox="lightbox'.$NewsFeedResult[0]->msg_id.'"><img src="'.$codesrc.'" class="imgpreview" /></a>';
                            }
                            else if($code)
                            {
                                $NewsFeedResult[0]->embed = $code;
                            }
                        }
                    }
                    else
                        $NewsFeedResult[0]->embed = "";
                    
                    
                    /*Upload Image */
                    $uploadPaths=array();
                    
                    if($NewsFeedResult[0]->uploads)
                    {
                        $s = explode(",", $NewsFeedResult[0]->uploads);
                        $NewsFeedResult[0]->uploadCount=count($s);
                        
                        /* Upload Paths */
                        foreach($s as $a)
                        {
                            array_push($uploadPaths,internalGetImagePath($a));
                        }
                        
                        $NewsFeedResult[0]->uploadPaths=$uploadPaths;
                        
                    }
                    else
                    {
                        $NewsFeedResult[0]->uploadCount='';
                        $NewsFeedResult[0]->uploadPaths='';
                    }
                    
                    $codesrc='';
                    $code='';
                    /* End */
                    
                    $db = null;
                    echo '{"friendsNewsFeed": ' . json_encode($NewsFeedResult) . '}';
                    
                }
                
                
                
            }
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
    
}

/* public status */
function publicStatus()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $msgID=$data->msgID;
    $uid=$data->uid;
    
    
    try {
        $db = getDB();
        $sql = "SELECT M.lat, M.lang, M.group_id_fk,M.msg_id, M.uid_fk, M.message, M.created,M.uploads,M.like_count,M.comment_count,M.share_count, U.username,U.name,U.profile_pic FROM messages M, users U WHERE  M.uid_fk=U.uid and M.msg_id=:msgID AND U.status='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msgID", $msgID, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->rowCount();
        
        if($count>0)
        {
            
            $NewsFeedResult = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            if($NewsFeedResult)
            {
                $n_time=$NewsFeedResult[0]->created;
                $NewsFeedResult[0]->timeAgo=date("c", $n_time);
                
                /* Start End */
                $originalMessage=$NewsFeedResult[0]->message;
                $NewsFeedResult[0]->message=htmlCode($NewsFeedResult[0]->message);
                
                
                if($NewsFeedResult[0]->name)
                {
                    $name=$NewsFeedResult[0]->name;
                }
                else
                {
                    $name=$NewsFeedResult[0]->username;
                }
                
                $NewsFeedResult[0]->name = $name;
                /* Profile Pic Modifiaction */
                $NewsFeedResult[0]->profile_pic = profilePic($NewsFeedResult[0]->profile_pic);
                $NewsFeedResult[0]->message=ucfirst($NewsFeedResult[0]->message);
                /*Like and Share Check */
                
                
                $likeCheckData=internalLikeCheck($uid,$NewsFeedResult[0]->msg_id);
                $NewsFeedResult[0]->likeCheck=$likeCheckData->like_id;
                $NewsFeedResult[0]->likeCheckReaction=$likeCheckData->reactionType;
                
                $NewsFeedResult[0]->shareCheck=internalShareCheck($uid,$NewsFeedResult[0]->msg_id);
                /* Message Details*/
                $NewsFeedResult[0]->messageDetails=internalMessageDetails($NewsFeedResult[0]->msg_id);
                $NewsFeedResult[0]->shareUserDetails=internalUserDetails($NewsFeedResult[0]->share_uid);
                $NewsFeedResult[0]->likeUserDetails=internalUserDetails($NewsFeedResult[0]->like_uid);
                $NewsFeedResult[0]->groupDetails=internalGroupDetails($NewsFeedResult[0]->group_id_fk);
                /* Like Users*/
                $NewsFeedResult[0]->likeUsers=internalLikeUsers($NewsFeedResult[0]->msg_id);
                
                
                /* Comment Count */
                $commentCount=count(internalComments($NewsFeedResult[0]->msg_id,'0'));
                $NewsFeedResult[0]->commentCount=$commentCount;
                if($commentCount>2)
                {
                    $second_count=$commentCount-2;
                    $NewsFeedResult[0]->comments=internalComments($NewsFeedResult[0]->msg_id,$second_count);
                }
                else
                {
                    $NewsFeedResult[0]->comments=internalComments($NewsFeedResult[0]->msg_id,'0');
                }
                
                
                if(textlink($originalMessage))
                {
                    $link =textLink($originalMessage);
                    $em = new wallExpand($link);
                    $site = $em->get_site();
                    if($site != "")
                    {
                        
                        $code = $em->get_iframe();
                        if($code == "")
                        {
                            $code = $em->get_embed();
                            if($code == "")
                            {
                                $codesrc=$em->get_thumb("medium");
                            }
                        }
                        if($codesrc)
                        {
                            $NewsFeedResult[0]->embed='<a href="'.$codesrc.'" data-lightbox="lightbox'.$NewsFeedResult[0]->msg_id.'"><img src="'.$codesrc.'" class="imgpreview" /></a>';
                        }
                        else if($code)
                        {
                            $NewsFeedResult[0]->embed = $code;
                        }
                    }
                }
                else
                    $NewsFeedResult[0]->embed = "";
                
                
                /*Upload Image */
                $uploadPaths=array();
                
                if($NewsFeedResult[0]->uploads)
                {
                    $s = explode(",", $NewsFeedResult[0]->uploads);
                    $NewsFeedResult[0]->uploadCount=count($s);
                    
                    /* Upload Paths */
                    foreach($s as $a)
                    {
                        array_push($uploadPaths,internalGetImagePath($a));
                    }
                    
                    $NewsFeedResult[0]->uploadPaths=$uploadPaths;
                    
                }
                else
                {
                    $NewsFeedResult[0]->uploadCount='';
                    $NewsFeedResult[0]->uploadPaths='';
                }
                
                $codesrc='';
                $code='';
                /* End */
                
                $db = null;
                echo '{"friendsNewsFeed": ' . json_encode($NewsFeedResult) . '}';
                
            }
            
            
            
            
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
    
}



/* updates */
function userNewsFeed()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $lastid=$data->lastid;
    $perpage=$data->perpage;
    
    
    
    /* Public Username Check */
    if($data->public_username)
    {
        $uid=internalUsernameDetails($data->public_username);
    }
    else
    {
        $uid=$data->uid;
    }
    
    
    
    
    /* More Button*/
    $morequery="";
    if($lastid)
    {
        $morequery_share=" and S.created<'".$lastid."' ";
        $morequery_like=" and L.created<'".$lastid."' ";
        $morequery=" and M.created<'".$lastid."' ";
    }
    /* More Button End*/
    
    $sql1 = "SELECT share_id FROM message_share";
    $sql2 = "SELECT like_id FROM message_like";
    
    try {
        
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $stmt = $db->prepare($sql1);
            $stmt->execute();
            $v=$stmt->rowCount();
            
            $stmt1 = $db->prepare($sql2);
            $stmt1->execute();
            $w=$stmt1->rowCount();
            
            if($v || $w)
            {
                $query="SELECT DISTINCT msg_id, lat,lang, uid_fk, message, created, like_count,comment_count,share_count, username,uploads,
                share_uid,share_ouid, like_uid,  like_ouid FROM ( SELECT DISTINCT M.msg_id, M.lat,M.lang, M.uid_fk, M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,
                S.uid_fk as share_uid,S.ouid_fk as share_ouid,'0' AS like_uid, '0' as like_ouid
                FROM
                messages M, users U, message_share S
                WHERE
                M.uid_fk=U.uid AND
                U.status='1' AND
                S.msg_id_fk=M.msg_id AND
                S.uid_fk=:uid $morequery_share group by M.msg_id
                UNION ALL
                SELECT DISTINCT M.msg_id, M.lat,M.lang, M.uid_fk, M.message, L.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,
                '0' as share_uid,'0' as share_ouid, L.uid_fk as like_uid,L.ouid_fk as like_ouid
                FROM
                messages M, users U, message_like L
                WHERE
                M.uid_fk=U.uid AND
                U.status='1' AND
                L.msg_id_fk=M.msg_id AND L.uid_fk<>L.ouid_fk AND
                L.uid_fk=:uid $morequery_like group by M.msg_id
                UNION ALL
                SELECT M.msg_id, M.lat,M.lang, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' AS like_uid, '0' as like_ouid
                FROM messages M, users U
                WHERE
                U.status='1' AND
                M.uid_fk=U.uid AND
                M.uid_fk=:uid AND M.group_id_fk='0'  $morequery group by M.msg_id)t GROUP BY msg_id ORDER BY created DESC LIMIT $perpage";
                
                
            }
            else
            {
                
                $query="SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
                FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid AND M.uid_fk=:uid AND M.group_id_fk='0' $morequery ORDER BY M.msg_id DESC LIMIT $perpage";
                
                
            }
            
            
            if($v == 0 || $w == 0 )
            {
                $stmt3 = $db->prepare($query);
                $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt3->execute();
                $friendsNewsFeed=$stmt3->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                
                $stmt4 = $db->prepare($query);
                $stmt4->bindParam("created", $created);
                $stmt4->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt4->execute();
                $friendsNewsFeed = $stmt4->fetchAll(PDO::FETCH_OBJ);
            }
            
            /* reset session uid */
            $uid=$data->uid;
            include 'feedLoop.php';
            
            echo '{"friendsNewsFeed": ' . json_encode($friendsNewsFeed) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* updates */
function publicUserNewsFeed()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    
    
    /* Public Username Check */
    if($data->public_username)
    {
        $uid=internalUsernameDetails($data->public_username);
    }
    
    
    $perpage=20;
    /* More Button*/
    
    
    /* More Button End*/
    
    $sql1 = "SELECT share_id FROM message_share";
    $sql2 = "SELECT like_id FROM message_like";
    
    try {
        $db = getDB();
        $stmt = $db->prepare($sql1);
        $stmt->execute();
        $v=$stmt->rowCount();
        
        $stmt1 = $db->prepare($sql2);
        $stmt1->execute();
        $w=$stmt1->rowCount();
        
        if($v || $w)
        {
            $query="SELECT DISTINCT msg_id, lat,lang, uid_fk, message, created, like_count,comment_count,share_count, username,uploads,
            share_uid,share_ouid, like_uid,  like_ouid FROM ( SELECT DISTINCT M.msg_id, M.lat,M.lang, M.uid_fk, M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,
            S.uid_fk as share_uid,S.ouid_fk as share_ouid,'0' AS like_uid, '0' as like_ouid
            FROM
            messages M, users U, message_share S
            WHERE
            M.uid_fk=U.uid AND
            U.status='1' AND
            S.msg_id_fk=M.msg_id AND
            S.uid_fk=:uid $morequery_share group by msg_id
            UNION ALL
            SELECT DISTINCT M.msg_id, M.lat,M.lang, M.uid_fk, M.message, L.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,
            '0' as share_uid,'0' as share_ouid, L.uid_fk as like_uid,L.ouid_fk as like_ouid
            FROM
            messages M, users U, message_like L
            WHERE
            M.uid_fk=U.uid AND
            U.status='1' AND
            L.msg_id_fk=M.msg_id AND L.uid_fk<>L.ouid_fk AND
            L.uid_fk=:uid $morequery_like group by msg_id
            UNION ALL
            SELECT M.msg_id, M.lat,M.lang, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' AS like_uid, '0' as like_ouid
            FROM messages M, users U
            WHERE
            U.status='1' AND
            M.uid_fk=U.uid AND
            M.uid_fk=:uid AND M.group_id_fk='0'  $morequery group by msg_id)t GROUP BY msg_id ORDER BY created DESC  LIMIT $perpage";
            
            
        }
        else
        {
            $query="SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid
            FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid AND M.uid_fk=:uid AND M.group_id_fk='0' $morequery ORDER BY M.msg_id DESC LIMIT $perpage";
            
            
        }
        
        
        $stmt3 = $db->prepare($query);
        $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
        $stmt3->execute();
        $friendsNewsFeed=$stmt3->fetchAll(PDO::FETCH_OBJ);
        
        
        include 'feedLoop.php';
        
        echo '{"friendsNewsFeed": ' . json_encode($friendsNewsFeed) . '}';
        
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}


/* Group News Feed */
function groupNewsFeed()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $group_id=$data->group_id;
    $lastid=$data->lastid;
    $perpage=$data->perpage;
    $moreCheck=$data->moreCheck;
    
    
    if($moreCheck)
    {
        $perpage=$perpage+1;
    }
    
    /* More Button*/
    $morequery="";
    if($lastid)
    {
        $morequery=" and M.created<'".$lastid."' ";
    }
    
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            
            
            /* More Button End*/
            $query = "SELECT
            DISTINCT M.msg_id, M.lat,M.lang,M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.group_id_fk,M.uploads, '0' AS share_uid, '0' as share_ouid
            FROM messages M, users U, group_users G
            WHERE U.status='1' AND M.uid_fk=U.uid AND G.uid_fk=U.uid AND G.status='1' AND M.group_id_fk=:group_id $morequery ORDER BY created DESC LIMIT $perpage";
            
            
            if($moreCheck)
            {
                $stmt3 = $db->prepare($query);
                $stmt3->bindParam("group_id", $group_id, PDO::PARAM_INT);
                $stmt3->execute();
                $friendsNewsFeed=$stmt3->rowCount();
            }
            else
            {
                $stmt4 = $db->prepare($query);
                $stmt4->bindParam("group_id", $group_id, PDO::PARAM_INT);
                $stmt4->execute();
                $friendsNewsFeed = $stmt4->fetchAll(PDO::FETCH_OBJ);
            }
            
            /* reset Uid value */
            $uid=$data->uid;
            include 'feedLoop.php';
            
            echo '{"friendsNewsFeed": ' . json_encode($friendsNewsFeed) . '}';
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}


/* Friends_Updates   */
function friendsNewsFeed()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $lastid=$data->lastid;
    $perpage=$data->perpage;
    
    
    
    /* More Button*/
    $morequery="";
    if($lastid)
    {
        $morequery_share=" and S.created<'".$lastid."' ";
        $morequery_like=" and L.created<'".$lastid."' ";
        $morequery=" and M.created<'".$lastid."' ";
    }
    /*More Button End*/
    $sql1 = "SELECT share_id FROM message_share";
    $sql2 = "SELECT like_id FROM message_like";
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            $stmt = $db->prepare($sql1);
            $stmt->execute();
            $v=$stmt->rowCount();
            
            $stmt1 = $db->prepare($sql2);
            $stmt1->execute();
            $w=$stmt1->rowCount();
            
            if($v || $w)
            {
                $query="SELECT DISTINCT msg_id, lat,lang,uid_fk,group_id_fk,message, created, like_count,comment_count,share_count, username,uploads, share_uid,share_ouid , like_uid,like_ouid
                FROM
                (SELECT DISTINCT M.msg_id,M.lat,M.lang, M.uid_fk,M.group_id_fk,M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, S.uid_fk as share_uid,S.ouid_fk as share_ouid , '0' as like_uid,'0' as like_ouid
                FROM
                messages M, users U, friends F,message_share S
                WHERE
                F.friend_one=:uid AND
                U.uid = F.friend_one AND
                U.status='1' AND
                F.friend_two != S.ouid_fk AND
                S.uid_fk  = F.friend_two AND
                M.uid_fk = S.ouid_fk AND F.role='fri' AND
                S.msg_id_fk = M.msg_id $morequery_share group by M.msg_id
                UNION ALL
                SELECT DISTINCT M.msg_id,M.lat,M.lang, M.uid_fk,M.group_id_fk,M.message, L.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads,'0' AS share_uid, '0' as share_ouid , L.uid_fk as like_uid,L.ouid_fk as like_ouid
                FROM
                messages M, users U, friends F,message_like L
                WHERE
                F.friend_one=:uid AND
                U.uid = F.friend_one AND
                U.status='1' AND
                F.friend_two != L.ouid_fk AND
                L.uid_fk  = F.friend_two AND
                M.uid_fk = L.ouid_fk AND F.role='fri' AND L.uid_fk<>L.ouid_fk AND
                L.msg_id_fk = M.msg_id $morequery_like group by M.msg_id
                UNION ALL
                SELECT DISTINCT M.msg_id,M.lat,M.lang, M.uid_fk, M.group_id_fk, M.message, M.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' as like_uid,'0' as like_ouid
                FROM
                messages M, users U, friends F
                WHERE F.friend_one=:uid AND U.status='1' AND M.uid_fk=U.uid AND M.uid_fk = F.friend_two
                AND M.group_id_fk='0' $morequery group by M.msg_id
                UNION ALL
                SELECT DISTINCT M.msg_id, M.lat,M.lang,M.uid_fk, M.group_id_fk, M.message, M.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' as like_uid,'0' as like_ouid
                FROM
                messages M, users U, group_users G
                WHERE G.uid_fk=:uid
                AND U.status='1'
                AND M.group_id_fk = G.group_id_fk AND G.status='1' AND M.uid_fk=U.uid $morequery group by M.msg_id )t GROUP BY msg_id ORDER BY created DESC LIMIT $perpage";
                
                
            }
            else
            {
                $query="SELECT DISTINCT M.msg_id,M.lat,M.lang, M.uid_fk,M.group_id_fk, M.message, M.created, U.username,U.name,U.profile_pic,M.uploads, '0' AS share_uid, '0' as share_ouid, '0' as like_uid,'0' as like_ouid
                FROM messages M, users U, friends F  WHERE U.status='1' AND M.uid_fk=U.uid AND  M.uid_fk = F.friend_two
                AND F.friend_one=:uid $morequery ORDER BY M.msg_id DESC LIMIT $perpage";
                
                
            }
            
            
            if($moreCheck || $v > 0 || $w > 0)
            {
                
                $stmt4 = $db->prepare($query);
                $stmt4->bindParam("created", $created);
                $stmt4->bindParam("uid", $uid, PDO::PARAM_INT);
            }
            else
            {
                $stmt4 = $db->prepare($query);
                $stmt4->bindParam("uid", $uid, PDO::PARAM_INT);
            }
            
            $stmt4->execute();
            $friendsNewsFeed = $stmt4->fetchAll(PDO::FETCH_OBJ);
            //$friendsNewsFeedCount=$stmt4->rowCount();
            
            include 'feedLoop.php';
            echo '{"friendsNewsFeed": ' . json_encode($friendsNewsFeed) . '}';
        }
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/*Delete NewsFeed */
function deleteNewsFeed()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $msg_id=$data->msg_id;
    $group_id=$data->group_id;
    
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $db = getDB();
            if(!empty($group_id))
            {
                $sql="SELECT group_id FROM `groups` WHERE group_id = :group_id and uid_fk=:uid";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->bindParam("group_id", $group_id, PDO::PARAM_INT);
                $stmt->execute();
                $msg_num=$stmt->rowCount();
            }
            
            if($msg_num == 0)
            {
                $sqlx="SELECT msg_id FROM `messages` WHERE msg_id = :msg_id and uid_fk=:uid";
                $stmtx = $db->prepare($sqlx);
                $stmtx->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmtx->bindParam("msg_id", $msg_id, PDO::PARAM_INT);
                $stmtx->execute();
                $msg_num=$stmtx->rowCount();
            }
            
            
            
            
            if($msg_num)
            {
                
                // Delete Newsfeed likes
                $s1="DELETE FROM `message_like` WHERE msg_id_fk = :msg_id";
                $stmt1 = $db->prepare($s1);
                $stmt1->bindParam("msg_id", $msg_id, PDO::PARAM_INT);
                $stmt1->execute();
                
                // Comments Delete
                $s2="DELETE FROM `comments` WHERE msg_id_fk = :msg_id";
                $stmt2 = $db->prepare($s2);
                $stmt2->bindParam("msg_id", $msg_id, PDO::PARAM_INT);
                $stmt2->execute();
                
                
                
                // Delete Upload Images
                $s3="SELECT uploads FROM `messages` WHERE msg_id = :msg_id";
                $stmt3 = $db->prepare($s3);
                $stmt3->bindParam("msg_id", $msg_id, PDO::PARAM_INT);
                $stmt3->execute();
                $messagesData = $stmt3->fetchAll(PDO::FETCH_OBJ);
                
                
                
                if(strlen($messagesData['0']->uploads)>1)
                {
                    
                    $s = explode(",", $messagesData['0']->uploads);
                    $i=1;
                    $f=count($s);
                    foreach($s as $a)
                    {
                        
                        $s4="SELECT image_path FROM user_uploads WHERE id=:a";
                        $stmt4 = $db->prepare($s4);
                        $stmt4->bindParam("a", $a, PDO::PARAM_INT);
                        $stmt4->execute();
                        $newdata = $stmt4->fetchAll(PDO::FETCH_OBJ);
                        
                        $final_image="../".UPLOAD_PATH.$newdata[0]->image_path;
                        unlink($final_image);
                        if(empty($group_id))
                        {
                            $s5="DELETE FROM user_uploads WHERE id=:a";
                            $stmt5 = $db->prepare($s5);
                            $stmt5->bindParam("a", $a, PDO::PARAM_INT);
                            $stmt5->execute();
                            
                            $s52="UPDATE users SET photos_count=photos_count-1  WHERE uid=:uid";
                            $stmt52 = $db->prepare($s52);
                            $stmt52->bindParam("uid", $uid, PDO::PARAM_INT);
                            $stmt52->execute();
                        }
                    }
                    
                }
                // Delete NewsFeed
                $s6="DELETE FROM messages WHERE msg_id = :msg_id";
                $stmt6 = $db->prepare($s6);
                $stmt6->bindParam("msg_id", $msg_id, PDO::PARAM_INT);
                $stmt6->execute();
                
                
                // Update Newsfeed Count
                if(empty($group_id))
                {
                    $s7="UPDATE users SET updates_count=updates_count-1 WHERE uid=:uid";
                    $stmt7 = $db->prepare($s7);
                    $stmt7->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt7->execute();
                }
                
                $db = null;
                echo '{"deleteNewsFeed": [{"status":"1"}]}';
            }
            else
            {
                echo '{"deleteNewsFeed": [{"status":"0"}]}';
            }
        }
    }catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
}

/* Update NewsFeed */
function updateNewsFeed()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $update=$data->update;
    $uploads=$data->uploads;
    $group_id=$data->group_id;
    $lat=$data->lat;
    $lang=$data->lang;
    
    try {
        $key=md5(SITE_KEY.$uid);
        if($key==$data->token && $uid > 0)
        {
            $time=time();
            $ip=$_SERVER['REMOTE_ADDR'];
            $db = getDB();
            
            if(empty($group_id))
            {
                $sql = "SELECT msg_id,message,created FROM `messages` WHERE uid_fk=:uid ORDER BY msg_id DESC LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->execute();
                $NewsFeed = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            else
            {
                $sql = "SELECT msg_id,message,created FROM `messages` WHERE uid_fk=:uid and group_id_fk=:group_id ORDER BY msg_id DESC LIMIT 1";
                $stmt = $db->prepare($sql);
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->bindParam("group_id", $group_id, PDO::PARAM_INT);
                $stmt->execute();
                $NewsFeed = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            
            if ($update!=$NewsFeed[0]->message && $time!=$NewsFeed[0]->created)
            {
                $uploads_array=explode(',',$uploads);
                $uploads=implode(',',array_unique($uploads_array));
                if(empty($uploads))
                {
                    $uploads='';
                }
                
                if(empty($group_id) && $uid>0)
                {
                    $s1="INSERT INTO `messages` (message, uid_fk, ip,created,uploads,lat,lang) VALUES (:feedUpdate, :uid, :ip,:time,:uploads,:lat,:lang)";
                    $stmt1 = $db->prepare($s1);
                    $stmt1->bindParam("feedUpdate", $update, PDO::PARAM_STR);
                    $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt1->bindParam("ip", $ip);
                    $stmt1->bindParam("time", $time);
                    $stmt1->bindParam("uploads", $uploads, PDO::PARAM_STR);
                    $stmt1->bindParam("lat", $lat, PDO::PARAM_STR);
                    $stmt1->bindParam("lang", $lang, PDO::PARAM_STR);
                    $stmt1->execute();
                    
                    $s2="UPDATE `users` SET updates_count=updates_count+1 WHERE uid=:uid";
                    $stmt2 = $db->prepare($s2);
                    $stmt2->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt2->execute();
                    
                    $s3="SELECT M.group_id_fk,M.msg_id, M.uid_fk, M.message, M.created,M.uploads,M.like_count,M.comment_count,M.share_count, U.username,U.name,U.profile_pic FROM messages M, users U WHERE M.uid_fk=U.uid and M.uid_fk=:uid ORDER BY M.msg_id DESC LIMIT 1";
                    $stmt3= $db->prepare($s3);
                    $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                    $stmt3->execute();
                    $NewsFeedResult = $stmt3->fetchAll(PDO::FETCH_OBJ);
                    
                    
                }
                else
                {
                    if(internalGroupCheck($uid,$group_id))
                    {
                        $s1="INSERT INTO `messages` (message, uid_fk, ip,created,uploads,lat,lang,group_id_fk) VALUES (:feedUpdate, :uid, :ip,:time,:uploads,:lat,:lang,:group_id)";
                        $stmt1 = $db->prepare($s1);
                        $stmt1->bindParam("feedUpdate", $update);
                        $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                        $stmt1->bindParam("ip", $ip);
                        $stmt1->bindParam("time", $time);
                        $stmt1->bindParam("uploads", $uploads, PDO::PARAM_STR);
                        $stmt1->bindParam("group_id", $group_id, PDO::PARAM_INT);
                        $stmt1->bindParam("lat", $lat, PDO::PARAM_STR);
                        $stmt1->bindParam("lang", $lang, PDO::PARAM_STR);
                        $stmt1->execute();
                        
                        $s2="UPDATE `groups` SET group_updates=group_count+1 WHERE group_id=:group_id";
                        $stmt2 = $db->prepare($s2);
                        $stmt2->bindParam("group_id", $group_id, PDO::PARAM_STR);
                        $stmt2->execute();
                        
                        $s3="SELECT M.group_id_fk,M.msg_id, M.uid_fk, M.message, M.created,M.uploads,M.like_count,M.comment_count,M.share_count, U.username,U.name,U.profile_pic FROM messages M, users U WHERE M.uid_fk=U.uid and M.uid_fk=:uid ORDER BY M.msg_id DESC LIMIT 1 ";
                        $stmt3 = $db->prepare($s3);
                        $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                        $stmt3->execute();
                        $NewsFeedResult = $stmt3->fetchAll(PDO::FETCH_OBJ);
                    }
                    
                }
                
                
                if($NewsFeedResult)
                {
                    $n_time=$NewsFeedResult[0]->created;
                    $NewsFeedResult[0]->timeAgo=date("c", $n_time);
                    
                    /* Start End */
                    $originalMessage=$NewsFeedResult[0]->message;
                    $NewsFeedResult[0]->message=htmlCode($NewsFeedResult[0]->message);
                    
                    if($NewsFeedResult[0]->name)
                    {
                        $name=$NewsFeedResult[0]->name;
                    }
                    else
                    {
                        $name=$NewsFeedResult[0]->username;
                    }
                    
                    $NewsFeedResult[0]->name = $name;
                    /* Profile Pic Modifiaction */
                    
                    
                    $NewsFeedResult[0]->profile_pic = profilePic($NewsFeedResult[0]->profile_pic);
                    
                }
                
                if(textlink($originalMessage))
                {
                    $link =textLink($originalMessage);
                    $em = new wallExpand($link);
                    $site = $em->get_site();
                    if($site != "")
                    {
                        
                        $code = $em->get_iframe();
                        if($code == "")
                        {
                            $code = $em->get_embed();
                            if($code == "")
                            {
                                $codesrc=$em->get_thumb("medium");
                            }
                        }
                        if($codesrc)
                        {
                            $NewsFeedResult[0]->embed='<a href="'.$codesrc.'" data-lightbox="lightbox'.$NewsFeedResult[0]->msg_id.'"><img src="'.$codesrc.'" class="imgpreview" /></a>';
                        }
                        else if($code)
                        {
                            $NewsFeedResult[0]->embed = $code;
                        }
                    }
                }
                else
                    $NewsFeedResult[0]->embed = "";
                
                
                /*Upload Image */
                $uploadPaths=array();
                
                if($NewsFeedResult[0]->uploads)
                {
                    $s = explode(",", $NewsFeedResult[0]->uploads);
                    $NewsFeedResult[0]->uploadCount=count($s);
                    
                    /* Upload Paths */
                    foreach($s as $a)
                    {
                        array_push($uploadPaths,internalGetImagePath($a));
                    }
                    
                    $NewsFeedResult[0]->uploadPaths=$uploadPaths;
                    
                }
                else
                {
                    $NewsFeedResult[0]->uploadCount='';
                    $NewsFeedResult[0]->uploadPaths='';
                }
                
                $codesrc='';
                $code='';
                /* End */
                
                $db = null;
                echo '{"NewsFeedResult": ' . json_encode($NewsFeedResult) . '}';
            }
            
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



/************************* COMMENTS *************************************/

/* Total Comments */
function comments()
{
    
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $msgid=$data->msg_id;
    $second_count=$data->second_count;
    
    $query='';
    if($second_count)
    {
        $query="limit $second_count,2";
    }
    $sql = "SELECT C.com_id, C.uid_fk, C.comment, C.created,C.like_count,C.uploads, U.username,U.name,U.profile_pic FROM comments C, users U WHERE U.status='1' AND C.uid_fk=U.uid and C.msg_id_fk=:msgid ORDER BY C.com_id asc $query ";
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            $commentsCount=count($comments);
            
            for($z=0;$z<$commentsCount;$z++)
            {
                $n_time=$comments[$z]->created;
                $comments[$z]->timeAgo=date("c", $n_time);
                $comments[$z]->comment=htmlCode($comments[$z]->comment);
                $comments[$z]->uploads=internalGetImagePath($comments[$z]->uploads);
                
                
                if(empty($comments[$z]->name))
                {
                    $comments[$z]->name=$comments[$z]->username;
                }
                $comments[$z]->profile_pic=profilePic($comments[$z]->profile_pic);
            }
            echo '{"comments": ' . json_encode($comments) . '}';
            
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* Comments Internal Use*/
function internalComments($msgid,$second_count)
{
    $query='';
    if($second_count)
    {
        $query="limit $second_count,2";
    }
    $sql = "SELECT C.com_id, C.uid_fk, C.comment, C.created,C.like_count,C.uploads, U.username,U.name,U.profile_pic FROM comments C, users U WHERE U.status='1' AND C.uid_fk=U.uid and C.msg_id_fk=:msgid ORDER BY C.com_id asc $query ";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $commentsCount=count($comments);
        
        for($z=0;$z<$commentsCount;$z++)
        {
            $n_time=$comments[$z]->created;
            $comments[$z]->timeAgo=date("c", $n_time);
            $comments[$z]->comment=htmlCode($comments[$z]->comment);
            $comments[$z]->uploads=internalGetImagePath($comments[$z]->uploads);
            if(empty($comments[$z]->name))
            {
                $comments[$z]->name=$comments[$z]->username;
            }
            $comments[$z]->profile_pic=profilePic($comments[$z]->profile_pic);
        }
        //echo '{"comments": ' . json_encode($comments) . '}';
        return $comments;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/* Comment Update */
function commentUpdate()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $msgid=$data->msg_id;
    $comment=$data->comment;
    $upload=$data->upload;
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            $time=time();
            $ip=$_SERVER['REMOTE_ADDR'];
            
            $sql = "SELECT com_id,comment FROM `comments` WHERE uid_fk=:uid and msg_id_fk=:msgid ORDER BY com_id DESC LIMIT 1";
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("msgid", $msgid, PDO::PARAM_INT);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            
            if ($comment!=$comments[0]->comment)
            {
                /* Previous Comment User Check */
                $s8="SELECT C.uid_fk FROM comments C WHERE  C.msg_id_fk=:msgid ORDER BY C.com_id DESC LIMIT 1 ";
                $stmt8 = $db->prepare($s8);
                $stmt8->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt8->execute();
                $commentsLastData = $stmt8->fetchAll(PDO::FETCH_OBJ);
                
                $oldCommentUid=$commentsLastData[0]->uid_fk;
                
                
                $s1="INSERT INTO `comments` (comment, uid_fk,msg_id_fk,ip,created,uploads) VALUES (:comment, :uid,:msgid, :ip,:time,:upload)";
                $stmt1 = $db->prepare($s1);
                $stmt1->bindParam("comment", $comment, PDO::PARAM_STR);
                $stmt1->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt1->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt1->bindParam("ip", $ip);
                $stmt1->bindParam("time", $time);
                $stmt1->bindParam("upload", $upload, PDO::PARAM_INT);
                $stmt1->execute();
                
                $s2="UPDATE messages SET comment_count=comment_count+1 WHERE msg_id=:msgid";
                $stmt2 = $db->prepare($s2);
                $stmt2->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt2->execute();
                
                $s3="SELECT C.com_id, C.uid_fk, C.comment, C.msg_id_fk, C.created,C.uploads, U.username,U.name,U.profile_pic FROM comments C, users U WHERE C.uid_fk=U.uid and C.uid_fk=:uid and C.msg_id_fk=:msgid ORDER BY C.com_id DESC LIMIT 1 ";
                $stmt3 = $db->prepare($s3);
                $stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt3->bindParam("msgid", $msgid, PDO::PARAM_INT);
                $stmt3->execute();
                $commentUpdate = $stmt3->fetchAll(PDO::FETCH_OBJ);
                if($commentUpdate[0]->comment)
                {
                    $n_time=$commentUpdate[0]->created;
                    $commentUpdate[0]->timeAgo=date("c", $n_time);
                    $commentUpdate[0]->comment=htmlCode($commentUpdate[0]->comment);
                    $commentUpdate[0]->uploads=internalGetImagePath($commentUpdate[0]->uploads);
                    
                    $commentUpdate[0]->profile_pic = profilePic($commentUpdate[0]->profile_pic);
                    
                    $newCommentUid=$commentUpdate[0]->uid_fk;
                    
                    if(empty($commentUpdate[0]->name))
                    {
                        $commentUpdate[0]->name=$commentUpdate[0]->username;
                    }
                    
                    $commentUser=ucfirst($commentUpdate[0]->name);
                    
                }
                $db = null;
                
                echo '{"commentUpdate": ' . json_encode($commentUpdate) . '}';
                
                
                if(SMTP_CONNECTION > 0 && $oldCommentUid!=$newCommentUid )
                {
                    $messageUserDetails=internalMessageDetails($msgid);
                    
                    $to=$messageUserDetails[0]->email;
                    $emailName=$messageUserDetails[0]->name;
                    $messageUid=$messageUserDetails[0]->uid_fk;
                    $emailNotifications=$messageUserDetails[0]->emailNotifications;
                    $applicationName=SITE_NAME;
                    
                    
                    if($uid!=$messageUid && $emailNotifications > 0)
                    {
                        
                        
                        
                        $messageLink=BASE_URL."status/".$msgid;
                        $subject =$commentUser.' commented on your post on '.$applicationName;
                        $body="Hello ".$emailName.",<br/> <br/> ".$commentUser." commented on your post!.<br/><br/> ( ".$commentUpdate[0]->comment." ) <br/><br/><a href='".$messageLink."'>Reply</a><br/><br/>Support
                        <br/>".$applicationName.'<br/>'.BASE_URL.'<br/><br/>
                        You are receiving this because you are subscribed to notifications on our website.
                        <a href="'.BASE_URL.'settings.php">Edit your email alerts</a>';
                        sendMail($to,$subject,$body);
                    }
                }
                
                
                
            }
            
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
    
}
/* Comment Delete */
function commentDelete()
{
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());
    $uid=$data->uid;
    $com_id=$data->com_id;
    
    try {
        $key=md5(SITE_KEY.$data->uid);
        if($key==$data->token)
        {
            
            $sql="SELECT M.uid_fk,C.uploads FROM comments C, messages M WHERE C.msg_id_fk = M.msg_id AND C.com_id=:com_id";
            $db = getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("com_id", $com_id);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_OBJ);
            $i=0;
            if($uid==$comments[0]->uid_fk)
            {
                $i=1;
                $s1="DELETE FROM `comments` WHERE com_id=:com_id";
                $stmt1 = $db->prepare($s1);
                $stmt1->bindParam("com_id", $com_id);
                $stmt1->execute();
                
            }
            else
            {
                $i=1;
                $s4="DELETE FROM `comments` WHERE uid_fk=:uid and com_id=:com_id";
                $stmt4 = $db->prepare($s4);
                $stmt4->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt4->bindParam("com_id", $com_id, PDO::PARAM_INT);
                $stmt4->execute();
            }
            if($comments[0]->uploads>0 && $i)
            {
                $uploadID=$comments[0]->uploads;
                $s5="SELECT image_path FROM user_uploads WHERE id=:uploadID";
                $stmt5 = $db->prepare($s5);
                $stmt5->bindParam("uploadID", $uploadID, PDO::PARAM_INT);
                $stmt5->execute();
                $newdata = $stmt5->fetchAll(PDO::FETCH_OBJ);
                $final_image="../".UPLOAD_PATH.$newdata[0]->image_path;
                unlink($final_image);
                
                $sql6="DELETE FROM user_uploads WHERE id=:uploadID AND uid_fk=:uid";
                $stmt6 = $db->prepare($sql6);
                $stmt6->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt6->bindParam("uploadID", $uploadID, PDO::PARAM_INT);
                $stmt6->execute();
            }
            
            $db = null;
            echo '{"deleteComment": [{"status":"1"}]}';
        }
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

?>