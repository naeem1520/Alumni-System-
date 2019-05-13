<?php
if($_GET['page'])
{
$page=$_GET['page'];
}
else
{
$page=1;
}
$cur_page = $page;
$page -= 1;
$per_page = $admin_perpage;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

?>