$(document).ready(function()
{


/* Responsive Sidebar*/
$("#bars").click(function()
{
    $("#sideBar").toggleClass("sideBarActive");
    return false;
});

$(".adType").click(function(){
var ID=$(this).val();
if(parseInt(ID))
{
$("#adGoogleCard").show();
$("#adBannerCard").hide();
}
else
{
$("#adGoogleCard").hide();
$("#adBannerCard").show();
}

});
/*Language Label Live*/
$(".live").click(function()
{
var ID=$(this).val();
var msg;
if(parseInt(ID))
msg="Sure you want to make this live?";
else
msg="Sure you want to make this off?";


var dataString = 'live='+ ID;
$.confirm({
    title: '',
    content: msg,
    confirm: function(){
$.ajax
({
type: "POST",
url: "ajaxLanguage.php",
data: dataString,
success: function(data)
{

}
});
},
    cancel: function(){
        
    }
});
return false;
});

/* table sortable*/
$( "#sortable" ).sortable({
revert: true
});

/* Template Order save*/
$('.save').click(function()
{
$.ajax
({
type: "POST",
url: "ajaxTemplate.php",
data: $("#sortable").sortable("serialize"),
success: function(data)
{
$('#alert').show();
}
});


/* Alerts hide*/
setTimeout(function()
{
$("#alert").slideUp("slow", function () {
$("#alert").hide();
}); }, 3000);
return false;
});

/* Upload logo images */
$('body').on('change','#imageform', function()
{
$("#imageform").ajaxForm({target: '#logo_img',
beforeSubmit:function(){
$("#logo_img").html("");
},
success:function(){

},
error:function(){
} }).submit();

});

/* Upload logo images */
$('body').on('change','#imageformFav', function()
{
$("#imageformFav").ajaxForm({target: '#fav_img',
beforeSubmit:function(){
$("#fav_img").html("");
},
success:function(){

},
error:function(){
} }).submit();

});

/* Add images */
$('body').on('change','#bigprofileimageform', function()
{
$("#bigprofileimageform").ajaxForm({target: '#ad_image',
beforeSubmit:function(){

},
success:function(){

},
error:function(){
} }).submit();

});

/* Ad Title */
$("#adTitle").keyup(function()
{
$("#suggest_title").html($(this).val());
});

/* Ad Description */
$("#adDesc").keyup(function()
{
$("#ad_desc").html($(this).val());
});

/* Ad URL */
$("#adURL").keyup(function()
{
var x=$(this).val()
$("#suggest_url").html(x);
$("#suggest_title").attr("href",x);
});

/* Ad Save */
$("#adSave").click(function()
{

var suggest_title=$("#adTitle").val();
var ad_desc=$("#adDesc").val();
var suggest_url=$("#adURL").val();
var ad_img=$(".ad_image").attr('rel');
var ad_code=$("#code").val();

var check_url = /^(http|https|ftp):\/\/(www+\.)?[a-zA-Z0-9]+\.([a-zA-Z]{2,4})\/?/;

var dataString;

if(suggest_title.length>0 && ad_desc.length>0 && check_url.test(suggest_url) && ad_img.length>0)
{
dataString = 'adTitle='+ suggest_title +'&adDesc='+ad_desc+'&adURL='+suggest_url+'&adImg='+ad_img;
$.ajax({
type: "POST",
url: 'ajaxAdvertisment.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#adTitle").val('');
$("#adDesc").val('');
$("#adURL").val('');
$("#exampleInputFile").val('');
$(".ad_image").val('');
$("#ad_image").html('');
$("#code").val('');
$("#suggest_title").html('Ad Title');
$("#ad_desc").html('Ad Description');
$("#suggest_url").html('Ad URL');
$("#AdsBlock").prepend(html);
}
});
}
else if(ad_code.length>0 && suggest_title.length>0)
{
dataString = 'code='+ ad_code +'&adTitle='+ suggest_title;
$.ajax({
type: "POST",
url: 'ajaxAdvertisment.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#adTitle").val('');
$("#adDesc").val('');
$("#adURL").val('');
$("#exampleInputFile").val('');
$(".ad_image").val('');
$("#code").val('');
$("#ad_image").html('');
$("#suggest_title").html('Ad Title');
$("#ad_desc").html('Ad Description');
$("#suggest_url").html('Ad URL');
$("#AdsBlock").prepend(html);
}
});
}
else
{
alert("Give valid data. ");
}
return false;
});

/*Block Users */
$(".textContent").livequery(function () { $(this).linkify({
target: "_blank"
}); });
/* Block and Unblock Users */
$("body").on("click",".block",function(){
var ID=$(this).attr("id");
var REL=$(this).attr("rel");
var msg;
var dataString = 'uid='+ ID +'&type='+REL;

if(REL.length>0)
{
msg="Sure you want to unblock this User?";
}
else
{
msg="Sure you want to block this User?";
}


$.confirm({
    title: '',
    content: msg,
    confirm: function(){
$.ajax({
type: "POST",
url: 'ajaxUserBlock.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#users"+ID).fadeOut("slow");
}
});
    },
    cancel: function(){
        
    }
});

return false;
});


