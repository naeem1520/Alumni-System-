<!-- Fixed navbar -->
<div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">
<div class="container-fluid" id="wallBar" >
<div class="navbar-header">

<a href="#" data-toggle="sidebar-menu" id="toggle-sidebar-menu" class="visible-xs" rel="0">
<i class="fa fa-user font24"></i>
</a>

<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>


<a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php" >
	<img src="<?php echo BASE_URL.UPLOAD_PATH; ?>iubat.jpg" id="logo"/>
<img src="<?php echo BASE_URL.UPLOAD_PATH; ?>logo.jpg" id="logo"/>
</a>
<i class="fa fa-search" id="searchIcon"></i>
<div id="searchBarMain" data-step="2" data-intro="Search for Friends and Groups.">
<input class="form-control search placeSearch" type="search" id="searchDesk" name="search" placeholder="Search for people and groups." autocomplete="off">

<div id="searchDisplay">
</div> 
</div>

</div>


<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="main-nav">

<ul class="nav navbar-nav navbar-right" id="topMenu">

<li >
<a href="<?php  echo BASE_URL.$sessionUsername; ?>" id="profileName">
<img src="<?php echo $sessionPic; ?>"  class="img-circle sessionProfilePic"  id="sessionProfilePic"/> <span class="sessionName" ></span>
 
</a>
</li>
<li ><a href="<?php echo BASE_URL ?>" ><i class="fa fa-newspaper-o"></i><span class="topMenuName topMenuHome">Home</span> </a></li>
<li class="relative" data-step="6" data-intro="Messages"><a href="<?php echo BASE_URL; ?>messages.php">
<span class="numberCount messageCount"></span>
<i class="fa fa-envelope" id="messagesIcon" ></i><span class="topMenuName topMenuMessages">Messages</span></a></li>
<li class="relative" data-step="5" data-intro="Notifications">
<a href="#" id="notificationsLink" >
<span class="numberCount notificationCount"></span>
<i class="fa fa-bell-o notificationIcon"></i><span class="topMenuName topMenuNotifications">Notifications</span></a>

<a href="<?php echo BASE_URL; ?>notifications.php" id="notificationsLinkMobile">
<span class="numberCount notificationCount"></span>
<i class="fa fa-bell-o  notificationIcon"></i><span class="topMenuName topMenuNotifications">Notifications</span></a>


<div id="notificationContainer">
<div id="notificationTitle" class="topMenuNotifications">Notifications</div>
<div  class="some-content-related-div" id="notificationsContent">
</div>
<div id="notificationFooter"><a href="<?php echo BASE_URL; ?>notifications.php" class="topMenuSeeAll">See All</a></div>
</div>


</li>

<li><a href="<?php echo BASE_URL.'settings.php' ?>" data-step="3" data-intro="Get to know your settings."><i class="fa fa-cogs"></i><span class="topMenuName topMenuSettings">Settings</span></a></li>
<li><a href="<?php echo BASE_URL; ?>logout.php" ><i class="fa fa-sign-out"></i><span class="topMenuLogout">Logout</span></a></li>
</ul>
</div>
<!-- /.navbar-collapse -->
</div>
</div>