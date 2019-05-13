/*########## Site Configurations ##########*/

$.networkError = 'No network connection';

/* Geolocation*/
var x = document.getElementById("geoContainer");

function getLocation(baseUrl) {
  $("#geoContainerDiv").html("<img src='" + baseUrl + "wall_icons/ajax.gif' class='padding10'/> Loading Geo Location")
  console.log(navigator.geolocation);
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

/* Reactions */
function reactions(id) {
  var A;

  if (parseInt(id) === 1)
    A = 'like';
  else if (parseInt(id) === 2)
    A = 'love';
  else if (parseInt(id) === 3)
    A = 'haha';
  else if (parseInt(id) === 4)
    A = 'wow';
  else if (parseInt(id) === 5)
    A = 'cool';
  else if (parseInt(id) === 6)
    A = 'confused';
  else if (parseInt(id) === 7)
    A = 'sad';
  else if (parseInt(id) === 8)
    A = 'angry';

  return A;

}

/* Geolocation Show Position */
function showPosition(position) {
  $("#latitude").val(position.coords.latitude);
  $("#longitude").val(position.coords.longitude);
  var img = "https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=570x300&scale=2&maptype=roadmap&markers=color:red%7Clabel:S%7C" + position.coords.latitude + "," + position.coords.longitude;
  $("#geoContainerDiv").html("<img src='" + img + "' id='geoImage'/>")
}

/* Push Grids into Array */
function loadGrid(htmlData) {
  // console.log("load");
  var boxes = new Array;
  boxes.push(htmlData);
  return boxes;
}

/* Grids Load */
function gridaliciousLoad(div, padding, newWidth, newSelector) {
  div.gridalicious({
    animate: true,
    gutter: padding,
    width: newWidth,
    selector: newSelector,
    animate: true,
    animationOptions: {
      speed: 200,
      duration: 300
    }
  });
}

/* Timeline Grids Configurations*/
function timelineGrid() {
  /* Newfeed Grids 15px padding 510 px width*/

  var div = $("#newsFeed");

  gridaliciousLoad(div, 15, 510, "");

  /* Full Grids 15px padding 950 px width*/
  var div = $("#notifications");
  gridaliciousLoad(div, 15, 950, "");

  /* Updatebox Grids 15px padding 970 px width*/
  var div = $("#updateBox");
  gridaliciousLoad(div, 15, 970, ".updateBox-block");

  /* Small Grids 15px padding 270 px width*/
  var div = $("#friendsList, #groupsList, #viewsList, #membersPhotosList, #photosList, #welcomeFriends");
  gridaliciousLoad(div, 15, 270, "");

}

/* Username update redirection oauth */
function usernameRedirect(username, baseUrl) {
  if ($.trim(username).length < 1) {
    window.location.href = baseUrl + 'username.php';
  }
}

/* no token redirection public access */
function noToken(token, baseUrl) {
  if ($.trim(token).length < 1) {
    window.location.href = baseUrl + 'login.php';
  }
}


/* Alert hide after 10 seconds */
function alertHide() {
  setTimeout(function () {
    $(".alert-success, .alert-danger").slideUp('slow');
  }, 10000);
}

/* Multiple images slider */
function sliderLoad(msgID) {
  $("#slider" + msgID).livequery(function () {
    var H = $("#slider_direction_" + msgID).html();
    if (H.length > 0) {
      $("#slider_direction_" + msgID).html("");
      $("#slider_control_" + msgID).html("");
    }
    $(this).leanSlider({
      directionNav: "#slider_direction_" + msgID,
      controlNav: "#slider_control_" + msgID
    });
  });
}

/* Advertisements   */
function advertisements(uid, token, apiBaseUrl) {

  var html = '';
  var j = '';
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token
  });
  var url = apiBaseUrl + 'api/advertisements';
  ajaxPost(url, encodedata, function (data) {
    if (data.advertisements.length) {

      $.each(data.advertisements, function (i, data) {

        if (parseInt(data.ad_type) < 1) {
          html = '<div class="panel panel-default">' +
            '<div style="text-align:center;font-size:20px;color:red" class="wall-share">Event Post</div>' +
            '<div class="panel-heading">' +
            '<div class="media">' +
            '<div class="suggestedPanel">' +
            '<p class="feed-author" target="_blank">' + data.a_title + '</p>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="suggestedPanel">' +
            '<p class="feedContent">' + data.a_desc + ' <a href="' + data.a_url + '" target="_blank" class="adURL">' + data.a_url + '</a></p>' +
            '</div><div><a href="' + data.a_url + '" target="_blank"><img src="' + data.a_img + '" class="imgpreview" ></a></div>' +
            '<div class="st_like_share"></div>' +
            '</div>';
        } else {
          html = '<div class="panel panel-default">' +
            '<div class="wall-share">Event Post</div>' +
            '<div class="panel-heading">' +
            '<div class="media">' +
            '<div class="suggestedPanel">' +

            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="suggestedPanel">' +
            '<p class="feedContent"></p>' +
            '</div><div style="text-align:center">' + data.ad_code + '</div>' +
            '<div class="st_like_share"></div>' +
            '</div>';
        }


        var ID = i + 1;
        $("#suggest" + ID).show().append(html);

      });
    }
  });
}

/*########## Users  ##########*/
/* User details */
function userDetails(uid, token, apiBaseUrl, baseUrl, public_username, msgID, groupID) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "public_username": public_username,
    "msgID": msgID
  });
  var url;
  if (token) {
    url = apiBaseUrl + 'api/userDetails';
  } else {
    url = apiBaseUrl + 'api/publicUserDetails';
  }

  ajaxPost(url, encodedata, function (data) {

    if (data) {
      var Message = "Message";
      var Follow = "Follow";
      var Following = "Following";
      var You = "You";
      if ($.labelData) {
        Message = $.labelData.buttonMessage;
        Follow = $.labelData.buttonFollow;
        Following = $.labelData.buttonFollowing;
        You = $.labelData.buttonYou;
      }

      $.each(data.userDetails, function (i, data) {
        if (data.uid) {
          var profilePic = data.profile_pic.replace("\\", "");
          var profileBG = data.profile_bg.replace("\\", "");
          /* counts */
          if (data.uid == uid) {
            $.conversation_count = data.conversation_count;
            if (data.profile_pic) {
              $(".sessionProfilePic").attr('src', '' + profilePic + '');
              $("#pic").val(profilePic);
            }

            if (parseInt(data.tour) < 1) {
              introJs().start();
            }
          }

          $("#notification_created").val(data.notification_created);
          $('.sessionName').html(data.sessionName);

          if (parseInt($.conversation_count)) {
            $(".messageCount").fadeIn("slow").html($.conversation_count);
            $("#messagesIcon").addClass("effectTada");
          }

          if ($.trim(groupID).length < 1) {


            $("#username").val(data.username);
            $(".profilePic").attr('src', '' + profilePic + '');
            $('#photosCount').html(data.photos_count);
            $('#friendsCount').html(data.friend_count);
            $('#facebookSettings').val(data.facebookProfile);
            $('#facebookSettingsLabel').html(data.facebookProfile);
            $('#twitterSettings').val(data.twitterProfile);
            $('#twitterSettingsLabel').html(data.twitterProfile);
            $('#googleSettings').val(data.googleProfile);
            $('#googleSettingsLabel').html(data.googleProfile);
            $('#instagramSettings').val(data.instagramProfile);
            $('#instagramSettingsLabel').html(data.instagramProfile);
            $("#updatesCount").html(data.updates_count);
            $("#photosCount").html(data.photos_count);

            if (token) {
              $("#name").val(data.sessionName);
              $("#pic").val(profilePic);
            }

            var verified = "";
            if (parseInt(data.verified) > 0) {
              verified = '<span id="verified"></span>';
            }

            $('#fullName').html(data.name + verified);
            $('.fullName').html(data.name);

            if (data.facebookProfile) {
              $("#facebookButton").show();
              $("#facebookButtonURL").attr("href", "https://www.facebook.com/" + data.facebookProfile);
            }
            if (data.twitterProfile) {
              $("#twitterButton").html(data.twitterProfile);
              $("#twitterButtonURL").attr(data.twitterProfile);
            }
            if (data.googleProfile) {
              $("#googleButton").html(data.googleProfile);
              $("#googleButtonURL").attr(data.googleProfile);
            }
            if (data.instagramProfile) {
              $("#instagramButton").html(data.instagramProfile);
              $("#instagramButtonURL").attr(data.instagramProfile);
            }
            
                
            if (profileBG.length > 0) {
              if (parseInt($(window).width()) > 800) {
                $("#coverBox").html('<img src="' + profileBG + '" alt="cover"   class="profileBG" style="margin-top:' + data.profile_bg_position + '"/>');
              } else {
                $("#coverBox").html('<img src="' + profileBG + '" alt="cover"   class="profileBG" />');
              }

            }

            /* Setting Page*/
            $('#usernameSettings').html(data.username);
            $('.idSettings').html(data.userid);
            $('#emailSettings').html(data.email);
            $('#nameSettings').val(data.name);

            if (data.gender) {
               $('#gender').html(data.gender);
              $("#genderSettings").val(data.gender);
            }

            $("#emailNotifications").val(data.emailNotifications);

            if (data.bio) {
              $('#aboutMe').html(data.bio);
              $('#aboutSettings').val(data.bio);
            } else {
              $("#aboutProfileBlock").hide();
            }
          }
          var messageButton = "";
          if (data.role != 'me') {
            messageButton = '<a href="' + baseUrl + 'messages/' + data.username + '" class="wallbutton messageButton marginRight10"><i class="fa fa-envelope"></i>' + Message + '</a>';
          }


          if (data.role == 'fri') {
            friendButton = '<a href="#" class="wallbutton removeButton" id="remove' + data.uid + '">' + Following + '</a>' +
              '<a href="#" class="wallbutton addButton displaynone" id="add' + data.uid + '" ><i class="fa fa-plus"></i>' + Follow + '</a>';
          } else if (data.role == 'me') {
            friendButton = "<span id='you'>" + You + "!</span>";
          } else {
            friendButton = '<a href="#" class="wallbutton addButton " id="add' + data.uid + '"  p="1"><i class="fa fa-plus"></i>' + Follow + '</a>' +
              '<a href="#" class="wallbutton removeButton displaynone" id="remove' + data.uid + '">' + Following + '</a>';

          }
          $('#friendButton').html(messageButton + friendButton);

        } else {
          window.location.href = baseUrl + '404.php';
        }
      });
    } else {
      window.location.href = baseUrl + '404.php';
    }
  });
}

/* into */
function introUpdate() {
  tour($.uid, $.token, $.apiBaseUrl)
}

/* Tour Update */
function tour(uid, token, apiBaseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token
  });
  var url = apiBaseUrl + 'api/tour';
  ajaxPost(url, encodedata, function (data) {
    if (data.tour.length) {
      if (parseInt(data.tour[0].status)) {

      }
    }
  });
}

/* Username Update */
function usernameUpdate(uid, token, username, apiBaseUrl, baseUrl) {
  noToken(token, baseUrl);
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "username": username
  });
  var url = apiBaseUrl + 'api/usernameUpdate';
  ajaxPost(url, encodedata, function (data) {
    if (data.usernameUpdate.length) {
      if (parseInt(data.usernameUpdate[0].status)) {
        $("#username").val(username);
        window.location.href = baseUrl;

      }
    }
  });
}