/* Verified and Unverified Users */
$("body").on("click",".verified",function(){
var X=$(this);
var ID=$(this).attr("id");
var REL=$(this).attr("rel")
var msg;
var dataString = 'uid='+ ID +'&type='+REL;

if(REL.length>0)
{
msg="Sure you want to unverify this User?";
}
else
{
msg="Sure you want to approve as a verified User?";
}

$.confirm({
    title: '',
    content: msg,
    confirm: function(){
		$.ajax({
type: "POST",
url: 'ajaxUserVerified.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
if(REL.length>0)
{
$("#users"+ID).fadeOut("slow");
}
else
{
X.fadeOut();
$("#verified"+ID).html('<span class="label label-blue">Verified</span>');
}
}
});
    },
    cancel: function(){
        
    }
});

return false;
});


/* Delete Users */
$("body").on("click",".delete",function(){
var ID=$(this).attr("id");
var dataString = 'uid='+ ID ;

$.confirm({
    title: '',
    content: 'Sure you want to delete this user? There is NO undo!',
    confirm: function(){
			$.ajax({
					type: "POST",
					url: 'ajaxUserDelete.php',
					data: dataString,
					cache: false,
					beforeSend: function(){},
					success: function(html)
					{
					$("#users"+ID).fadeOut("slow");
					}
					});
    },
    cancel: function(){
        
    }
});
return false;
});

/* Search Button */

$("body").on('click','#searchButton',function(){
var name=$(this).attr("rel");

var searchKey=$("#searchInput").val();

$("#tbody").html("");
if($.trim(searchKey).length>0)
{
var dataString = 'searchKey='+ searchKey +'&rel='+name;

$.ajax({
type: "POST",
url: 'ajaxSearch.php',
data: dataString,
cache: false,
dataType:"json",
beforeSend: function(){},
success: function(data)
{

if(data.searchResults.length>0)
{
$("#"+name+"SearchResults").show();
$("#"+name+"Results").hide();
var tableHTML='';
 $.each(data.searchResults, function(i,data)
  {

if(name=='user' || name=='blocked_user' || name=='verifiedUsers')
{

    var complete='';
    if(data.name)
    {
    complete ='<span class="label label-success">Complete</span>';
    }

    var social='';
    if(data.provider)
    {
    social ='<span class="label label-primary">Social</span>';
    }

    var verify='';
    if(data.verified)
    {
    verify ='<span class="label label-blue">Verified</span>';
    }

    var actionButtons='';
    if(name=='user')
    {
    var verifyButton='';
    if(data.verified=='0')
    {
     verifyButton='<a href="#" class="btn btn-info btn-sm verified" id="'+data.uid+'" rel=""><i class="fa fa-star-o"></i> Verify</a>';   
    }
    actionButtons='<td><a href="#" class="btn btn-danger btn-sm block" id="'+data.uid+'" rel=""><i class="fa fa-ban"></i> Block</a>&nbsp;&nbsp;&nbsp;'+verifyButton ;
    }
    else if(name == 'verifiedUsers')
    {
    actionButtons='<td> <a href="#" class="btn btn-danger btn-sm verified" id="'+data.uid+'"  rel="1">Unverify</a></td>';    
    }
    else if(name == 'blocked_user')
    {
    actionButtons='<td><a href="#" class="btn btn-danger btn-sm delete" id="'+data.uid+'" rel=""><i class="fa fa-trash"></i> Delete</a>'+
                  '<a href="#" class="btn btn-warning btn-sm block" id="'+data.uid+'" rel="1">Unblock</a></td>';  
                                             
    }

    tableHTML='<tr id="users'+data.uid+'">'+
    '<td style="width: 10px">'+data.uid+'</td>'+
    '<td>'+data.userid+'</td>'+
    '<td><a href="'+data.username+'" target="_blank">'+data.username+'</a></td>'+
    '<td>'+data.name+'</td>'+
    '<td>'+data.email+'</td>'+
    '<td>'+data.googleProfile+'</td>'+
    '<td>'+data.bio+'</td>'+
    '<td>'+social+'</td>'+
    '<td>'+complete+'</td>'+
    '<td id="verified'+data.uid+'">'+verify+'</td>'+
    actionButtons+
    '</td></tr>';
}
else if(name=='updates')
{


tableHTML='<tr id="comments'+data.msg_id+'"><td style="width: 10px">#</td>'+
'<td><a href="'+data.username+'" target="_blank">'+data.username+'</a></td>'+
'<td class="textContent">'+data.message+'</td><td><a href="status/'+data.msg_id+'" target="_blank">View</a></td>'+
'<td>'+data.ip+'</td>'+
'<td><a href="#" class="btn btn-danger btn-sm updateDelete" id="'+data.msg_id+'"><i class="fa fa-trash"></i> Delete</a></td></tr>';

}
else if(name=='comment')
{

tableHTML='<tr id="comments'+data.com_id+'"><td style="width: 10px">#</td>'+
'<td><a href="'+data.username+'" target="_blank">'+data.username+'</a></td>'+
'<td class="textContent">'+data.comment+'</td><td></td>'+
'<td>'+data.ip+'</td>'+
'<td><a href="#" class="btn btn-danger btn-sm commentDelete" id="'+data.com_id+'"><i class="fa fa-trash"></i> Delete</a></td></tr>';

}
else if(name=='group')
{

tableHTML='<tr id="'+data.group_id+'">'+
'<td style="width: 10px">'+data.group_id+'</td>'+
'<td><a href="group/'+data.group_id+'">'+data.group_name+'</a></td>'+
'<td>'+data.group_desc+'</td>'+
'<td><a href="'+data.username+'" target="_blank">'+data.username+'</a></td>'+
'<td>'+data.group_ip+'</td>'+
'<td><a href="#" class="btn btn-warning btn-sm groupBlock" id="'+data.group_id+'" rel=""><i class="fa fa-ban"></i> Block</a></td></tr>'



}
else if(name=='blockGroup')
{

tableHTML='<tr id="'+data.group_id+'">'+
'<td style="width: 10px">'+data.group_id+'</td>'+
'<td><a href="group/'+data.group_id+'">'+data.group_name+'</a></td>'+
'<td>'+data.group_desc+'</td>'+
'<td><a href="'+data.username+'" target="_blank">'+data.username+'</a></td>'+
'<td>'+data.group_ip+'</td>'+
'<td>'+
'<a href="#" class="btn btn-warning btn-sm groupBlock" id="'+data.group_id+'" rel="1">Unblock</a> &nbsp; &nbsp;'+
'<a href="#" class="btn btn-danger btn-sm groupDelete" id="'+data.group_id+'"><i class="fa fa-trash"></i> Delete</a></tr>';



}


$("#tbody").append(tableHTML);


});


}
else
{
$.alert({
    title: '',
    content: 'No search results found.',
    confirm: function(){
       // alert('Confirmed!');
    }
});    
$("#"+name+"Results").show();
$("#"+name+"SearchResults").hide();
}
}
});

    
    

}

return false;
});


