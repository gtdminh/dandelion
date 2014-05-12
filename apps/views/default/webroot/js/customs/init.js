$(".autoloadModuleElement").ready(function()
{
    $.ajax({
        type: "GET",
        url: "/pull",
        cache: false,
        success: function(html) {
            $(".autoloadModuleElement").html(html);
            var lengthChild = $('.autoloadModuleElement > div').length;
            var actionArrays = [];
            var action;
            for (var i = 1; i <= lengthChild; i++)
            {
                action = $('.autoloadModuleElement > div:nth-child(' + i + ')').attr('class');
                actionArrays.push(action);
            }
            //console.log(actionArrays);
            $.ajax({
                type: "POST",
                url: "/loadSuggest",
                data: {actionsName: actionArrays},
                cache: false,
                success: function(html) {
                    $(".autoloadModuleElement").html(html);
                    //new IsActionsForSuggest();
                    var existFriendRequests = $('.uiBoxFriendRequests .rowItemBox').length;
                    if (existFriendRequests < 1)
                        $('.uiBoxFriendRequests').hide();
                    var existPeopleYMK = $('.uiBoxPeopleYouMayKnow .rowItemBox').length;
                    if (existPeopleYMK < 1)
                        $('.uiBoxPeopleYouMayKnow').hide();

                }
            })
        }
    })
});