function usernameEmailCheck(uid, token, username, apiBaseUrl) {
  var encodedata = JSON.stringify({
    "usernameEmail": username,
    "type": "0"
  });
  var url = apiBaseUrl + 'api/usernameEmailCheck'; /* User singup API */
  ajaxPost(url, encodedata, function (data) {
    if (data.usernameEmailCheck.length) {
      if (parseInt(data.usernameEmailCheck[0].status)) {
        $('#usernameValue').removeClass("errorInput").addClass("successInput").attr("rel", "1");
        $("#usernameUpdateMsg").hide();
      } else {
        $('#usernameValue').removeClass("successInput").addClass("errorInput").attr("rel", "0");
        $("#usernameUpdateMsg").show().html("Username already exists, please give new.");
      }
    } else {
      $('#usernameValue').removeClass("successInput").addClass("errorInput").attr("rel", "0");
      $("#usernameUpdateMsg").show().html("Username already exists, please give new.");
    }
  });
}

/* Verified Welcome Users  */
function welcomeFriends(uid, token, apiBaseUrl, baseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token
  });
  var url = apiBaseUrl + 'api/welcomeFriends';
  ajaxPost(url, encodedata, function (data) {
    if (data.welcomeFriends.length) {
      var Follow = "Follow";
      var Following = "Following";
      var You = 'You';
      if ($.labelData) {
        Follow = $.labelData.buttonFollow;
        Following = $.labelData.buttonFollowing;
        You = $.labelData.buttonYou;
      }
      $.each(data.welcomeFriends, function (i, data) {
        var friendButton;
        var i = '';

        if (data.role == 'fri') {
          friendButton = '<a href="#" class="wallbutton removeButton" id="remove' + data.uid + '">' + Following + '</a>' +
            '<a href="#" class="wallbutton addButton displaynone" id="add' + data.uid + '" ><i class="fa fa-plus"></i>' + Follow + '</a>';
        } else if (data.role == 'me') {
          friendButton = "<div id='you'>You!</div>";
        } else {
          friendButton = '<a href="#" class="wallbutton addButton " id="add' + data.uid + '"  p="1"><i class="fa fa-plus"></i>' + Follow + '</a>' +
            '<a href="#" class="wallbutton removeButton displaynone" id="remove' + data.uid + '">' + Following + '</a>';

        }

        i = '<div class="friendBlock" >' +
          '<div class="panel panel-default user-box">' +
          '<div class="panel-body">' +
          '<div class="media">' +
          '<img src="' + data.profile_pic + '" alt="people" class="media-object img-circle pull-left" />' +
          '<div class="media-body">' +
          '<a href="' + baseUrl + data.username + '" class="username">' + data.name + '</a>' +
          '</div></div></div>' +
          '<div class="panel-footer">' +
          friendButton +
          '</div></div></div>';

        $("#welcomeFriends").gridalicious('append', loadGrid(i));

      });
    }


  });
}

/* update Settings  */
function updateSettings(uid, token, apiBaseUrl, baseUrl, full_name, about_me, gender, emails) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "full_name": full_name,
    "about_me": about_me,
    "gender": gender,
    "emails": emails
  });
  var url = apiBaseUrl + 'api/updateSettings';
  ajaxPost(url, encodedata, function (data) {

    if (parseInt(data.settings[0].status)) {
      $("#successMessage").fadeIn("slow").html("You profile details has been updated successfully.");
    } else {
      $("#networkError").fadeIn("slow").html("Please enter valid details.");
    }
  });
}

/* Public label data */
function publicLabelData(apiBaseUrl) {
  var uid = '';
  var token = "";
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token
  });
  var url = apiBaseUrl + 'api/publicLabelData';
  ajaxPost(url, encodedata, function (data) {

    if (data) {
      $.labelData = data.labelData[0];
      if ($.labelData) {
        $(".commonFriends").html($.labelData.commonFriends);
        $(".commonGroups").html($.labelData.commonGroups);
        $(".commonPhotos").html($.labelData.commonPhotos);
        $(".commonCreateGroup").html($.labelData.commonCreateGroup);
        $(".commonAbout").html($.labelData.commonAbout);
        $(".commonRecentVisitors").html($.labelData.commonRecentVisitors);
        $(".commonFollowers").html($.labelData.commonFollowers);
        $(".commonMembers").html($.labelData.commonMembers);
        $(".msgConversation").html($.labelData.msgConversation);
        $(".topMenuHome").html($.labelData.topMenuHome);
        $(".topMenuMessages").html($.labelData.topMenuMessages);
        $(".topMenuNotifications").html($.labelData.topMenuNotifications);
        $(".topMenuSeeAll").html($.labelData.topMenuSeeAll);
        $(".topMenuSettings").html($.labelData.topMenuSettings);
        $(".topMenuLogout").html($.labelData.topMenuLogout);

        $(".topMenuLogin").html($.labelData.topMenuLogin);
        $(".topMenuJoin").html($.labelData.topMenuJoin);

        $(".yourPhotos").html($.labelData.yourPhotos);
        $(".photosOfYours").html($.labelData.photosOfYours);
        $(".boxName").html($.labelData.boxName);
        $(".boxUpdates").html($.labelData.boxUpdates);
        $(".boxWebcam").html($.labelData.boxWebcam);
        $(".boxLocation").html($.labelData.boxLocation);
        $(".buttonUpdate").html($.labelData.buttonUpdate);
        $(".buttonComment").html($.labelData.buttonComment);
        $(".buttonSaveSettings").val($.labelData.buttonSaveSettings);
        $(".buttonSocialSave").html($.labelData.buttonSocialSave);
        $(".buttonLogin").html($.labelData.buttonLogin);
        $(".buttonSignUp").html($.labelData.buttonSignUp);
        $(".buttonForgotButton").html($.labelData.buttonForgotButton);
        $(".buttonSetNewPassword").html($.labelData.buttonSetNewPassword);
        $(".buttonFacebook").html($.labelData.buttonFacebook);
        $(".buttonGoogle").html($.labelData.buttonGoogle);
        $(".buttonMicrosoft").html($.labelData.buttonMicrosoft);
        $(".buttonLinkedin").html($.labelData.buttonLinkedin);

        $(".msgNoMoreUpdates").html($.labelData.msgNoMoreUpdates);
        $(".msgNoUpdates").html($.labelData.msgNoUpdates);

        $(".settingsTitle").html($.labelData.settingsTitle);
        $(".settingsUsername").html($.labelData.settingsUsername);
        $(".settingsEmail").html($.labelData.settingsEmail);
        $(".settingsName").html($.labelData.settingsName);
        $(".settingsPassword").html($.labelData.settingsPassword);
        $(".settingsChangePassword").html($.labelData.settingsChangePassword);
        $(".settingsOldPassword").html($.labelData.settingsOldPassword);
        $(".settingsNewPassword").html($.labelData.settingsNewPassword);
        $(".settingsConfirmPassword").html($.labelData.settingsConfirmPassword);
        $(".settingsGroup").html($.labelData.settingsGroup);
        $(".settingsGender").html($.labelData.settingsGender);
        $(".settingsAboutMe").html($.labelData.settingsAboutMe);
        $(".settingsEmailAlerts").html($.labelData.settingsEmailAlerts);
        $(".socialTitle").html($.labelData.socialTitle);
        $(".socialFacebook").html($.labelData.socialFacebook);
        $(".socialTwitter").html($.labelData.socialTwitter);
        $(".socialGoogle").html($.labelData.socialGoogle);
        $(".socialInstagram").html($.labelData.socialInstagram);
        $(".placeSearch").attr("placeholder", $.labelData.placeSearch);
        $(".placeUpdate").attr("placeholder", $.labelData.placeUpdate);
      }

    }

  });
}



/* socialSettings */
function socialSettings(uid, token, apiBaseUrl, baseUrl, facebook, twitter, google, instagram) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "facebook": facebook,
    "twitter": twitter,
    "google": google,
    "instagram": instagram
  });
  var url = apiBaseUrl + 'api/socialSettings';
  ajaxPost(url, encodedata, function (data) {

    if (parseInt(data.settings[0].status)) {
      $("#successMessage").fadeIn("slow").html("You social information has been updated successfully.");
    } else {
      $("#networkError").fadeIn("slow").html("Please enter valid details.");
    }

  });
}


/* User Group Search  */
function userGroupSearch(uid, token, apiBaseUrl, baseUrl, searchword) {
  var i = '';
  var j = '';
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "searchword": searchword
  });
  var url = apiBaseUrl + 'api/userGroupSearch';
  ajaxPost(url, encodedata, function (data) {
    $("#searchDisplay").show();
    if (data) {

      $.each(data.userGroupSearch, function (i, data) {
        var nameHTML = '';
        if (data.type == 'user') {
          nameHTML = '<a href="' + baseUrl + data.username + '" class="feed-author">';
        } else {
          nameHTML = '<a href="' + baseUrl + 'group/' + data.id + '" class="feed-author">';
        }

        var aboutHTML = '';
        if (data.aboutme) {
          aboutHTML = data.aboutme;
        }

        i = '<div class="timeline-block item searchList">' +
          '<div class="popupBlock">' +
          nameHTML +
          '<div class="media">' +
          '<span class="pull-left">' +
          '<img src="' + data.profile_pic + '" class="media-object searchFace"></span>' +
          '<div class="media-body-popup">' +
          '<div class="feed-author"><b>' + data.name + '</b></div>' +
          '<div class="timeago feedContent">' + aboutHTML + '</div>' +
          '</div></div></a></div></div>';
        j += i;
      });
      $("#searchDisplay").html(j);
    } else {
      $("#searchDisplay").html("<div id='noSeachResults'>No results.</div>");
    }


  });
}

/* Change Password */
function changePassword(uid, token, apiBaseUrl, baseUrl, oldPassword, newPassword, confirmPassword) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "oldPassword": oldPassword,
    "newPassword": newPassword,
    "confirmPassword": confirmPassword
  });
  var url = apiBaseUrl + 'api/changePassword';
  ajaxPost(url, encodedata, function (data) {
    if (data.changePassword.length) {

      if (parseInt(data.changePassword[0].status)) {
        $("#oldPassword").val("");
        $("#newPassword").val("");
        $("#confirmPassword").val("");
        $("#successMessage").fadeIn("slow").html("Password has been changed.");
      } else {
        $("#networkError").show().html("Please give valid current password.");
      }

    }
  });
}


/*########## Notifications  ##########*/

/* Notification Time Update  */
function notificationCreatedUpdate(uid, token, apiBaseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token
  });
  var url = apiBaseUrl + 'api/notificationCreatedUpdate';
  ajaxPost(url, encodedata, function (data) {});
}

/* Notification New Count  */
function notificationsNewCount(uid, token, apiBaseUrl, baseUrl, createdTime) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token
  });
  var url = apiBaseUrl + 'api/notificationsNewCount';
  ajaxPost(url, encodedata, function (data) {

    if (parseInt(data.notificationsNewCount[0].count) > 0) {
      $(".notificationCount").html(data.notificationsNewCount[0].count).fadeIn("slow");
      $(".notificationIcon").addClass("effectSwing");
    }

  });
}

