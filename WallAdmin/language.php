<?php
include_once 'includes.php';
include_once 'includes/AdminUser.php';
$AdminUser = new AdminUser($db);

$language=1;
$msg="";
$pmsg="";
$qmsg="";
$a='';

/*Image Configuration*/
if(isSet($_POST['NewsFeedPerPage']) && isSet($_POST['notifications']))
{

}

$Get_Configurations=$WallAdmin->Get_Configurations();
$language_labels=$Get_Configurations["language_labels"];

/* Configurations   */
$Get_Labels=$WallAdmin->Get_Labels();
$commonFriends=$Get_Labels['commonFriends']; 
$commonFollowers=$Get_Labels['commonFollowers']; 
$commonGroups=$Get_Labels['commonGroups'];
$commonPhotos=$Get_Labels['commonPhotos'];
$commonCreateGroup=$Get_Labels['commonCreateGroup'];
$commonAbout=$Get_Labels['commonAbout'];
$commonRecentVisitors=$Get_Labels['commonRecentVisitors'];
$commonMembers=$Get_Labels['commonMembers'];
$commonViewAll=$Get_Labels['commonViewAll'];


$topMenuHome=$Get_Labels['topMenuHome']; 
$topMenuMessages=$Get_Labels['topMenuMessages'];
$topMenuNotifications=$Get_Labels['topMenuNotifications'];
$topMenuSeeAll=$Get_Labels['topMenuSeeAll'];
$topMenuSettings=$Get_Labels['topMenuSettings'];
$topMenuLogout=$Get_Labels['topMenuLogout'];
$topMenuLogin=$Get_Labels['topMenuLogin'];
$topMenuJoin=$Get_Labels['topMenuJoin'];

$boxName=$Get_Labels['boxName'];
$boxUpdates=$Get_Labels['boxUpdates'];
$boxWebcam=$Get_Labels['boxWebcam'];
$boxLocation=$Get_Labels['boxLocation'];

$feedLike=$Get_Labels['feedLike'];
$feedUnLike=$Get_Labels['feedUnLike'];
$feedLikeThis=$Get_Labels['feedLikeThis'];
$feedShare=$Get_Labels['feedShare'];
$feedUnshare=$Get_Labels['feedUnshare'];
$feedShareThis=$Get_Labels['feedShareThis'];
$feedComment=$Get_Labels['feedComment'];
$feedDeleteUpdate=$Get_Labels['feedDeleteUpdate'];
$feedPosted=$Get_Labels['feedPosted'];
$photosOfYours=$Get_Labels['photosOfYours'];
$yourPhotos=$Get_Labels['yourPhotos'];

$buttonUpdate=$Get_Labels['buttonUpdate'];
$buttonComment=$Get_Labels['buttonComment'];
$buttonFollow=$Get_Labels['buttonFollow'];
$buttonFollowing=$Get_Labels['buttonFollowing'];
$buttonMessage=$Get_Labels['buttonMessage'];
$buttonJoinGroup=$Get_Labels['buttonJoinGroup'];
$buttonUnfollowGroup=$Get_Labels['buttonUnfollowGroup'];
$buttonEditGroup=$Get_Labels['buttonEditGroup'];
$buttonSaveSettings=$Get_Labels['buttonSaveSettings'];
$buttonSocialSave=$Get_Labels['buttonSocialSave'];
$buttonLogin=$Get_Labels['buttonLogin'];
$buttonSignUp=$Get_Labels['buttonSignUp'];
$buttonForgotButton=$Get_Labels['buttonForgotButton'];
$buttonSetNewPassword=$Get_Labels['buttonSetNewPassword'];
$buttonFacebook=$Get_Labels['buttonFacebook'];
$buttonGoogle=$Get_Labels['buttonGoogle'];
$buttonMicrosoft=$Get_Labels['buttonMicrosoft'];
$buttonLinkedin=$Get_Labels['buttonLinkedin'];
$buttonYou=$Get_Labels['buttonYou'];

$settingsTitle=$Get_Labels['settingsTitle'];
$settingsUsername=$Get_Labels['settingsUsername'];
$settingsEmail=$Get_Labels['settingsEmail'];
$settingsName=$Get_Labels['settingsName'];
$settingsPassword=$Get_Labels['settingsPassword'];
$settingsChangePassword=$Get_Labels['settingsChangePassword'];
$settingsOldPassword=$Get_Labels['settingsOldPassword'];
$settingsNewPassword=$Get_Labels['settingsNewPassword'];
$settingsConfirmPassword=$Get_Labels['settingsConfirmPassword'];
$settingsGroup=$Get_Labels['settingsGroup'];
$settingsGender=$Get_Labels['settingsGender'];
$settingsAboutMe=$Get_Labels['settingsAboutMe'];
$settingsEmailAlerts=$Get_Labels['settingsEmailAlerts'];

$socialTitle=$Get_Labels['socialTitle'];
$socialFacebook=$Get_Labels['socialFacebook'];
$socialTwitter=$Get_Labels['socialTwitter'];
$socialGoogle=$Get_Labels['socialGoogle'];
$socialInstagram=$Get_Labels['socialInstagram'];

$loginTitle=$Get_Labels['loginTitle'];
$emailUsername=$Get_Labels['emailUsername'];
$password=$Get_Labels['password'];
$forgotPassword=$Get_Labels['forgotPassword'];
$registrationTitle=$Get_Labels['registrationTitle'];
$email=$Get_Labels['email'];
$username=$Get_Labels['username'];
$agreeMessage=$Get_Labels['agreeMessage'];
$resetPassword=$Get_Labels['resetPassword'];
$thankYou=$Get_Labels['thankYou'];
$thankYouMessage=$Get_Labels['thankYouMessage'];
$terms=$Get_Labels['terms'];

