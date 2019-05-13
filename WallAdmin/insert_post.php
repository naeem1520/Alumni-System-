<?php
include_once 'includes.php';

if( (isSet($_POST['adDesc2']) && isSet($_POST['adImg2'])) || isSet($_POST['code']) )
{
    
    if( empty($_POST['code']))
    {
        
       
        $desc2=$_POST['adDesc2'];
        $image2=$_POST['adImg2'];
        $data2=$WallAdmin->Insert_Advertisment($desc2,$image2);
        
        if($data2)
        {
            ?>
  <div class="blockPreview" id="adBlock<?php echo $data['id'];  ?>">
    <a href="#" id="<?php echo $data['id'];  ?>" class="adDelete">X</a>
    <div class='ad_imagedivx'><img src="<?php echo $base_url.$upload_path.$data['b_img']; ?>" style="width:228px"></div>
    <div>
      
    </div>
   
    <div class="ad_desc">
      <?php echo $data['b_desc']; ?>
    </div>
  </div>
  <?php
        }
    }
    else
    {
        
        $code=$_POST['code'];
        $data=$WallAdmin->Insert_Advertisment_Code($title,$code);
        if($data2)
        {
            ?>
                    <div class="blockPreview" id="adBlock<?php echo $data['id'];  ?>">
                            <a href="#" id="<?php echo $data['id'];  ?>" class="adDelete">X</a>
                            <div class='ad_imagedivx' style="width:228px;height: 170px;">Ad Java Script Code</div>
                            <div>
                              
                            </div>
                            

                          </div>

            <?php
        }
    }
    
}
?>