/* notifications API */
function notifications(uid, token, apiBaseUrl, baseUrl, notification_created, notifications_perpage, type) {
  var i = '';
  var j = '';
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "notification_created": notification_created,
    "notifications_perpage": notifications_perpage
  });
  var url = apiBaseUrl + 'api/notifications'; /* Notifications API */
  ajaxPost(url, encodedata, function (data) {
    if (data) {
      if (data.notifications.length) {
        $.each(data.notifications, function (i, data) {
          var notificationUrl = '';

          /* Status message */
          if (parseInt(data.msg_id) > 0) {
            notificationUrl = baseUrl + 'status/' + data.msg_id;
          } else {
            notificationUrl = baseUrl + data.username;
          }

          var reactionType = '';
          if (parseInt(data.reactionType) > 0) {

            var x = reactions(data.reactionType);

            reactionType = '<i class="' + x + 'IconSmall likeTypeSmall"></i>';



          }



          i = '<div class="timeline-block notificationsBlock popupBlock item" rel="' + data.created + '">' +
            '<div class=""><a href="' + notificationUrl + '" class="popupBlock">' +
            '<div class="panel-heading">' +
            '<div class="media nBlock">' +
            '<span class="pull-left">' +
            '<img src="' + data.notification_userDetails[0].profile_pic + '" class="media-object searchFace"></span>' +
            '<div class="media-body-popup">' +
            '<b class="feed-author">' + data.notification_userDetails[0].name + '</b>' +
            '<span > ' + reactionType + data.message + '</span>' +
            '<div class="timeago" title="' + data.timeAgo + '"></div>' +
            '</div></div></div></a></div></div>';
          if (type > 0)
            $("#notificationsContent").append(i);
          else
            $("#notifications").gridalicious('append', loadGrid(i));

        });
      } else {
        $("#notifications").append("<div class='noDataMessage'>No more notifications.</div>").removeClass("scrollMore").attr("rel", "0");

      }

    } else
      $("#networkError").show().html($.networkError);

  });
}

/*########## Friends  ##########*/

/* Add Friend */
function addFriend(uid, fid, token, apiBaseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "fid": fid,
    "token": token
  });
  var url = apiBaseUrl + 'api/addFriend';
  ajaxPost(url, encodedata, function (data) {
    if (data.friend.length) {
      if (parseInt(data.friend[0].status)) {
        $("#add" + fid).fadeOut('fast');
        $("#remove" + fid).removeClass('displaynone').fadeIn('fast');
      }
    }
  });
}

/* Remove Friend */
function removeFriend(uid, fid, token, apiBaseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "fid": fid,
    "token": token
  });
  var url = apiBaseUrl + 'api/removeFriend';
  ajaxPost(url, encodedata, function (data) {
    if (data.friend.length) {
      if (parseInt(data.friend[0].status)) {
        $("#remove" + fid).fadeOut("fast");
        $("#add" + fid).removeClass('displaynone').fadeIn("fast");
      }
    }

  });
}

/* Friends List API */
function friendsList(uid, token, apiBaseUrl, baseUrl, page, rowsPerPage, type, username) {

  if ($.trim(token).length < 1) {
    var rowsPerPage = 8;
  }

  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "page": page,
    "rowsPerPage": rowsPerPage,
    "type": type,
    "username": username
  });

  var url;
  if (token)
    url = apiBaseUrl + 'api/friendsList';
  else
    url = apiBaseUrl + 'api/publicFriendsList';

  ajaxPost(url, encodedata, function (data) {
    var i = '';
    var j = '';
    var DIV;
    var friendButton;

    if (parseInt(type) > 0) /* Small Friend List */
      DIV = $("#userFriendList")
    else
      DIV = $("#friendsList")

    if (data) {

      if (data.friendsList.length) {
        var Follow = "Follow";
        var Following = "Following";
        var You = 'You';
        if ($.labelData) {
          Follow = $.labelData.buttonFollow;
          Following = $.labelData.buttonFollowing;
          You = $.labelData.buttonYou;
        }
        if (data.friendsList.length >= 8)
          $("#friendsViewAll").fadeIn("slow");

        $.each(data.friendsList, function (i, data) {
          fullName = data.name;
          if (parseInt(type) > 0) /* Small Friend List */ {
            i = '<li><a href="' + baseUrl + data.username + '"><img src="' + data.profile_pic + '" alt="people"  class="sFace"/></a></li>';
          } else {
            if (data.role == 'fri') {
              friendButton = '<a href="#" class="wallbutton removeButton" id="remove' + data.uid + '">' + Following + '</a>' +
                '<a href="#" class="wallbutton addButton displaynone" id="add' + data.uid + '" ><i class="fa fa-plus"></i>' + Follow + '</a>';
            } else if (data.role == 'me') {
              friendButton = "<div id='you'>" + You + "!</div>";
            } else {
              friendButton = '<a href="#" class="wallbutton addButton " id="add' + data.uid + '"  p="1"><i class="fa fa-plus"></i>' + Follow + '</a>' +
                '<a href="#" class="wallbutton removeButton displaynone" id="remove' + data.uid + '">' + Following + '</a>';

            }

            i = '<div class="friendBlock" rel="' + page + '">' +
              '<div class="panel panel-default user-box">' +
              '<div class="panel-body">' +
              '<div class="media">' +
              '<img src="' + data.profile_pic + '" alt="people" class="media-object img-circle pull-left" />' +
              '<div class="media-body">' +
              '<a href="' + baseUrl + data.username + '" class="username">' + fullName + '</a>' +
              '</div></div></div>' +
              '<div class="panel-footer">' +
              friendButton +
              '</div></div></div>';
          }
          //j += i;

          if (parseInt(type) > 0)
            DIV.append(i);
          else
            DIV.gridalicious('append', loadGrid(i));


        });


      } else {

        var NoFriends = "No friends";
        var NoMoreFriends = "No more friends";
        if ($.labelData) {
          NoFriends = $.labelData.msgNoFriends;
          NoMoreFriends = $.labelData.msgNoMoreFriends;
        }

        if (parseInt(type) > 0) {
          $("#friendsProfileBlock_child").html(NoFriends);
        } else {

          DIV.removeClass("scrollMore").attr("rel", "0");
          if (parseInt(page) > 1)
            $("#noRecords").html("<div class='noDataMessage'>" + NoMoreFriends + "</div>");
          else
            $("#noRecords").html("<div class='noDataMessage'>" + NoFriends + "</div>");

        }

      }

    } else {
      $("#networkError").show().html($.networkError);
    }

  });

}


/* Friends List API */
function followersList(uid, token, apiBaseUrl, baseUrl, page, rowsPerPage, type, username) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "page": page,
    "rowsPerPage": rowsPerPage,
    "type": type,
    "username": username
  });
  var url = apiBaseUrl + 'api/followersList';
  ajaxPost(url, encodedata, function (data) {
    var i = '';
    var j = '';
    var DIV;
    var friendButton;


    DIV = $("#friendsList")

    if (data) {

      if (data.followersList.length) {
        var Follow = "Follow";
        var Following = "Following";
        var You = 'You';
        if ($.labelData) {
          Follow = $.labelData.buttonFollow;
          Following = $.labelData.buttonFollowing;
          You = $.labelData.buttonYou;
        }


        $.each(data.followersList, function (i, data) {
          fullName = data.name;

          if (data.role == 'fri') {
            friendButton = '<a href="#" class="wallbutton removeButton" id="remove' + data.uid + '">' + Following + '</a>' +
              '<a href="#" class="wallbutton addButton displaynone" id="add' + data.uid + '" ><i class="fa fa-plus"></i>' + Follow + '</a>';
          } else if (data.role == 'me') {
            friendButton = "<div id='you'>" + You + "!</div>";
          } else {
            friendButton = '<a href="#" class="wallbutton addButton " id="add' + data.uid + '"  p="1"><i class="fa fa-plus"></i>' + Follow + '</a>' +
              '<a href="#" class="wallbutton removeButton displaynone" id="remove' + data.uid + '">' + Following + '</a>';

          }

          i = '<div class="friendBlock" rel="' + page + '">' +
            '<div class="panel panel-default user-box">' +
            '<div class="panel-body">' +
            '<div class="media">' +
            '<img src="' + data.profile_pic + '" alt="people" class="media-object img-circle pull-left" />' +
            '<div class="media-body">' +
            '<a href="' + baseUrl + data.username + '" class="username">' + fullName + '</a>' +
            '</div></div></div>' +
            '<div class="panel-footer">' +
            friendButton +
            '</div></div></div>';

          //j += i;


          DIV.gridalicious('append', loadGrid(i));


        });


      } else {

        var NoFollowers = "No followers";
        var NoMoreFollowers = "No more followers";
        if ($.labelData) {
          NoFollowers = $.labelData.msgNoFollowers;
          NoMoreFollowers = $.labelData.msgNoMoreFollowers;
        }

        DIV.removeClass("scrollMore").attr("rel", "0");

        if (parseInt(page) > 1) {
          $("#noRecords").html("<div class='noDataMessage'>" + NoMoreFollowers + "</div>");
        } else {
          $("#noRecords").html("<div class='noDataMessage'>" + NoFollowers + "</div>");
        }

      }

    } else {
      $("#networkError").show().html($.networkError);
    }

  });

}

/*########## ProfileView  ##########*/

/* profile view create */
function profileViewed(uid, token, apiBaseUrl, baseUrl, public_username) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "public_username": public_username,
    "token": token
  });
  var url = apiBaseUrl + 'api/profileViewed';
  ajaxPost(url, encodedata, function (data) {


  });
}


/* Profile viewer list API */
function profileViewedList(uid, token, apiBaseUrl, baseUrl, page, rowsPerPage, type, username) {

  if ($.trim(token).length < 1) {
    var rowsPerPage = 8;
  }

  var i = '';
  var j = '';
  var friendButton;
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "page": page,
    "rowsPerPage": rowsPerPage,
    "username": username
  });
  var url;
  if (token)
    url = apiBaseUrl + 'api/profileViewedList';
  else
    url = apiBaseUrl + 'api/publicProfileViewedList';

  ajaxPost(url, encodedata, function (data) {

    if (parseInt(type) > 0) /* Small Friend List */
      DIV = $("#userProfileViewList")
    else
      DIV = $("#viewsList")

    if (data) {
      if (data.profileViewedList.length) {
        var Follow = "Follow";
        var Following = "Following";
        var You = 'You';
        if ($.labelData) {
          Follow = $.labelData.buttonFollow;
          Following = $.labelData.buttonFollowing;
          You = $.labelData.buttonYou;
        }

        if (data.profileViewedList.length >= 8)
          $("#profilesViewAll").fadeIn("slow");

        $.each(data.profileViewedList, function (i, data) {

          if (parseInt(type) > 0) /* Small Friend List */ {
            i = '<li><a href="' + baseUrl + data.username + '"><img src="' + data.profile_pic + '" alt="people"  class="sFace"/></a></li>';
          } else {

            if (data.role == 'fri') {
              friendButton = '<a href="#" class="wallbutton removeButton" id="remove' + data.uid + '">' + Following + '</a>' +
                '<a href="#" class="wallbutton addButton displaynone" id="add' + data.uid + '" ><i class="fa fa-plus"></i>' + Follow + '</a>';
            } else if (data.role == 'me') {
              friendButton = "<div id='you'>" + You + "!</div>";
            } else {
              friendButton = '<a href="#" class="wallbutton addButton " id="add' + data.uid + '"  p="1"><i class="fa fa-plus"></i>' + Follow + '</a>' +
                '<a href="#" class="wallbutton removeButton displaynone" id="remove' + data.uid + '">' + Following + '</a>';

            }


            i = '<div class="friendBlock" rel="' + page + '">' +
              '<div class="panel panel-default user-box">' +
              '<div class="panel-body">' +
              '<div class="media">' +
              '<img src="' + data.profile_pic + '" alt="people" class="media-object img-circle pull-left" />' +
              '<div class="media-body">' +
              '<a href="' + baseUrl + data.username + '" class="username">' + data.name + '</a>' +
              '</div></div></div>' +
              '<div class="panel-footer">' +
              friendButton +
              '</div></div></div>';
          }


          if (parseInt(type) > 0)
            DIV.append(i);
          else
            DIV.gridalicious('append', loadGrid(i));

        });



      } else {
        if (parseInt(type) > 0) {
          $("#recentProfileBlock_child").html("No Recent Views");
        } else {

          DIV.removeClass("scrollMore").attr("rel", "0");


          var NoViews = "No visitors";
          var NoMoreViews = "No more visitors";
          if ($.labelData) {
            NoViews = $.labelData.msgNoViews;
            NoMoreViews = $.labelData.msgNoMoreViews;
          }


          if (parseInt(page) > 1)
            $("#noRecords").html("<div class='noDataMessage'>" + NoMoreViews + "</div>");
          else
            $("#noRecords").html("<div class='noDataMessage'>" + NoViews + "</div>");


        }

      }

    } else
      $("#networkError").show().html($.networkError);
  });
}

