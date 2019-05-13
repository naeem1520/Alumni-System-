<?php

if($data)
{
    
    $cdata=$oauthLogin->configurations();
    
    $uid=$data->uid;
    $notification_created=$data->notification_created;
    $username=$data->username;
    $name=$data->name;
    $profile_pic=BASE_URL.'wall_icons/default.png';
    $tour=$data->tour;
    $key=SITE_KEY.$uid;
    $token = md5($key);
    
    $newsfeedPerPage=$cdata->newsfeedPerPage;
    $friendsPerPage=$cdata->friendsPerPage;
    $photosPerPage=$cdata->photosPerPage;
    $groupsPerPage=$cdata->groupsPerPage;
    $notificationPerPage=$cdata->notificationPerPage;
    $friendsWidgetPerPage=$cdata->friendsWidgetPerPage;
    
 $url=BASE_URL.'authentication.php?uid='.$uid.'&token='.$token.
       '&name='.$name.'&username='.$username.'&pic='.$profile_pic.
       '&newsfeedPerPage='.$newsfeedPerPage.'&notification_created='.$notification_created.'&friendsPerPage='.$friendsPerPage.
       '&photosPerPage='.$photosPerPage.'&groupsPerPage='.$groupsPerPage.
       '&notificationPerPage='.$notificationPerPage.'&friendsWidgetPerPage='.$friendsWidgetPerPage.'&tour='.$tour;

    //echo $url;
    echo "<script>window.location.href='".$url."'</script>";
}
else
{
    header("Location:$index");
    //echo "<script>window.location.href='".$index."'</script>";
}
?>