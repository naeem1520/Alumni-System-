<script src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
<?php
/* Background Drag */
if($_GET['groupID'] || $public_username) { ?>
  <script src="<?php echo BASE_URL;?>js/jquery-ui.min.js"></script>
  <?php
}
if($_SESSION["tour"] < 1) {
    ?>
    <script src="<?php echo BASE_URL;?>js/intro.js"></script>
    <?php } ?>
      <script src="<?php echo BASE_URL;?>js/ajaxPost.js"></script>
      <script src="<?php echo BASE_URL;?>js/wallscriptPlugins.js"></script>
      <script src="<?php echo BASE_URL;?>js/wallscript.js"></script>
      <script>
        $(document).ready(function() {
          var uid, username, token, messageID, editGroupID, networkError, fullName, profilePic, page, sessionUid,
            offset, groupID, public_uid, public_username, type, counter, listType, pic, publicAccess, apiBaseUrl, baseUrl,
            lastid, newsfeedPerPage, friendsPerPage, photosPerPage, groupsPerPage, notificationPerPage, widgetPerPage, moreCheck, feedType, photos_of;

          baseUrl = '<?php echo BASE_URL; ?>';
          apiBaseUrl = '<?php echo API_BASE_URL; ?>';

          messageID = '<?php echo $msgID; ?>';
          $.conversation_count;
          feedType = '1';
          type = '1';
          counter = '8';
          uid = $('#uid').val();
          username = $('#username').val();
          name = $('#name').val();
          public_username = $('#public_username').val();
          groupID = '<?php echo $_GET["groupID"]; ?>';
          page = '1';
          offset = '0';
          lastid = '';
          sessionUid = '<?php echo $_SESSION["uid"] ?>';
          newsfeedPerPage = '<?php echo $_SESSION["newsfeedPerPage"] ?>';
          friendsPerPage = '<?php echo $_SESSION["friendsPerPage"] ?>';
          photosPerPage = '<?php echo $_SESSION["photosPerPage"] ?>';
          groupsPerPage = '<?php echo $_SESSION["groupsPerPage"] ?>';
          notificationPerPage = '<?php echo $_SESSION["notificationPerPage"] ?>';
          widgetPerPage = '<?php echo $_SESSION["friendsWidgetPerPage"] ?>';
          editGroupID = '<?php echo $_GET["editGroupID"] ?>';
          token = $('#token').val();
          pic = $('#pic').val();
          publicAccess = '<?php echo $publicAccess ?>';

          $.token = token;
          $.uid = uid;
          $.apiBaseUrl = apiBaseUrl;
          $.baseUrl = baseUrl;
          $.labelData;




          /* update box focus */
          $("#statusText").val("").focus();

          /*########## Plugins ##########*/
          /*Scroll */
          $('[data-scrollable]').niceScroll({
            cursorborder: 0,
            cursorcolor: "#1bbc9b"
          });

          /* Language Label Data */
          publicLabelData(apiBaseUrl);
          /*Time Ago */
          $(".timeago").livequery(function() {
            $(this).timeago();
          });
          /*Dropdown */
          $('.dropdown-toggle').dropdown();
          /* collapse */
          $('#main-nav').on('show.bs.collapse', function(e) {
            e.stopPropagation();
            var parents = $(this).parents('ul:first').find('> li.open [data-toggle="collapse"]');
            if (parents.length) {
              parents.trigger('click');
            }
            $(this).parent().addClass("open");
          });
          $('#main-nav').on('hidden.bs.collapse', function(e) {
            e.stopPropagation();
            $(this).parent().removeClass("open");
          });
          /*Text to URL*/
          $(".feedContent, .commentContent, .notificationContent").livequery(function() {
            $(this).linkify({
              target: '_blank'
            });
          });
          /*URL Tooltips */
          $(".commonDelete").tipsy({
            gravity: 'e',
            live: true
          });
          $(".likeUserFace,  .imageDelete, .social,  .updateControl, .likeTypeAction").tipsy({
            gravity: 's',
            live: true
          });


          $(".reaction").livequery(function() {
            var reactionsCode = '<span class="likeTypeAction" original-title="Like" data-reaction="1"><i class="likeIcon likeType"></i></span>' +
              '<span class="likeTypeAction" original-title="Love" data-reaction="2"><i class="loveIcon likeType"></i></span>' +
              '<span class="likeTypeAction" original-title="Haha" data-reaction="3"><i class="hahaIcon likeType"></i></span>' +
              '<span class="likeTypeAction" original-title="Wow" data-reaction="4"><i class="wowIcon likeType"></i></span>' +
              '<span class="likeTypeAction" original-title="Cool" data-reaction="5"><i class="coolIcon likeType"></i></span>' +
              '<span class="likeTypeAction" original-title="Confused" data-reaction="6"><i class="confusedIcon likeType"></i></span>' +
              '<span class="likeTypeAction" original-title="Sad" data-reaction="7"><i class="sadIcon likeType"></i></span>' +
              '<span class="likeTypeAction last" original-title="Angry" data-reaction="8"><i class="angryIcon likeType"></i></span>';

            $(this).tooltipster({
              contentAsHTML: true,
              interactive: true,
              content: $(reactionsCode),
            });

          });




          /*########## Plugins END ##########*/

          /*########## Basic Configurations ##########*/
          /* Grids */
          timelineGrid();
          $("#sessionName").html(name);
          if (parseInt(publicAccess) < 1) {
            //userDetails(uid,token,apiBaseUrl,baseUrl,public_username,messageID,groupID);
            conversationsNewCount(sessionUid, token, apiBaseUrl);
          }
          /* User Details + Configurations */
          userDetails(uid, token, apiBaseUrl, baseUrl, public_username, messageID, groupID);
          notificationsNewCount(sessionUid, token, apiBaseUrl);
          /*########## Basic Configurations END ##########*/

          /*########## Common Events ##########*/
          /* Search Box */
          $('body').on("keyup", '.search', function() {
            var searchword = $(this).val();
            if ($.trim(searchword).length > 0) {
              userGroupSearch(uid, token, apiBaseUrl, baseUrl, searchword);
            }
          });

          $('body').on("click", "#mobileNavbar", function() {

            $(this).hide();
            $("#profileNavbar").show();
            $("#upArrow").show();
            return false;
          });

          $('body').on("click", "#upArrow", function() {

            $(this).hide();
            $("#profileNavbar").hide();
            $("#mobileNavbar").show();
            return false;
          })

          /* Mobile Search Box Enable */
          $('body').on("click", '#searchIcon', function() {
            $(this).hide();
            $(".navbar-brand").hide();
            $("#searchBarMain").show();
            $("#searchDesk").focus();
            return false;
          });

          /* Upload Grid Blocks Controls for webcam, geo, photo & voice */
          $("body").on("click", '.updateControl', function() {
            $("#latitude").val('');
            $("#longitude").val('');
            var ID = $(this).attr("id");
            $(".blockControl").hide();
            if (ID == 'photo') {
              $("#photoContainer").slideDown("fast");
            } else if (ID == 'webcamButton') {
              $("#webcam").html("");
              $("#webcamContainer").slideDown("fast");
              $("#webcam").webcam({
                width: 320,
                height: 240,
                mode: "callback",
                swffile: baseUrl + "js/jscam_canvas_only.swf",
                onSave: saveCB,
                onCapture: function() {
                  webcam.save();
                },
                debug: function(type, string) {
                  $("#webcam_status").html(type + ": " + string);
                }
              });
            } else if (ID == 'geo') {
              getLocation(baseUrl);
              $("#geoContainer").slideDown("fast");
            } else {
              $("#micContainer").slideDown("fast");
            }
            return false;
          });

          /* Notifications Click */
          $('body').on("click", '#notificationsLink', function() {
            /* new notification timestamp created */
            notificationCreatedUpdate(uid, token, apiBaseUrl);
            notification_created = 0;
            notifications_perpage = '7';
            type = '1';
            if ($.trim($("#notificationsContent").html()).length < 1) {
              notifications(uid, token, apiBaseUrl, baseUrl, notification_created, notifications_perpage, type);
              $(".notificationCount").fadeOut("slow");
            }
            $("#notificationContainer").show();
            return false;
          });

          /* Panel click prevent */
          $("#searchDisplay, #notificationContainer, #profileSidebar").mouseup(function() {
            return false
          });

          /* Document Click */
          $(document).mouseup(function() {
            $('#searchDisplay, #notificationContainer').hide();
            $('.search').val("");
            $("#profileSidebar").removeClass("showSidebar");
          });
          /* Add Follow */
          $('body').on("click", '.addButton', function() {
            var x = $(this).attr("id");
            var sid = x.split("add");
            var fid = sid[1];
            addFriend(uid, fid, token, apiBaseUrl);
            return false;
          });

          /* Remove Follow */
          $('body').on("click", '.removeButton', function() {
            var x = $(this).attr("id");
            var sid = x.split("remove");
            var fid = sid[1];
            removeFriend(uid, fid, token, apiBaseUrl);
            return false;
          });

          /* Comment Camera */
          $('body').on("click", '.commentCamera', function() {
            noToken(token, baseUrl);
            var A = $(this).attr("id");
            var sid = A.split("commentCamara");
            var msgID = sid[1];
            var html = '<form id="commentUploadForm' + msgID + '" method="post" enctype="multipart/form-data" action="' + apiBaseUrl + 'api/commentUpload">' +
              '<input type="file" name="photoimg" class="commentPhotoImg" id="c' + msgID + '" >' +
              '<input type="hidden" name="messageID" value=""><input type="hidden" name="uid" value="<?php echo $sessionUid ?>"><input type="hidden" name="user_token" value="<?php echo $sessionToken ?>"></form>';
            $("#commentUpload" + msgID).fadeIn("show").html(html);

            return false;
          });

          /* Ajax NewsFeed Uploading Image */
          $('body').on('change', '#photoimg', function() {
            $("#imageform").ajaxForm({
              target: '#preview',
              beforeSubmit: function() {
                $("#imageloadstatus").show();
                $("#imageloadbutton").hide();
              },
              success: function() {
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();
              },
              error: function() {
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();
              }
            }).submit();
          });

          /* Ajax Comment Image */
          $('body').on('change', '.commentPhotoImg', function() {
            var x = $(this).attr("id");
            var sid = x.split("c");
            var id = sid[1];
            $("#commentUploadForm" + id).ajaxForm({
              target: '#profilePicImageComment' + id,
              beforeSubmit: function() {},
              success: function() {
                $("#commentUploadForm" + id).hide();
              },
              error: function() {}
            }).submit();
          });

          /* Ajax Profile Image */
          $('body').on('change', '#profilephotoimg', function() {
            $("#profileimageform").ajaxForm({
              target: '#profilePicImage',
              beforeSubmit: function() {},
              success: function() {
                $("#profileimageform").hide();
              },
              error: function() {}
            }).submit();
          });

          /* Background Image */
          $('body').on('change', '#bgphotoimg', function() {
            $("#bgimageform").ajaxForm({
              target: '#coverBox',
              beforeSubmit: function() {},
              success: function() {
                $("#bgimageform").hide();
              },
              error: function() {}
            }).submit();
          });

          /* Banner position */
          $("body").on('mouseover', '.headerimage', function() {
            var y1 = $('#coverBox').height();
            var y2 = $('.headerimage').height();
            $(this).draggable({
              scroll: false,
              axis: "y",
              drag: function(event, ui) {
                if (ui.position.top >= 0) {
                  ui.position.top = 0;
                } else if (ui.position.top <= y1 - y2) {
                  ui.position.top = y1 - y2;
                }
              },
              stop: function(event, ui) {}
            });
          });

          /* Bannert Position Save*/
          $("body").on('click', '.bgSave', function() {
            var X = '0';
            var type = $(this).attr("id");
            var p = $("#profileBG").attr("style");
            if (p) {
              var position = p.split("top:");
              X = position[1];
            }
            var group_id = $("#groupID").val();
            saveBGPosition(uid, token, apiBaseUrl, baseUrl, X, type, group_id);
            return false;
          });

          /* Remove Group */
          $("body").on('click', '.removeGroup', function() {
            var vid = $(this).attr("id");
            var sid = vid.split("removeGroup");
            var group_id = sid[1];
            groupRemove(uid, token, apiBaseUrl, baseUrl, group_id);
            return false;
          });

          /* Add Group */
          $("body").on('click', '.addGroup', function() {
            var vid = $(this).attr("id");
            var sid = vid.split("addGroup");
            var group_id = sid[1];
            groupAdd(uid, token, apiBaseUrl, baseUrl, group_id);
            return false;
          });

          /* Toggle Menu */
          $("body").on('click', '#toggle-sidebar-menu', function() {
            var R = $(this).attr('rel');
            if (parseInt(R)) {
              $("#profileSidebar").addClass("showSidebar").removeClass("showSidebar");
              $(this).attr("rel", "0");
            } else {
              $("#profileSidebar").removeClass("showSidebar").addClass("showSidebar");
              $(this).attr("rel", "1");
              $("#sidebarFocus").focus();
              $('#toggleSideBar').niceScroll({
                cursorborder: 0,
                cursorcolor: "#1bbc9b"
              });
            }
            return false;
          });

          /* Photo Delete */
          $('body').on("click", '.imageDelete', function() {
            var x = $(this).attr("id");
            var sid = x.split("photo");
            var pid = sid[1];
            var group_id = $(this).attr("rel");
            var photo_uid = $(this).attr("prel");
            $.confirm({
              title: '',
              content: 'Sure you want to delete this photo? There is NO undo!',
              confirm: function() {
                deletePhoto(uid, pid, token, group_id, photo_uid, apiBaseUrl);
              },
              cancel: function() {}
            });
            return false;
          });

          /* Set timeout for Alerts  */
          $(".wallbutton").click(function() {
            alertHide();
          });

          /*Settings Social */
          $(".social").keyup(function() {
            var x = $(this).attr("id");
            var y = $(this).val();
            $("#" + x + "Label").html(y);
          });




          /* TakeSnap */
          $("body").on('click', '#takeSnap', function() {
            if (webcam.capture()) {} else {
              $("#webcam_status").html("Please refresh your browser.");
            }
            return false;
          });

          /* Sidebar List */
          if (typeof groupID == 'undefined' || groupID.length < 1) {
            /* Profile viewed List*/
            profileViewedList(uid, token, apiBaseUrl, baseUrl, page, widgetPerPage, type, public_username);
            /* User Friend List*/
            friendsList(uid, token, apiBaseUrl, baseUrl, page, widgetPerPage, type, public_username);
            /* User Groups List*/
            groupsList(uid, token, apiBaseUrl, baseUrl, page, widgetPerPage, type, public_username);
          }

          /* Webcam function*/
          var pos = 0,
            ctx = null,
            saveCB, image = [];
          var canvas = document.createElement("canvas");
          canvas.setAttribute('width', 320);
          canvas.setAttribute('height', 240);
          if (canvas.toDataURL) {
            ctx = canvas.getContext("2d");
            image = ctx.getImageData(0, 0, 320, 240);
            saveCB = function(data) {
              var col = data.split(";");
              var img = image;
              for (var i = 0; i < 320; i++) {
                var tmp = parseInt(col[i]);
                img.data[pos + 0] = (tmp >> 16) & 0xff;
                img.data[pos + 1] = (tmp >> 8) & 0xff;
                img.data[pos + 2] = tmp & 0xff;
                img.data[pos + 3] = 0xff;
                pos += 4;
              }

              if (pos >= 4 * 320 * 240) {
                ctx.putImageData(img, 0, 0);
                var xtype = "data";
                var ximage = canvas.toDataURL("image/png");
                var webcamURL = apiBaseUrl + 'api/webcamImageCreate';
                $.post(webcamURL, {
                    uid: uid,
                    token: token,
                    group_id: groupID,
                    type: "data",
                    image: canvas.toDataURL("image/png")
                  },
                  function(data) {
                    if (data) {
                      var values = $("#uploadvalues").val();
                      $("#webcam_preview").prepend(data);
                      var X = $('.webcam_preview').attr('id');
                      if ($.trim(values).length > 0) {
                        var Z = X + ',' + values;
                      } else {
                        var Z = X;
                      }

                      if (Z != 'undefined,') {
                        $("#uploadvalues").val(Z);
                      }
                    } else {
                      $("#webcam").html('<div id="camera_error"><b>Camera Not Found</b><br/>Please turn your camera on or make sure that it <br/>is not in use by another application</div>');
                      $("#webcam_status").html("<span style='color:#e82110'>Camera not found please reload this page.</span>");
                      $("#webcam_takesnap").hide();
                      return false;
                    }
                  });
                pos = 0;
              }

            };
          }
          /*########## Common Events END ##########*/

          /*########## Home, Profile & Group Feed Page ##########*/

          <?php
        if($usernameValue<1)
        {
            ?>
          var sessionUsername = '<?php echo $sessionUsername; ?>';
          /* Username redirect social login */
          usernameRedirect(sessionUsername, baseUrl);
          <?php
        }
        
        if($home || $status)
        {
            
            /*########## Profile Page ##########*/
            if($public_username)
            {
                ?>
          /* Profile View Created */
          if (public_username != username) {
            profileViewed(uid, token, apiBaseUrl, baseUrl, public_username);
          }
          feedType = 0;
          /* News Feed */
          var lastid = "";
          newsFeed(uid, token, apiBaseUrl, baseUrl, lastid, newsfeedPerPage, feedType, public_username, groupID, messageID);
          /* Profile Feed Scroll Down */
          if (parseInt(publicAccess) < 1) {
            $(window).scroll(function() {
              var a = 0;
              if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                var REL = $("#newsFeed").attr("rel");
                if (parseInt(REL)) {
                  if (a == '0') {
                    /* News Feed */
                    newsFeed(uid, token, apiBaseUrl, baseUrl, $.lastID, newsfeedPerPage, feedType, public_username, groupID, messageID);
                    a = 1;
                  }
                }
              }
            });
          }
          <?php
            }
            /*########## Group Page ##########*/
            else if($_GET['groupID'])
            {
                ?>


          /* Empty user profile background */
          $("#coverBox").empty();
          /* Group Details */
          groupDetails(uid, groupID, token, apiBaseUrl, baseUrl);
          /* Group Followers */
          groupFollowers(uid, groupID, token, token, page, friendsPerPage, type, apiBaseUrl, baseUrl);
          /* Group News Feed */
          <?php if(empty($_GET['track'])) { ?>
          newsFeed(uid, token, apiBaseUrl, baseUrl, $.lastID, newsfeedPerPage, feedType, public_username, groupID, messageID);
          <?php } ?>
          /* Group Feed Scroll Down */
          $(window).scroll(function() {
            var a = 0;
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
              var REL = $("#newsFeed").attr("rel");
              if (parseInt(REL)) {
                if (a == '0') {
                  newsFeed(uid, token, apiBaseUrl, baseUrl, $.lastID, newsfeedPerPage, feedType, public_username, groupID, messageID);
                  a = 1;
                }
              }
            }
          });

          <?php if($_GET['track']=='members') { ?>
          type = 0;
          /* Group Followers */
          groupFollowers(uid, groupID, token, token, page, friendsPerPage, type, apiBaseUrl, baseUrl);

          /* Group Members*/
          $(window).scroll(function() {
            var a = 0;
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
              var REL = $("#membersPhotosList").attr("rel");
              if (parseInt(REL)) {
                if (a == '0') {
                  var newPage = $(".memberBlock:last").attr("rel");
                  groupFollowers(uid, groupID, token, token, newPage, friendsPerPage, type, apiBaseUrl, baseUrl);
                  a = 1;
                }
              }
            }
          });

          <?php } else if($_GET['track']=='photos'){ ?>
          /* Group Photos */
          groupPhotosList(uid, token, apiBaseUrl, baseUrl, page, offset, photosPerPage, groupID);
          /* Group Photos */
          $(window).scroll(function() {
            var a = 0;
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
              var REL = $("#membersPhotosList").attr("rel");
              if (parseInt(REL)) {
                if (a == '0') {
                  var newPage = $(".photo-block:last").attr("rel");
                  groupPhotosList(uid, token, apiBaseUrl, baseUrl, newPage, offset, photosPerPage, groupID);
                  a = 1;
                }
              }
            }
          });

          <?php }
            }
            /*########## Home News Feed Page ##########*/
            else
            {
                ?>
          /* Friends News Feed */
          var lastid = "";
          var feed = newsFeed(uid, token, apiBaseUrl, baseUrl, lastid, newsfeedPerPage, feedType, public_username, groupID, messageID);
          $.when(feed).then(function(x) {


          });

          /* Scroll Downl */
          $(window).scroll(function() {
            var a = 0;
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
              var REL = $("#newsFeed").attr("rel");
              if (parseInt(REL)) {
                if (a == '0') {
                  newsFeed(uid, token, apiBaseUrl, baseUrl, $.lastID, newsfeedPerPage, feedType, public_username, groupID, messageID);
                  a = 1;
                }
              }
            }
          });
          <?php } ?>

          /* Upload Button */
          $("body").on('click', '#updateButton', function() {
            var update = $("#statusText").val();
            var lat = $("#latitude").val();
            var lang = $("#longitude").val();
            var up = $("#uploadvalues").val();
            if (up) {
              var uploadvalues = $("#uploadvalues").val();
            } else {
              var uploadvalues = $(".preview:last").attr('id');
            }

            var X = $('.preview').attr('id');
            var Y = $('.webcam_preview').attr('id');

            if (X) {
              var Z = X + ',' + uploadvalues;
            } else if (Y) {
              var Z = uploadvalues;
            } else {
              var Z = 0;
            }
//$.trim(update).length > 0
            if (true) {
              /* Update News Feed */
              updateNewsFeed(uid, update, Z, groupID, token, pic, lat, lang, baseUrl, apiBaseUrl);
              $("#statusText").val('').focus().css("height", "20px");
              $("#latitude").val('');
              $("#longitude").val('');
              $("#geoContainer").slideUp();
              $('#uploadvalues').val('');
              $('#preview').html('');
              $("#webcamContainer").slideUp();
              $('#webcam').html('');
              $('#webcam_preview').html('');
              $('#photoContainer').slideUp('fast');
            } 
            // else {
            //   $.alert({
            //     title: '',
            //     content: 'Please write something.',
            //     confirm: function() {
            //       $("#statusText").val('').focus();
            //     }
            //   });
            // }
          });
          /*########## News Feed Common Event Actions ##########*/

          /* Textare Resize */
          $("textarea").on('mousemove', function(e) {
              var myPos = $(this).offset();
              myPos.bottom = $(this).offset().top + $(this).outerHeight();
              myPos.right = $(this).offset().left + $(this).outerWidth();

              if (myPos.bottom > e.pageY && e.pageY > myPos.bottom - 16 && myPos.right > e.pageX && e.pageX > myPos.right - 16) {
                $(this).css({
                  cursor: "nw-resize"
                });
              } else {
                $(this).css({
                  cursor: ""
                });
              }
            })
            .on('keyup', function(e) {
              while ($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
                $(this).height($(this).height() + 1);
              };
            });

          /* Comment Box */
          $('body').on("click", '.commentopen', function() {
            var created = $(this).attr("c");
            var x = $(this).attr("id");
            var sid = x.split("commentopen");
            var msgID = sid[1];

            //$("#commentBox"+msgID).slideDown("fast");
            //$("#commentText"+msgID).focus();

            $(".commentBox" + msgID + created).slideToggle("fast");
            $(".commentText" + msgID + created).focus();
            return false;
          });

          /* Delete News Feed */
          $('body').on("click", '.feedDelete', function() {
            var created = $(this).attr("c");
            var x = $(this).attr("id");
            var sid = x.split("deleteFeed");
            var msgID = sid[1];
            var group_id = $(this).attr("rel");;
            $.confirm({
              title: '',
              content: 'Sure you want to delete this update? There is NO undo!',
              confirm: function() {
                deleteNewsFeed(uid, msgID, group_id, token, apiBaseUrl, created);
              },
              cancel: function() {}
            });
            return false;
          });

          /* Delete Comment */
          $('body').on("click", '.commentDelete', function() {
            var created = $(this).attr("c");
            var x = $(this).attr("id");
            var sid = x.split("commentDelete");
            var com_id = sid[1];
            var msg_id = $(this).attr("rel");
            $.confirm({
              title: '',
              content: 'Sure you want to delete this comment? There is NO undo!',
              confirm: function() {
                commentDelete(uid, token, apiBaseUrl, baseUrl, com_id, msg_id, created);
              },
              cancel: function() {}
            });
            return false;
          });

          /* Comment View */
          $('body').on("click", '.commentView', function() {
            var created = $(this).attr("c");
            var x = $(this).attr("id");
            var msgUID = $(this).attr("rel");
            var sid = x.split("commentView");
            var msgID = sid[1];
            commentsView(uid, msgID, token, msgUID, apiBaseUrl, baseUrl, created);
            return false;
          });

          /* Comment Update */
          $("body").on("click", '.commentButton', function() {
            var created = $(this).attr("c");
            var x = $(this).attr("id");
            var sid = x.split("commentButton");
            var msgID = sid[1];
            var comment = $("#commentText" + msgID).val();
            var upload = '';
            var uploadID = $(".commentPreview").attr("id");

            if (parseInt(uploadID) > 0)
              upload = parseInt(uploadID);
            if ($.trim(comment).length > 0) {
              /* Comment Update */
              commentUpdate(uid, token, apiBaseUrl, baseUrl, comment, msgID, name, pic, upload, created);
            } else {
              $.alert({
                title: '',
                content: 'Please write comment.',
                confirm: function() {
                  //$("#commentText"+msgID).focus();
                  $(".commentText" + msgID + created).focus();
                }
              });
            }
            return false;
          });


          /* Like Count */
          $('body').on("click", '.likeCount', function() {
            var created = $(this).attr('c');
            var x = $(this).attr("id");
            var sid = x.split("likesCount");
            var msg_id = sid[1];
            likeUsers(uid, msg_id, token, apiBaseUrl, baseUrl, created);
            return false;
          });
          /*Like and Unlike*/
          $('body').on("click", '.like', function() {
            var created = $(this).attr("c");
            var rel = $(this).attr("rel");

            var x = $(this).attr("id");
            var sid = x.split("like");

            var msg_id = sid[1];
            var reactionType = 1;
            var reactionName = "Like";
            if (rel != 'Like') {
              userLikeUnlike(uid, msg_id, token, rel, name, username, pic, apiBaseUrl, baseUrl, created, reactionType, reactionName);
            }
            return false;
          });

          /*Reaction*/
          $("body").on("click", ".likeTypeAction", function() {
            var created = $(this).parent().parent().attr("c");
            var rel = $(this).parent().parent().attr("rel");
            var x = $(this).parent().parent().attr("id");
            var sid = x.split("reaction");
            var msg_id = sid[1];
            var reactionType = $(this).attr("data-reaction");

            var reactionName = $(this).attr("original-title");

            userLikeUnlike(uid, msg_id, token, rel, name, username, pic, apiBaseUrl, baseUrl, created, reactionType, reactionName);
            $("#" + x).hide();
            return false;
          });

          /*Share and Unshare*/
          $('body').on("click", '.sharebutton', function() {
            var created = $(this).attr("c");
            var rel = $(this).attr("rel");
            var x = $(this).attr("id");
            var sid = x.split("share");
            var msg_id = sid[1];
            userShareUnshare(uid, msg_id, token, rel, apiBaseUrl, baseUrl, created);
            return false;
          });
          /*########## News Feed Common Event Actions End ##########*/
          <?php }
        /*########## Friends Page ##########*/
        else if($friends){ ?>
          /* Friends Grid */
          public_username = $('#public_username').val();
          if (public_username.length > 0) {
            type = '0';
            listType = 'friends';
            /* Friends List */
            friendsList(uid, token, apiBaseUrl, baseUrl, page, friendsPerPage, type, public_username);
            /* Friends scroll Down */
            $(window).scroll(function() {
              var a = 0;
              if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                var REL = $("#friendsList").attr("rel");
                if (parseInt(REL)) {
                  if (a == '0') {
                    var newPage = parseInt($(".friendBlock:last").attr("rel")) + 1;
                    friendsList(uid, token, apiBaseUrl, baseUrl, newPage, friendsPerPage, type, public_username);
                    a = 1;
                  }
                }
              }
            });
          }

          <?php }
        /*########## Followers Page ##########*/
        else if($followers){ ?>
          /* Friends Grid */
          public_username = $('#public_username').val();
          if (public_username.length > 0) {
            type = '0';
            listType = 'friends';
            /* Friends List */
            followersList(uid, token, apiBaseUrl, baseUrl, page, friendsPerPage, type, public_username);
            /* Friends scroll Down */
            $(window).scroll(function() {
              var a = 0;
              if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                var REL = $("#friendsList").attr("rel");
                if (parseInt(REL)) {
                  if (a == '0') {
                    var newPage = parseInt($(".friendBlock:last").attr("rel")) + 1;
                    followersList(uid, token, apiBaseUrl, baseUrl, newPage, friendsPerPage, type, public_username);
                    a = 1;
                  }
                }
              }
            });
          }

          <?php
        }
        /*########## Profile Views Page ##########*/
        else if($views)
        {
            ?>
          /* Views Grid */
          public_username = $('#public_username').val();
          if (public_username.length > 0) {
            type = '0';
            listType = 'views';
            /* Profile View List */
            profileViewedList(uid, token, apiBaseUrl, baseUrl, page, friendsPerPage, type, public_username);

            /* Profile Scroll Down */
            $(window).scroll(function() {
              var a = 0;
              if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                var REL = $("#viewsList").attr("rel");
                if (parseInt(REL)) {
                  if (a == '0') {
                    var newPage = parseInt($(".friendBlock:last").attr("rel")) + 1;
                    profileViewedList(uid, token, apiBaseUrl, baseUrl, newPage, friendsPerPage, type, public_username);
                    a = 1;
                  }
                }
              }
            });
          }
          <?php
        }
        /*########## Photos Page ##########*/
        else if($photos)
        {
            if($photos_of)
            {
                echo "photos_of='1';";
            }
            else
            {
                echo "photos_of='0';";
            }
            ?>
          public_username = $('#public_username').val();
          /* photos list */
          photosList(uid, token, apiBaseUrl, baseUrl, page, photosPerPage, photos_of, public_username);
          /* Scroll Downl */
          $(window).scroll(function() {
            var a = 0;
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
              var REL = $("#photosList").attr("rel");
              if (parseInt(REL)) {
                if (a == '0') {
                  var newPage = parseInt($(".photoBlock:last").attr("rel")) + 1;
                  photosList(uid, token, apiBaseUrl, baseUrl, newPage, photosPerPage, photos_of, public_username);
                  a = 1;
                }
              }
            }
          });

          <?php
        }
        /*########## Groups Page ##########*/
        else if($groups)
        {
            ?>
          /* Views Grid */
          public_username = $('#public_username').val();
          if (public_username.length > 0) {
            type = '0';
            /* Groups List */
            groupsList(uid, token, apiBaseUrl, baseUrl, page, groupsPerPage, type, public_username);
            /* Groups List Scroll */
            $(window).scroll(function() {
              var a = 0;
              if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                var REL = $("#groupsList").attr("rel");
                if (parseInt(REL)) {
                  if (a == '0') {
                    var newPage = parseInt($(".groupBlock:last").attr("rel")) + 1;
                    groupsList(uid, token, apiBaseUrl, baseUrl, newPage, groupsPerPage, type, public_username);
                    a = 1;
                  }
                }
              }
            });
          }
          <?php
        }
        /*########## Notifications Page ##########*/
        else if($notifications)
        {
            ?>
          /* new notification timestamp created */
          notificationCreatedUpdate(uid, token, apiBaseUrl);
          notification_created = 0;
          type = '0';
          /* Notifications */
          notifications(uid, token, apiBaseUrl, baseUrl, notification_created, notificationPerPage, type);
          /* Notifications Scroll*/
          $(window).scroll(function() {
            var a = 0;
            if ($(window).scrollTop() == $(document).height() - $(window).height()) {
              var REL = $("#notifications").attr("rel");
              if (parseInt(REL)) {
                if (a == '0') {
                  var notification_created = $(".notificationsBlock:last").attr("rel");
                  notifications(uid, token, apiBaseUrl, baseUrl, notification_created, notificationPerPage, type);
                  a = 1;
                }
              }
            }
          });
          <?php
        }
        /*########## Messages Page ##########*/
        else if($messages){
            ?>
          var message_user = '<?php echo $_GET["message_username"] ?>';
          /* Conversation Scroll */
          $('#conversationReplies').scroll(function(eve) {
            if ($(this).scrollTop() == 0) {
              var ID = $(".conversationReply:first").attr("id");
              var sid = ID.split("last");
              var lastID = sid[1];
              var rel = $(this).attr("rel");
              conversationReplies(uid, token, apiBaseUrl, baseUrl, message_user, lastID, rel);
            }
          });

          /* Conversation List Scroll */
          $('#cList').scroll(function(eve) {
            var gridHeight = 500;
            var s = $("#conversationsList").height() - gridHeight;
            var a = $(this).attr("rel");
            if ($(this).scrollTop() >= s) {
              var ID = $(".cListGroup:last").attr("time");
              if (parseInt(a)) {
                /* Conversations */
                conversations(uid, token, apiBaseUrl, baseUrl, ID, conversation_uid);
                $(this).attr("rel", "0");
              }
            }
          });

          $("#conversationReply").focus();
          var last_time = '';
          var conversation_uid = '';
          conversations(uid, token, apiBaseUrl, baseUrl, last_time, conversation_uid);
          <?php
            if($_GET['message_username'])
            {
                ?>
          var topHeight = parseInt($('#conversationReplies')[0].scrollHeight) + 800;
          $("#conversationReplies").animate({
            "scrollTop": topHeight
          }, "slow");
          var last = '';
          var rel = $("#conversationReplies").attr("rel");
          /* Conversation Replies */
          conversationReplies(uid, token, apiBaseUrl, baseUrl, message_user, last, rel);
          /* Conversation Reply */
          $('body').on("click", '#conversationReplyButton', function() {
            var reply = $("#conversationReply").val();
            var lat = $("#latitude").val();
            var lang = $("#longitude").val();
            var up = $("#uploadvalues").val();
            var uploadvalues = 0;
            if (up) {
              uploadvalues = $("#uploadvalues").val();
            } else {
              uploadvalues = $(".preview:last").attr('id');
            }
            var X = $('.preview').attr('id');
           //$.trim(reply).length > 0
            if (true) {
              conversationReplyInsert(uid, token, apiBaseUrl, baseUrl, $.conversationID, reply, lat, lang, uploadvalues);
              $("#latitude").val('');
              $("#longitude").val('');
              $("#geoContainer").slideUp();
              $('#uploadvalues').val('');
              $('#preview').html('');
              $('#photoContainer').slideUp('fast');
            }
          });

          /* Conversation Delete */
          $('body').on("click", '.conversationDelete', function() {
            var ID = $(this).attr("id");
            var sid = ID.split("conversation");
            var cid = sid[1];
            $.confirm({
              title: '',
              content: 'Sure you want to delete this conversation? There is NO undo!',
              confirm: function() {
                conversationDelete(uid, token, apiBaseUrl, baseUrl, cid);
              },
              cancel: function() {}
            });
            return false;
          });
          <?php
            }
        }
        /*########## Create Group Page ##########*/
        else if($createGroup){ ?>
          $('body').on("click", '#createGroup', function() {
            var groupName = $("#groupName").val();
            var groupDesc = $("#groupDesc").val();
            if ($.trim(groupName).length > 0 && $.trim(groupDesc).length > 0 && /^[a-zA-Z0-9_ -]{3,100}$/i.test(groupName)) {
              createGroup(uid, token, apiBaseUrl, baseUrl, groupName, groupDesc);
            } else {
              $("#networkError").fadeIn("slow").html("Please enter valid details.");
            }

            return false;
          });
          <?php }
        /*########## Edit Group Page ##########*/
        else if($editGroup) {
            ?>
          /* Group edit Check */
          groupEditCheck(uid, token, apiBaseUrl, baseUrl, editGroupID);
          /* Delete Group */
          $("body").on("click", "#deleteGroup", function() {
            $.confirm({
              title: '',
              content: 'Sure you want to delete this group? There is NO undo!',
              confirm: function() {
                groupDelete(uid, token, apiBaseUrl, baseUrl, editGroupID, username);
              },
              cancel: function() {}
            });
          });

          /* Group Edit */
          $("body").on("click", "#editGroup", function() {
            var name = $("#groupNameEdit").val();
            var desc = $("#groupDescEdit").val();
            if ($.trim(name).length > 0 && $.trim(desc).length > 0 && /^[a-zA-Z0-9_ -]{3,100}$/i.test(name)) {
              /* Group Update */
              groupUpdate(uid, token, apiBaseUrl, baseUrl, editGroupID, name, desc);
            }
            return false;
          });
          <?php
        }
        /*########## Create Group Page ##########*/
        else if($settings) {
            ?>
          /* Update Settings */
          $("body").on('click', '#updateSettings', function() {
            var full_name = $("#nameSettings").val();
            var about_me = $("#aboutSettings").val();
            var gender = $("#genderSettings").val();
            var emails = $("#emailNotifications").val();
            if ($.trim(full_name).length > 0 && $.trim(about_me).length > 0 && $.trim(gender).length > 0 && $.trim(emails).length > 0 && /^[a-zA-Z0-9_ -]{3,35}$/i.test(full_name)) {
              /* Update Settings */
              updateSettings(uid, token, apiBaseUrl, baseUrl, full_name, about_me, gender, emails);
            } else {
              $("#networkError").fadeIn("slow").html("Please enter valid details.");
            }
            return false;
          });

          /* Update Settings */
          $("body").on('click', '#socialSettings', function() {
            var facebook = $("#facebookSettings").val();
            var twitter = $("#twitterSettings").val();
            var google = $("#googleSettings").val();
            var instagram = $("#instagramSettings").val();
            var fcheck = /^[a-zA-Z0-9_.-]{3,26}$/i.test(facebook);
            var tcheck = /^[a-zA-Z0-9_.-]{3,26}$/i.test(twitter);
            var gcheck = /^[a-zA-Z0-9_.-]{3,26}$/i.test(google);
            var icheck = /^[a-zA-Z0-9_.-]{3,26}$/i.test(instagram);
            if (($.trim(facebook).length > 0 && fcheck) || ($.trim(twitter).length > 0 && tcheck) || ($.trim(google).length > 0 && gcheck) || ($.trim(instagram).length > 0 && icheck)) {
              /* Social Settings */
              socialSettings(uid, token, apiBaseUrl, baseUrl, facebook, twitter, google, instagram);
            } else {
              $("#networkError").fadeIn("slow").html("Please enter valid social details.");
            }
            return false;
          });
          <?php
        }
        else if($usernameValue)
        {
            ?>

          /* Username.php Redirection */
          if ($.trim(username).length > 1) {
            window.location.href = baseUrl + username;
          }


          /* Username Update */
          $("body").on('click', '#usernameSubmit', function() {
            var usernameValue = $("#usernameValue").val();
            if (/^[a-zA-Z0-9_-]{3,25}$/i.test(usernameValue)) {
              usernameUpdate(uid, token, usernameValue, apiBaseUrl, baseUrl);
            } else {
              $('#usernameValue').removeClass("successInput").addClass("errorInput").attr("rel", "0");
            }
            return false;
          });

          /* Username Check */
          $('body').on('keyup', '#usernameValue', function() {
            var usernameValue = $(this).val();
            if (/^[a-zA-Z0-9_-]{3,25}$/i.test(usernameValue)) {
              usernameEmailCheck(uid, token, usernameValue, apiBaseUrl);
              $("#usernameUpdateMsg").hide();
            } else {
              $('#usernameValue').removeClass("successInput").addClass("errorInput").attr("rel", "0");
              $("#usernameUpdateMsg").show().html("Username should be 3-15characters and no spaces");
            }
            return false;
          });


          <?php
        }
        else if($changePassword)
        {
            ?>
          /* Change Password */
          $("body").on('click', '#changePassword', function() {
            var oldPassword = $("#oldPassword").val();
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();
            if ($.trim(oldPassword).length > 0 && $.trim(newPassword).length > 0 && $.trim(confirmPassword).length > 0) {
              changePassword(uid, token, apiBaseUrl, baseUrl, oldPassword, newPassword, confirmPassword);
            }
            return false;
          });

          <?php
        }
        ?>
        });
      </script>