/*########## Groups  ##########*/

/* Update Group */
function groupUpdate(uid, token, apiBaseUrl, baseUrl, editGroupID, name, desc) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "group_id": editGroupID,
    "name": name,
    "desc": desc
  });
  var url = apiBaseUrl + 'api/groupUpdate';
  ajaxPost(url, encodedata, function (data) {
    $("#successMessage").show().html("Group has been updated successfully, <a href='" + baseUrl + "group/" + editGroupID + "'>click here</a>");
  });
}

/* Delete Group */
function groupDelete(uid, token, apiBaseUrl, baseUrl, editGroupID, username) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "group_id": editGroupID
  });
  var url = apiBaseUrl + 'api/groupDelete';
  ajaxPost(url, encodedata, function (data) {
    window.location = baseUrl + "groups/" + username;
  });
}



/* Group Edit Check  */
function groupEditCheck(uid, token, apiBaseUrl, baseUrl, editGroupID) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "group_id": editGroupID
  });
  var url = apiBaseUrl + 'api/groupEditCheck';
  ajaxPost(url, encodedata, function (data) {
    $.each(data.groupEditCheck, function (i, data) {
      if (parseInt(data.editCheck)) {
        $("#groupNameEdit").val(data.group_name);
        $("#groupDescEdit").val(data.group_desc);

      } else {
        window.location = baseUrl + "404.php";
      }
    });
  });
}


/* Create Group  */
function createGroup(uid, token, apiBaseUrl, baseUrl, groupName, groupDesc) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "groupName": groupName,
    "groupDesc": groupDesc
  });
  var url = apiBaseUrl + 'api/createGroup';
  ajaxPost(url, encodedata, function (data) {
    $.each(data.group, function (i, data) {
      $("#groupName").val("");
      $("#groupDesc").val("");
      if (parseInt(data.groupID)) {
        $("#successMessage").show().html("Group has been created successfully, <a href='" + baseUrl + "group/" + data.groupID + "'>click here</a>");
      } else {
        $("#networkError").show().html("Group name is already present, please try different name. ");
      }

    });

  });
}

/* Add Group */
function groupAdd(uid, token, apiBaseUrl, baseUrl, group_id) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "group_id": group_id
  });
  var url = apiBaseUrl + 'api/groupAdd';
  ajaxPost(url, encodedata, function (data) {
    if (data.group.length) {

      $("#addGroup" + group_id).fadeOut("fast");
      $("#removeGroup" + group_id).fadeIn("fast");
      //$("#updateBox").fadeIn();
    }

  });
}

/* Remove Group */
function groupRemove(uid, token, apiBaseUrl, baseUrl, group_id) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "group_id": group_id
  });
  var url = apiBaseUrl + 'api/groupRemove';
  ajaxPost(url, encodedata, function (data) {
    if (data.group.length) {

      $("#removeGroup" + group_id).fadeOut('fast');
      $("#addGroup" + group_id).fadeIn('fast');
      //$("#updateBox").fadeOut();
    }

  });
}

/* Group Details */
function groupDetails(uid, group_id, token, apiBaseUrl, baseUrl) {
  var joinButton = "";
  var encodedata = JSON.stringify({
    "uid": uid,
    "group_id": group_id,
    "token": token
  });
  var url = apiBaseUrl + 'api/groupDetails';
  ajaxPost(url, encodedata, function (data) {
    if (data.groupDetails.length) {
      var EditGroup = "Edit Group";
      var UnfollowGroup = "Unfollow Group";
      var JoinGroup = "Join Group";
      if ($.labelData) {
        EditGroup = $.labelData.buttonEditGroup;
        UnfollowGroup = $.labelData.buttonEditGroup;
        JoinGroup = $.labelData.buttonJoinGroup;
      }
      $.each(data.groupDetails, function (i, data) {
        $("#groupName").html(data.group_name);
        $(".groupPic").attr('src', '' + data.group_pic + '');
        $("#membersCount").html(data.group_count);
        if (data.group_bg.length > 0)
          $("#coverBox").html('').html('<img src="' + data.group_bg + '" alt="cover"  class="profileBG"  style="margin-top:' + data.group_bg_position + '"/>');

        if (data.groupStatus.length < 1) {
          $("#updateBoxBlock").html('').hide();
        }

        if (data.group_desc.length < 1) {
          $("#aboutGroupBlock").hide();
        } else {
          $("#groupDesc").html(data.group_desc);
        }

        if (data.group_owner_id != uid) {
          $("#bgimageform, #profileimageform").html("").hide();
        }


        if (data.group_owner_id == uid) {
          joinButton = '<a href="' + baseUrl + 'editGroup/' + group_id + '" class="wallbutton messageButton ">' + EditGroup + '</a>';
        } else if (data.groupCheck) {
          joinButton = '<a href="#" class="wallbutton redButton removeGroup" id="removeGroup' + group_id + '"><i class="fa fa-minus-circle"></i>' + UnfollowGroup + '</a>' +
            '<a href="#" class="wallbutton addGroup displaynone" id="addGroup' + group_id + '"><i class="fa fa-users"></i>' + JoinGroup + '</a>';
        } else {
          joinButton = '<a href="#" class="wallbutton addGroup" id="addGroup' + group_id + '"><i class="fa fa-users"></i>' + JoinGroup + '</a>' +
            '<a href="#" class="wallbutton redButton removeGroup displaynone" id="removeGroup' + group_id + '"><i class="fa fa-minus-circle"></i>' + UnfollowGroup + '</a>';
        }


      });

      $('#joinButton').html(joinButton);

    }

  });
}

/* Group Followers */
function groupFollowers(uid, group_id, token, token, page, rowsPerPage, type, apiBaseUrl, baseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "group_id": group_id,
    "token": token,
    "page": page,
    "rowsPerPage": rowsPerPage
  });
  var url = apiBaseUrl + 'api/groupFollowers';
  var DIV;
  var i = '';
  var j = '';

  if (parseInt(type) > 0) /* Small Friend List */
    DIV = $("#userGroupMembersList");
  else
    DIV = $("#membersPhotosList");

  ajaxPost(url, encodedata, function (data) {
    if (data.groupFollowers.length) {
      var Follow = "Follow";
      var Following = "Following";
      var you = "You";
      if ($.labelData) {
        Follow = $.labelData.buttonFollow;
        Following = $.labelData.buttonFollowing;
        You = $.labelData.buttonYou;
      }
      $.each(data.groupFollowers, function (i, data) {
        fullName = data.name;

        if (parseInt(type) > 0) /* Small Group Follower List */ {
          i = '<li><a href="' + baseUrl + data.username + '"><img src="' + data.profile_pic + '" alt="people"  class="sFace"/></a></li>';
        } else {
          if (data.role == 'fri') {
            friendButton = '<a href="#" class="wallbutton removeButton" id="remove' + data.uid + '">' + Following + '</a>' +
              '<a href="#" class="wallbutton addButton displaynone" id="add' + data.uid + '" ><i class="fa fa-plus"></i>' + Follow + '</a>';
          } else if (data.role == 'me') {
            friendButton = "<div id='you'>" + you + "!</div>";
          } else {
            friendButton = '<a href="#" class="wallbutton addButton " id="add' + data.uid + '"  p="1"><i class="fa fa-plus"></i>' + Follow + '</a>' +
              '<a href="#" class="wallbutton removeButton displaynone" id="remove' + data.uid + '">' + Following + '</a>';

          }

          i = '<div class="memberBlock" rel="' + page + '">' +
            '<div class="panel panel-default user-box">' +
            '<div class="panel-body">' +
            '<div class="media">' +
            '<img src="' + data.profile_pic + '" alt="people" class="media-object img-circle pull-left" />' +
            '<div class="media-body">' +
            '<a href="' + baseUrl + data.username + '" class="username">' + fullName + '</a>' +
            '</div></div></div>' +
            '<div class="panel-footer">' +
            friendButton +
            '</div></div></div>';
        }


        if (parseInt(type) > 0)
          DIV.append(i);
        else
          DIV.gridalicious('append', loadGrid(i));

      });

    } else {
      DIV.removeClass("scrollMore").attr("rel", "0");

      var NoMembers = "No group members";
      var NoMoreMembers = "No more group members";
      if ($.labelData) {
        NoMembers = $.labelData.msgNoMembers;
        NoMoreMembers = $.labelData.msgNoMoreMembers;
      }

      if (parseInt(page) > 1)
        $("#noRecords").html("<div class='noDataMessage'>" + NoMoreMembers + "</div>");
      else
        $("#noRecords").html("<div class='noDataMessage'>" + NoMembers + "</div>");

    }
  });
}

/* Groups list API */
function groupsList(uid, token, apiBaseUrl, baseUrl, page, rowsPerPage, type, username) {

  if ($.trim(token).length < 1) {
    var rowsPerPage = 8;
  }

  var i = '';
  var j = '';
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "page": page,
    "rowsPerPage": rowsPerPage,
    "type": type,
    "username": username
  });
  var url;

  if (token)
    url = apiBaseUrl + 'api/groupsList';
  else
    url = apiBaseUrl + 'api/publicGroupsList';

  ajaxPost(url, encodedata, function (data) {

    var DIV;

    if (parseInt(type) > 0) /* Small Groups List */
      DIV = $("#userGroupsList")
    else
      DIV = $("#groupsList")

    if (data.groupsList.length) {
      var EditGroup = "Edit Group";
      var UnfollowGroup = "Unfollow Group";
      var JoinGroup = "Join Group";
      if ($.labelData) {
        EditGroup = $.labelData.buttonEditGroup;
        UnfollowGroup = $.labelData.buttonEditGroup;
        JoinGroup = $.labelData.buttonJoinGroup;
      }
      if (data.groupsList.length >= 8)
        $("#groupsViewAll").fadeIn("slow");

      $.each(data.groupsList, function (i, data) {
        if (parseInt(type) > 0) /* Small Friend List */ {
          i = '<li><a href="' + baseUrl + 'group/' + data.group_id + '"><img src="' + data.group_pic + '" alt="' + data.group_name + '"  class="sFace"/></a></li>';
        } else {
          var joinButton = ""
          if (data.group_owner_id == uid) {
            joinButton = '<a href="' + baseUrl + 'editGroup/' + data.group_id + '" class="wallbutton messageButton">' + EditGroup + '</a>';
          } else if (data.groupCheck) {
            joinButton = '<a href="#" class="wallbutton redButton removeGroup" id="removeGroup' + data.group_id + '">' + UnfollowGroup + '</a>' +
              '<a href="#" class="wallbutton addGroup " id="addGroup' + data.group_id + '" style="display:none">' + JoinGroup + '</a>';
          } else {
            joinButton = '<a href="#" class="wallbutton addGroup" id="addGroup' + data.group_id + '">' + JoinGroup + '</a>' +
              '<a href="#" class="wallbutton redButton removeGroup " id="removeGroup' + data.group_id + '" style="display:none">' + UnfollowGroup + '</a>';
          }

          i = '<div class="timeline-block groupBlock item" rel="' + page + '">' +
            '<div class="panel panel-default profile">' +
            '<div class="cover-container">' +
            '<img src="' + data.group_bg + '" alt="place" class="img-responsive" />' +
            '</div>' +
            '<div class="info">' +
            '<h4><a href="' + baseUrl + 'group/' + data.group_id + '">' + data.group_name + '</a></h4>' +
            '<p>' + data.group_desc + '</p>' +
            '</div>' +
            '<img src="' + data.group_pic + '" alt="people" class="img-circle avatar" />' +
            '<div class="groupJoin">' +
            joinButton +
            '</div></div></div>';
        }

        if (parseInt(type) > 0)
          DIV.append(i);
        else
          DIV.gridalicious('append', loadGrid(i));
      });

    } else {

      if (parseInt(type) > 0) {
        $("#userGroupsList").html("No groups added");
      } else {
        DIV.removeClass("scrollMore").attr("rel", "0");

        var NoGroups = "No groups";
        var NoMoreGroups = "No more groups";
        if ($.labelData) {
          NoGroups = $.labelData.msgNoGroups;
          NoMoreGroups = $.labelData.msgNoMoreGroups;
        }

        if (parseInt(page) > 1)
          $("#noRecords").html("<div class='noDataMessage'>" + NoMoreGroups + "</div>");
        else
          $("#noRecords").html("<div class='noDataMessage'>" + NoGroups + "</div>");

      }


    }
  });
}