$placeSearch=$Get_Labels['placeSearch'];
$placeComment=$Get_Labels['placeComment'];
$placeUpdate=$Get_Labels['placeUpdate'];
$placeEmailUsername=$Get_Labels['placeEmailUsername'];
$placePassword=$Get_Labels['placePassword'];
$placeEmail=$Get_Labels['placeEmail'];
$placeUsername=$Get_Labels['placeUsername'];
$placeSendMessage=$Get_Labels['placeSendMessage'];

$notiFollowingYou=$Get_Labels['notiFollowingYou'];
$notiLiked=$Get_Labels['notiLiked'];
$notiShared=$Get_Labels['notiShared'];
$notiStatus=$Get_Labels['notiStatus'];
$notiIsFollowingGroup=$Get_Labels['notiIsFollowingGroup'];
$notiCommented=$Get_Labels['notiCommented'];
$msgDeleteConversation=$Get_Labels['msgDeleteConversation'];
$msgConversation=$Get_Labels['msgConversation'];
$msgStartConversation=$Get_Labels['msgStartConversation'];
$msgNoUpdates=$Get_Labels['msgNoUpdates'];
$msgNoMoreUpdates=$Get_Labels['msgNoMoreUpdates'];

$msgNoFriends=$Get_Labels['msgNoFriends'];
$msgNoMoreFriends=$Get_Labels['msgNoMoreFriends'];
$msgNoFollowers=$Get_Labels['msgNoFollowers'];
$msgNoMoreFollowers=$Get_Labels['msgNoMoreFollowers'];
$msgNoPhotos=$Get_Labels['msgNoPhotos'];
$msgNoMorePhotos=$Get_Labels['msgNoMorePhotos'];
$msgNoViews=$Get_Labels['msgNoViews'];
$msgNoMoreViews=$Get_Labels['msgNoMoreViews'];
$msgNoGroups=$Get_Labels['msgNoGroups'];
$msgNoMoreGroups=$Get_Labels['msgNoMoreGroups'];
$msgNoMembers=$Get_Labels['msgNoMembers'];
$msgNoMoreMembers=$Get_Labels['msgNoMoreMembers'];
$msgNoConversations=$Get_Labels['msgNoConversations'];

