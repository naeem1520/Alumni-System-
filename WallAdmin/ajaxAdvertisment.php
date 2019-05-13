<?php
include_once 'includes.php';

if( (isSet($_POST['adTitle']) && isSet($_POST['adDesc']) && isSet($_POST['adURL']) && isSet($_POST['adImg'])) || isSet($_POST['code']) )
{
    
    if( empty($_POST['code']))
    {
        
        $title=$_POST['adTitle'];
        $desc=$_POST['adDesc'];
        $url=$_POST['adURL'];
        $image=$_POST['adImg'];
        $data=$WallAdmin->Insert_Advertisment($title,$desc,$url,$image);
        
        if($data)
        {
            ?>
  <div class="blockPreview" id="adBlock<?php echo $data['a_id'];  ?>">
    <a href="#" id="<?php echo $data['a_id'];  ?>" class="adDelete">X</a>
    <div class='ad_imagedivx'><img src="<?php echo $base_url.$upload_path.$data['a_img']; ?>" style="width:228px"></div>
    <div>
      <a href="<?php echo $data['a_url']; ?>" class="suggest_title" target="blank">
        <?php echo $data['a_title']; ?>
      </a>
    </div>
    <div class="suggest_url">
      <?php echo $data['a_url']; ?>
    </div>
    <div class="ad_desc">
      <?php echo $data['a_desc']; ?>
    </div>
  </div>
  <?php
        }
    }
    else
    {
        $title=$_POST['adTitle'];
        $code=$_POST['code'];
        $data=$WallAdmin->Insert_Advertisment_Code($title,$code);
        if($data)
        {
            ?>
                    <div class="blockPreview" id="adBlock<?php echo $data['a_id'];  ?>">
                            <a href="#" id="<?php echo $data['a_id'];  ?>" class="adDelete">X</a>
                            <div class='ad_imagedivx' style="width:228px;height: 170px;">Ad Java Script Code</div>
                            <div>
                              <a href="<?php echo $data['a_url']; ?>" class="suggest_title" target="blank">
                                <?php echo $data['a_title']; ?>
                              </a>
                            </div>
                            

                          </div>

            <?php
        }
    }
    
}
?>