/* Delete Advertisments */
$("body").on('click','.adDelete',function(){
var ID=$(this).attr("id");
var dataString = 'aid='+ ID ;


$.confirm({
    title: '',
    content: 'Sure you want to delete this adverstisement? There is NO undo!',
    confirm: function(){
			$.ajax({
			type: "POST",
			url: 'ajaxAdDelete.php',
			data: dataString,
			cache: false,
			beforeSend: function(){},
			success: function(html)
			{
			$("#adBlock"+$.trim(html)).fadeOut("slow");
			}
			});
    },
    cancel: function(){
        
    }
});

return false;
});


/* updateDelete Users */
$("body").on("click",".updateDelete",function(){
var ID=$(this).attr("id");
var dataString = 'msg_id='+ ID ;


$.confirm({
    title: '',
    content: 'Sure you want to delete this update? There is NO undo!',
    confirm: function(){
			$.ajax({
type: "POST",
url: 'ajaxMessageDelete.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#updates"+ID).fadeOut("slow");
}
});
    },
    cancel: function(){
        
    }
});

return false;
});

/* commentDelete Users */
$("body").on("click",".commentDelete",function(){

var ID=$(this).attr("id");
var dataString = 'com_id='+ ID ;


$.confirm({
    title: '',
    content: 'Sure you want to delete this comment? There is NO undo!',
    confirm: function(){
$.ajax({
type: "POST",
url: 'ajaxCommentDelete.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#comments"+ID).fadeOut("slow");
}
});
    },
    cancel: function(){
        
    }
});

return false;
});

/* groupDelete Users */
$("body").on("click",".groupDelete",function(){

var ID=$(this).attr("id");
var dataString = 'group_id='+ ID ;

$.confirm({
    title: '',
    content: 'Sure you want to delete this Group?',
    confirm: function(){
$.ajax({
type: "POST",
url: 'ajaxGroupDelete.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#groups"+ID).fadeOut("slow");
}
});
    },
    cancel: function(){
        
    }
});
return false;
});

/* group Block  */
$("body").on("click",".groupBlock",function(){

var ID=$(this).attr("id");
var REL=$(this).attr("rel");
var dataString = 'group_id='+ ID +'&type='+REL;


$.confirm({
    title: '',
    content: 'Sure you want to block this Group?',
    confirm: function(){
$.ajax({
type: "POST",
url: 'ajaxGroupBlock.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#groups"+ID).fadeOut("slow");
}
});
    },
    cancel: function(){
        
    }
});

return false;
});

/* commentDelete Users */
$(".imageDelete").click(function(){
var ID=$(this).attr("id");
var dataString = 'pid='+ ID ;


$.confirm({
    title: '',
    content: 'Sure you want to delete this Image? There is NO undo!',
    confirm: function(){
$.ajax({
type: "POST",
url: 'ajaxImageDelete.php',
data: dataString,
cache: false,
beforeSend: function(){},
success: function(html)
{
$("#image"+ID).fadeOut("slow");
}
});
    },
    cancel: function(){
        
    }
});
return false;
});



});
