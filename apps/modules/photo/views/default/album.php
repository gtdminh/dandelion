<?php
foreach(glob(MODULES.'photo/webroot/js/jshome.php') as $jshome){
    if(file_exists($jshome)){
        require_once ($jshome);
    }
}
$albumID    = F3::get('albumID');
?>
<div class="photoContainer">
    <div class="wrapperTitlePhoto">
        <div class="BoxUpload">
            <div class="photosTitle">
                <p class="iconPhoto"></p>
                <a>Photos</a>
            </div>
            <div class="uploadPhoto">
                <input id="album_id" type="hidden" value="">
            </div>
        </div>
        <?php
        AppController::elementModules('menu','photo');
        ?>
    </div>
    <div id="fade" class="black_overlay"></div>
    <div id="lightUpload">
        <div class="containerPhotoPopUp">
            <div class="actionUpload">
                <input name="album_id" id="albumID" value="<?php echo $albumID; ?>" type="hidden">
                <div id="mulitplefileuploader">Select Files</div>
                <div class="photoActionBtn">
                    <div class="qualityOption">
                        <input type="checkbox" id="cbQualityPhoto" class="uncheck" value="" name="qualityPhoto">
                        <label>High Quality</label>
                    </div>
                    <div class="actionUploadBtn">
                        <label for="" id="cancelUpload" class="actionFileUpload">Cancel</label>
                    </div>
                    <div class="actionUploadBtn">
                        <label for="" id="uploadPhoto" class="actionFileUpload">Upload</label>
                    </div>
                </div>
            </div>
            <div id="displayPhotos"></div>
            <div id="status"></div>
        </div>
    </div>
    <div id="fadeUpload"></div>
</div>