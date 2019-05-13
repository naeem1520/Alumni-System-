function ajaxPost(url, encodedata, success)
{
$.ajax({
type:"POST",
url:url,
data :encodedata,
dataType:"json",
contentType: 'application/json',
cache:false,
timeout:50000,
beforeSend :function(data) 
{ 
$(".scrollMore").attr("rel","0"); 
$("#networkError").slideUp("slow"); 
},
success:function(data){

success.call(this, data);
$(".scrollMore").attr("rel","1"); 
},
error:function(data){
$("#networkError").show().html($.networkError);
}
});
}