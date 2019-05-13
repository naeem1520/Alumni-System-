<?php
								/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='box-footer clearfix'><ul class='pagination pagination-sm no-margin pull-right'>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li><a href='?page=1' class='active'>First</a></li>";
} else if ($first_btn) {
    $msg .= "<li style='display:none'><a href='?page=1' class='inactive'>First</a></li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li><a href='?page=$pre' class='active'>Previous</a></li>";
} else if ($previous_btn) {
    $msg .= "<li style='display:none'><a href='#' class='inactive'>Previous</a></li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li><a href='?page=$i' class='active active_select'>{$i}</a></li>";
    else
        $msg .= "<li><a href='?page=$i' class='active'>{$i}</a></li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li> <a href='?page=$nex' class='active'>Next</a></li>";
} else if ($next_btn) {
    $msg .= "<li style='display:none'><a class='inactive'>Next</a></li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li><a href='?page=$no_of_paginations' class='active'>Last</a></li>";
} else if ($last_btn) {
    $msg .= "<li style='display:none'><a href='?page=$no_of_paginations' class='inactive'>Last</a></li>";
}
//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div></div>";  // Content for pagination
echo $msg;
								
?>     