<?php


class Wall_Admin
{
    /* Configurations*/
    public function Get_Configurations()
    {
        
        $db = getDB();
        $stmt = $db->prepare("SELECT  * FROM configurations WHERE con_id='1' ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    /* Configurations*/
    public function Get_Labels()
    {
        
        $db = getDB();
        $stmt = $db->prepare("SELECT  * FROM language_labels");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    
    /* Users Count */
    public function Users_Count()
    {
        
        $db = getDB();
        $sql="SELECT uid FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
        
    }
    
    //Updates Count
    public function Updates_Count()
    {
        $db = getDB();
        $sql="SELECT msg_id FROM messages";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    //Comments Count
    public function Comments_Count()
    {
        $db = getDB();
        $sql="SELECT com_id FROM comments";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    //Groups Count
    public function Groups_Count()
    {
        $db = getDB();
        $sql="SELECT group_id FROM groups";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    /*Share Count*/
    public function Share_Count()
    {
        $db = getDB();
        $sql="SELECT share_id FROM message_share";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    /*Language*/
    public function Language($live)
    {
        
        $db = getDB();
        $sql="UPDATE  configurations SET language_labels=:live WHERE con_id='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':live', $live, PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    /*Common Language*/
    public function commonLabelUpdate($commonMembers,$commonViewAll,$commonFriends,$commonGroups,$commonPhotos,$commonCreateGroup,$commonAbout,$commonRecentVisitors,$commonFollowers)
    {
        
        $db = getDB();
        $sql="UPDATE language_labels SET commonMembers=:commonMembers,commonViewAll=:commonViewAll,commonFriends=:commonFriends, commonGroups=:commonGroups,commonPhotos=:commonPhotos,commonCreateGroup=:commonCreateGroup,commonAbout=:commonAbout,commonRecentVisitors=:commonRecentVisitors,commonFollowers=:commonFollowers WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':commonFriends', $commonFriends, PDO::PARAM_STR);
        $stmt->bindValue(':commonGroups', $commonGroups, PDO::PARAM_STR);
        $stmt->bindValue(':commonPhotos', $commonPhotos, PDO::PARAM_STR);
        $stmt->bindValue(':commonCreateGroup', $commonCreateGroup, PDO::PARAM_STR);
        $stmt->bindValue(':commonAbout', $commonAbout, PDO::PARAM_STR);
        $stmt->bindValue(':commonRecentVisitors', $commonRecentVisitors, PDO::PARAM_STR);
        $stmt->bindValue(':commonFollowers', $commonFollowers, PDO::PARAM_STR);
        $stmt->bindValue(':commonMembers', $commonMembers, PDO::PARAM_STR);
        $stmt->bindValue(':commonViewAll', $commonViewAll, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    /*Top Menu Language*/
    public function topMenuLabelUpdate($topMenuHome,$topMenuMessages,$topMenuNotifications,
    $topMenuSeeAll,$topMenuSettings,$topMenuLogout,$topMenuLogin,$topMenuJoin)
    {
        $db = getDB();
        
        $sql="UPDATE language_labels SET topMenuHome=:topMenuHome, topMenuMessages=:topMenuMessages,
        topMenuNotifications=:topMenuNotifications,topMenuSeeAll=:topMenuSeeAll,
        topMenuSettings=:topMenuSettings,topMenuLogout=:topMenuLogout,topMenuLogin=:topMenuLogin,topMenuJoin=:topMenuJoin WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':topMenuHome', $topMenuHome, PDO::PARAM_STR);
        $stmt->bindValue(':topMenuMessages', $topMenuMessages, PDO::PARAM_STR);
        $stmt->bindValue(':topMenuNotifications', $topMenuNotifications, PDO::PARAM_STR);
        $stmt->bindValue(':topMenuSeeAll', $topMenuSeeAll, PDO::PARAM_STR);
        $stmt->bindValue(':topMenuSettings', $topMenuSettings, PDO::PARAM_STR);
        $stmt->bindValue(':topMenuLogout', $topMenuLogout, PDO::PARAM_STR);
        $stmt->bindValue(':topMenuLogin', $topMenuLogin, PDO::PARAM_STR);
        $stmt->bindValue(':topMenuJoin', $topMenuJoin, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
    }
    
    /* box labels */
    public function boxLabelUpdate($boxName,$boxUpdates,$boxWebcam,$boxLocation)
    {
        $db = getDB();
        $sql="UPDATE language_labels SET boxName=:boxName, boxUpdates=:boxUpdates,boxWebcam=:boxWebcam,boxLocation=:boxLocation WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':boxName', $boxName, PDO::PARAM_STR);
        $stmt->bindValue(':boxUpdates', $boxUpdates, PDO::PARAM_STR);
        $stmt->bindValue(':boxWebcam', $boxWebcam, PDO::PARAM_STR);
        $stmt->bindValue(':boxLocation', $boxLocation, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    /* photos labels */
    public function photosLabelUpdate($yourPhotos,$photosOfYours)
    {
        $db = getDB();
        $sql="UPDATE language_labels SET yourPhotos=:yourPhotos, photosOfYours=:photosOfYours WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':yourPhotos', $yourPhotos, PDO::PARAM_STR);
        $stmt->bindValue(':photosOfYours', $photosOfYours, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    public function newsFeedLabelUpdate($feedLike,$feedUnLike,$feedLikeThis,$feedShare,$feedUnshare,$feedComment,$feedShareThis,$feedDeleteUpdate, $feedPosted)
    {
        
        $db = getDB();
        $sql="UPDATE language_labels SET
        feedLike=:feedLike,feedUnLike=:feedUnLike,feedLikeThis=:feedLikeThis,
        feedShare=:feedShare,feedUnshare=:feedUnshare,feedComment=:feedComment,
        feedDeleteUpdate=:feedDeleteUpdate,feedShareThis=:feedShareThis,feedPosted=:feedPosted WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':feedLike', $feedLike, PDO::PARAM_STR);
        $stmt->bindValue(':feedUnLike', $feedUnLike, PDO::PARAM_STR);
        $stmt->bindValue(':feedLikeThis', $feedLikeThis, PDO::PARAM_STR);
        $stmt->bindValue(':feedShare', $feedShare, PDO::PARAM_STR);
        $stmt->bindValue(':feedUnshare', $feedUnshare, PDO::PARAM_STR);
        $stmt->bindValue(':feedComment', $feedComment, PDO::PARAM_STR);
        $stmt->bindValue(':feedShareThis', $feedShareThis, PDO::PARAM_STR);
        $stmt->bindValue(':feedDeleteUpdate', $feedDeleteUpdate, PDO::PARAM_STR);
        $stmt->bindValue(':feedPosted', $feedPosted, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    public function buttonLabelUpdate($buttonUpdate,$buttonComment,$buttonFollow,
    $buttonFollowing,$buttonMessage,$buttonJoinGroup,$buttonUnfollowGroup,
    $buttonEditGroup, $buttonSaveSettings,
    $buttonSocialSave,$buttonLogin,$buttonSignUp,
    $buttonForgotButton,$buttonSetNewPassword,$buttonFacebook,
    $buttonGoogle,$buttonMicrosoft,$buttonLinkedin,$buttonYou)
    {
        
        $db = getDB();
        $sql="UPDATE language_labels SET buttonUpdate=:buttonUpdate,buttonComment=:buttonComment,buttonFollow=:buttonFollow,
        buttonFollowing=:buttonFollowing,buttonMessage=:buttonMessage,buttonJoinGroup=:buttonJoinGroup,
        buttonEditGroup=:buttonEditGroup,buttonUnfollowGroup=:buttonUnfollowGroup,buttonSaveSettings=:buttonSaveSettings,
        buttonSocialSave=:buttonSocialSave,buttonLogin=:buttonLogin,buttonSignUp=:buttonSignUp,
        buttonForgotButton=:buttonForgotButton,buttonSetNewPassword=:buttonSetNewPassword,buttonFacebook=:buttonFacebook,
        buttonMicrosoft=:buttonMicrosoft,buttonGoogle=:buttonGoogle,buttonLinkedin=:buttonLinkedin,buttonYou=:buttonYou WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':buttonUpdate', $buttonUpdate, PDO::PARAM_STR);
        $stmt->bindValue(':buttonComment', $buttonComment, PDO::PARAM_STR);
        $stmt->bindValue(':buttonFollow', $buttonFollow, PDO::PARAM_STR);
        $stmt->bindValue(':buttonFollowing', $buttonFollowing, PDO::PARAM_STR);
        $stmt->bindValue(':buttonMessage', $buttonMessage, PDO::PARAM_STR);
        $stmt->bindValue(':buttonJoinGroup', $buttonJoinGroup, PDO::PARAM_STR);
        $stmt->bindValue(':buttonEditGroup', $buttonEditGroup, PDO::PARAM_STR);
        $stmt->bindValue(':buttonUnfollowGroup', $buttonUnfollowGroup, PDO::PARAM_STR);
        $stmt->bindValue(':buttonSaveSettings', $buttonSaveSettings, PDO::PARAM_STR);
        $stmt->bindValue(':buttonSocialSave', $buttonSocialSave, PDO::PARAM_STR);
        $stmt->bindValue(':buttonLogin', $buttonLogin, PDO::PARAM_STR);
        $stmt->bindValue(':buttonSignUp', $buttonSignUp, PDO::PARAM_STR);
        $stmt->bindValue(':buttonForgotButton', $buttonForgotButton, PDO::PARAM_STR);
        $stmt->bindValue(':buttonSetNewPassword', $buttonSetNewPassword, PDO::PARAM_STR);
        $stmt->bindValue(':buttonFacebook', $buttonFacebook, PDO::PARAM_STR);
        $stmt->bindValue(':buttonMicrosoft', $buttonMicrosoft, PDO::PARAM_STR);
        $stmt->bindValue(':buttonGoogle', $buttonGoogle, PDO::PARAM_STR);
        $stmt->bindValue(':buttonLinkedin', $buttonLinkedin, PDO::PARAM_STR);
        $stmt->bindValue(':buttonYou', $buttonYou, PDO::PARAM_STR);
        
        
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    
    /* box labels */
    public function settingsLabelUpdate($settingsTitle,$settingsUsername,$settingsEmail,$settingsName,
    $settingsPassword,$settingsChangePassword,$settingsOldPassword,$settingsNewPassword,
    $settingsConfirmPassword,$settingsGroup,$settingsGender,$settingsAboutMe,$settingsEmailAlerts)
    {
        
        $db = getDB();
        $sql="UPDATE language_labels SET settingsTitle=:settingsTitle, settingsUsername=:settingsUsername,settingsEmail=:settingsEmail, settingsName=:settingsName,
        settingsPassword=:settingsPassword, settingsChangePassword=:settingsChangePassword,settingsOldPassword=:settingsOldPassword, settingsNewPassword=:settingsNewPassword,
        settingsConfirmPassword=:settingsConfirmPassword, settingsGroup=:settingsGroup,settingsGender=:settingsGender, settingsAboutMe=:settingsAboutMe,settingsEmailAlerts=:settingsEmailAlerts WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':settingsTitle', $settingsTitle, PDO::PARAM_STR);
        $stmt->bindValue(':settingsUsername', $settingsUsername, PDO::PARAM_STR);
        $stmt->bindValue(':settingsEmail', $settingsEmail, PDO::PARAM_STR);
        $stmt->bindValue(':settingsName', $settingsName, PDO::PARAM_STR);
        
        $stmt->bindValue(':settingsPassword', $settingsPassword, PDO::PARAM_STR);
        $stmt->bindValue(':settingsChangePassword', $settingsChangePassword, PDO::PARAM_STR);
        $stmt->bindValue(':settingsOldPassword', $settingsOldPassword, PDO::PARAM_STR);
        $stmt->bindValue(':settingsNewPassword', $settingsNewPassword, PDO::PARAM_STR);
        
        $stmt->bindValue(':settingsConfirmPassword', $settingsConfirmPassword, PDO::PARAM_STR);
        $stmt->bindValue(':settingsGroup', $settingsGroup, PDO::PARAM_STR);
        $stmt->bindValue(':settingsGender', $settingsGender, PDO::PARAM_STR);
        $stmt->bindValue(':settingsAboutMe', $settingsAboutMe, PDO::PARAM_STR);
        $stmt->bindValue(':settingsEmailAlerts', $settingsEmailAlerts, PDO::PARAM_STR);
        
        
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    
    
    /* Social labels */
    public function socialLabelUpdate($socialTitle,$socialFacebook,$socialTwitter,$socialGoogle,$socialInstagram)
    {
        $db = getDB();
        $sql="UPDATE language_labels SET socialTitle=:socialTitle,socialFacebook=:socialFacebook, socialTwitter=:socialTwitter,socialGoogle=:socialGoogle,socialInstagram=:socialInstagram WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':socialTitle', $socialTitle, PDO::PARAM_STR);
        $stmt->bindValue(':socialFacebook', $socialFacebook, PDO::PARAM_STR);
        $stmt->bindValue(':socialTwitter', $socialTwitter, PDO::PARAM_STR);
        $stmt->bindValue(':socialGoogle', $socialGoogle, PDO::PARAM_STR);
        $stmt->bindValue(':socialInstagram', $socialInstagram, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    
    
    /* login labels */
    public function loginLabelUpdate($loginTitle,$emailUsername,$password,$forgotPassword,$registrationTitle,
    $email,$username,$agreeMessage,$resetPassword,$thankYou,$thankYouMessage,$terms)
    {
        $db = getDB();
        $sql="UPDATE language_labels SET loginTitle=:loginTitle,emailUsername=:emailUsername, password=:password,forgotPassword=:forgotPassword,registrationTitle=:registrationTitle,
        email=:email,username=:username, agreeMessage=:agreeMessage,resetPassword=:resetPassword,thankYou=:thankYou,thankYouMessage=:thankYouMessage,terms=:terms WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':loginTitle', $loginTitle, PDO::PARAM_STR);
        $stmt->bindValue(':emailUsername', $emailUsername, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':forgotPassword', $forgotPassword, PDO::PARAM_STR);
        $stmt->bindValue(':registrationTitle', $registrationTitle, PDO::PARAM_STR);
        
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':agreeMessage', $agreeMessage, PDO::PARAM_STR);
        $stmt->bindValue(':resetPassword', $resetPassword, PDO::PARAM_STR);
        $stmt->bindValue(':thankYou', $thankYou, PDO::PARAM_STR);
        
        $stmt->bindValue(':thankYouMessage', $thankYouMessage, PDO::PARAM_STR);
        $stmt->bindValue(':terms', $terms, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    /* Place labels */
    
    public function placeLabelUpdate($placeSearch,$placeComment,$placeUpdate,$placeEmailUsername,$placePassword,
    $placeEmail,$placeUsername,$placeSendMessage)
    {
        $db = getDB();
        $sql="UPDATE language_labels SET placeSearch=:placeSearch,placeComment=:placeComment, placeUpdate=:placeUpdate,
        placeEmailUsername=:placeEmailUsername,placePassword=:placePassword,placeEmail=:placeEmail,placeUsername=:placeUsername,placeSendMessage=:placeSendMessage WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':placeSearch', $placeSearch, PDO::PARAM_STR);
        $stmt->bindValue(':placeComment', $placeComment, PDO::PARAM_STR);
        $stmt->bindValue(':placeUpdate', $placeUpdate, PDO::PARAM_STR);
        $stmt->bindValue(':placeEmailUsername', $placeEmailUsername, PDO::PARAM_STR);
        $stmt->bindValue(':placePassword', $placePassword, PDO::PARAM_STR);
        $stmt->bindValue(':placeEmail', $placeEmail, PDO::PARAM_STR);
        $stmt->bindValue(':placeUsername', $placeUsername, PDO::PARAM_STR);
        $stmt->bindValue(':placeSendMessage', $placeSendMessage, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    /* Noti labels */
    public function notiLabelUpdate($notiFollowingYou,$notiLiked,$notiShared,$notiStatus,$notiIsFollowingGroup,
    $notiCommented)
    {
        $db = getDB();
        $sql="UPDATE language_labels SET notiFollowingYou=:notiFollowingYou,notiLiked=:notiLiked, notiShared=:notiShared,
        notiStatus=:notiStatus,notiIsFollowingGroup=:notiIsFollowingGroup,notiCommented=:notiCommented WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':notiFollowingYou', $notiFollowingYou, PDO::PARAM_STR);
        $stmt->bindValue(':notiLiked', $notiLiked, PDO::PARAM_STR);
        $stmt->bindValue(':notiShared', $notiShared, PDO::PARAM_STR);
        $stmt->bindValue(':notiStatus', $notiStatus, PDO::PARAM_STR);
        $stmt->bindValue(':notiIsFollowingGroup', $notiIsFollowingGroup, PDO::PARAM_STR);
        $stmt->bindValue(':notiCommented', $notiCommented, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
        
    }
    
    
    
    
    
    
    /* other messages */
    public function msgLabelUpdate($msgDeleteConversation,$msgConversation,$msgStartConversation,$msgNoUpdates,$msgNoMoreUpdates,
    $msgNoFriends,$msgNoMoreFriends,$msgNoFollowers,$msgNoMoreFollowers,$msgNoPhotos,$msgNoMorePhotos,$msgNoViews,$msgNoMoreViews,$msgNoGroups,$msgNoMoreGroups,$msgNoMembers,$msgNoMoreMembers,$msgNoConversations)
    {
        $db = getDB();
        $sql="UPDATE language_labels SET msgDeleteConversation=:msgDeleteConversation,msgConversation=:msgConversation, msgStartConversation=:msgStartConversation,msgNoUpdates=:msgNoUpdates,msgNoMoreUpdates=:msgNoMoreUpdates,
        msgNoFriends=:msgNoFriends,msgNoMoreFriends=:msgNoMoreFriends, msgNoFollowers=:msgNoFollowers,msgNoMoreFollowers=:msgNoMoreFollowers, msgNoPhotos=:msgNoPhotos,msgNoMorePhotos=:msgNoMorePhotos,msgNoViews=:msgNoViews,msgNoMoreViews=:msgNoMoreViews,msgNoGroups=:msgNoGroups,msgNoMoreGroups=:msgNoMoreGroups,msgNoMembers=:msgNoMembers,msgNoMoreMembers=:msgNoMoreMembers,msgNoConversations=:msgNoConversations WHERE labelID='1'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':msgDeleteConversation', $msgDeleteConversation, PDO::PARAM_STR);
        $stmt->bindValue(':msgConversation', $msgConversation, PDO::PARAM_STR);
        $stmt->bindValue(':msgStartConversation', $msgStartConversation, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoUpdates', $msgNoUpdates, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMoreUpdates', $msgNoMoreUpdates, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoFriends', $msgNoFriends, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMoreFriends', $msgNoMoreFriends, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoFollowers', $msgNoFollowers, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMoreFollowers', $msgNoMoreFollowers, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoPhotos', $msgNoPhotos, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMorePhotos', $msgNoMorePhotos, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoViews', $msgNoViews, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMoreViews', $msgNoMoreViews, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoGroups', $msgNoGroups, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMoreGroups', $msgNoMoreGroups, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMembers', $msgNoMembers, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoMoreMembers', $msgNoMoreMembers, PDO::PARAM_STR);
        $stmt->bindValue(':msgNoConversations', $msgNoConversations, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
    }
    
    /*Like Count*/
    public function Like_Count()
    {
        $db = getDB();
        $sql="SELECT like_id FROM message_like";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    /*Active Users Count*/
    public function ActiveUsers_Count()
    {
        $db = getDB();
        $sql="SELECT uid FROM users where status='1'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    /*Conversations Users Count*/
    public function Conversations_Count()
    {
        $db = getDB();
        $sql="SELECT c_id FROM conversation";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    //Conversations Users Count
    public function UserUploads_Count()
    {
        $db = getDB();
        $sql="SELECT id FROM user_uploads WHERE image_type='0'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    /*Conversations Users Count*/
    public function ProfileUploads_Count()
    {
        $db = getDB();
        $sql="SELECT id FROM user_uploads WHERE image_type>'0'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return $stmt->rowCount();
    }
    
    /* User Details*/
    public function Users_Details($start,$per_page)
    {
        $db = getDB();
        $stmt2 = $db->prepare("SELECT uid,userid,username,email,googleProfile,bio,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,
        profile_pic_status,verified,provider,name  FROM users WHERE status='1' ORDER BY uid DESC LIMIT :start, :per_page");
        $stmt2->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt2->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt2->execute();
        $row = $stmt2->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    public function Users_Details_Search($searchKey)
    {
	$db = getDB();
	$stmt2 = $db->prepare("SELECT uid,userid,username,email,googleProfile,bio,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,
	profile_pic_status,verified,provider,name  FROM users WHERE status='1' AND (userid  LIKE :searchKey OR email  LIKE :searchKey OR  name  LIKE :searchKey OR  username  LIKE :searchKey OR  bio  LIKE :searchKey) ORDER BY uid DESC");  
	$searchKey="%".$searchKey."%";
	$stmt2->bindValue(':searchKey', $searchKey, PDO::PARAM_STR);
	$stmt2->execute();
	$row = $stmt2->fetchAll(PDO::FETCH_OBJ);
	//$data = json_decode(json_encode($row),true);
	$db = null;
	echo '{"searchResults": ' . json_encode($row) . '}';
	}



	 /* User Details*/
    public function Blocked_Users_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT uid,userid,username,email,googleProfile,bio,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,
        profile_pic_status,verified,provider,name  FROM users WHERE status='2' ORDER BY uid DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    public function Blocked_Users_Details_Search($searchKey)
    {
	$db = getDB();
	$stmt2 = $db->prepare("SELECT uid,userid,googleProfile,bio,username,email,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,
		profile_pic_status,verified,provider,name  FROM users WHERE status='2' AND (userid  LIKE :searchKey OR username  LIKE :searchKey OR name LIKE :searchKey OR email LIKE :searchKey) ORDER BY uid DESC");  
	$searchKey="%".$searchKey."%";
	$stmt2->bindValue(':searchKey', $searchKey, PDO::PARAM_STR);
	$stmt2->execute();
	$row = $stmt2->fetchAll(PDO::FETCH_OBJ);
	//$data = json_decode(json_encode($row),true);
	$db = null;
	echo '{"searchResults": ' . json_encode($row) . '}';
    }
    
    /* User Details*/
    public function Verified_Users_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT uid,userid,username,email,googleProfile,bio,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,
        profile_pic_status,verified,provider,name  FROM users WHERE status='1' AND verified='1' ORDER BY uid DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    public function Verified_Users_Details_Search($searchKey)
    {
	$db = getDB();
	$stmt2 = $db->prepare("SELECT uid,userid,username,email,googleProfile,bio,friend_count,profile_pic,conversation_count,updates_count,profile_bg,group_count,
		profile_pic_status,verified,provider,name  FROM users WHERE status='1' AND verified='1' AND (userid  LIKE :searchKey OR username LIKE :searchKey OR name LIKE :searchKey OR email LIKE :searchKey OR bio LIKE :searchKey ) ORDER BY uid DESC");  
	$searchKey="%".$searchKey."%";
	$stmt2->bindValue(':searchKey', $searchKey, PDO::PARAM_STR);
	$stmt2->execute();
	$row = $stmt2->fetchAll(PDO::FETCH_OBJ);
	$db = null;
	echo '{"searchResults": ' . json_encode($row) . '}';
    }
    
    /* Updates Details*/
    public function Updates_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT M.msg_id,M.message,U.username,U.userid,M.ip  FROM messages M, users U WHERE U.uid=M.uid_fk  ORDER BY msg_id DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    public function Updates_Details_Search($searchKey)
    {
	$db = getDB();
	$stmt2 = $db->prepare("SELECT M.msg_id,M.message,U.username,M.ip  FROM messages M, users U WHERE U.uid=M.uid_fk AND (M.message LIKE :searchKey OR U.username LIKE :searchKey OR U.userid LIKE :searchKey) ORDER BY msg_id DESC");  
	$searchKey="%".$searchKey."%";
	$stmt2->bindValue(':searchKey', $searchKey, PDO::PARAM_STR);
	$stmt2->execute();
	$row = $stmt2->fetchAll(PDO::FETCH_OBJ);
	$rowCount=$stmt2->rowCount();
	if($rowCount)
	{
	 	for($z=0;$z<$rowCount;$z++)
	 	{
         $row[$z]->message=htmlcode($row[$z]->message);
	 	}
	}
	$db = null;
	echo '{"searchResults": ' . json_encode($row) . '}';
    }
    
    /* Comments Details*/
    public function Comments_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT C.com_id,C.comment,U.username, U.userid, C.ip FROM comments C, users U WHERE U.uid=C.uid_fk   ORDER BY com_id DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    public function Comments_Details_Search($searchKey)
    {
	$db = getDB();
	$stmt2 = $db->prepare("SELECT C.com_id,C.comment,U.username, C.ip FROM comments C, users U WHERE U.uid=C.uid_fk AND ( C.comment LIKE :searchKey OR U.username LIKE :searchKey )ORDER BY com_id DESC");  

	$searchKey="%".$searchKey."%";
	$stmt2->bindValue(':searchKey', $searchKey, PDO::PARAM_STR);
	$stmt2->execute();
	$row = $stmt2->fetchAll(PDO::FETCH_OBJ);
	
	$rowCount=$stmt2->rowCount();
	if($rowCount)
	{
	 	for($z=0;$z<$rowCount;$z++)
	 	{
         $row[$z]->comment=htmlcode($row[$z]->comment);
	 	}
	}
	
	//$data = json_decode(json_encode($row),true);
	$db = null;
	echo '{"searchResults": ' . json_encode($row) . '}';
    }
    
    /* Group Details*/
    public function Groups_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT G.group_name,G.group_id,G.group_desc,G.group_ip,U.username  FROM groups G, users U WHERE U.uid=G.uid_fk AND G.status='1' ORDER BY group_id DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    public function Groups_Details_Search($searchKey)
    {
	$db = getDB();
	$stmt2 = $db->prepare("SELECT G.group_name,G.group_id,G.group_desc,G.group_ip,U.username  FROM groups G, users U WHERE U.uid=G.uid_fk AND G.status='1' AND (G.group_name LIKE :searchKey OR G.group_desc LIKE :searchKey OR  U.username LIKE :searchKey) ORDER BY group_id DESC");  
	
	$searchKey="%".$searchKey."%";
	$stmt2->bindValue(':searchKey', $searchKey, PDO::PARAM_STR);
	$stmt2->execute();
	$row = $stmt2->fetchAll(PDO::FETCH_OBJ);
	//$data = json_decode(json_encode($row),true);
	$db = null;
	echo '{"searchResults": ' . json_encode($row) . '}';
    }
    
    /* Group Details*/
    public function BlockGroups_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT G.group_name,G.group_id,G.group_desc,G.group_ip,U.username  FROM groups G, users U WHERE U.uid=G.uid_fk  AND G.status='0' ORDER BY group_id DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    public function BlockGroups_Details_Search($searchKey)
    {
	$db = getDB();
	$stmt2 = $db->prepare("SELECT G.group_name,G.group_id,G.group_desc,G.group_ip,U.username  FROM groups G, users U WHERE U.uid=G.uid_fk  AND G.status='0' AND  (G.group_name LIKE :searchKey OR G.group_desc LIKE :searchKey OR  U.username LIKE :searchKey) ORDER BY group_id DESC");  

	$searchKey="%".$searchKey."%";
	$stmt2->bindValue(':searchKey', $searchKey, PDO::PARAM_STR);
	$stmt2->execute();
	$row = $stmt2->fetchAll(PDO::FETCH_OBJ);
	//$data = json_decode(json_encode($row),true);
	$db = null;
	echo '{"searchResults": ' . json_encode($row) . '}';
    }
    
    /* UserUploads Details*/
    public function UserUploads_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT G.image_path,G.id,G.group_id_fk,U.username  FROM user_uploads G, users U WHERE U.uid=G.uid_fk  AND image_type='0' ORDER BY id DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    
    
    /* Profile Details*/
    public function ProfileUploads_Details($start,$per_page)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT G.image_path,G.id,G.group_id_fk,U.username  FROM user_uploads G, users U WHERE U.uid=G.uid_fk  AND image_type>'0' ORDER BY id DESC LIMIT :start, :per_page");
        $stmt->bindValue(':start', (int) trim($start), PDO::PARAM_INT);
        $stmt->bindValue(':per_page', (int) trim($per_page), PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    /* User Block*/
    public function User_Block($uid,$type)
    {
        $db = getDB();
        if(strlen($type))
        {
            $stmt = $db->prepare("UPDATE users SET status='1' WHERE uid=:uid");
            $stmt->bindParam("uid", $uid,PDO::PARAM_INT) ;
            $stmt->execute();
            
            $stmt1 = $db->prepare("UPDATE group_users SET status='1' WHERE uid_fk=:uid");
            $stmt1->bindParam("uid", $uid,PDO::PARAM_INT) ;
            $stmt1->execute();
        }
        else
        {
            $stmt= $db->prepare("UPDATE users SET status='2' WHERE uid=:uid");
            $stmt->bindParam("uid", $uid,PDO::PARAM_INT) ;
            $stmt->execute();
            
            $stmt1 = $db->prepare("UPDATE group_users SET status='0' WHERE uid_fk=:uid");
            $stmt1->bindParam("uid", $uid,PDO::PARAM_INT) ;
            $stmt1->execute();
        }
        $db = null;
        return true;
    }
    
    /* User Verify*/
    public function User_Verify($uid,$type)
    {
        $db = getDB();
        if(strlen($type))
        {
            $stmt = $db->prepare("UPDATE users SET verified='0' WHERE uid=:uid");
            $stmt->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt->execute();
        }
        else
        {
            $stmt= $db->prepare("UPDATE users SET verified='1' WHERE uid=:uid");
            $stmt->bindParam("uid", $uid,PDO::PARAM_INT) ;
            $stmt->execute();
        }
        $db = null;
        return true;
    }
    
    /* User Delete*/
    public function User_Delete($uid)
    {
        $db = getDB();
        if(strlen($uid))
        {
            $stmt = $db->prepare("DELETE FROM conversation_reply WHERE user_id_fk=:uid");
            $stmt->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt->execute();
            $stmt1 = $db->prepare("DELETE FROM conversation WHERE user_one=:uid OR user_two=:uid");
            $stmt1->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt1->execute();
            $stmt2 = $db->prepare("DELETE FROM user_uploads WHERE uid_fk=:uid");
            $stmt2->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt2->execute();
            $stmt3 = $db->prepare("DELETE FROM comment_like WHERE uid_fk=:uid");
            $stmt3->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt3->execute();
            $stmt4 = $db->prepare("DELETE FROM message_share WHERE uid_fk=:uid");
            $stmt4->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt4->execute();
            $stmt5 = $db->prepare("DELETE FROM message_like WHERE uid_fk=:uid");
            $stmt5->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt5->execute();
            $stmt6 = $db->prepare("DELETE FROM group_users WHERE uid_fk=:uid");
            $stmt6->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt6->execute();
            $stmt7 = $db->prepare("DELETE FROM groups WHERE uid_fk=:uid");
            $stmt7->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt7->execute();
            $stmt8 = $db->prepare("DELETE FROM comments WHERE uid_fk=:uid");
            $stmt8->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt8->execute();
            $stmt9 = $db->prepare("DELETE FROM messages WHERE uid_fk=:uid");
            $stmt9->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt9->execute();
            $stmt10= $db->prepare("DELETE FROM users WHERE uid=:uid");
            $stmt10->bindParam("uid", $uid,PDO::PARAM_INT);
            $stmt10->execute();
        }
        $db = null;
        return true;
    }
    
    /* User Delete*/
    public function Message_Delete($msg_id)
    {
        $db = getDB();
        if(strlen($msg_id))
        {

                $stmt2 = $db->prepare("DELETE FROM message_share WHERE msg_id_fk=:msg_id");
                $stmt2->bindParam("msg_id", $msg_id,PDO::PARAM_INT);
                $stmt2->execute();

                $stmt3 = $db->prepare("DELETE FROM message_like WHERE msg_id_fk=:msg_id");
                $stmt3->bindParam("msg_id", $msg_id,PDO::PARAM_INT);
                $stmt3->execute();

                $stmt4 = $db->prepare("DELETE FROM comments WHERE msg_id_fk=:msg_id");
                $stmt4->bindParam("msg_id", $msg_id,PDO::PARAM_INT);
                $stmt4->execute();
           
                $stmt5 = $db->prepare("DELETE FROM messages WHERE msg_id=:msg_id");
                $stmt5->bindParam("msg_id", $msg_id,PDO::PARAM_INT);
                $stmt5->execute();
            
        }
        $db = null;
        return true;
    }
    
    
    /* Comment Delete*/
    public function Comment_Delete($com_id)
    {
        $db = getDB();
        if(strlen($com_id))
        {
            $stmt = $db->prepare("DELETE FROM comment_like WHERE com_id_fk=:com_id");
            $stmt->bindParam("com_id", $com_id , PDO::PARAM_INT);
            $stmt->execute();
            $stmt1 = $db->prepare("DELETE FROM comments WHERE com_id=:com_id");
            $stmt1->bindParam("com_id", $com_id , PDO::PARAM_INT);
            $stmt1->execute();
        }
        $db = null;
        return true;
    }
    
    /* Group Delete*/
    public function Group_Delete($group_id)
    {
        $db = getDB();
        if(strlen($group_id))
        {
            $stmt = $db->prepare("DELETE FROM messages WHERE group_id_fk=:group_id");
            $stmt->bindParam("group_id", $group_id,PDO::PARAM_INT);
            $stmt->execute();
            $stmt1 = $db->prepare("DELETE FROM group_users WHERE group_id_fk=:group_id");
            $stmt1->bindParam("group_id", $group_id , PDO::PARAM_INT);
            $stmt1->execute();
            $stmt2 = $db->prepare("DELETE FROM groups WHERE group_id=':group_id'");
            $stmt2->bindParam("group_id", $group_id , PDO::PARAM_INT);
            $stmt2->execute();
        }
        $db = null;
        return true;
    }
    
    /* Group Block*/
    public function Group_Block($group_id,$type)
    {
        $db = getDB();
        if(strlen($type))
        {
            $stmt = $db->prepare("UPDATE groups SET status='1' WHERE group_id=:group_id");
            $stmt->bindParam("group_id", $group_id , PDO::PARAM_INT);
            $stmt->execute();
        }
        else
        {
            $stmt = $db->prepare("UPDATE groups SET status='0' WHERE group_id=:group_id");
            $stmt->bindParam("group_id", $group_id , PDO::PARAM_INT);
            $stmt->execute();
        }
        $db = null;
        return true;
    }
    
    /*Delete images*/
    public function Delete_Image($pid,$upload_path)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT id,image_path FROM user_uploads U WHERE id=:pid");
        $stmt->bindParam("pid", $pid , PDO::PARAM_INT);
        $stmt->execute();
        $num=$stmt->rowCount();
        
        if($num>0)
        {
            
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $data = json_decode(json_encode($row),true);
            
            $final_image="../".$upload_path.$data['image_path'];
            unlink($final_image);
            
            $q = $db->prepare("SELECT uploads,msg_id FROM messages WHERE  uploads!=0 AND  uploads LIKE :pid");
            $spid='%'.$pid.'%';
            $q->bindParam("pid", $spid);
            $q->execute();
            $row = $q->fetch(PDO::FETCH_OBJ);
            $d = json_decode(json_encode($row),true);
            $msgid=$d['msg_id'];
            $str = $d['uploads'];
            
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
            
            if(strlen($newSet)==0){
                $newSet='0';
            }
            
            
            
            $stmt1 = $db->prepare("UPDATE messages SET uploads=:newSet WHERE msg_id=:msgid");
            $stmt1->bindParam("newSet", $newSet, PDO::PARAM_STR);
            $stmt1->bindParam("msgid", $msgid , PDO::PARAM_INT);
            $stmt1->execute();
            
            $stmt2= $db->prepare("DELETE FROM user_uploads WHERE id=:pid");
            $stmt2->bindParam("pid", $pid , PDO::PARAM_INT);
            $stmt2->execute();
            return true;
        }
        return false;
    }
    
    
    /* Template Update*/
    public function Template($t_id,$t_order)
    {
        $db = getDB();
        if(strlen($t_id) && strlen($t_order))
        {
            $stmt = $db->prepare("UPDATE template SET t_order=:t_id WHERE t_id=:t_order");
            $stmt->bindParam("t_order", $t_order , PDO::PARAM_INT);
            $stmt->bindParam("t_id", $t_id , PDO::PARAM_INT);
            $stmt->execute();
        }
        $db = null;
        return true;
    }
    
    /* Template Update*/
    public function Template_Order()
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT t_id,t_name,t_file,t_order FROM template ORDER BY t_order ASC");
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    /* Template Update*/
    public function Insert_Advertisment($title,$desc,$url,$image)
    {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO advertisments(a_title,a_desc,a_url,a_img)VALUES(:title,:desc1,:url,:image)");
        $stmt->bindParam("title", $title,PDO::PARAM_STR);
        $stmt->bindParam("desc1", $desc , PDO::PARAM_STR);
        $stmt->bindParam("url", $url , PDO::PARAM_STR);
        $stmt->bindParam("image", $image , PDO::PARAM_STR);
        $stmt->execute();
        
        $stmt1 = $db->prepare("SELECT a_id,a_title,a_desc,a_url,a_img FROM advertisments ORDER BY a_id DESC LIMIT 1");
        $stmt1->execute();
        $row = $stmt1->fetch(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }

     public function Insert_Advertisment_Code($title,$code)
    {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO advertisments(a_title,ad_type,ad_code)VALUES(:title,'1',:code)");
        $stmt->bindParam("title", $title,PDO::PARAM_STR);
        $stmt->bindParam("code", $code , PDO::PARAM_STR);
        $stmt->execute();  
       
         $stmt1 = $db->prepare("SELECT a_id,a_title,a_desc,a_code FROM advertisments ORDER BY a_id DESC LIMIT 1");
        $stmt1->execute();
        $row = $stmt1->fetch(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }


    
    /* Advertisments*/
    public function Advertisments()
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT a_id,a_title,a_desc,a_url,a_img,status,ad_type,ad_code FROM advertisments ORDER BY a_id DESC");
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);
        $data = json_decode(json_encode($row),true);
        $db = null;
        return $data;
    }
    
    /* Template Update*/
    public function Advertisment_Delete($aid)
    {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM advertisments WHERE a_id=:aid");
        $stmt->bindParam("aid", $aid , PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        return true;
    }
    
    /* Image Config*/
    public function Image_Config($uploadimage,$banner,$profile,$upload)
    {
        $db = getDB();
        $final_uploadimage=$uploadimage*1024;
        $stmt = $db->prepare("UPDATE configurations SET uploadImage=:final_uploadimage,bannerWidth=:banner,profileWidth=:profile,upload=:upload WHERE con_id='1'");
        $stmt->bindParam("final_uploadimage", $final_uploadimage , PDO::PARAM_INT);
        $stmt->bindParam("banner", $banner , PDO::PARAM_INT);
        $stmt->bindParam("profile", $profile , PDO::PARAM_INT);
        $stmt->bindParam("upload", $upload , PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        return true;
    }
    
    /* PerPage Config*/
    public function Perpage_Config($NewsFeedPerPage,$notifications,$friends,$friendsWidget,$photos,$groups,$admin,$forgot)
    {
        $db = getDB();
        $stmt = $db->prepare("UPDATE configurations SET newsfeedPerPage=:newsFeedPerPage,notificationPerPage=:notifications,friendsPerPage=:friends,photosPerPage=:photos,groupsPerPage=:groups,adminPerPage=:admin,friendsWidgetPerPage=:friendsWidget,forgot=:forgot  WHERE con_id='1'");
        $stmt->bindParam("newsFeedPerPage", $NewsFeedPerPage , PDO::PARAM_INT);
        $stmt->bindParam("notifications", $notifications ,PDO::PARAM_INT);
        $stmt->bindParam("friends", $friends, PDO::PARAM_INT);
        $stmt->bindParam("friendsWidget", $friendsWidget , PDO::PARAM_INT);
        $stmt->bindParam("photos", $photos , PDO::PARAM_INT);
        $stmt->bindParam("groups", $groups , PDO::PARAM_INT);
        $stmt->bindParam("admin", $admin , PDO::PARAM_INT);
        $stmt->bindParam("forgot", $forgot , PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
    }
    
    /* SiteDetails Config*/
    public function Site_Config($applicationName,$applicationDesc,$applicationToken)
    {
        $db = getDB();
        $stmt = $db->prepare("UPDATE configurations SET applicationName=:applicationName,applicationDesc=:applicationDesc,applicationToken=:applicationToken WHERE con_id='1'");
        $stmt->bindParam("applicationName", $applicationName, PDO::PARAM_STR);
        $stmt->bindParam("applicationDesc", $applicationDesc, PDO::PARAM_STR);
        $stmt->bindParam("applicationToken", $applicationToken, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        return true;
    }
    
    
    
}
?>