/* Group Photos List */
function groupPhotosList(uid, token, apiBaseUrl, baseUrl, page, offset, rowsPerPage, group_id) {
  var i = '';
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "page": page,
    "offset": offset,
    "rowsPerPage": rowsPerPage,
    "group_id": group_id
  });
  var url = apiBaseUrl + 'api/groupPhotosList';
  ajaxPost(url, encodedata, function (data) {

    DIV = $("#membersPhotosList")

    if (data.groupPhotosList.length) {
      $.each(data.groupPhotosList, function (i, data) {
        var deleteHTML = "";

        if (data.uid == uid || data.group_owner_id == uid) {
          deleteHTML = '<span class="imageDelete" id="photo' + data.id + '" rel="' + group_id + '" prel="' + data.uid + '" original-title="Delete Photos"></span>';
        }

        i = '<div class="photoBlock" id="photoBlock' + data.id + '" rel="' + page + '">' +
          '<div class="panel panel-default user-box">' +
          '<div class="panel-body">' + deleteHTML +
          '<a href="' + data.image_path + '" data-lightbox="groupPhotos"><img src="' + data.image_path + '"/></a>' +
          '</div></div></div>';
        DIV.gridalicious('append', loadGrid(i));
      });

    } else
      DIV.removeClass("scrollMore").attr("rel", "0");
    $("#noRecords").html("No group photos");
    //$("#networkError").show().html($.networkError);
  });

}

/*########## Photos  ##########*/

/* Save Background Positions  */
function saveBGPosition(uid, token, apiBaseUrl, baseUrl, position, type, group_id) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "position": position,
    "type": type,
    "group_id": group_id
  });
  var url = apiBaseUrl + 'api/saveBGPosition';
  ajaxPost(url, encodedata, function (data) {

    $(".bgSave").fadeOut('slow');
    $("#profileBG").removeClass("headerimage");
    var B = "margin-top:" + position;
    $("#profileBG").attr('style', B);
  });
}

/* Delete Photo */
function deletePhoto(uid, pid, token, group_id, photo_uid, apiBaseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "pid": pid,
    "token": token,
    "group_id": group_id,
    "photo_uid": photo_uid
  });
  var url = apiBaseUrl + 'api/deletePhoto';
  ajaxPost(url, encodedata, function (data) {
    if (data.deletePhoto.length) {
      $("#photoBlock" + pid).fadeOut('slow');
    }

  });
}

/* Photos List */
function photosList(uid, token, apiBaseUrl, baseUrl, page, rowsPerPage, photos_of, public_username) {
  var i = '';
  var j = '';
  var deleteHTML = "";
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "page": page,
    "rowsPerPage": rowsPerPage,
    "public_username": public_username,
    "photos_of": photos_of
  });
  var url = apiBaseUrl + 'api/photosList';
  ajaxPost(url, encodedata, function (data) {

    DIV = $("#photosList")

    if (data.photosList.length) {
      $.each(data.photosList, function (i, data) {

        if (data.uid == uid) {
          deleteHTML = '<span class="imageDelete" id="photo' + data.id + '" rel="0" prel="0" original-title="Delete Photo"></span>';
        }

        i = '<div class="photoBlock" id="photoBlock' + data.id + '" rel="' + page + '">' +
          '<div class="panel panel-default user-box">' +
          '<div class="panel-body">' + deleteHTML +
          '<a href="' + data.image_path + '" data-lightbox="photos' + public_username + '"><img src="' + data.image_path + '"/></a>' +
          '</div></div></div>';
        DIV.gridalicious('append', loadGrid(i));
      });

    } else
      DIV.removeClass("scrollMore").attr("rel", "0");

    var NoPhotos = "No photos";
    var NoMorePhotos = "No more photos";
    if ($.labelData) {
      NoPhotos = $.labelData.msgNoPhotos;
      NoMorePhotos = $.labelData.msgNoMorePhotos;
    }

    if (parseInt(page) > 1)
      $("#noRecords").html("<div class='noDataMessage'>" + NoMorePhotos + "</div>");
    else
      $("#noRecords").html("<div class='noDataMessage'>" + NoPhotos + "</div>");

    //$("#networkError").show().html($.networkError);
  });

}


/*########## NewsFeed  ##########*/

/* User total likes */
function likeUsers(uid, msg_id, token, apiBaseUrl, baseUrl, created) {
  noToken(token, baseUrl);
  var encodedata = JSON.stringify({
    "uid": uid,
    "msg_id": msg_id,
    "token": token
  });
  var url = apiBaseUrl + 'api/likeUsers';
  ajaxPost(url, encodedata, function (data) {
    if (data.likeUsers.length) {
      var i = '';
      var j = '';
      $.each(data.likeUsers, function (i, ldata) {
        i = '<a href="' + baseUrl + ldata.username + '" id="likeUserFace' + ldata.uid + msg_id + '" original-title="' + ldata.name + '" class="likeUserFace likeUserFace' + ldata.uid + msg_id + created + '"><img src="' + ldata.profile_pic + '" alt="' + ldata.name + '" class="img-circle marginRight" ></a>';
        j += i;
      });
      $(".likeUsersBlock" + msg_id + created).html(j);
    }
    //else
    //$("#networkError").show().html($.networkError);
  });
}

/* Like Unlike API */
function userLikeUnlike(uid, msg_id, token, type, name, username, pic, apiBaseUrl, baseUrl, created, reactionType, reactionName) {
  noToken(token, baseUrl);
  var encodedata = JSON.stringify({
    "uid": uid,
    "msg_id": msg_id,
    "token": token,
    "type": type,
    "reactionType": reactionType
  });
  var url = apiBaseUrl + 'api/userLikeUnlike';
  ajaxPost(url, encodedata, function (data) {
    if (data.userLikeUnlike.length) {

      var Like = "Like";
      var Unlike = "Unlike";

      if ($.labelData) {
        Like = $.labelData.feedLike;
        Unlike = $.labelData.feedUnLike;
      }

      var L = $(".likeUserDiv" + msg_id + created);
      $('.likeUsersBlock' + msg_id + created).show();

      var A = '<a href="' + baseUrl + username + '" id="likeUserFace' + uid + msg_id + '" original-title="' + name + '" class="likeUserFace likeUserFace' + uid + msg_id + created + '"><img src="' + pic + '" alt="' + data.name + '" class="img-circle marginRight" ></a>';
      if (type == 'Like') {
        var B;

        if (parseInt(reactionType) > 0) {
          var x = reactionName.toLowerCase();
          B = '<i class="' + x + 'IconSmall likeTypeSmall reactionLeft"></i>' + reactionName;
        }


        $(".like" + msg_id + created).attr("rel", "Unlike").attr("rel", "Unlike").removeClass("reaction").removeClass("tooltipstered").html(B);
        if (L.html().length > 0) {
          $(".likeUsersBlock" + msg_id + created).prepend(A);
        } else {
          L.html('<div class="panel-body likesList likeUsersBlock' + msg_id + created + '" id="likeUsersBlock' + msg_id + '" >' + A + '</div>');
        }
      } else {
        $(".like" + msg_id + created).attr("rel", "Like").attr("rel", "Like").addClass("reaction").html("<i class='fa fa-heart'></i>" + Like);
        // $("#likeUserFace"+uid+msg_id).remove();
        $(".likeUserFace" + uid + msg_id + created).remove();

        if ($(".likeUsersBlock" + msg_id + created).html().length == 0) {
          $('.likeUsersBlock' + msg_id + created).hide();
        }
      }
    }
    //else
    //$("#networkError").show().html($.networkError);
  });
}

/* Share Unshare API */
function userShareUnshare(uid, msg_id, token, type, apiBaseUrl, baseUrl, created) {
  noToken(token, baseUrl);
  var encodedata = JSON.stringify({
    "uid": uid,
    "msg_id": msg_id,
    "token": token,
    "type": type
  });
  var url = apiBaseUrl + 'api/userShareUnshare';
  ajaxPost(url, encodedata, function (data) {
    if (data.userShareUnshare.length) {
      var Unshare = "Unshare";
      var Share = "Share";
      if ($.labelData) {
        Unshare = $.labelData.feedUnshare;
        Share = $.labelData.feedShare;
      }
      if (type == 'Share') {
        //$("#share"+msg_id).attr("rel","Unshare").attr("rel","Unshare").html("<i class='fa fa-share shareColor'></i>"+Unshare);
        $(".share" + msg_id + created).attr("rel", "Unshare").attr("rel", "Unshare").html("<i class='fa fa-share shareColor'></i>" + Unshare);
      } else {
        //$("#share"+msg_id).attr("rel","Share").attr("rel","Share").html("<i class='fa fa-share'></i>"+Share);
        $(".share" + msg_id + created).attr("rel", "Share").attr("rel", "Share").html("<i class='fa fa-share'></i>" + Share);
      }
    }
  });
}

/* NewsFeed Delete API */
function deleteNewsFeed(uid, msg_id, group_id, token, apiBaseUrl, created) {

  var encodedata = JSON.stringify({
    "uid": uid,
    "msg_id": msg_id,
    "group_id": group_id,
    "token": token
  });
  var url = apiBaseUrl + 'api/deleteNewsFeed';
  ajaxPost(url, encodedata, function (data) {
    if (data.deleteNewsFeed.length) {
      $(".newsFeed" + msg_id + created).html(" ").empty();
      $(".newsFeed" + msg_id + created).fadeOut("fast").remove;
    }
  });
}


