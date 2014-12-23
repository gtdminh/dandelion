<style>
    #pgwModal .pm-body{
        background-color: #fff !important;
    }
</style>
<?php
$status = $this->f3->get('status');
$user = $this->f3->get('user');
$userName = ucfirst($user->data->firstName) . ' ' . ucfirst($user->data->lastName);
$profilePic = $user->data->profilePic;
$statusID = str_replace(':', '_', $status->recordID);
?>
<script type="text/javascript">
    $(function () {
        $(".shareBtn").on('click', function (e)
        {
            e.preventDefault();
            var statusID = $(this).attr('id').replace('shareStatus-', '');
            //var txt = $('#contentShare-'+statusID).val();
            $.ajax({
                type: "POST",
                url: "/content/post/insertStatus",
                data: $('#fmShareStatus-' + statusID).serialize(),
                cache: false,
                success: function () {
                    $('.uiShare').hide();
                    $('.notificationShare').show();
                    setTimeout(function () {
                        $('.notificationShare').hide();
                        $('#fade').hide();
                    }, 3000);
                }
            });
        });
        $('.cancelBtn').click(function (e) {
            e.preventDefault();
            $('#fade').hide();
            $('.uiShare').hide();
        });
        $('.taPostShare').autosize();
    });

</script>

<div class=" large-100">
    <div class="shareFor column-group">
        <span class="large-30 shareIcon">Share: </span>
        <span class="large-70 shareOn">On your own timeline</span>
    </div>
    <div class="uiTextShare large-100">
        <form class="ink-form" id="fmShareStatus-<?php echo $statusID; ?>">
            <fieldset>
                <div class="control-group">
                    <div class="control">
                        <input type="hidden" id="parentStatus" name="statusID" value="<?php echo $statusID; ?>">
                        <textarea name="shareTxt" class="textareaNoResize" id="contentShare-<?php echo $statusID; ?>" spellcheck="false" placeholder="Write a something..."></textarea>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="contentShareWrapper column-group">
        <div class="large-15">
            <img style="margin-left:10px;" class="avatar_50" src="<?php echo $this->getAvatar($profilePic) ?>" alt=""/>
        </div>
        <div class="textContainer large-80">
            <span class="shareStage"><?php echo $userName; ?></span>
            <p class="contentShare"><?php echo $status->data->content; ?></p>
        </div>
    </div>
</div>
<div class="actionPopUp column-group push-right large-100">
    <a class="button">Cancel</a>
    <a class="button active shareBtn" id="shareStatus-<?php echo $statusID; ?>">Share</a>

</div>
