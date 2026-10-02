<form action="/build/upload" enctype="multipart/form-data" id="upload-form" method="post">
    <input name="__RequestVerificationToken" type="hidden" value="CAXQrg7krO1TmRjJtJ-C3OiaIQuyDt3BNRkLEy8jg8safyeZErlnvtw7KsNDtXMGzosmJbDmWOzLK6JWE7gCjizHIUw1" />
    <input id="assetTypeId" name="assetTypeId" type="hidden" value="2" />
    <input id="isOggUploadEnabled" name="isOggUploadEnabled" type="hidden" value="True" />
    <input data-val="true" data-val-required="The IsTgaUploadEnabled field is required." id="isTgaUploadEnabled" name="isTgaUploadEnabled" type="hidden" value="True" />
    <input id="groupId" name="groupId" type="hidden" value="3584209" />
    <input id="onVerificationPage" name="onVerificationPage" type="hidden" value="False" />

    <div id="container">
            <div class="form-row">
                <label for="file">Find your image:</label>
                <input id="file" type="file" name="file" tabindex="1" />
                <span id="file-error" class="error"></span>
            </div>
                    <div class="form-row">
                <label for="name">T-Shirt Name:</label>
                <input id="name" type="text" class="text-box text-box-medium" name="name" maxlength="50" tabindex="2" />
                <span id="name-error" class="error"></span>
            </div>
                <div class="form-row submit-buttons">
                            <a id="upload-button" class="btn-medium btn-primary btn-level-element " tabindex="4">Upload</a>
                                    <span id="loading-container"><img src="https://cdn.lunarix.lol/ec4e85b0c4396cf753a06fade0a8d8af.gif"></span>
                <div id="upload-result" class="status-confirm btn-level-element">
                    <a href="https://web.lunarix.com/catalog/1161477602/haaa" target="_top">T-Shirt</a> successfully created!
                </div>
                    <script type="text/javascript">

                        window.parent.$('.items-container').load('https://web.lunarix.com/build/assets?assetTypeId=2');
                    </script>
        </div>
    </div>
</form>
<script type="text/javascript">
    if (typeof Lunarix === "undefined") {
        Lunarix = {};
    }
    if (typeof Lunarix.EmbeddedUpload === 'undefined') {
        Lunarix.EmbeddedUpload = {};
    }

    Lunarix.EmbeddedUpload.Resources = {
        //<sl:translate>
        invalidImageFile: 'Must be a .png, .jpg, .tga,  or .bmp file',
        invalidSoundFile: 'Must be a .mp3 or .ogg file',
        invalidPluginFile: 'Must be an .lrxm file',
        noFile: 'You must select a file',
        noName: 'You must specify a name',
        noDescription: 'You must add a description',
        fileIsEmpty: 'The file is empty',
        fileTooLarge: 'The file is too large'
        //</sl:translate>
    };

    // Only disabled upload button for Badge and GamePass
    Lunarix.EmbeddedUpload.isInsufficientFunds = false;
    Lunarix.EmbeddedUpload.isPlaceSpecificAsset = false;
</script>
<script type='text/javascript' src='https://js.lunarix.lol/83130c78c1b36f01e9c6ae1afb856f7d.js.gzip'></script>