/* update News Feed */
function updateNewsFeed(uid, update, uploads, group_id, token, pic, lat, lang, baseUrl, apiBaseUrl) {
  $("#newsFeed").fadeIn();
  var embed = '';
  var encodedata = JSON.stringify({
    "uid": uid,
    "update": update,
    "group_id": group_id,
    "uploads": uploads,
    "token": token,
    "lat": lat,
    "lang": lang
  });
  var url = apiBaseUrl + 'api/updateNewsFeed';

  ajaxPost(url, encodedata, function (data) {
    if (data.NewsFeedResult.length) {

      var Unshare = "Unshare";
      var Share = "Share";
      var Like = "Like";
      var Unlike = "Unlike";
      var Comment = "Comment";
      var placeComment = "Write a comment.."

      if ($.labelData) {
        Unshare = $.labelData.feedUnshare;
        Share = $.labelData.feedShare;
        Like = $.labelData.feedLike;
        Unlike = $.labelData.feedUnLike;
        Comment = $.labelData.feedComment;
        placeComment = $.labelData.placeComment;

      }

      $.each(data.NewsFeedResult, function (i, data) {

        var shareHTML = '';
        var geoView = 1;
        /* Expanding URL Data*/
        if (data.embed) {
          embed = data.embed;
          geoView = 0;
        }
        /*GEO MAP */
        var geoHTML = '';
        var geoIMG = '';
        if (lat && lang && geoView > 0) {
          geoIMG = "https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=570x300&scale=2&maptype=roadmap&markers=color:red%7Clabel:S%7C" + lat + "," + lang;
          geoHTML = "<div class='geoDivBlock'><img src='" + geoIMG + "' style='width:100%'/></div>";
        }
        /* Share HTML */
        if (data.uid_fk != uid) {
          shareHTML = '<a href="#" class="sharebutton  icontext share' + data.msg_id + data.created + '" c="' + data.created + '" id="share' + data.msg_id + '" title="Share" rel="Share" data="0"><i class="fa fa-share"></i>' + Share + '</a>';
        }

        /* Upload Images */
        var uploadImageHTMLTitle = '<div class="img_container slider-wrapper"><div class="slider" id="slider' + data.msg_id + '">';
        var uploadImageHTMLFooter = '</div><div class="slider-direction-nav" id="slider_direction_' + data.msg_id + '"></div><div class="slider-control-nav" id="slider_control_' + data.msg_id + '"></div></div>';
        var uploadImageHTML = '';
        var C = '';
        if (data.uploadPaths.length) {
          if (data.uploadPaths.length > 1) {
            uploadImageHTML += uploadImageHTMLTitle;
            for (var i = 0; i < data.uploadPaths.length; i++) {
              C = '<div class="slide' + i + '"><a href="' + data.uploadPaths[i] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[i] + '" class="imgpreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a></div>';
              uploadImageHTML += C;
            }
            uploadImageHTML += uploadImageHTMLFooter;
            sliderLoad(data.msg_id);
          } else {
            uploadImageHTML = '<div><a href="' + data.uploadPaths[0] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[0] + '" class="imgpreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a></div>';
          }
        }


        var html = '<div class="newsFeed-block timeline-block item newsFeed' + data.msg_id + data.created + '" id="newsFeed' + data.msg_id + '"  rel="' + data.created + '" >' +
          '<div class="panel panel-default">' +
          '<div class="panel-heading">' +
          '<div class="media">' +
          '<a href="' + baseUrl + data.username + '" class="pull-left">' +
          '<img src="' + data.profile_pic + '" class="media-object smallFace">' +
          '</a>' +
          '<div class="media-body">' +
          '<a class="feedDelete commonDelete" c="' + data.created + '" href="#" id="deleteFeed' + data.msg_id + '" rel="" title="Delete Update"></a>' +
          '<a href="' + baseUrl + data.username + '" class="feed-author">' + data.name + '</a>' +
          '<a href="' + baseUrl + 'status/' + data.msg_id + '" class="timeago" title="' + data.timeAgo + '"></a>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '<div class="panel-body">' +
          '<p class="feedContent">' + data.message + '</p>' +
          '</div><div>' + embed + '</div>' + uploadImageHTML + geoHTML +
          '<div id="likeUserDiv' + data.msg_id + '" class="likeUserDiv' + data.msg_id + data.created + '">' +
          '</div>' +
          '<div class="st_like_share">' +
          '<a href="#" class="reaction like  icontext like' + data.msg_id + data.created + '" c="' + data.created + '" id="like' + data.msg_id + '" title="Like" rel="Like" data="0"><i class="fa fa-heart"></i>' + Like + '</a>' +
          '<a href="#commentbox' + data.created + '" class="commentopen  icontext " id="commentopen' + data.msg_id + '" rel="' + data.msg_id + '" c="' + data.created + '" title="Comment"><i class="fa fa-comment"></i>' + Comment + ' </a>' +
          shareHTML +
          '</div>' +
          '<ul class="comments comments' + data.msg_id + data.created + '" id="comments' + data.msg_id + '">' +
          '</ul>' +
          '<ul class="comments displaynone commentBox commentBox' + data.msg_id + data.created + '" id="commentBox' + data.msg_id + '">' +
          '<li class="comment-form " >' +
          '<div class="input-group">' +
          '<input type="text" class="form-control placeComment commentText' + data.msg_id + data.created + '" placeholder="' + placeComment + '" id="commentText' + data.msg_id + '"/>' +
          '<span class="input-group-addon">' +
          '<a href="#" id="commentCamara' + data.msg_id + '" class="commentCamera" title="Upload Image"><i class="fa fa-camera commentCamIcon"></i></a>' +
          '</span>' +
          '</div>' +
          '<div class="margintop10" >' +
          '<a href="#" class="wallbutton commentButton" id="commentButton' + data.msg_id + '" c="' + data.created + '">' + Comment + '</a></div>' +
          '</li>' +
          '</ul>' +
          '</div>' +
          '</div>';



        if (parseInt($(window).width()) < 401) {
          $("#newsFeed").prepend(html);
        } else {
          $("#newsFeed").gridalicious('prepend', loadGrid(html));
        }



        if (up) {
          var uploadvalues = $("#uploadValues").val();
        } else {
          var uploadvalues = $(".preview:last").attr('id');
        }
      });
    }

  });
}

