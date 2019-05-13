<?php
$friendsNewsFeedCount=count($friendsNewsFeed);

for($z=0;$z<$friendsNewsFeedCount;$z++)
{
/* TimeAgo */
$originalMessage=$friendsNewsFeed[$z]->message;
$n_time=$friendsNewsFeed[$z]->created;
$friendsNewsFeed[$z]->timeAgo=date("c", $n_time);

$friendsNewsFeed[$z]->profile_pic=profilePic($friendsNewsFeed[$z]->profile_pic);
$friendsNewsFeed[$z]->message=ucfirst($friendsNewsFeed[$z]->message);
/*Like and Share Check */
//$friendsNewsFeed[$z]->likeCheck=internalLikeCheck($uid,$friendsNewsFeed[$z]->msg_id);

$likeCheckData=internalLikeCheck($uid,$friendsNewsFeed[$z]->msg_id);
$friendsNewsFeed[$z]->likeCheck=$likeCheckData->like_id;
$friendsNewsFeed[$z]->likeCheckReaction=$likeCheckData->reactionType;


$friendsNewsFeed[$z]->shareCheck=internalShareCheck($uid,$friendsNewsFeed[$z]->msg_id);
/* Message Details*/

$friendsNewsFeed[$z]->messageDetails=internalMessageDetails($friendsNewsFeed[$z]->msg_id);
$friendsNewsFeed[$z]->shareUserDetails=internalUserDetails($friendsNewsFeed[$z]->share_uid);
$friendsNewsFeed[$z]->likeUserDetails=internalUserDetails($friendsNewsFeed[$z]->like_uid);
$friendsNewsFeed[$z]->groupDetails=internalGroupDetails($friendsNewsFeed[$z]->group_id_fk);
/* Like Users*/
$friendsNewsFeed[$z]->likeUsers=internalLikeUsers($friendsNewsFeed[$z]->msg_id);

$friendsNewsFeed[$z]->feedCount=$friendsNewsFeedCount;
/*Upload Image */
$uploadPaths=array();

if($friendsNewsFeed[$z]->uploads)
{
	$s = explode(",", $friendsNewsFeed[$z]->uploads);
	$friendsNewsFeed[$z]->uploadCount=count($s);

	/* Upload Paths */
	foreach($s as $a)
	{
	array_push($uploadPaths,internalGetImagePath($a));
	}

	$friendsNewsFeed[$z]->uploadPaths=$uploadPaths;	

}
else
{
	$friendsNewsFeed[$z]->uploadCount='';
	$friendsNewsFeed[$z]->uploadPaths='';		
}




/* Comment Count */
$commentCount=count(internalComments($friendsNewsFeed[$z]->msg_id,'0'));
$friendsNewsFeed[$z]->commentCount=$commentCount;
if($commentCount>2)
{
$second_count=$commentCount-2;
$friendsNewsFeed[$z]->comments=internalComments($friendsNewsFeed[$z]->msg_id,$second_count);
}
else
{
$friendsNewsFeed[$z]->comments=internalComments($friendsNewsFeed[$z]->msg_id,'0');
}


/* Expanding URL */
$friendsNewsFeed[$z]->message=htmlCode($friendsNewsFeed[$z]->message);
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
        $friendsNewsFeed[$z]->embed='<a href="'.$codesrc.'" data-lightbox="lightbox'.$friendsNewsFeed[$z]->msg_id.'"><img src="'.$codesrc.'" class="imgpreview" /></a>';
        }
        else if($code)
        {
        $friendsNewsFeed[$z]->embed = $code;
        }
}
}
else
$friendsNewsFeed[$z]->embed = "";

$codesrc='';
$code='';
/* End */

}
?>