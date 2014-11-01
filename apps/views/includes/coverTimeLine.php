<?php
$otherUser = $this->f3->get('otherUser');
$currentUser = $this->f3->get('currentUser');
$statusFriendShip = $this->f3->get('statusFriendShip');
//prepare data
$otherUserID = $otherUser->recordID;
$otherUserName = ucfirst($otherUser->data->firstName) . " " . ucfirst($otherUser->data->lastName);
$currentUserName = ucfirst($currentUser->data->firstName) . " " . ucfirst($currentUser->data->lastName);

$rpOtherUserID = str_replace(':', '_', $otherUser->recordID);
?>

<div class="uiCoverTimeLineContainer" style=" position: relative">
    <form id="submitCover">
        <?php
        if ($otherUser->data->coverPhoto != 'none')
            $photo = HelperController::findPhoto($otherUser->data->coverPhoto);
        if (!empty($photo))
        {
            $a = 'Change cover';
        }
        else
        {
            $a = 'Add a cover';
        }
        ?>
        <div class="column-group uiCoverTimeLine">
            <div class="uploadCoverStatusBar"></div>
            <div class="displayPhoto">
                <?php
                if (!empty($photo))
                {
                    $photoID = str_replace(':', '_', $photo->recordID);
                    ?>
                    <div class="imgCover">
                        <div style="width:<?php echo $photo->data->width; ?>px; height:<?php echo $photo->data->height; ?>px;  position: relative; <?php if (!empty($photo->data->dragX)) echo 'left: -' . $photo->data->dragX . 'px' ?>; <?php if (!empty($photo->data->dragY)) echo 'top: -' . $photo->data->dragY . 'px' ?>">
                            <a class="page" url="/content/photo/detail?id=<?php echo $photoID ?>">
                                <img src="<?php echo UPLOAD_URL . "cover/750px/" . $photo->data->fileName ?>" style="width:100%;">
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="actionCover">
                <a data-dropdown="#dropdown-uploadCover" class="button icon add"><span><?php echo $a ?></span></a>
                <div id="dropdown-uploadCover" class="dropdown dropdown-tip">
                    <ul class="dropdown-menu">
                        <li><a href="/photoBrowser?profile_id=<?php echo $currentUser->recordID ?>&photo_id=<?php echo $currentUser->recordID ?>&type=cover" class="popupMyPhoto"  title="Choose From My Photos">Choose from Photos...</a></li>
                        <li><a id="uploadPhotoCover">Upload photo</a></li>
                        <?php
                        if (!empty($photo))
                        {
                            ?>
                            <li><a href="javascript:void(0)" class="rCoverUser" rel="<?php echo $photo->recordID ?>">Reposition</a></li>
                            <?php
                        }
                        if (!empty($otherUser->data->coverPhoto) && $otherUser->data->coverPhoto != 'none')
                        {
                            ?>
                            <li><a href="javascript:void(0)" class="removeImgUser " id="removeCover" role="cover" title="Remove">Remove</a></li>
                        <?php } ?>
                    </ul>

                </div>
            </div>
        </div>
        <div >
            <div id="imgAvatar" style=" position: relative;">
                <div class="uploadAvatarStatusBar"></div>
                <div class="profilePic">
                    <?php
                    if ($otherUser->data->profilePic != 'none')
                    {
                        $photo = HelperController::findPhoto($otherUser->data->profilePic);
                        $src = UPLOAD_URL . 'avatar/170px/' . $photo->data->fileName;
                        $labelStt = 'Change avatar';
                        $photoID = str_replace(':', '_', $photo->recordID);
                        $viewAvatar = '/content/photo/detail?id=' . $photoID . '&p=';
                    }
                    else
                    {
                        $gender = HelperController::findGender($otherUser->recordID);
                        if ($gender == 'male')
                            $src = UPLOAD_URL . 'avatar/170px/avatarMenDefault.png';
                        else
                            $src = UPLOAD_URL . 'avatar/170px/avatarWomenDefault.png';
                        $labelStt = 'Add avatar';
                        $viewAvatar = '';
                    }
                    ?>
                    <a class="infoUser page" url="<?php echo $viewAvatar; ?>">
                        <img src="<?php echo $src; ?>">
                    </a>
                </div>
                <div class="profileInfo">
                    <a data-dropdown="#dropdown-uploadAvatar" class="button icon add"><span><?php echo $labelStt ?></span></a>
                    <div id="dropdown-uploadAvatar" class="dropdown dropdown-tip">
                        <ul class="dropdown-menu">
                            <li><a class="photoBrowse" role="avatar" title="My Photos">Choose from Photos...</a></li>
                            <li><a id="uploadAvatar">Upload photo</a></li>
                            <?php
                            if ($otherUser->data->profilePic != 'none')
                            {
                                ?>
                                <li><a href="#" class="removeImgUser" id="removeAvatar" role="avatar" title="Remove">Remove</a></li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
            <a class="name" href="#"><?php echo $otherUserName; ?></a>
            <div class="timeLineMenuNav ">
                <div>
                    <?php
                    $username = $otherUser->data->username;
                    $f3 = require('navTimeLine.php');
                    ?>
                </div>
            </div>
        </div>
    </form>
    <div class="uiProfilePicTimeLine imgAvatar">

        <div class="firendRequest profileInfoDiv">
            <div class="uiActionUser">
                <?php
                if ($statusFriendShip == 'request' || $statusFriendShip == 'later' || $statusFriendShip == 'addFriend')
                {
                    if ($statusFriendShip == 'request' || $statusFriendShip == 'later')
                    {
                        ?>
                        <a data-dropdown="#dropdown-requestFriend" class="requestFriend button blue"><span>Friend Request Sent</span></a>
                        <div id="dropdown-requestFriend" class="dropdown dropdown-tip">
                            <ul class="dropdown-menu">
                                <li><a>Report/Block</a></li>
                                <li><a class="cancelRequestFriend" id="<?php echo $rpOtherUserID; ?>">Cancel Request</a></li>
                            </ul>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <a class="addFriend button blue linkHover-fffff" id="<?php echo $rpOtherUserID; ?>">Add Friend</a>
                        <?php
                    }
                }
                elseif ($statusFriendShip == 'respondRequest')
                {
                    ?>
                    <a data-dropdown="#dropdown-respondFriendRequest" class="respondFriendRequest button blue"><span>Respond to Friend Request</span></a>
                    <div id="dropdown-respondFriendRequest" class="dropdown dropdown-tip">
                        <ul class="dropdown-menu">
                            <li><a class="confirmFriend" id="<?php echo $rpOtherUserID; ?>">Confirm Friend</a></li>
                            <li><a class="cancelRequestFriend" id="<?php echo $rpOtherUserID; ?>">Unaccept Request</a></li>
                        </ul>
                    </div>
                    <?php
                }
                elseif ($statusFriendShip == 'updateInfo')
                {
                    ?>
                    <a class="button blue linkHover-fffff" href="/about?user=<?php echo $currentUser->data->username; ?>&section=overview">Update Info</a>
                    <?php
                }
                else
                {
                    ?>
                    <div class="friendButton">
                        <div>
                            <a data-dropdown="#dropdown-isFriend" class="button blue"><span>Friend</span></a>
                            <div id="dropdown-isFriend" class="dropdown dropdown-tip">
                                <ul class="dropdown-menu">
                                    <li><a>Report/Block</a></li>
                                    <li><a class="cancelRequestFriend" id="<?php echo $rpOtherUserID; ?>">Unfriend</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>

<script>
    $(function() {

        $("#submitCover").submit(function() {

            $.ajax({
                type: "POST",
                url: "/savePhoto",
                data: $("#submitCover").serialize(), // serializes the form's elements.
                success: function(data)
                {
                    var obj = jQuery.parseJSON(data);
                    var user = [
                        {username: obj.username}
                    ];
                    $("#navInfoUserTemplate").tmpl(user).appendTo(".timeLineMenuNav");
                    $('.arrow_timeLineMenuNav').show();
                    $('.profilePic a img').css('display', 'block');
                    $('.profilePic .profileInfo').css('display', 'block ');
                    $('.dropdown').css('display', '');
                    $('.name').css('display', 'block');
                    $('.actionCover').css('display', 'block');
                    $('.cancelCover').remove();
                    $('.dragCover').css('cursor', 'pointer');
                }
            });

            return false; // avoid to execute the actual submit of the form.
        });
    })
</script>
<script id="photoCoverUserTemplate" type="text/x-jQuery-tmpl">
    <div class="imgCover">
    <div style="width:${width}px; height:${height}px;  position: relative; left: ${left}px; top: ${top}px">
    <img src="<?php echo UPLOAD_URL . 'cover/750px/'; ?>${src}" style="width:100%;">
    </div>
    </div>
</script>
<script id="comfirmTemplate" type="text/x-jQuery-tmpl">
    <div class="control-group">
    <div class="control">
    <div class="statusDialog">Are you sure you want to remove </div>
    </div>
    <input type="hidden" id="role" name="role" value="${role}">
    <div class="footerDialog" >
    <button type="submit" class="ink-button green-button comfirmDialog">Comfirm</button>
    <button class=" closeDialog ink-button ">Cancel</a>
    </div>
    </div>
</script>

<script id="navInfoUserTemplate" type="text/x-jQuery-tmpl">
    <div>
    <nav class="ink-navigation uiTimeLineHeadLine">
    <ul class="menu horizontal">
    <li><a href="/user/${username}">TimeLine</a></li>
    <li><a href="/about?user=${username}">About</a></li>
    <li><a href="/friends?user=${username}">Friends</a></li>
    <li><a href="/content/post?user=${username}">Post</a></li>
    <li><a href="/content/photo?user=${username}">Photos</a></li>
    <li><a href="#">More</a></li>
    </ul>
    </nav>
    </div>
</script>
<script id="navCoverUserTemplate" type="text/x-jQuery-tmpl">
    <div class="cancelCover">
    <nav class="ink-navigation uiTimeLineHeadLine">
    <ul class="menu horizontal uiTimeLineHeadLine float-right">
    <li><button type="button" class="ink-button cancel" id="coverPhoto">Cancel</button></li>
    <li><button type="submit" class="ink-button green-button">Save Changes</button></li>
    </ul>
    </nav>
    </div>
</script>