/* NewsFeed Details API */
function newsFeed(uid, token, apiBaseUrl, baseUrl, lastid, perpage, type, public_username, groupID, msgID) {

  $(".load").show();
  var feedHtml, adHtml = '';
  var j = '';
  var k = '';
  var ads = 1;

  /* Group Updates else Friend Updates */
  if (groupID) {
    var encodedata = JSON.stringify({
      "uid": uid,
      "group_id": groupID,
      "token": token,
      "lastid": lastid,
      "perpage": perpage
    });
    var url = apiBaseUrl + 'api/groupNewsFeed';
  } else if (msgID) {
    var encodedata = JSON.stringify({
      "uid": uid,
      "token": token,
      "msgID": msgID
    });

    if (token) {
      var url = apiBaseUrl + 'api/status';
    } else {
      var url = apiBaseUrl + 'api/publicStatus';
    }

  } else {
    var encodedata = JSON.stringify({
      "uid": uid,
      "token": token,
      "lastid": lastid,
      "perpage": perpage,
      "public_username": public_username
    });
    if (type) {
      var url = apiBaseUrl + 'api/friendsNewsFeed';
    } else {

      if (token) {
        var url = apiBaseUrl + 'api/userNewsFeed';
      } else {
        var url = apiBaseUrl + 'api/publicUserNewsFeed';
      }

    }
  }

  ajaxPost(url, encodedata, function (data) {

    $(".load").hide();
    var Unshare = "Unshare";
    var Share = "Share";
    var SharedThis = " shared this";
    var Like = "Like";
    var Unlike = "Unlike";
    var LikeThis = "like this";
    var Comment = "Comment";
    var placeComment = "Write a comment..";
    var Posted = " posted in";
    var DeleteUpdate = "Delete update";
    var ViewAll = "View all";

    if ($.labelData) {
      Unshare = $.labelData.feedUnshare;
      Share = $.labelData.feedShare;
      SharedThis = $.labelData.feedShareThis;
      Like = $.labelData.feedLike;
      Unlike = $.labelData.feedUnLike;
      LikeThis = $.labelData.feedLikeThis;
      Comment = $.labelData.feedComment;
      placeComment = $.labelData.placeComment;
      DeleteUpdate = $.labelData.feedDeleteUpdate;
      Posted = $.labelData.feedPosted;
      ViewAll = $.labelData.commonViewAll;

    }


    if (data.friendsNewsFeed.length) {
      $.each(data.friendsNewsFeed, function (i, data) {
        var msg_id = data.msg_id;
        var msg_uid = data.messageDetails[0].uid_fk;
        var group_owner_id, group_id = "";
        if (data.groupDetails.length) {
          group_owner_id = data.groupDetails[0].group_owner_id;
          group_id = data.groupDetails[0].group_id;
        }

        /* Feed header */
        var shareLikeHead = '';
        var shareLikeImg = '';
        var deleteHTML = '';
        var groupText = '';
        /* Delete button enable */
        if (data.uid_fk == uid || uid == group_owner_id) {
          deleteHTML = '<a class="feedDelete commonDelete" c="' + data.created + '" href="#" id="deleteFeed' + data.msg_id + '" rel="' + group_id + '" title="' + DeleteUpdate + '"></a>';
        }

        /* Group Details */
        if (data.group_id_fk) {
          if (data.groupDetails.length) {
            $.each(data.groupDetails, function (i, gdata) {
              groupText = Posted + ' <a href="' + baseUrl + 'group/' + gdata.group_id + '" class="feed-author">' + gdata.group_name + '</a>';
            });
          }
        }

        if (data.share_uid > 0) {
          shareLikeHead = '<div class="wall-share">' + deleteHTML + '<a href="' + baseUrl + data.shareUserDetails[0].username + '">' + data.shareUserDetails[0].name + '</a> ' + SharedThis + '</div>';
          shareLikeImg = '<a href="' + baseUrl + data.shareUserDetails[0].username + '" class="pull-right shareUser">' +
            '<img src="' + data.shareUserDetails[0].profile_pic + '" class="media-object smallFace">' +
            '</a>';
          deleteHTML = '';
        } else if (data.like_uid > 0) {
          shareLikeHead = '<div class="wall-share">' + deleteHTML + '</a><a href="' + baseUrl + data.likeUserDetails[0].username + '">' + data.likeUserDetails[0].name + '</a> ' + LikeThis + '</div>';
          shareLikeImg = '<a href="' + baseUrl + data.likeUserDetails[0].username + '" class="pull-right shareUser">' +
            '<img src="' + data.likeUserDetails[0].profile_pic + '" class="media-object smallFace">' +
            '</a>';
          deleteHTML = ''
        }

        /* Comments */
        var commentsHTML = '';
        var viewAll = '';
        var embed = '';
        if (data.commentCount > 2) {
          viewAll = '<div class="view-all-comments view' + data.msg_id + data.created + '" id="view' + data.msg_id + '"><a href="#" id="commentView' + data.msg_id + '" c="' + data.created + '" class="commentView " rel="' + msg_uid + '"><i class="fa fa-comments-o"></i> ' + ViewAll + '</a> <span class="viewCount' + data.msg_id + data.created + '" id="viewCount' + data.msg_id + '">' + data.commentCount + '</span> comments</div>';
        }

        if (data.comments.length) {


          $.each(data.comments, function (i, cdata) {
            var deleteCommentHTML = '';
            var commentUploadHTML = '';
            if (cdata.uid_fk == uid || uid == msg_uid || uid == group_owner_id) {
              deleteCommentHTML = '<a class="commentDelete commonDelete" href="#" id="commentDelete' + cdata.com_id + '" c="' + cdata.created + '" rel="' + msg_id + '" title="Delete Comment"></a>';
            }

            if (cdata.uploads.length > 0) {
              commentUploadHTML = '<img src="' + cdata.uploads + '" class="commentPic"/>';
            }

            k = '<li id="comment' + cdata.com_id + '" class="comment' + cdata.com_id + cdata.created + '"><div class="media comment-body">' +
              '<a href="#" class="pull-left">' +
              '<img src="' + cdata.profile_pic + '" class="media-object smallCommentFace ">' +
              '</a>' +
              '<div class="media-body ">' + deleteCommentHTML +
              '<a href="' + baseUrl + cdata.username + '" class="comment-author">' + cdata.name + '</a> ' +
              '<span class="commentContent">' + cdata.comment + '</span>' +
              '<div class="comment-date timeago" title="' + cdata.timeAgo + '"></div><div class="commentUploadBlock">' + commentUploadHTML + '</div>' +
              '</div>' +
              '</div>' +
              '</li>';
            commentsHTML += k;
          });
        }

        var geoView = 1;
        /* Expanding URL Data*/
        if (data.embed) {
          embed = data.embed;
          geoView = 0;
        }

        /*GEO MAP */
        var geoHTML = '';
        var geoIMG = '';
        if (data.lat && data.lang && geoView > 0) {
          geoIMG = "https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=570x300&scale=2&maptype=roadmap&markers=color:red%7Clabel:S%7C" + data.lat + "," + data.lang;
          geoHTML = "<div class='geoDivBlock'><img src='" + geoIMG + "' style='width:100%'/></div>";
        }

        /* Upload Images */
        var uploadImageHTMLTitle = '<div class="img_container slider-wrapper"><div class="slider" id="slider' + data.msg_id + '">';
        var uploadImageHTMLFooter = '</div><div class="slider-direction-nav" id="slider_direction_' + data.msg_id + '"></div><div class="slider-control-nav" id="slider_control_' + data.msg_id + '"></div></div>';
        var uploadImageHTML = '';
        var C = '';
        if (data.uploadPaths.length) {
          if (data.uploadPaths.length > 1) {
            uploadImageHTML += uploadImageHTMLTitle;
            for (var i = 0; i < data.uploadPaths.length; i++) {
              C = '<div class="slide' + i + '"><a href="' + data.uploadPaths[i] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[i] + '" class="imgpreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a></div>';
              uploadImageHTML += C;
            }
            uploadImageHTML += uploadImageHTMLFooter;
            sliderLoad(data.msg_id);
          } else {
            uploadImageHTML = '<div class="img_container"><a href="' + data.uploadPaths[0] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[0] + '" class="imgpreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a></div>';
          }

        }


        /*Share Button */
        var shareHTML = '';
        if (data.uid_fk != uid) {
          if (parseInt(data.shareCheck)) {
            shareHTML = '<a href="#" class="sharebutton  icontext share' + data.msg_id + data.created + '" c="' + data.created + '" id="share' + data.msg_id + '" title="Unhare" rel="Unshare" data="0"><i class="fa fa-share shareColor"></i>' + Unshare + '</a>';
          } else {
            shareHTML = '<a href="#" class="sharebutton  icontext share' + data.msg_id + data.created + '" c="' + data.created + '" id="share' + data.msg_id + '" title="Share" rel="Share" data="0"><i class="fa fa-share"></i>' + Share + '</a>';
          }
        }

        /* Like Button */
        var likeButton = '';
        if (parseInt(data.likeCheck)) {
          var reactionName = reactions(data.likeCheckReaction);

          var B;


          var x = reactionName.toLowerCase();
          B = '<i class="' + x + 'IconSmall likeTypeSmall reactionLeft"></i>' + reactionName;



          //likeButton='<a href="#" class="like  icontext like'+data.msg_id+data.created+'" id="like'+data.msg_id+'" c="'+data.created+'" title="Unlike" rel="Unlike" data="0"><i class="fa fa-heart likeColor" ></i>'+Unlike+'</a>';  
          likeButton = '<a href="#" class="like  icontext like' + data.msg_id + data.created + '" id="like' + data.msg_id + '" c="' + data.created + '" title="Unlike" rel="Unlike" data="0">' + B + '</a>';
        } else {
          likeButton = '<a href="#" class="reaction like  icontext like' + data.msg_id + data.created + '" id="like' + data.msg_id + '" c="' + data.created + '" title="Like" rel="Like" data="0"><i class="fa fa-heart"></i>' + Like + '</a>';
        }

        /* Like Users */
        var A = '';
        var likeUsersHTML = '';
        var C = '';
        if (parseInt(data.like_count)) {

          $.each(data.likeUsers, function (i, ldata) {
            A = '<a href="' + baseUrl + ldata.username + '" id="likeUserFace' + ldata.uid + data.msg_id + '" original-title="' + ldata.name + '" class="likeUserFace likeUserFace' + ldata.uid + data.msg_id + data.created + '"><img src="' + ldata.profile_pic + '" alt="' + ldata.name + '" class="img-circle marginRight" ></a>';
            likeUsersHTML += A;
          });

          if (parseInt(data.like_count) > 4) {
            C = parseInt(data.like_count) - 4;
            likeUsersHTML = likeUsersHTML + '<a href="#" class="user-count-circle likeCount likesCount' + data.msg_id + data.created + '" c="' + data.created + '" id="likesCount' + data.msg_id + '">' + C + '+</a>';
          }
          likeUsersHTML = '<div class="panel-body likesList likeUsersBlock' + data.msg_id + data.created + '" id="likeUsersBlock' + data.msg_id + '" >' + likeUsersHTML + '</div>';
        }


        feedHtml = '<div class="newsFeed-block timeline-block item newsFeed' + data.msg_id + data.created + '"  rel="' + data.created + '" id="newsFeed' + data.msg_id + '">' +
          '<div class="panel panel-default">' +
          shareLikeHead +
          '<div class="panel-heading">' +
          '<div class="media">' +
          '<a href="' + baseUrl + data.username + '" class="pull-left">' +
          '<img src="' + data.messageDetails[0].profile_pic + '" class="media-object smallFace">' +
          '</a>' +
          shareLikeImg +
          '<div class="media-body">' +
          deleteHTML +
          '<a href="' + baseUrl + data.messageDetails[0].username + '" class="feed-author">' + data.messageDetails[0].name + '</a>' + groupText +
          '<a href="' + baseUrl + 'status/' + data.msg_id + '"class="timeago" title="' + data.timeAgo + '"></a>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '<div class="panel-body">' +
          '<p class="feedContent">' + data.message + '</p>' +
          '</div><div>' + embed + '</div>' + uploadImageHTML + geoHTML +
          '<div id="likeUserDiv' + data.msg_id + '" class="likeUserDiv' + data.msg_id + data.created + '">' +
          likeUsersHTML +
          '</div>' +
          '<div class="st_like_share">' +
          likeButton +
          '<a href="#commentbox' + data.created + '" class="commentopen  icontext" id="commentopen' + data.msg_id + '" rel="' + data.msg_id + '" c="' + data.created + '" title="Comment"><i class="fa fa-comment"></i>' + Comment + ' </a>' +
          shareHTML +
          '</div>' +
          viewAll +
          '<ul class="comments comments' + data.msg_id + data.created + '" id="comments' + data.msg_id + '">' +
          commentsHTML +
          '</ul>' +
          '<ul class="comments displaynone commentBox commentBox' + data.msg_id + data.created + '" id="commentBox' + data.msg_id + '">' +
          '<li class="comment-form " >' +
          '<div class="input-group">' +
          '<input type="text" class="form-control commentText' + data.msg_id + data.created + '" placeholder="' + placeComment + '"id="commentText' + data.msg_id + '"/>' +
          '<span class="input-group-addon">' +
          '<a href="#" id="commentCamara' + data.msg_id + '" class="commentCamera" title="Upload Image"><i class="fa fa-camera commentCamIcon"></i></a>' +
          '</span>' +
          '</div>' +
          '<div id="commentUpload' + data.msg_id + '" class="commentUpload"></div><div id="profilePicImageComment' + data.msg_id + '"></div><div class="margintop10" >' +
          '<a href="#" class="wallbutton commentButton" id="commentButton' + data.msg_id + '" c="' + data.created + '">' + Comment + '</a></div>' +
          '</li>' +
          '</ul>' +
          '</div>' +
          '</div>';

        $.lastID = data.created;
        $.feedCount = data.feedCount;

        if (i % 4 == 0 && i > 0) {
          var A = i / 4;
          adHtml = '<div class="item timeline-block suggest-block displaynone" id="suggest' + A + '"></div>';
          if (parseInt($(window).width()) < 401) {
            $("#newsFeed").append(adHtml);
          } else {
            $("#newsFeed").gridalicious('append', loadGrid(adHtml));
          }


        }


        if (parseInt($(window).width()) < 401) {
          $("#newsFeed").append(feedHtml);
        } else {
          $("#newsFeed").gridalicious('append', loadGrid(feedHtml));
        }


        if (ads === 1 && lastid.length === 0) {

          advertisements(uid, token, apiBaseUrl);
        }
        ads = ads + 1;

      });


      var NoUpdates = "No updates";
      var NoMoreUpdates = "No more updates";
      if ($.labelData) {
        NoUpdates = $.labelData.msgNoUpdates;
        NoMoreUpdates = $.labelData.msgNoMoreUpdates;
      }


      if (parseInt($.feedCount) < parseInt(perpage)) {
        $("#newsFeed").removeClass("scrollMore").attr("rel", "0");
        $("#noRecords").html("<div class='noDataMessage msgNoMoreUpdates'>" + NoMoreUpdates + "</div>");
      }


    } else {

      var NoUpdates = "No updates";
      var NoMoreUpdates = "No more updates";
      if ($.labelData) {
        NoUpdates = $.labelData.msgNoUpdates;
        NoMoreUpdates = $.labelData.msgNoMoreUpdates;
      }


      $("#noRecords").html("<div class='noDataMessage msgNoUpdates'>" + NoUpdates + "</div>");


      if (lastid.length > 0) {
        $("#newsFeed").removeClass("scrollMore").attr("rel", "0");
        $("#noRecords").html("<div class='noDataMessage msgNoMoreUpdates'>" + NoMoreUpdates + "</div>");
      } else {
        $("#welcomeGrid").show();

        welcomeFriends(uid, token, apiBaseUrl, $.baseUrl);
      }

      if (parseInt(page) > 1)
        $("#noRecords").html("<div class='noDataMessage msgNoMoreUpdates'>" + NoMoreUpdates + "</div>");
      else
        $("#noRecords").html("<div class='noDataMessage msgNoUpdates'>" + NoUpdates + "</div>");


    }



    /* Userprofile Scroll Top */
    if (public_username) {
      $(document).scrollTop(250);
    }

  });
}

/*########## Comments  ##########*/

/* Comments View  */
function commentsView(uid, msg_id, token, msgUID, apiBaseUrl, baseUrl, created) {
  noToken(token, baseUrl);
  var i = '';
  var j = '';
  var encodedata = JSON.stringify({
    "uid": uid,
    "msg_id": msg_id,
    "token": token
  });
  var url = apiBaseUrl + 'api/comments';
  ajaxPost(url, encodedata, function (data) {
    if (data.comments.length) {

      $("#comments" + msg_id).html("");
      $.each(data.comments, function (i, data) {
        var deleteCommentHTML = '';
        var commentUploadHTML = '';

        if (data.uid_fk == uid || uid == msgUID) {
          deleteCommentHTML = '<a class="commentDelete commonDelete" href="#" id="commentDelete' + data.com_id + '" c="' + data.created + '" rel="' + msg_id + '" title="Delete Comment"></a>';
        }

        if (data.uploads.length > 0) {
          commentUploadHTML = '<img src="' + data.uploads + '" class="commentPic"/>';
        }

        i = '<li id="comment' + data.com_id + '" class="comment' + data.com_id + data.created + '"><div class="media comment-body">' +
          '<a href="' + baseUrl + data.username + '" class="pull-left">' +
          '<img src="' + data.profile_pic + '" class="media-object smallCommentFace ">' +
          '</a>' +
          '<div class="media-body ">' + deleteCommentHTML +
          '<a href="' + baseUrl + data.username + '" class="comment-author">' + data.name + '</a> ' +
          '<span class="commentContent">' + data.comment + '</span>' +
          '<div class="comment-date timeago" title="' + data.timeAgo + '"></div><div class="commentUploadBlock">' + commentUploadHTML + '</div>' +
          '</div>' +
          '</div>' +
          '</li>';
        j += i;
      });

      //$("#comments"+msg_id).html(j);
      //$("#view"+msg_id).slideUp('fast');
      $(".comments" + msg_id + created).html(j);
      $(".view" + msg_id + created).slideUp('fast');
    }
  });
}

