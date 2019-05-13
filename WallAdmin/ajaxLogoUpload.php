<?php
//Srinivas Tamada http://9lessons.info
include_once 'includes.php';
$valid_formats = array("png","PNG");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$name = $_FILES['photoimg']['name'];
$size = $_FILES['photoimg']['size'];

if(strlen($name))
{

	 $ext = getExtension($name);
	if(in_array($ext,$valid_formats))
	{
	if($size<(1024*$uploadImageSize))
		{
			
			$actual_image_name = "logo.".$ext;
			$tmp = $_FILES['photoimg']['tmp_name'];

move_uploaded_file($tmp, $admin_path.$actual_image_name);
echo "<img src='".$admin_path.$actual_image_name."' class='logoPreview'/>";



		}
	}
	else
	echo "Please upload PNG  format image. ";
}
else
echo "Please upload PNG  format image. ";

}
?>