?>
<!DOCTYPE html>
<html>
    <?php include_once("head.php"); ?>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once("header.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
           <?php include_once("menu.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> Language </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Language</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 <div class="row">
                        <!-- left column -->

                        <!-- right column -->

						   <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Label Configurations</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                   <div class="box-body">
                                     <div class="form-group col-md-12">
                                    <label for="exampleInputPassword1"> Live</label>
                                            <?php if($language_labels)
                                            {
                                        ?>
                                        <input type="radio"  class="form-control live" name="live" id="languageLiveOn" value='1' style="width:20px !important" checked="checked"/> On  &nbsp;&nbsp;&nbsp;&nbsp;


                                        <input class="form-control live" type="radio" name="live"  id="languageLiveOff" value='0' style="width:20px !important"/> Off
                                        <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <input type="radio"  class="form-control live" name="live"  id="languageLiveOn" value='1' style="width:20px !important;" /> On &nbsp;&nbsp;&nbsp;&nbsp;

                                            <input class="form-control live" type="radio" name="live"  id="languageLiveOff" value='0' style="width:20px !important;" checked="checked"/> Off
                                            <?php
                                            }
                                            ?>
                                        </div></div>
                                    <div class="box-body">
                                    <?php 
if (!empty($_POST['commonSubmit'])) {

$commonFriends=$_POST['commonFriends'];
$commonGroups=$_POST['commonGroups'];
$commonPhotos=$_POST['commonPhotos'];
$commonCreateGroup=$_POST['commonCreateGroup'];
$commonAbout=$_POST['commonAbout'];
$commonRecentVisitors=$_POST['commonRecentVisitors'];
$commonFollowers=$_POST['commonFollowers'];
$commonMembers=$_POST['commonMembers'];
$commonViewAll=$_POST['commonViewAll'];

if(!empty($commonMembers) && !empty($commonViewAll) && !empty($commonFriends) && !empty($commonGroups) && !empty($commonPhotos) && !empty($commonCreateGroup) && !empty($commonAbout) && !empty($commonRecentVisitors) && !empty($commonFollowers) )
{
$data=$WallAdmin->commonLabelUpdate($commonMembers,$commonViewAll,$commonFriends,$commonGroups,$commonPhotos,$commonCreateGroup,$commonAbout,$commonRecentVisitors,$commonFollowers);
}
}
?>
									 <div class="form-group col-md-12">
                                             <h3 class="box-title" id="commonSubmit">Common Labels</h3>
                                        </div>


                                        <form name="common" method="post" action="#commonSubmit">
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Friends</label>
                                            <input type="text" class="form-control" name="commonFriends" value="<?php echo $commonFriends; ?>">
                                        </div>
										<div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Followers</label>
                                            <input type="text" class="form-control" name="commonFollowers" value="<?php echo $commonFollowers; ?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label >Groups</label>
                                            <input type="text" class="form-control" name="commonGroups" value="<?php echo $commonGroups; ?>">
                                        </div>
										 <div class="form-group col-md-3">
                                            <label >Photos</label>
                                            <input type="text" class="form-control" name="commonPhotos" value="<?php echo $commonPhotos; ?>">
                                        </div>
										
										 <div class="form-group col-md-3">
                                            <label >Create Group</label>
                                            <input type="text" class="form-control" name="commonCreateGroup" value="<?php echo $commonCreateGroup; ?>">
                                        </div>
                                       <div class="form-group col-md-3">
                                            <label >About</label>
                                            <input type="text" class="form-control" name="commonAbout" value="<?php echo $commonAbout; ?>">
                                        </div>
										<div class="form-group col-md-3">
                                            <label >Recent Visitors </label>
                                            <input type="text" class="form-control" name="commonRecentVisitors" value="<?php echo $commonRecentVisitors; ?>">
                                        </div>

<div class="form-group col-md-3">
<label >Members </label>
<input type="text" class="form-control" name="commonMembers" value="<?php echo $commonMembers; ?>">
</div>

<div class="form-group col-md-3">
<label >View All </label>
<input type="text" class="form-control" name="commonViewAll" value="<?php echo $commonViewAll; ?>">
</div>

                                        <div class="box-footer">
                                        <input type="submit" class="btn btn-success" name="commonSubmit" value="Save Labels" />
                                    </div>
                                    </form>
										
<?php 
if (!empty($_POST['topMenuSubmit'])) {

$topMenuHome=$_POST['topMenuHome'];
$topMenuMessages=$_POST['topMenuMessages'];
$topMenuNotifications=$_POST['topMenuNotifications'];
$topMenuSeeAll=$_POST['topMenuSeeAll'];
$topMenuSettings=$_POST['topMenuSettings'];
$topMenuLogout=$_POST['topMenuLogout'];
$topMenuLogin=$_POST['topMenuLogin'];
$topMenuJoin=$_POST['topMenuJoin'];
if(!empty($topMenuHome) && !empty($topMenuMessages) && !empty($topMenuNotifications) && !empty($topMenuSeeAll) && 
    !empty($topMenuSettings) && !empty($topMenuLogout) && !empty($topMenuLogin) && !empty($topMenuJoin) )
{
$data=$WallAdmin->topMenuLabelUpdate($topMenuHome,$topMenuMessages,$topMenuNotifications,
    $topMenuSeeAll,$topMenuSettings,$topMenuLogout,$topMenuLogin,$topMenuJoin);
}
}
?>									
								
<div class="form-group col-md-12">
<h3 class="box-title" id="topMenuSubmit">Top Menu</h3>
</div>
<form name="tomMenu" method="post" action="#topMenuSubmit">
<div class="form-group col-md-3">
<label for="exampleInputEmail1">Home</label>
<input type="text" class="form-control" name="topMenuHome" value="<?php echo $topMenuHome; ?>">
</div>
<div class="form-group col-md-3">
<label >Messages</label>
<input type="text" class="form-control" name="topMenuMessages" value="<?php echo $topMenuMessages; ?>">
</div>
<div class="form-group col-md-3">
<label >Notifications</label>
<input type="text" class="form-control" name="topMenuNotifications" value="<?php echo $topMenuNotifications; ?>">
</div>
<div class="form-group col-md-3">
<label >See All</label>
<input type="text" class="form-control" name="topMenuSeeAll" value="<?php echo $topMenuSeeAll; ?>">
</div>
<div class="form-group col-md-3">
<label >Settings</label>
<input type="text" class="form-control" name="topMenuSettings" value="<?php echo $topMenuSettings; ?>">
</div>
<div class="form-group col-md-3">
<label >Logout</label>
<input type="text" class="form-control" name="topMenuLogout" value="<?php echo $topMenuLogout; ?>">
</div>
<div class="form-group col-md-3">
<label >Login</label>
<input type="text" class="form-control" name="topMenuLogin" value="<?php echo $topMenuLogin; ?>">
</div>
<div class="form-group col-md-3">
<label >Join</label>
<input type="text" class="form-control" name="topMenuJoin" value="<?php echo $topMenuJoin; ?>">
</div>
<div class="box-footer">
<input type="submit" class="btn btn-success" name="topMenuSubmit" value="Save Changes"  />
</div>
</form>

<?php 
if (!empty($_POST['boxSubmit'])) {

$boxName=$_POST['boxName'];
$boxUpdates=$_POST['boxUpdates'];
$boxWebcam=$_POST['boxWebcam'];
$boxLocation=$_POST['boxLocation'];

if(!empty($boxName) && !empty($boxUpdates) && !empty($boxWebcam) && !empty($boxLocation) )
{
$data=$WallAdmin->boxLabelUpdate($boxName,$boxUpdates,$boxWebcam,$boxLocation);
}
}
?>  

<div class="form-group col-md-12">
 <h3 class="box-title" id="updateBox">Update Box</h3>
</div>
<form name="updateBox" method="post" action="#updateBox">
<div class="form-group col-md-3">
<label >What's Up</label>
<input type="text" class="form-control" name="boxName" value="<?php echo $boxName; ?>">
</div>

<div class="form-group col-md-3">
<label >Updates</label>
<input type="text" class="form-control" name="boxUpdates" value="<?php echo $boxUpdates; ?>">
</div>

<div class="form-group col-md-3">
<label >Webcam</label>
<input type="text" class="form-control" name="boxWebcam" value="<?php echo $boxWebcam; ?>">
</div>

<div class="form-group col-md-3">
<label >Location</label>
<input type="text" class="form-control" name="boxLocation" value="<?php echo $boxLocation; ?>">
</div>
<div class="box-footer">
<input type="submit" class="btn btn-success" name="boxSubmit" value="Save Changes" />
</div>
</form>

<?php 
if (!empty($_POST['newsFeedSubmit'])) {

$feedLike=$_POST['feedLike'];
$feedUnLike=$_POST['feedUnLike'];
$feedLikeThis=$_POST['feedLikeThis'];
$feedShare=$_POST['feedShare'];
$feedUnshare=$_POST['feedUnshare'];
$feedShareThis=$_POST['feedShareThis'];
$feedComment=$_POST['feedComment'];
$feedDeleteUpdate=$_POST['feedDeleteUpdate'];
$feedPosted=$_POST['feedPosted'];

if(!empty($feedLike) && !empty($feedUnLike) && !empty($feedLikeThis) && !empty($feedShare) && !empty($feedUnshare) && !empty($feedComment) && !empty($feedShareThis) && !empty($feedDeleteUpdate) && !empty($feedPosted) )
{
$data=$WallAdmin->newsFeedLabelUpdate($feedLike,$feedUnLike,$feedLikeThis,$feedShare,$feedUnshare,$feedComment,$feedShareThis,$feedDeleteUpdate, $feedPosted);
}
}
?> 

<div class="form-group col-md-12">
     <h3 class="box-title" id="newsFeed">News Feed</h3>
</div>

 <form name="newsFeed" method="post" action="#newsFeed">
<div class="form-group col-md-3">
    <label >Like</label>
    <input type="text" class="form-control" name="feedLike" value="<?php echo $feedLike; ?>">
</div>

<div class="form-group col-md-3">
    <label >Unlike</label>
    <input type="text" class="form-control" name="feedUnLike" value="<?php echo $feedUnLike; ?>">
</div>

<div class="form-group col-md-3">
    <label >like this</label>
    <input type="text" class="form-control" name="feedLikeThis" value="<?php echo $feedLikeThis; ?>">
</div>

<div class="form-group col-md-3">
    <label >Share</label>
    <input type="text" class="form-control" name="feedShare" value="<?php echo $feedShare; ?>">
</div>

<div class="form-group col-md-3">
    <label >Unshare</label>
    <input type="text" class="form-control" name="feedUnshare" value="<?php echo $feedUnshare; ?>">
</div>

<div class="form-group col-md-3">
    <label >shared this</label>
    <input type="text" class="form-control" name="feedShareThis" value="<?php echo $feedShareThis; ?>">
</div>

<div class="form-group col-md-3">
    <label >Comment</label>
    <input type="text" class="form-control" name="feedComment" value="<?php echo $feedComment; ?>">
</div>

<div class="form-group col-md-3">
    <label >Delete Update</label>
    <input type="text" class="form-control" name="feedDeleteUpdate" value="<?php echo $feedDeleteUpdate; ?>">
</div>

  <div class="form-group col-md-3">
    <label >posted in</label>
    <input type="text" class="form-control" name="feedPosted" value="<?php echo $feedPosted; ?>">
</div>
 <div class="box-footer">
<input type="submit" class="btn btn-success" name="newsFeedSubmit" value="Save Changes" />
</div>
</form>

<?php 
if (!empty($_POST['photosSubmit'])) 
{
$yourPhotos=$_POST['yourPhotos'];
$photosOfYours=$_POST['photosOfYours'];
if(!empty($yourPhotos) && !empty($photosOfYours))
{
$data=$WallAdmin->photosLabelUpdate($yourPhotos,$photosOfYours);
}
}
?>

<div class="form-group col-md-12">
<h3 class="box-title" id="photosPage">Photos Page</h3>
</div>
<form name="photosPage" method="post" action="#photosPage">
<div class="form-group col-md-3">
<label >Profile Photos</label>
<input type="text" class="form-control" name="yourPhotos" value="<?php echo $yourPhotos; ?>">
</div>

<div class="form-group col-md-3">
<label >Photos of</label>
<input type="text" class="form-control" name="photosOfYours" value="<?php echo $photosOfYours; ?>">
</div>
<div class="box-footer">
<input type="submit" class="btn btn-success" name="photosSubmit" value="Save Changes" />
</div>
</form>




<?php 
if (!empty($_POST['buttonSubmit'])) {

$buttonUpdate=$_POST['buttonUpdate'];
$buttonComment=$_POST['buttonComment'];
$buttonFollow=$_POST['buttonFollow'];
$buttonFollowing=$_POST['buttonFollowing'];
$buttonMessage=$_POST['buttonMessage'];
$buttonJoinGroup=$_POST['buttonJoinGroup'];
$buttonUnfollowGroup=$_POST['buttonUnfollowGroup'];
$buttonEditGroup=$_POST['buttonEditGroup'];
$buttonSaveSettings=$_POST['buttonSaveSettings'];
$buttonSocialSave=$_POST['buttonSocialSave'];
$buttonLogin=$_POST['buttonLogin'];
$buttonSignUp=$_POST['buttonSignUp'];
$buttonForgotButton=$_POST['buttonForgotButton'];
$buttonSetNewPassword=$_POST['buttonSetNewPassword'];
$buttonFacebook=$_POST['buttonFacebook'];
$buttonGoogle=$_POST['buttonGoogle'];
$buttonMicrosoft=$_POST['buttonMicrosoft'];
$buttonLinkedin=$_POST['buttonLinkedin'];
$buttonYou=$_POST['buttonYou'];

if(!empty($buttonUpdate) && !empty($buttonComment) && !empty($buttonFollow) && 
    !empty($buttonFollowing) && !empty($buttonMessage) && !empty($buttonJoinGroup) && 
    !empty($buttonUnfollowGroup) && !empty($buttonEditGroup) && !empty($buttonSaveSettings) && 
    !empty($buttonSocialSave) && !empty($buttonLogin) && !empty($buttonSignUp) && 
    !empty($buttonForgotButton) && !empty($buttonSetNewPassword) && !empty($buttonFacebook) && 
    !empty($buttonGoogle) && !empty($buttonMicrosoft) && !empty($buttonLinkedin) && !empty($buttonYou))
{
$data=$WallAdmin->buttonLabelUpdate($buttonUpdate,$buttonComment,$buttonFollow,
    $buttonFollowing,$buttonMessage,$buttonJoinGroup,$buttonUnfollowGroup,
    $buttonEditGroup, $buttonSaveSettings,$buttonSocialSave,$buttonLogin,$buttonSignUp,
    $buttonForgotButton,$buttonSetNewPassword,$buttonFacebook,$buttonGoogle,$buttonMicrosoft,$buttonLinkedin,$buttonYou);
}
}
?> 

<div class="form-group col-md-12">
<h3 class="box-title" id="buttonsDiv">Buttons</h3>
</div>
<form name="buttonsForm" method="post" action="#buttonsDiv">
<div class="form-group col-md-3">
<label >Update</label>
<input type="text" class="form-control" name="buttonUpdate" value="<?php echo $buttonUpdate; ?>">
</div>

<div class="form-group col-md-3">
<label >Comment</label>
<input type="text" class="form-control" name="buttonComment" value="<?php echo $buttonComment; ?>">
</div>

<div class="form-group col-md-3">
<label >Follow</label>
<input type="text" class="form-control" name="buttonFollow" value="<?php echo $buttonFollow; ?>">
</div>

<div class="form-group col-md-3">
<label >Following</label>
<input type="text" class="form-control" name="buttonFollowing" value="<?php echo $buttonFollowing; ?>">
</div>

<div class="form-group col-md-3">
<label >Message</label>
<input type="text" class="form-control" name="buttonMessage" value="<?php echo $buttonMessage; ?>">
</div>

<div class="form-group col-md-3">
<label >Join Group</label>
<input type="text" class="form-control" name="buttonJoinGroup" value="<?php echo $buttonJoinGroup; ?>">
</div>

<div class="form-group col-md-3">
<label >Unfollow Group</label>
<input type="text" class="form-control" name="buttonUnfollowGroup" value="<?php echo $buttonUnfollowGroup; ?>">
</div>

<div class="form-group col-md-3">
<label >Edit Group</label>
<input type="text" class="form-control" name="buttonEditGroup" value="<?php echo $buttonEditGroup; ?>">
</div>


<div class="form-group col-md-3">
<label >Save Settings</label>
<input type="text" class="form-control" name="buttonSaveSettings" value="<?php echo $buttonSaveSettings; ?>">
</div>

<div class="form-group col-md-3">
<label >Social Save</label>
<input type="text" class="form-control" name="buttonSocialSave" value="<?php echo $buttonSocialSave; ?>">
</div>

<div class="form-group col-md-3">
<label >Login</label>
<input type="text" class="form-control" name="buttonLogin" value="<?php echo $buttonLogin; ?>">
</div>

<div class="form-group col-md-3">
<label >Sign Up</label>
<input type="text" class="form-control" name="buttonSignUp" value="<?php echo $buttonSignUp; ?>">
</div>

 <div class="form-group col-md-3">
<label >Forgot Password</label>
<input type="text" class="form-control" name="buttonForgotButton" value="<?php echo $buttonForgotButton; ?>">
</div>

<div class="form-group col-md-3">
<label >Set New Password - Reset</label>
<input type="text" class="form-control" name="buttonSetNewPassword" value="<?php echo $buttonSetNewPassword; ?>">
</div>

<div class="form-group col-md-3">
<label >You</label>
<input type="text" class="form-control" name="buttonYou" value="<?php echo $buttonYou; ?>">
</div>

<div class="form-group col-md-3">
<label >Login with Facebook</label>
<input type="text" class="form-control" name="buttonFacebook" value="<?php echo $buttonFacebook; ?>">
</div>
<div class="form-group col-md-3">
<label >Login with Google</label>
<input type="text" class="form-control" name="buttonGoogle" value="<?php echo $buttonGoogle; ?>">
</div>
<div class="form-group col-md-3">
<label >Login with Microsoft</label>
<input type="text" class="form-control" name="buttonMicrosoft" value="<?php echo $buttonMicrosoft; ?>">
</div>
<div class="form-group col-md-3">
<label >Login with LinkedIn</label>
<input type="text" class="form-control" name="buttonLinkedin" value="<?php echo $buttonLinkedin; ?>">
</div>
<div class="box-footer">
<input type="submit" class="btn btn-success" name="buttonSubmit" value="Save Changes" />
</div>
</form>

<?php 
if (!empty($_POST['settingsSubmit'])) 
{
$settingsTitle=$_POST['settingsTitle'];
$settingsUsername=$_POST['settingsUsername'];
$settingsEmail=$_POST['settingsEmail'];
$settingsName=$_POST['settingsName'];
$settingsPassword=$_POST['settingsPassword'];
$settingsChangePassword=$_POST['settingsChangePassword'];
$settingsOldPassword=$_POST['settingsOldPassword'];
$settingsNewPassword=$_POST['settingsNewPassword'];
$settingsConfirmPassword=$_POST['settingsConfirmPassword'];
$settingsGroup=$_POST['settingsGroup'];
$settingsGender=$_POST['settingsGender'];
$settingsAboutMe=$_POST['settingsAboutMe'];
$settingsEmailAlerts=$_POST['settingsEmailAlerts'];

if(!empty($settingsTitle) && !empty($settingsUsername) && !empty($settingsEmail) && !empty($settingsName) &&
  !empty($settingsPassword) && !empty($settingsChangePassword) && !empty($settingsOldPassword) && !empty($settingsNewPassword) &&
  !empty($settingsConfirmPassword) && !empty($settingsGroup) && !empty($settingsGender) && !empty($settingsAboutMe) && !empty($settingsEmailAlerts) )
{
$data=$WallAdmin->settingsLabelUpdate($settingsTitle,$settingsUsername,$settingsEmail,$settingsName,
    $settingsPassword,$settingsChangePassword,$settingsOldPassword,$settingsNewPassword,
    $settingsConfirmPassword,$settingsGroup,$settingsGender,$settingsAboutMe,$settingsEmailAlerts);
}
}
?>

<div class="form-group col-md-12">
<h3 class="box-title" id="userSettings">User Setting Page</h3>
</div>
<form method="post" action="#userSettings" name="userSettingPage">
<div class="form-group col-md-3">
<label >Settings Title</label>
<input type="text" class="form-control" name="settingsTitle" value="<?php echo $settingsTitle; ?>">
</div>
<div class="form-group col-md-3">
<label >Username</label>
<input type="text" class="form-control" name="settingsUsername" value="<?php echo $settingsUsername; ?>">
</div>

<div class="form-group col-md-3">
<label >Email</label>
<input type="text" class="form-control" name="settingsEmail" value="<?php echo $settingsEmail; ?>">
</div>

<div class="form-group col-md-3">
<label >Name</label>
<input type="text" class="form-control" name="settingsName" value="<?php echo $settingsName; ?>">
</div>

<div class="form-group col-md-3">
<label >Password</label>
<input type="text" class="form-control" name="settingsPassword" value="<?php echo $settingsPassword; ?>">
</div>

<div class="form-group col-md-3">
<label >Change Password</label>
<input type="text" class="form-control" name="settingsChangePassword" value="<?php echo $settingsChangePassword; ?>">
</div>

<div class="form-group col-md-3">
<label >Old Password</label>
<input type="text" class="form-control" name="settingsOldPassword" value="<?php echo $settingsOldPassword; ?>">
</div>

<div class="form-group col-md-3">
<label >New Password</label>
<input type="text" class="form-control" name="settingsNewPassword" value="<?php echo $settingsNewPassword; ?>">
</div>

<div class="form-group col-md-3">
<label >Confirm Password</label>
<input type="text" class="form-control" name="settingsConfirmPassword" value="<?php echo $settingsConfirmPassword; ?>">
</div>

<div class="form-group col-md-3">
<label >Group</label>
<input type="text" class="form-control" name="settingsGroup" value="<?php echo $settingsGroup; ?>">
</div>

<div class="form-group col-md-3">
<label >Gender</label>
<input type="text" class="form-control" name="settingsGender" value="<?php echo $settingsGender; ?>">
</div>

<div class="form-group col-md-3">
<label >About Me</label>
<input type="text" class="form-control" name="settingsAboutMe" value="<?php echo $settingsAboutMe; ?>">
</div>

<div class="form-group col-md-3">
<label >Email Alerts</label>
<input type="text" class="form-control" name="settingsEmailAlerts" value="<?php echo $settingsEmailAlerts; ?>">
</div>
<div class="box-footer">
<input type="submit" class="btn btn-success" name="settingsSubmit" value="Save Changes" />
</div>
</form>


<?php 
if (!empty($_POST['socialSubmit'])) 
{
$socialTitle=$_POST['socialTitle'];
$socialFacebook=$_POST['socialFacebook'];
$socialTwitter=$_POST['socialTwitter'];
$socialGoogle=$_POST['socialGoogle'];
$socialInstagram=$_POST['socialInstagram'];

if(!empty($socialTitle) && !empty($socialFacebook) && !empty($socialTwitter) && !empty($socialGoogle) && !empty($socialInstagram))
{
$data=$WallAdmin->socialLabelUpdate($socialTitle,$socialFacebook,$socialTwitter,$socialGoogle,$socialInstagram);
}

}
?>

     
<div class="form-group col-md-12">
<h3 class="box-title" id="socialProfile">Social Profile</h3>
</div>
<form method="post" action="#socialProfile" name="socialProfile">
<div class="form-group col-md-3">
<label >Social Title</label>
<input type="text" class="form-control" name="socialTitle" value="<?php echo $socialTitle; ?>">
</div>
<div class="form-group col-md-3">
<label >Social Facebook</label>
<input type="text" class="form-control" name="socialFacebook" value="<?php echo $socialFacebook; ?>">
</div>
<div class="form-group col-md-3">
<label >Social Twitter</label>
<input type="text" class="form-control" name="socialTwitter" value="<?php echo $socialTwitter; ?>">
</div>

<div class="form-group col-md-3">
<label >Social Google</label>
<input type="text" class="form-control" name="socialGoogle" value="<?php echo $socialGoogle; ?>">
</div>

<div class="form-group col-md-3">
<label >Social Instagram</label>
<input type="text" class="form-control" name="socialInstagram" value="<?php echo $socialInstagram; ?>">
</div>
<div class="box-footer">
<input type="submit" class="btn btn-success" name="socialSubmit" value="Save Changes" />
</div>
</form>

<?php 
if (!empty($_POST['loginSubmit'])) 
{
$loginTitle=$_POST['loginTitle'];
$emailUsername=$_POST['emailUsername'];
$password=$_POST['password'];
$forgotPassword=$_POST['forgotPassword'];
$registrationTitle=$_POST['registrationTitle'];
$email=$_POST['email'];
$username=$_POST['emailUsername'];
$agreeMessage=$_POST['agreeMessage'];
$resetPassword=$_POST['resetPassword'];
$thankYou=$_POST['thankYou'];
$thankYouMessage=$_POST['thankYouMessage'];
$terms=$_POST['terms'];

if(!empty($loginTitle) && !empty($emailUsername) && !empty($password) && !empty($forgotPassword) && !empty($registrationTitle) &&
    !empty($email) && !empty($username) && !empty($agreeMessage) && !empty($resetPassword) && !empty($thankYou) && !empty($thankYouMessage) && !empty($terms))
{
$data=$WallAdmin->loginLabelUpdate($loginTitle,$emailUsername,$password,$forgotPassword,$registrationTitle,
    $email,$username,$agreeMessage,$resetPassword,$thankYou,$thankYouMessage,$terms);
}

}
?>

    <div class="form-group col-md-12">
    <h3 class="box-title" id="loginForgot">Login Forgot Forms</h3>
    </div>
    <form method="post" action="#loginForgot" name="loginForogt">
    <div class="form-group col-md-3">
    <label >Login Title</label>
    <input type="text" class="form-control" name="loginTitle" value="<?php echo $loginTitle; ?>">
    </div>
    <div class="form-group col-md-3">
    <label >Email or Username</label>
    <input type="text" class="form-control" name="emailUsername" value="<?php echo $emailUsername; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Password</label>
    <input type="text" class="form-control" name="password" value="<?php echo $password; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Forgot Password</label>
    <input type="text" class="form-control" name="forgotPassword" value="<?php echo $forgotPassword; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Registration Title</label>
    <input type="text" class="form-control" name="registrationTitle" value="<?php echo $registrationTitle; ?>">
    </div>
    <div class="form-group col-md-3">
    <label >Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Sign Up Agree Message</label>
    <input type="text" class="form-control" name="agreeMessage" value="<?php echo $agreeMessage; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Reset Password</label>
    <input type="text" class="form-control" name="resetPassword" value="<?php echo $resetPassword; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Thank You</label>
    <input type="text" class="form-control" name="thankYou" value="<?php echo $thankYou; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Please conirm message</label>
    <input type="text" class="form-control" name="thankYouMessage" value="<?php echo $thankYouMessage; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Terms</label>
    <input type="text" class="form-control" name="terms" value="<?php echo $terms; ?>">
    </div>

    <div class="box-footer">
    <input type="submit" class="btn btn-success" name="loginSubmit" value="Save Changes" />
    </div>
    </form>

  <?php 
if (!empty($_POST['notiSubmit'])) 
{
$notiFollowingYou=$_POST['notiFollowingYou'];
$notiLiked=$_POST['notiLiked'];
$notiShared=$_POST['notiShared'];
$notiStatus=$_POST['notiStatus'];
$notiIsFollowingGroup=$_POST['notiIsFollowingGroup'];
$notiCommented=$_POST['notiCommented'];

if(!empty($notiFollowingYou) && !empty($notiLiked) && !empty($notiShared) 
    && !empty($notiStatus) && !empty($socialInstagram) && !empty($notiCommented))
{
$data=$WallAdmin->notiLabelUpdate($notiFollowingYou,$notiLiked,$notiShared,
    $notiStatus,$notiIsFollowingGroup,$notiCommented);
}

}
?>

       <div class="form-group col-md-12">
    <h3 class="box-title" id="notifications">Notifications</h3>
    </div>
    <form method="post" action="#notifications" name="loginForogt">
    <div class="form-group col-md-3">
    <label >following you</label>
    <input type="text" class="form-control" name="notiFollowingYou" value="<?php echo $notiFollowingYou; ?>">
    </div>
    <div class="form-group col-md-3">
    <label >liked</label>
    <input type="text" class="form-control" name="notiLiked" value="<?php echo $notiLiked; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >shared</label>
    <input type="text" class="form-control" name="notiShared" value="<?php echo $notiShared; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >status</label>
    <input type="text" class="form-control" name="notiStatus" value="<?php echo $notiStatus; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >following group</label>
    <input type="text" class="form-control" name="notiIsFollowingGroup" value="<?php echo $notiIsFollowingGroup; ?>">
    </div>
    <div class="form-group col-md-3">
    <label >commented</label>
    <input type="text" class="form-control" name="notiCommented" value="<?php echo $notiCommented; ?>">
    </div>

    <div class="box-footer">
    <input type="submit" class="btn btn-success" name="notiSubmit" value="Save Changes" />
    </div>
    </form>

   <?php 
if (!empty($_POST['msgSubmit'])) 
{
$msgDeleteConversation=$_POST['msgDeleteConversation'];
$msgConversation=$_POST['msgConversation'];
$msgStartConversation=$_POST['msgStartConversation'];
$msgNoUpdates=$_POST['msgNoUpdates'];
$msgNoMoreUpdates=$_POST['msgNoMoreUpdates'];
$msgNoFriends=$_POST['msgNoFriends'];
$msgNoMoreFriends=$_POST['msgNoMoreFriends'];
$msgNoFollowers=$_POST['msgNoFollowers'];
$msgNoMoreFollowers=$_POST['msgNoMoreFollowers'];
$msgNoPhotos=$_POST['msgNoPhotos'];
$msgNoMorePhotos=$_POST['msgNoMorePhotos'];
$msgNoViews=$_POST['msgNoViews'];
$msgNoMoreViews=$_POST['msgNoMoreViews'];
$msgNoGroups=$_POST['msgNoGroups'];
$msgNoMoreGroups=$_POST['msgNoMoreGroups'];
$msgNoMembers=$_POST['msgNoMembers'];
$msgNoMoreMembers=$_POST['msgNoMoreMembers'];
$msgNoConversations=$_POST['msgNoConversations'];

if(!empty($msgDeleteConversation) && !empty($msgConversation) && !empty($msgStartConversation) 
    && !empty($msgNoUpdates) && !empty($msgNoMoreUpdates) && !empty($msgNoFriends) 
    && !empty($msgNoMoreFriends) && !empty($msgNoFollowers) 
    && !empty($msgNoMoreFollowers) && !empty($msgNoPhotos) && !empty($msgNoMorePhotos)
     && !empty($msgNoViews) && !empty($msgNoMoreViews) && !empty($msgNoGroups) && !empty($msgNoMoreGroups) 
     && !empty($msgNoMembers) && !empty($msgNoMoreMembers) && !empty($msgNoConversations))
{
$data=$WallAdmin->msgLabelUpdate($msgDeleteConversation,$msgConversation,$msgStartConversation,
    $msgNoUpdates,$msgNoMoreUpdates,$msgNoFriends,
    $msgNoMoreFriends,$msgNoFollowers,
    $msgNoMoreFollowers,$msgNoPhotos,$msgNoMorePhotos,
    $msgNoViews,$msgNoMoreViews,$msgNoGroups,$msgNoMoreGroups,
    $msgNoMembers,$msgNoMoreMembers,$msgNoConversations);
}

}
?>

     <div class="form-group col-md-12">
    <h3 class="box-title" id="otherMessages">Other Messages</h3>
    </div>


    <form method="post" action="#otherMessages" name="loginForogt">
    <div class="form-group col-md-3">
    <label >Delete Conversation</label>

    <input type="text" class="form-control" name="msgDeleteConversation" value="<?php echo $msgDeleteConversation; ?>">
    </div>
    <div class="form-group col-md-3">
    <label >Conversation</label>
    <input type="text" class="form-control" name="msgConversation" value="<?php echo $msgConversation; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >Start conversation</label>
    <input type="text" class="form-control" name="msgStartConversation" value="<?php echo $msgStartConversation; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No updates</label>
    <input type="text" class="form-control" name="msgNoUpdates" value="<?php echo $msgNoUpdates; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No more updates</label>
    <input type="text" class="form-control" name="msgNoMoreUpdates" value="<?php echo $msgNoMoreUpdates; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No friends</label>
    <input type="text" class="form-control" name="msgNoFriends" value="<?php echo $msgNoFriends; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No more friends</label>
    <input type="text" class="form-control" name="msgNoMoreFriends" value="<?php echo $msgNoMoreFriends; ?>">
    </div>

     <div class="form-group col-md-3">
    <label >No followers</label>
    <input type="text" class="form-control" name="msgNoFollowers" value="<?php echo $msgNoFollowers; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No more followers</label>
    <input type="text" class="form-control" name="msgNoMoreFollowers" value="<?php echo $msgNoMoreFollowers; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No Photos</label>
    <input type="text" class="form-control" name="msgNoPhotos" value="<?php echo $msgNoPhotos; ?>">
    </div>
    
    <div class="form-group col-md-3">
    <label >No more photos</label>
    <input type="text" class="form-control" name="msgNoMorePhotos" value="<?php echo $msgNoMorePhotos; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No views</label>
    <input type="text" class="form-control" name="msgNoViews" value="<?php echo $msgNoViews; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No more views</label>
    <input type="text" class="form-control" name="msgNoMoreViews" value="<?php echo $msgNoMoreViews; ?>">
    </div>
    
    <div class="form-group col-md-3">
    <label >No groups</label>
    <input type="text" class="form-control" name="msgNoGroups" value="<?php echo $msgNoGroups; ?>">
    </div>


    <div class="form-group col-md-3">
    <label >No more groups</label>
    <input type="text" class="form-control" name="msgNoMoreGroups" value="<?php echo $msgNoMoreGroups; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No members</label>
    <input type="text" class="form-control" name="msgNoMembers" value="<?php echo $msgNoMembers; ?>">
    </div>
    
    <div class="form-group col-md-3">
    <label >No more members</label>
    <input type="text" class="form-control" name="msgNoMoreMembers" value="<?php echo $msgNoMoreMembers; ?>">
    </div>

    <div class="form-group col-md-3">
    <label >No conversations</label>
    <input type="text" class="form-control" name="msgNoConversations" value="<?php echo $msgNoConversations; ?>">
    </div>

    <div class="box-footer">
    <input type="submit" class="btn btn-success" name="msgSubmit" value="Save Changes" />
    </div>
    </form>

<?php 
if (!empty($_POST['placeSubmit'])) 
{
$placeSearch=$_POST['placeSearch'];
$placeComment=$_POST['placeComment'];
$placeUpdate=$_POST['placeUpdate'];
$placeEmailUsername=$_POST['placeEmailUsername'];
$placePassword=$_POST['placePassword'];
$placeEmail=$_POST['placeEmail'];
$placeUsername=$_POST['placeUsername'];
$placeSendMessage=$_POST['placeSendMessage'];

if(!empty($placeSearch) && !empty($placeComment) && !empty($placeUpdate) && !empty($placeEmailUsername) && 
    !empty($placePassword) && !empty($placeEmail) && !empty($placeUsername) && !empty($placeSendMessage))
{
$data=$WallAdmin->placeLabelUpdate($placeSearch,$placeComment,$placeUpdate,$placeEmailUsername,
    $placePassword,$placeEmail,$placeUsername,$placeSendMessage);
}

}
?>

<div class="form-group col-md-12">
<h3 class="box-title" id="placeHolder">Placeholders</h3>
</div>

<form method="post" action="#placeHolder" name="placeholders">

<div class="form-group col-md-3">
<label >Search of people</label>
<input type="text" class="form-control" name="placeSearch" value="<?php echo $placeSearch; ?>">
</div>
<div class="form-group col-md-3">
<label >Write a comment</label>
<input type="text" class="form-control" name="placeComment" value="<?php echo $placeComment; ?>">
</div>

<div class="form-group col-md-3">
<label >Write a update.</label>
<input type="text" class="form-control" name="placeUpdate" value="<?php echo $placeUpdate; ?>">
</div>

<div class="form-group col-md-3">
<label >Email or Username.</label>
<input type="text" class="form-control" name="placeEmailUsername" value="<?php echo $placeEmailUsername; ?>">
</div>

<div class="form-group col-md-3">
<label >Enter Password</label>
<input type="text" class="form-control" name="placePassword" value="<?php echo $placePassword; ?>">
</div>

<div class="form-group col-md-3">
<label >Enter Email</label>
<input type="text" class="form-control" name="placeEmail" value="<?php echo $placeEmail; ?>">
</div>

<div class="form-group col-md-3">
<label >Enter Username</label>
<input type="text" class="form-control" name="placeUsername" value="<?php echo $placeUsername; ?>">
</div>

<div class="form-group col-md-3">
<label >Send Message</label>
<input type="text" class="form-control" name="placeSendMessage" value="<?php echo $placeSendMessage; ?>">
</div>
                           
</div><!-- /.box-body -->

<div class="box-footer">
<input type="submit" class="btn btn-success" name="placeSubmit" value="Save Changes" />
</div>

</form>





</div><!-- /.box -->




                        </div><!--/.col (left) -->

                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

    </body>
</html>