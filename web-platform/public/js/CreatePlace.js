var Roblox = Roblox || {};
Roblox.CreatePlaceTabs = new function () {
    var tabs = {
        TemplatesTab: 'Templates',
        BasicSettingsTab: 'BasicSettings',
        AccessTab: 'Access',
        AdvancedSettingsTab: 'AdvancedSettings'
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
Roblox.CreatePlace = new function () {
    var createUrl = '/API/CreatePlace';
    var selectedPlaceType = 'game';
    var submitting = false;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var GenreMap = {
        all: 1,
        adventure: 2,
        building: 3,
        comedy: 4,
        fighting: 5,
        fps: 6,
        horror: 7,
        medieval: 8,
        military: 9,
        naval: 10,
        rpg: 11,
        scifi: 12,
        sports: 13,
        townandcity: 14,
        western: 15
    };
    var AccessMap = {
        'Everyone': 0,
        'Friends': 1,
        'No One': 2
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
    function initPills() {
        $('#servertype li').on('click', function () {
            $('#servertype li').removeClass('active');
            $(this).addClass('active');
            selectedPlaceType = $(this).data('type');
        });
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
        var devices = $('#devices input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get();
        var genreKey = $('select[name="genre"]').val();
        var accessText = $('#Access').val();
        return {
            name: $('input[name="name"]').val().trim(),
            description: $('textarea[name="description"]').val(),
            access: AccessMap.hasOwnProperty(accessText) ? AccessMap[accessText] : AccessMap['Everyone'],
            max_players: parseInt($('#NumPlayers').val(), 10),
            can_comment: true
        };
    }
    function submit() {
        if (submitting) return;
        if (!validate()) return;
        submitting = true;
        showProcessing();
        $.ajax({
            type: 'POST',
            url: createUrl,
            contentType: 'application/json; charset=utf-8',
            data: JSON.stringify(collectPayload()),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json',
            success: function (response) {
                submitting = false;
                if (response && response.success === true) {
                    window.location.href = '/develop?View=9';
                    return;
                }
                hideProcessing();
                if (response && response.message) {
                    showValidationError('Name', response.message);
                }
            },
            error: function () {
                submitting = false;
                hideProcessing();
            }
        });
    }
    function init() {
        initPills();
        $('#CreatePlaceSubmit').on('click', function (e) {
            e.preventDefault();
            submit();
        });
    }
    $(init);
    return { submit: submit };
}();