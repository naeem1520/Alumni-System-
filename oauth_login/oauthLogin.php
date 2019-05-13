<?php
class oauthLogin {
    
    public function userDetails($user_session)
    {
        $db = getDB();
        $query = $db->prepare("SELECT * FROM users WHERE  uid=:session_id");
        $query->bindParam("session_id", $user_session,PDO::PARAM_INT) ;
        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $data;
    }
    
    public function configurations() {
        
        $db = getDB();
        $success_query = $db->prepare("SELECT language_labels,applicationName,applicationDesc,forgot,newsfeedPerPage,friendsPerPage,photosPerPage,groupsPerPage,notificationPerPage, uploadImage,bannerWidth, profileWidth,gravatar,friendsWidgetPerPage FROM configurations WHERE con_id='1'");
        $success_query->execute();
        $data = $success_query->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $data;
        
    }
    
    public function userSignup($userData,$loginProvider)
    {
        
        $first_name='';
        $last_name='';
        $gender='';
        $birthday='';
        $location= '';
        $hometown='';
        $bio='';
        $relationship='';
        $timezone='';
        $picture='';
        $blog='';
        
        if($loginProvider == 'microsoft')
        {
            $email=$userData->emails->account;
        }
        else {
            $email=$userData->email;
        }
        
        
        $db = getDB();
        
        $emain_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
        //Email Check
        if(strlen(trim($email))>0 && $emain_check>0){
            
            
            
            $provider_id=$userData->id;
            // Common for facebook and git
            if($loginProvider == 'linkedin') {
                $name=$userData->firstName.' '.$userData->lastName;
            }
            else{
                $name=$userData->name;
            }
            
            if($loginProvider == 'facebook')
            {
                $first_name=$userData->first_name;
                $last_name=$userData->last_name;
                $gender=$userData->gender;
                $timezone=$userData->timezone;
                $picture='https://graph.facebook.com/'.$provider_id.'/picture?type=large';
                
            }
            
            else if($loginProvider == 'microsoft'){
                
                $first_name=$userData->first_name;
                $last_name=$userData->last_name;
                if($userData->birth_month)
                $birthday=$userData->birth_month.'/'.$userData->birth_day.'/'.$userData->birth_year;
            }
            
            else if($loginProvider == 'google')
            {
                
                $first_name=$userData->given_name;
                $last_name=$userData->family_name;
                $gender=$userData->gender;
                $timezone=$userData->timezone;
                $picture=$userData->picture;
            }
            
            else if($loginProvider == 'github')
            {
                
                $picture=$userData->avatar_url;
                $blog=$userData->blog;
                $bio=$userData->bio;
            }
            else if($loginProvider == 'linkedin')
            {
                
                $first_name=$userData->firstName;
                $last_name=$userData->lastName;
            }
            
            
            
            
            
            $sql = $db->prepare("SELECT uid,provider FROM users WHERE  email=:email");
            $sql->bindParam("email", $email,PDO::PARAM_STR) ;
            $sql->execute();
            
            if($sql->rowCount() == 0){
     


                $sql1="INSERT INTO users (email, name, first_name, last_name, gender, birthday, location, hometown, bio, relationship, timezone, provider, provider_id,last_login,status,notification_created) VALUES (:email,:name,:first_name,:last_name,:gender,:birthday,:location,:hometown,:bio,:relationship,:timezone,:loginProvider,:provider_id,:created,:status,:notification_created)";
$stmt1 = $db->prepare($sql1); 
$stmt1->bindValue(':email', $email, PDO::PARAM_STR);
$stmt1->bindValue(':name', $name, PDO::PARAM_STR);
$stmt1->bindValue(':first_name', $first_name, PDO::PARAM_STR);
$stmt1->bindValue(':last_name', $last_name, PDO::PARAM_STR);
$stmt1->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt1->bindValue(':last_name', $last_name, PDO::PARAM_STR);
$stmt1->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt1->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt1->bindValue(':location', $location, PDO::PARAM_STR);
$stmt1->bindValue(':hometown', $hometown, PDO::PARAM_STR);
$stmt1->bindValue(':bio', $bio, PDO::PARAM_STR);
$stmt1->bindValue(':relationship', $relationship, PDO::PARAM_STR);
$stmt1->bindValue(':timezone', $timezone, PDO::PARAM_STR);
$stmt1->bindValue(':loginProvider', $loginProvider, PDO::PARAM_STR);
$stmt1->bindValue(':provider_id', $provider_id, PDO::PARAM_STR);
$created=time();
$stmt1->bindValue(':created', $created, PDO::PARAM_STR);
$stmt1->bindValue(':notification_created', $created, PDO::PARAM_STR);
$status='1';
$stmt1->bindValue(':status', $status, PDO::PARAM_INT);
$stmt1->execute();

$stmt2 = $db->prepare("SELECT  uid  FROM users WHERE email=:email "); 
$stmt2->bindValue(':email', $email, PDO::PARAM_STR);
$stmt2->execute();
$login=$stmt2->fetch(PDO::FETCH_OBJ);

//$data = json_decode(json_encode($login),true);

$uid=$login->uid;
$sql3 = "INSERT INTO friends(friend_one,friend_two,role,created)VALUES(:uid,:uid,:me,:created)";
$stmt3 = $db->prepare($sql3);
$stmt3->bindParam("uid", $uid, PDO::PARAM_INT);
$time=time();
$stmt3->bindParam("created", $time, PDO::PARAM_STR);
$me='me';
$stmt3->bindParam("me", $me,PDO::PARAM_STR);
$stmt3->execute();
                
                
            }
            else {
                
                $row= $sql->fetch(PDO::FETCH_OBJ);
                $provider=$row->provider;
                $uid=$row->uid;
                
                if($provider != $loginProvider)
                {
                    
                    if(strlen($first_name)){
                        $query = $db->prepare(" UPDATE users SET first_name =:first_name WHERE uid=:uid ");
                        $query->bindParam("first_name", $first_name ,PDO::PARAM_STR) ;
                        $query->bindParam("uid", $uid ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($last_name)){
                        $query = $db->prepare(" UPDATE users SET last_name =:last_name WHERE uid=:uid ");
                        $query->bindParam("last_name", $last_name ,PDO::PARAM_STR) ;
                        $query->bindParam("uid", $uid ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($gender)){
                        $query = $db->prepare(" UPDATE users SET gender =:gender WHERE uid=:uid ");
                        $query->bindParam("gender", $gender ,PDO::PARAM_STR) ;
                        $query->bindParam("uid", $uid ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($location)){
                        $query = $db->prepare(" UPDATE users SET location =:location WHERE uid=:uid ");
                        $query->bindParam("location", $location ,PDO::PARAM_STR) ;
                        $query->bindParam("uid", $uid ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($birthday)){
                        $query = $db->prepare(" UPDATE users SET birthday =:birthday WHERE uid=:uid ");
                        $query->bindParam("birthday", $birthday ,PDO::PARAM_STR) ;
                        $query->bindParam("uid", $uid ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    
                    if(strlen($picture)){
                        $query = $db->prepare(" UPDATE users SET facebookProfile =:picture WHERE uid=:uid ");
                        $query->bindParam("picture", $picture ,PDO::PARAM_STR) ;
                        $query->bindParam("uid", $uid ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    
                    $query = $db->prepare(" UPDATE users SET provider_id =:provider_id, provider =:provider WHERE uid=:uid ");
                    $query->bindParam("provider_id", $provider_id ,PDO::PARAM_STR) ;
                    $query->bindParam("provider", $loginProvider ,PDO::PARAM_STR) ;
                    $query->bindParam("uid", $uid ,PDO::PARAM_STR) ;
                    $query->execute();
                    
                }
                
            }
            
            
            
            
        }
        
        
        $success_query = $db->prepare("SELECT uid,notification_created,username,name,profile_pic,tour  FROM users WHERE  email=:email");
        $success_query->bindParam("email", $email ,PDO::PARAM_STR) ;
        $success_query->execute();
        $data = $success_query->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $data;
        
        
    }
    
    
}

?>