/* Comment Update */
function commentUpdate(uid, token, apiBaseUrl, baseUrl, comment, msg_id, name, pic, upload, created) {
  noToken(token, baseUrl);
  var encodedata = JSON.stringify({
    "uid": uid,
    "msg_id": msg_id,
    "comment": comment,
    "token": token,
    "upload": upload
  });
  var url = apiBaseUrl + 'api/commentUpdate';
  ajaxPost(url, encodedata, function (data) {
    if (data.commentUpdate.length) {
      $("#commentUploadForm" + msg_id).html("");
      $("#profilePicImageComment" + msg_id).html("");

      $.each(data.commentUpdate, function (i, data) {
        var deleteCommentHTML = '<a class="commentDelete commonDelete" href="#" id="commentDelete' + data.com_id + '" c="' + data.created + '" rel="' + msg_id + '" title="Delete Comment"></a>';
        var commentUploadHTML = '';
        if (data.uploads.length > 0) {
          commentUploadHTML = '<img src="' + data.uploads + '" class="commentPic"/>';
        }

        var k = '<li id="comment' + data.com_id + '"><div class="media comment-body">' +
          '<a href="' + baseUrl + data.username + '" class="pull-left">' +
          '<img src="' + data.profile_pic + '" class="media-object smallCommentFace ">' +
          '</a>' +
          '<div class="media-body ">' + deleteCommentHTML +
          '<a href="' + baseUrl + data.username + '" class="comment-author">' + name + '</a> ' +
          '<span class="commentContent">' + data.comment + '</span>' +
          '<div class="comment-date timeago" title="' + data.timeAgo + '"></div><div class="commentUploadBlock">' + commentUploadHTML + '</div>' +

          '</div>' +
          '</div>' +
          '</li>';

        //$("#comments"+data.msg_id_fk).append(k);
        //$("#commentText"+data.msg_id_fk).val('').focus();
        $(".comments" + data.msg_id_fk + created).append(k);
        $(".commentText" + data.msg_id_fk + created).val('').focus();
        var v = $("#viewCount" + msg_id).html();
        if (v.length) {
          var q = parseInt(v) + 1;
          $("#viewCount" + msg_id).html(q);
        }
      });
    }
  });
}

/* Comment Delete API */
function commentDelete(uid, token, apiBaseUrl, baseUrl, com_id, msg_id, created) {
  noToken(token, baseUrl);
  var encodedata = JSON.stringify({
    "uid": uid,
    "com_id": com_id,
    "token": token
  });
  var url = apiBaseUrl + 'api/commentDelete';
  ajaxPost(url, encodedata, function (data) {
    if (data.deleteComment.length) {
      //$("#comment"+com_id).slideUp("fast");

      $(".comment" + com_id + created).slideUp("fast");
      var v = $("#viewCount" + msg_id).html();
      if (v.length) {
        var q = parseInt(v) - 1;
        $("#viewCount" + msg_id).html(q);
      }
    }
  });
}

/*########## Conversations  ##########*/

/* conversation New Count  */
function conversationsNewCount(uid, token, apiBaseUrl) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token
  });
  var url = apiBaseUrl + 'api/conversationsNewCount';
  ajaxPost(url, encodedata, function (data) {

    if (parseInt(data.conversationsNewCount[0].count) > 0) {
      $(".messageCount").html(data.conversationsNewCount[0].count).fadeIn("slow");
      $("#messagesIcon").addClass("effectTada");
    }
  });
}

/* conversations */
function conversations(uid, token, apiBaseUrl, baseUrl, last_time, conversation_uid) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "last_time": last_time,
    "conversation_uid": conversation_uid
  });
  var url = apiBaseUrl + 'api/conversations';
  ajaxPost(url, encodedata, function (data) {

    if (data.conversations.length) {
      var i = '';
      var j = '';
      $.each(data.conversations, function (i, data) {

        var active = '';
        if (data.lastReply.read_status > 0) {
          active = 'listActive';
        }

        var replyIcon = '';
        if (data.lastReply.user_id_fk == uid) {
          replyIcon = '<i class="fa fa-reply"></i>';
          active = "";
        }




        i = '<li class="list-group-item cListGroup ' + active + '" id="conversationGrid' + data.c_id + '" time="' + data.time + '">' +
          '<a href="' + baseUrl + 'messages/' + data.username + '">' +
          '<div class="media">' +
          '<div class="media-object pull-left">' +
          '<img src="' + data.profile_pic + '" class="conversationListFace" alt="' + data.name + '">' +
          '</div>' +
          '<div class="media-body conversation-body">' +
          '<span class=" commonDelete conversationDelete" original-title="Delete Conversation" id="conversation' + data.c_id + '"></span>' +
          '<b class="feed-author">' + data.name + '</b>' +
          '<div class="message feedContent">' + replyIcon + data.lastReply.reply + '<div class="timeago" title="' + data.timeAgo + '"></div></div>' +
          '</div>' +
          '</div>' +
          '</a>' +
          '</li>';
        //j += i;
        $('#conversationsList').append(i);

      });
      $("#cList").attr("rel", "1")
      //$('#conversationsList').html(j);

      /*Mobile width settings */
      if (parseInt($(window).width()) < 401) {
        $('#cList').removeClass("height500");
        $('#cList').addClass("marginZero");
        $('.messages-list .panel ul').width(parseInt(data.conversations.length) * 50);
        $('#ascrail2003').hide();

      } else {
        $('#cList').removeClass("marginZero");
      }

      $("#cListScroll").niceScroll({
        cursorborder: 0,
        cursorcolor: "#1bbc9b"
      });

    } else {
      var noCon = "No conversations";
      if ($.labelData)
        noCon = $.labelData.msgNoConversations;



      if (parseInt($(window).width()) > 800) {
        $('#conversationsList').append('<li class="noConersations">' + noCon + '</li>');
      }

    }
  });
}

/* Conversation Replies */
function conversationReplies(uid, token, apiBaseUrl, baseUrl, message_user, last, rel) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "message_user": message_user,
    "last": last
  });
  var url = apiBaseUrl + 'api/conversationReplies';
  ajaxPost(url, encodedata, function (data) {

    if (data.conversationReplies.length) {
      $('#conversationHead').html($.otherName);
      var i = '';
      var j = '';
      $.each(data.conversationReplies, function (i, data) {

        if (parseInt(data.c_id_fk)) {
          $.conversationID = data.c_id_fk;
          $.otherName = data.otherName;
        } else {
          window.location = baseUrl + "404.php";
        }

        var geoHTML = "";
        if (data.lat && data.lang) {
          var geoIMG = "https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=570x300&scale=2&maptype=roadmap&markers=color:red%7Clabel:S%7C" + data.lat + "," + data.lang;
          geoHTML = '<img src="' + geoIMG + '" width="100%"/>';
        }

        /*upload */
        var uploadImageHTML = '';
        var C = '';
        if (data.uploadPaths) {
          if (data.uploadPaths.length > 1) {
            for (var i = 0; i < data.uploadPaths.length; i++) {
              C = '<a href="' + data.uploadPaths[i] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[i] + '" class="conversationPreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a>';
              uploadImageHTML += C;
            }
          } else {
            uploadImageHTML = '<a href="' + data.uploadPaths[0] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[0] + '" class="conversationPreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a>';
          }
        }

        if (data.username) {
          i = '<div class="media conversationReply" id="last' + data.cr_id + '"><div class="timeline-block conversationReplyBlock" >' +
            '<div class="panel-heading borderRound">' +
            '<div class="media nBlock">' +
            '<span class="pull-left">' +
            '<img src="' + data.profile_pic + '" class="media-object conversationFace" alt="' + data.name + '"></span>' +
            '<div class="media-body-popup">' +
            '<a href="' + baseUrl + data.username + '" class="bold">' + data.name + '</a>' +
            '<span class="pull-right">' +
            '<small class="text-muted timeago" title="' + data.timeAgo + '"></small>' +
            '</span>' +
            '<div class="feedContent"> ' + data.reply + '</div>' +
            '<div class="photosBlock">' + uploadImageHTML + '</div><div class="geoDivBlock">' + geoHTML + '</div>' +
            '</div></div></div></div></div>';
          j += i;
        }
      });

      $('#conversationHead').html("<a href='" + baseUrl + message_user + "'>" + $.otherName + "</a>");


      /* Activate Converstion */
      if (parseInt($.conversationID) > 0) {
        $(".list-group").removeClass("cActive");
        $("#conversationGrid" + $.conversationID).addClass("cActive");
      }



      if (j.length > 0) {
        $('#conversationReplies').prepend(j);
        $('#conversationReplies').attr("rel", '1')
      } else {

        if (parseInt(rel) < 1) {

          var start = "Start conversation with ";
          if ($.labelData) {
            start = $.labelData.msgStartConversation;
          }

          $('#conversationHead').html(start + " " + $.otherName);
        }
      }

    } else
      $('#conversationHead').html("No conversation replies");
  });
}

/* conversationReplyInsert Reply */
function conversationReplyInsert(uid, token, apiBaseUrl, baseUrl, c_id, reply, lat, lang, uploads) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "c_id": c_id,
    "reply": reply,
    "lat": lat,
    "lang": lang,
    "uploads": uploads
  });
  var url = apiBaseUrl + 'api/conversationReplyInsert';
  ajaxPost(url, encodedata, function (data) {
    if (data.conversationReply.length) {
      var i = '';
      var j = '';
      $.each(data.conversationReply, function (i, data) {
        var geoHTML = "";
        if (data.lat && data.lang) {
          var geoIMG = "https://maps.googleapis.com/maps/api/staticmap?zoom=13&size=570x300&scale=2&maptype=roadmap&markers=color:red%7Clabel:S%7C" + data.lat + "," + data.lang;
          geoHTML = '<img src="' + geoIMG + '" width="100%"/>';
        }

        /*upload */
        var uploadImageHTML = '';
        var C = '';
        if (data.uploadPaths.length) {
          if (data.uploadPaths.length > 1) {

            for (var i = 0; i < data.uploadPaths.length; i++) {
              C = '<a href="' + data.uploadPaths[i] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[i] + '" class="conversationPreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a>';
              uploadImageHTML += C;
            }

          } else {
            uploadImageHTML = '<a href="' + data.uploadPaths[0] + '" data-lightbox="lightbox' + data.msg_id + '"><img src="' + data.uploadPaths[0] + '" class="conversationPreview" id="' + data.msg_id + '" rel="' + data.msg_id + '"/></a>';
          }
        }

        i = '<div class="media"><div class="timeline-block conversationReplyBlock" >' +
          '<div class="panel-heading borderRound">' +
          '<div class="media nBlock">' +
          '<span class="pull-left">' +
          '<img src="' + data.profile_pic + '" class="media-object conversationFace" alt="' + data.name + '"></span>' +
          '<div class="media-body-popup">' +
          '<a href="' + baseUrl + data.username + '" class="bold">' + data.name + '</a>' +
          '<span class="pull-right">' +
          '<small class="text-muted timeago" title="' + data.timeAgo + '"></small>' +
          '</span>' +
          '<div class="class="feedContent""> ' + data.reply + '</div>' +
          '<div class="photosBlock">' + uploadImageHTML + '</div><div class="geoDivBlock">' + geoHTML + '</div>' +
          '</div></div></div></div></div>';
        j += i;

      });
      $('#conversationReplies').append(j);
    }

  });


  $("#conversationReplies").animate({
    "scrollTop": $('#conversationReplies')[0].scrollHeight
  }, "slow");
  $('#conversationReply').val('');
  $('#conversationReply').focus();
}



/* Conversation Delete */
function conversationDelete(uid, token, apiBaseUrl, baseUrl, cid) {
  var encodedata = JSON.stringify({
    "uid": uid,
    "token": token,
    "cid": cid
  });
  var url = apiBaseUrl + 'api/conversationDelete';
  ajaxPost(url, encodedata, function (data) {
    window.location = baseUrl + "messages.php";
  });
}