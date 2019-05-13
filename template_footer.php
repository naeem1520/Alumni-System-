<!-- Footer -->
<div class="footer">
<?php echo SITE_NAME; ?> &copy; <?php echo SITE_COPYRIGHT; ?>
<input type="hidden" id="uid" value="<?php echo $sessionUid;?>"/>
<input type="hidden" id="username" value="<?php echo $sessionUsername;?>"/>
<input type="hidden" id="name" value="<?php echo $sessionName;?>"/>
<input type="hidden" id="pic"  value="<?php echo $sessionPic;?>"/>
<input type="hidden" id="token" value="<?php echo $sessionToken;?>"/>



<input type="hidden" id="public_username" value="<?php echo $public_username; ?>" />

<input type="hidden" id="group_owner" value="" />
</div>

<!-- // Footer -->
</div>

<!-- Vendor Scripts Bundle -->
<?php include_once 'javaScript.php'; ?>
</body>
</html>