$(document).ready(function() {
    $('.taPostStatus').autosize();
    $('.taPostComment').autosize();
    //target show popUp
    new showPopUpOver('a.settingOption', '.uiSettingOptionPopUpOver');
    new showPopUpOver('a.quickPostStatusNav', '.uiQuickPostStatusPopUpOver');
    new showPopUpOver('a.showRequestFriends', '.uiFriendRequestsPopUpOver');
    new showPopUpOver('a.showMessages', '.uiMessagesPopUpOver');
    new showPopUpOver('a.showNotifications', '.uiNotificationsPopUpOver');
    new hoverShowPopUpOver('a.requestFriend', '.uiFriendOptionPopUpOver');
    new hoverShowPopUpOver('a.respondFriendRequest', '.uiFriendOptionPopUpOver');
    new hoverShowPopUpOver('a.isFriend', '.uiFriendOptionPopUpOver');
    $(document).click(function() {
        $('.uiPostOptionPopUpOver').hide();
        $('.uiSettingOptionPopUpOver').hide();
        $('.uiFriendRequestsPopUpOver').hide();
        $('.uiMessagesPopUpOver').hide();
        $('.uiNotificationsPopUpOver').hide();
        var existSearchPopUp = $('#resultsList li').length;
        if (existSearchPopUp > 0)
        {
            $('#resultsList').css('display', 'none');
        } else {
            $('#resultsList').css('display', 'block');
        }
    });
    $('.cancelPostStatusNavBtn').click(function() {
        $('.uiQuickPostStatusPopUpOver').hide();
        return false;
    });

    $('#resultsHolder').click(function(e) {
        e.stopPropagation();
    });
    $('body').on('click', '.likeAction', function() {
        var objectID = $(this).attr('id');
        $(this).like('status', objectID);
    });
    $('body').on('click', '.unlikeAction', function() {
        var objectID = $(this).attr('id');
        $(this).unlike('status', objectID);
    });
    $('body').on('click', '.shareStatus', function() {
        var objectID = $(this).attr('id');
        $(this).share(objectID);
    });
    $('body').on('click', '.deleteAction', function() {
        var objectID = $(this).attr('id');
        $(this).deleteEntry(objectID);
    });
    $('body').on('click', '.addFriend', function() {
        var objectID = $(this).attr('id');
        $(this).addFriend(objectID);
    });
    $('body').on('click', '.cancelRequestFriend', function() {
        var objectID = $(this).attr('id');
        $(this).unAccept(objectID);
    });
    $('body').on('click', '.confirmFriend', function() {
        var objectID = $(this).attr('id');
        $(this).acceptFriend(objectID);
    });
    jQuery.fn.center = function() {
        this.css("position", "absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
        return this;
    };
});

//layout photo like pinterest
/*$(window).load(function() {
    $('.uiPhotoPinCol').BlocksIt({
        numOfCol: 3,
        offsetX: -5,
        offsetY: 5
    });
});*/

function showPopUpOver($click, $popUpOver) {
    $('body').on('click', $click, function() {
        $($popUpOver).show();
        return false;
    });
}

function hoverShowPopUpOver($click, $popUpOver) {
    $('body').on('mouseover', $click, function() {
        $($popUpOver).show();
    });
    $('body').on('mouseout', $click, function() {
        $($popUpOver).hide();
    });
    $('body').on('mouseover', $popUpOver, function() {
        $(this).show();
    });
    $('body').on('mouseout', $popUpOver, function() {
        $(this).hide();
    });
}

(function($) {
    $.fn.like = function(type, objectID)
    {
        var getNumLike = parseInt($("#numLike-" + objectID).html());
        $.ajax({
            type: "POST",
            url: "/like",
            data: {type: type, objectID: objectID},
            cache: false,
            success: function(html) {
                $('.like-' + objectID).html(html);
                $('.postItem-' + objectID).fadeIn("slow");
                var likeSentence = $('#likeSentence-' + objectID).length;
                $('#numLike-' + objectID).html(getNumLike + 1);
                if (likeSentence)
                {
                    $("<span>You and </span>").prependTo("#likeSentence-" + objectID);
                } else {
                    $(".tempLike-" + objectID).prepend("<div class='whoLikeThisPost verGapBox likeSentenceView' id='likeSentence-" + objectID + "'>" +
                            "<span><i class='statusCounterIcon-like'></i>You like this</span>" +
                            "</div>");
                }
            }
        });
    };
    $.fn.unlike = function(type, objectID)
    {
        var getNumLike = parseInt($("#numLike-" + objectID).html());
        $.ajax({
            type: "POST",
            url: "/unlike",
            data: {type: type, objectID: objectID},
            cache: false,
            success: function(html) {
                $('.like-' + objectID).html(html);
                $('#numLike-' + objectID).html(getNumLike - 1);
                $('.postItem-' + objectID).fadeIn("slow");
                var otherLike = $('#likeSentence-' + objectID + ' a').length;
                if (otherLike)
                {
                    $('#likeSentence-' + objectID + ' span').remove();
                } else {
                    $('#likeSentence-' + objectID).detach();
                }
            }
        });
    };
    $.fn.share = function(objectID)
    {
        $('#fade').show();
        $('.uiShare').show();
        $('.uiShare').center();
        $('.notificationShare').center();
        $.ajax({
            async: true,
            type: 'POST',
            beforeSend: function() {
                $('.uiShare').addClass('loading');
            },
            complete: function(request, json) {
                $('.uiShare').removeClass('loading');
                $('.uiShare').html(request.responseText);
            },
            url: '/content/post/shareStatus',
            data: {statusID: objectID}
        });
    };
    $.fn.deleteEntry = function(objectID)
    {
        $.ajax({
            type: 'POST',
            url: '/content/post/delete',
            data: {objectID: objectID},
            success: function(){
                $('.postItem-'+objectID).fadeOut('slow');
            }
        });
    }
})(jQuery);

(function($) {
    $.fn.addFriend = function(to)
    {
        $.ajax({
            type: 'POST',
            url: '/sentFriendRequest',
            data: {toUser: to},
            cache: false,
            success: function(html) {
                $('.uiActionUser').html(html);
            }
        });
    };
    $.fn.acceptFriend = function(to)
    {
        $.ajax({
            type: 'POST',
            url: '/acceptFriendship',
            data: {toUser: to},
            cache: false,
            success: function(html) {
                $('.uiActionUser').html(html);
            }
        });
    };
    $.fn.unAccept = function(to)
    {
        $.ajax({
            type: 'POST',
            url: '/unAcceptFriendship',
            data: {toUser: to},
            cache: false,
            success: function(html) {
                $('.uiActionUser').html(html);
            }
        });
    };
})(jQuery);

$(document).ready(function()
{
    $('#search').keyup(function()
    {
        var searchText = $(this).val();
        if (searchText != '')
        {
            $.ajax({
                type: "POST",
                url: "/search",
                data: {data: searchText},
                beforeSend: function() {
                    //Lets add a loading image
                    $('#resultsHolder').addClass('loading');
                },
                success: function(data) {
                    $('#resultsHolder').removeClass('loading');
                    //Clear the results list
                    $('#resultsList').empty();
                    if (data.success)
                    {
                        console.log(data);
                        //Display the results
                        if (data.results.length > 0)
                        {
                            //check if return to result is larger, just display 8 results
                            if (data.results.length > 9)
                            {
                                for (var i = 0; i < data.results.length - 9; i++)
                                {
                                    data.results.pop();
                                }
                            }
                            //Loop through each result and add it to the list
                            $.each(data.results, function()
                            {
                                $('#resultsList').append("<li rel='" + this.recordID + "'>" +
                                        "<a href='/content/myPost?username=" + this.username + "'>" +
                                        "<span>" +
                                        "<img class='imgFindPeople' src='" + this.profilePic + "' width='30' height='30'/>" +
                                        "<span class='infoPeople'>" + this.firstName + " " + this.lastName + "</span>" +
                                        "</span>" +
                                        "</a>" +
                                        "</li>");
                            });
                            $('#resultsList').append("<li class='moreSearch'><a href='/moreSearch?search=" + searchText + "'><span class='moreSearchText'>See more results for '" + searchText + "'</span></a></li>");
                        } else {
                            $('#resultsList').append("<li class='no-results'>" + data.error + "</li>");
                        }
                    } else {
                        //Display the error message
                        $('#resultsList').append("<li class='no-results'>" + data.error + "</li>");
                    }
                    $('#resultsList').fadeIn();
                }
            })
        } else {
            $('#resultsList').empty();
        }
    });
});
function moreComment(id) {
    $.ajax({
        type: "POST",
        url: "/content/post/moreComment",
        data: {statusID: id},
        cache: false,
        success: function(html) {
            $('#' + id).css('display', 'none');
            $('.moreComment-' + id).html(html);

        }
    })
}

$(function() {
    $("body").on("click", "a.commentBtn", function(e) {
        e.preventDefault();
        var getId = $(this).attr('id').replace('stream-', '');
        $('.postItem-' + getId).fadeIn("slow");
        $('#commentBox-' + getId).fadeIn("slow");
        $('#textComment-' + getId).focus();
    }
    );


});

$(document).ready(function()
{
    var settingSingleFile = {
        url: "/content/photo/loadingPhoto",
        method: "POST",
        allowedTypes: "jpg,png,gif",
        fileName: "myfile",
        multiple: false,
        onSuccess: function(files, data, xhr)
        {
            $('.ajax-file-upload-statusbar').fadeOut('slow');
            $.each(data.results, function() {
                console.log(this.url);
                $('#displayPhotoGroup').html("<div id='photoItem-" + this.photoID + "'>" +
                        "<input type='hidden' id ='imgID' name='imgID[]' value='" + this.photoID + "'/>" +
                        "<img src='" + this.url + "' title='" + this.fileName + "'/>" +
                        "</div>");
            });
            new Hover();
        },
        onError: function(files, status, errMsg)
        {
            $("#status").html("<font color='red'>Upload is Failed</font>");
        }
    };
    var settingMultiFiles = {
        url: "/content/photo/loadingPhoto",
        method: "POST",
        allowedTypes: "jpg,png,gif",
        fileName: "myfile",
        multiple: true,
        onSuccess: function(files, data, xhr)
        {
            $('.ajax-file-upload-statusbar').fadeOut('slow');
            $.each(data.results, function() {
                console.log(this.url);
                $('#embedPhotos').append("<div class='photoWrap' id='photoItem-" + this.photoID + "'>" +
                        "<input type='hidden' id ='imgID' name='imgID[]' value='" + this.photoID + "'/>" +
                        "<img src='" + this.url + "' title='" + this.fileName + "'/>" +
                        "</div>");
                $('#removePhoto' + this.photoID).click(function() {
                    var photoID = $(this).attr('id').replace('removePhoto', '');
                    console.log(photoID);
                    $.ajax({
                        type: 'POST',
                        url: '/content/photo/removePhoto',
                        data: {photoID: photoID},
                        cache: false,
                        success: function() {
                            $('#photoItems-' + photoID).detach();
                        }
                    });
                });
            });
            new Hover();
        },
        onError: function(files, status, errMsg)
        {
            $("#status").html("<font color='red'>Upload is Failed</font>");
        }
    };
    var settingMultiFiles2 = {
        url: "/content/photo/loadingPhoto",
        method: "POST",
        allowedTypes: "jpg,png,gif",
        fileName: "myfile",
        multiple: true,
        onSuccess: function(files, data, xhr)
        {
            $('.ajax-file-upload-statusbar').fadeOut('slow');
            $.each(data.results, function() {
                console.log(this.url);
                $('#displayPhotos').append("<div class='photoWrap' id='photoItem" + this.photoID + "'>" +
                        "<div class='loadedPhoto' id='photo" + this.photoID + "'>" +
                        "<img src='" + this.url + "' title='" + this.fileName + "'/>" +
                        "</div> " +
                        "</div>");
                $('#removePhoto' + this.photoID).click(function() {
                    var photoID = $(this).attr('id').replace('removePhoto', '');
                    console.log(photoID);
                    $.ajax({
                        type: 'POST',
                        url: '/content/photo/removePhoto',
                        data: {photoID: photoID},
                        cache: false,
                        success: function() {
                            $('#photoItems-' + photoID).detach();
                        }
                    });
                });
            });
            new Hover();
        },
        onError: function(files, status, errMsg)
        {
            $("#status").html("<font color='red'>Upload is Failed</font>");
        }
    };
    $("#singleFile").uploadFile(settingSingleFile);
    $("#multiFiles").uploadFile(settingMultiFiles);
    $("#multiFiles2").uploadFile(settingMultiFiles2);

});
$("body").on('click', '#createGroup', function(e) {
    e.preventDefault();
    var title = $(this).attr('title');
    var href = $(this).attr('href');
    $('.ui-dialog').html('<div class="loadingGroup">Loading...</div>');
    $(".dialog").dialog({
        width: "400",
        height: "280",
        position: ['top', 120],
        title: title,
        resizable: false,
        modal: true,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
            $('body').css('overflow', 'hidden');


        }
    });

    $.ajax({
        type: "POST",
        url: href,
        success: function(data) {
            $(".dialog").html(data);

        }
    });
});
$("body").on('click', '#leaveGroup', function(e) {
    e.preventDefault();
    var title = $(this).attr('title');
    var href = $(this).attr('href');
    var groupID = $(this).attr('rel');
    $(".dialog").dialog({
        width: "500",
        height: "150",
        position: ['top', 120],
        title: "Leave " + title,
        resizable: false,
        modal: true,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
            $('.dialog').html('<div><img src="<?php echo IMAGES ?>/loadingIcon.gif"</div>');
        }
    });
    $.ajax({
        type: "POST",
        url: href,
        data: {groupID: groupID},
        success: function(data) {
            $(".dialog").html(data);

        }
    });
});

