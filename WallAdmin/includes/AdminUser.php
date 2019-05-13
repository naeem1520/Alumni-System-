<?php
//Srinivas Tamada http://9lessons.info
//User

class AdminUser
{
    
	 /* User Login Check */
     public function User_Login($username,$password)
     {
          $db = getDB();
          $md5_password=md5($password);
          $stmt = $db->prepare("SELECT admin_id FROM admin WHERE (admin_username=:username or admin_email=:username) and admin_password=:md5_password");  
          $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
          $stmt->bindParam("md5_password", $md5_password,PDO::PARAM_STR) ;
          $stmt->execute();
          if($stmt->rowCount()==1)
          {
               $row = $stmt->fetch(PDO::FETCH_OBJ);
               $data = json_decode(json_encode($row),true);
               $db = null;
               return $data['admin_id'];
               
          }
          else
          {
               $db = null;
               return false;
          }    

     }

	 	 /* Admin Password Change*/
     public function ChangePassword($newPassword,$session_admin_uid)
     {
          $db = getDB();
          $newPassword=md5($newPassword);
          $stmt = $db->prepare("UPDATE admin SET admin_password=:newPassword WHERE admin_id=:session_admin_uid");  
          $stmt->bindParam("newPassword", $newPassword,PDO::PARAM_STR) ;
          $stmt->bindParam("session_admin_uid", $session_admin_uid,PDO::PARAM_INT) ;
          $stmt->execute();
          $db = null;
          return true;

     }

}

?>
