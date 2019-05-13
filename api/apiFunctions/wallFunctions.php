<?php
/************************* Support Functions *************************************/
/* Text Link */
function textLink($text){
	$text = html_entity_decode($text);
	$text = " ".$text;
	if(preg_match('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',$text,$a))
	{
	}
	else if(preg_match('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',$text,$a))
	{
	}
	else
	{
	$a=false;
	}
	return $a[0];
}

/* HTML Code */
function htmlCode($orimessage)
{

$s = array ("<", ">");
$z = array ("&lt;","&gt;");
$message = str_replace($s, $z, $orimessage);
$finalMessage=trim(str_replace("\/n", "<br/>", $message));
$final=htmlspecialchars(stripslashes($finalMessage), ENT_QUOTES, "UTF-8");
return preg_replace("/\r\n|\r|\n/", '<br/>', $final);

}

function htmlcode_nolink($orimessage){
$message= preg_replace("/\r\n|\r|\n/", ' ', $orimessage);
$s = array ("<", ">");
$z = array ("&lt;","&gt;");
$final = str_replace($s, $z, $message);
return stripslashes($final);
}

/* Name Filter*/ 
function nameFilter($name,$number)
{
if($name)
{
		$str_length = strlen($name);
        if($str_length >= $number)
	    {
	    $name= substr($name, 0, $number) . "..." ;
	    }
		return ucfirst($name);
}
}

/*Get File Extension*/ 
function getExtension($str) 
{
         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

/* Compress Image */
function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
{

if($ext=="jpg" || $ext=="jpeg" )
{
$src = imagecreatefromjpeg($uploadedfile);
}
else if($ext=="png")
{
$src = imagecreatefrompng($uploadedfile);
}
else if($ext=="gif")
{
$src = imagecreatefromgif($uploadedfile);
}
else
{
$src = imagecreatefrombmp($uploadedfile);
}




list($width,$height)=getimagesize($uploadedfile);

if($width>$newwidth && $ext!="gif")
{
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = $path.$actual_image_name; 
imagejpeg($tmp,$filename,90);/* Image Quality */
imagedestroy($tmp);
}
else
{
move_uploaded_file($uploadedfile, $path.$actual_image_name);
}

$filename = $path.$actual_image_name; 
return $filename;
}


 /* Send Email */

function sendMail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from = SMTP_FROM_EMAIL;
$title=SMTP_FROM_TITLE;
$mail = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
//$mail->SMTPDebug  = 2;        // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only 
// Port Value 401
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = SMTP_HOST;           // Amazon SES server, note "tls://" protocol
$mail->Port       = SMTP_PORT;                    // set the SMTP port
$mail->Username   = SMTP_USERNAME;  // SES SMTP  username
$mail->Password   = SMTP_PASSWORD;  // SES SMTP password

$mail->SetFrom($from, $title);
$mail->AddReplyTo($from,$title);
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;

$mail->AddAddress($address, $to);
$mail->Send();

}
?>