$("body").on('click', '#addMember', function(e) {
    e.preventDefault();
    var title = $(this).attr('title');
    var href = $(this).attr('href');
    var groupID = $(this).attr('rel');
    $(".dialog").dialog({
        width: "500",
        height: "160",
        position: ['top', 120],
        title: title,
        resizable: false,
        modal: true,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
            $('.dialog').html('<div><img src="<?php echo IMAGES ?>/loadingIcon.gif"</div>');
        }
    });
    $.ajax({
        type: "POST",
        url: href,
        data: {groupID: groupID},
        success: function(data) {
            $(".dialog").html(data);

        }
    });
});

$("body").on('click', '.removeGroup', function(e) {
    e.preventDefault();
    var title = $(this).attr('title');
    var href = $(this).attr('href');
    var userID = $(this).attr('rel');
    var groupID = $("#group_id").val();
    $(".dialog").dialog({
        width: "500",
        height: "160",
        position: ['top', 120],
        title: title,
        resizable: false,
        modal: true,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
            $('.dialog').html('<div><img src="<?php echo IMAGES ?>/loadingIcon.gif"</div>');
        }
    });
    $.ajax({
        type: "POST",
        url: href,
        data: {groupID: groupID, userID: userID},
        success: function(data) {
            $(".dialog").html(data);

        }
    });
});
$("body").on('click', '.roleGroup', function(e) {
    e.preventDefault();
    var title = $(this).attr('title');
    var href = $(this).attr('href');
    var userID = $(this).attr('rel');
    var groupID = $("#group_id").val();
    $(".dialog").dialog({
        width: "500",
        height: "160",
        position: ['top', 120],
        title: title,
        resizable: false,
        modal: true,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
            $('.dialog').html('<div><img src="<?php echo IMAGES ?>/loadingIcon.gif"</div>');
        }
    });
    $.ajax({
        type: "POST",
        url: href,
        data: {groupID: groupID, userID: userID},
        success: function(data) {
            $(".dialog").html(data);

        }
    });
});
$("body").on('click', '.closeDialog', function(e) {
    e.preventDefault();
    $(".dialog").dialog("close");
    $('body').css('overflow', 'scroll'); //this line does the actual hiding
});
