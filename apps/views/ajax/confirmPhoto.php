<?php
$image = $this->f3->get('image');
$target = $this->f3->get('target');
?>
<div class="imgCover">
    <div class="userCover">
        <input type="hidden" name="dragX" value="0">
        <input type="hidden" name="dragY" value="0">
    </div>
    <input type="hidden" name="fileName" value="<?php echo $image['name']; ?>">
    <input type="hidden" name="width" value="<?php echo $image['width']; ?>">
    <input type="hidden" name="height" value="<?php echo $image['height']; ?>">
    <input type="hidden" name="target" value="<?php echo $target; ?>">
    <input type="hidden" name="chooseBy" value="cover">
    <div class="dragCover">
        <img src="<?php echo UPLOAD_URL . 'images/' . $image['name']; ?>" style="width:100%;">
    </div>
    <script>
        $('.dragCover').draggable({
        stop: function(event, ui) {

        // Show dropped position.
        var Stoppos = $(this).position();
        var left = Math.abs(Stoppos.left);
        var top = Math.abs(Stoppos.top);
        $('.userCover').html('<input type="hidden" name="dragX" value="' + left + '"><input type="hidden" name="dragY"  value="' + top + '">');
        }

        });
    </script>
</div>
