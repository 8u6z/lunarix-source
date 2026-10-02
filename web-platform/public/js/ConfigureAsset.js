var Roblox = Roblox || {};
Roblox.ConfigureTabs = new function () {
    var tabs = {
        ConfigureTab: 'Configure',
        SellTab: 'Sell',
        ExtrasTab: 'Extras'
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
Roblox.ItemConfigure = new function () {
    var updateUrl = '/API/ConfigureItem';
    var assetId = null;
    var feePercent = 30;
    var submitting = false;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
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
            showValidationError('Name', 'Please enter a name for your item.');
            valid = false;
        } else if (name.trim().length > 100) {
            $('input[name="name"]').addClass('input-validation-error');
            showValidationError('Name', 'Name cannot exceed 100 characters.');
            valid = false;
        }
        return valid;
    }
    function recalcPricing() {
        var price = parseInt($('#PriceInput').val(), 10);
        if (isNaN(price) || price < 0) {
            price = 0;
        }
        var fee = price > 0 ? Math.max(Math.floor(price * (feePercent / 100)), 1) : 0;
        var earnings = price - fee;
        $('#FeeDisplay').text(fee);
        $('#EarnDisplay').text(earnings >= 0 ? earnings : 0);
    }
    function toggleSellDetails() {
        var isForSale = $('#SellCheckbox').is(':checked');
        $('#SellDetails').css('display', isForSale ? 'flex' : 'none');
    }
    function initPricing() {
        $('#SellCheckbox').on('change', toggleSellDetails);
        $('#PriceInput').on('input', recalcPricing);
        toggleSellDetails();
        recalcPricing();
    }
    function collectPayload() {
        return {
            id: assetId,
            name: $('input[name="name"]').val().trim(),
            description: $('textarea[name="description"]').val(),
            onsale: $('#SellCheckbox').is(':checked'),
            price: parseInt($('#PriceInput').val(), 10) || 0,
            can_comment: $('#CommentsCheckbox').is(':checked')
        };
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
                    window.location.href = '/-item?id=' + assetId;
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
        var $config = $('#ItemConfigureData');
        if ($config.length) {
            assetId = parseInt($config.data('asset-id'), 10);
            feePercent = parseInt($config.data('fee-percent'), 10);
        }
        initPricing();
        $('#CreatePlaceSubmit').on('click', function (e) {
            e.preventDefault();
            submit();
        });
    }
    $(init);
    return { submit: submit };
}();