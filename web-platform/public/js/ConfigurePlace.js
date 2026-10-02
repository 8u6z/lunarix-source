var Roblox = Roblox || {};
Roblox.ConfigureTabs = new function () {
    var tabs = {
        BasicSettingsTab: 'BasicSettings',
        AccessTab: 'Access',
        ExtrasTab: 'Extras',
        UploadTab: 'Upload',
        ThumbnailTab: 'Thumbnail'
    };
    function activate(tabId) {
        for (var t in tabs) {
            if (!tabs.hasOwnProperty(t)) continue;
            var isActive = t === tabId;
            $('#' + t).toggleClass('tab-active', isActive);
            $('#' + tabs[t]).toggleClass('tab-active', isActive);
        }
    }
    function init() {
        for (var t in tabs) {
            if (!tabs.hasOwnProperty(t)) continue;
            (function (tabId) {
                $('#' + tabId).on('click', function () {
                    activate(tabId);
                });
            })(t);
        }
    }
    $(init);
    return { activate: activate };
}();
Roblox.PlaceConfigure = new function () {
    var updateUrl = '/API/ConfigurePlace';
    var uploadUrl = '/API/ConfigurePlace/UploadFile';
    var uploadThumbnailUrl = '/API/ConfigurePlace/UploadThumbnail';
    var placeId = null;
    var submitting = false;
    var uploading = false;
    var uploadingThumbnail = false;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var accessMap = {
        'Everyone': 1,
        'Friends': 2,
        'No One': 0
    };
    function showProcessing() {
        $('#ProcessingView').modal({
            overlayClose: false,
            escClose: false,
            opacity: 80,
            zIndex: 1040,
            overlayCss: { backgroundColor: '#000' },
            focus: false
        });
    }
    function hideProcessing() {
        $.modal.close('.ProcessingView');
    }
    function clearValidation() {
        $('[data-valmsg-for]').removeClass('field-validation-error').addClass('field-validation-valid').text('');
        $('input[name="name"]').removeClass('input-validation-error');
    }
    function showValidationError(field, message) {
        $('[data-valmsg-for="' + field + '"]').removeClass('field-validation-valid').addClass('field-validation-error').text(message);
    }
    function validate() {
        clearValidation();
        var name = $('input[name="name"]').val();
        var valid = true;
        if (!name || !name.trim().length) {
            $('input[name="name"]').addClass('input-validation-error');
            showValidationError('Name', 'Please enter a name for your place.');
            valid = false;
        } else if (name.trim().length > 50) {
            $('input[name="name"]').addClass('input-validation-error');
            showValidationError('Name', 'Name cannot exceed 50 characters.');
            valid = false;
        }
        return valid;
    }
    function collectPayload() {
        return {
            id: placeId,
            name: $('input[name="name"]').val().trim(),
            description: $('textarea[name="description"]').val(),
            access: parseInt($('#AccessSelect').val(), 10),
            max_players: parseInt($('#NumPlayers').val(), 10) || 6,
            can_comment: $('#CommentsCheckbox').is(':checked')
        };
    }
    function hasPlaceFile() {
        var input = $('#itemPlace')[0];
        return !!(input && input.files.length);
    }
    function hasThumbnailFiles() {
        var large = $('#itemThumbnailLarge')[0];
        var square = $('#itemThumbnailSquare')[0];
        return !!((large && large.files.length) || (square && square.files.length));
    }
    function finish() {
        window.location.href = '/develop?View=9';
    }
    function submit() {
        if (submitting) return;
        if (!validate()) return;
        submitting = true;
        showProcessing();
        $.ajax({
            type: 'POST',
            url: updateUrl,
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify(collectPayload()),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json',
            success: function (response) {
                submitting = false;
                if (response && response.success === true) {
                    if (hasPlaceFile()) {
                        uploadFile();
                        return;
                    }
                    if (hasThumbnailFiles()) {
                        uploadThumbnail();
                        return;
                    }
                    finish();
                    return;
                }
                hideProcessing();
                if (response && response.message) {
                    showValidationError('Name', response.message);
                }
            },
            error: function (xhr) {
                submitting = false;
                hideProcessing();
                showValidationError('Name', extractErrorMessage(xhr));
            }
        });
    }
    function uploadFile() {
        if (uploading) return;
        var input = $('#itemPlace')[0];
        if (!input || !input.files.length) {
            if (hasThumbnailFiles()) {
                uploadThumbnail();
                return;
            }
            finish();
            return;
        }
        uploading = true;
        showProcessing();
        var formData = new FormData();
        formData.append('id', placeId);
        formData.append('placeItem', input.files[0]);
        $.ajax({
            type: 'POST',
            url: uploadUrl,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json',
            success: function (response) {
                uploading = false;
                if (response && response.success === true) {
                    if (hasThumbnailFiles()) {
                        uploadThumbnail();
                        return;
                    }
                    hideProcessing();
                    finish();
                    return;
                }
                hideProcessing();
                if (response && response.message) {
                    showValidationError('Name', response.message);
                }
            },
            error: function (xhr) {
                uploading = false;
                hideProcessing();
                showValidationError('Name', extractErrorMessage(xhr));
            }
        });
    }
    function uploadThumbnail() {
        if (uploadingThumbnail) return;
        var largeInput = $('#itemThumbnailLarge')[0];
        var squareInput = $('#itemThumbnailSquare')[0];
        var hasLarge = !!(largeInput && largeInput.files.length);
        var hasSquare = !!(squareInput && squareInput.files.length);
        if (!hasLarge && !hasSquare) {
            hideProcessing();
            finish();
            return;
        }
        uploadingThumbnail = true;
        showProcessing();
        var formData = new FormData();
        formData.append('id', placeId);
        if (hasLarge) {
            formData.append('thumbnail_large', largeInput.files[0]);
        }
        if (hasSquare) {
            formData.append('thumbnail_square', squareInput.files[0]);
        }
        $.ajax({
            type: 'POST',
            url: uploadThumbnailUrl,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json',
            success: function (response) {
                uploadingThumbnail = false;
                hideProcessing();
                if (response && response.success === true) {
                    finish();
                    return;
                }
                if (response && response.message) {
                    showValidationError('Name', response.message);
                }
            },
            error: function (xhr) {
                uploadingThumbnail = false;
                hideProcessing();
                showValidationError('Name', extractErrorMessage(xhr));
            }
        });
    }
    function extractErrorMessage(xhr) {
        if (xhr && xhr.responseJSON && xhr.responseJSON.message) {
            return xhr.responseJSON.message;
        }
        return 'Something went wrong saving your place. Please try again.';
    }
    function init() {
        var $config = $('#PlaceConfigureData');
        if ($config.length) {
            placeId = parseInt($config.data('place-id'), 10);
        }
        $('#ConfigurePlaceSubmit').on('click', function (e) {
            e.preventDefault();
            submit();
        });
    }
    $(init);
    return { submit: submit };
}();