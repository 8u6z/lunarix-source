if (typeof Lunarix === "undefined") {
    Lunarix = {};
}
if (typeof Lunarix.SuperSafePrivacyMode === "undefined") {
    Lunarix.SuperSafePrivacyMode = function () {
        function openSuperSafeModal() {
            Lunarix.GenericModal.open(Lunarix.SuperSafePrivacyMode.Resources.modalTitle, null, Lunarix.SuperSafePrivacyMode.Resources.modalMsg, function () { });  
        }

        function initModals() {
            $('[data-js-supersafeprivacymode]').each(function (index, html) {
                var self = $(html);
                var parent = self.parent();

                if (self.hasClass('SuperSafePrivacyModeImg')) { //banner image
                    self.click(function () {
                        openSuperSafeModal();
                    });
                    if (parent.attr('data-js-supersafe-specialstyle') === "True") {
                        return;
                    }
                    parent = parent.parent();
                    self.parent().css('left', parent.find('input[data-js-supersafeprivacymode],textarea[data-js-supersafeprivacymode]').outerWidth() - self.outerWidth());

                } else { //disabled element
                    var overlay = $("<div />");
                    overlay.css({
                        position: "absolute",
                        top: self.position().top,
                        left: self.position().left,
                        width: self.outerWidth(),
                        height: self.outerHeight(),
                        zIndex: 1000,
                        backgroundColor: "#fff", //IE
                        opacity: 0
                    }).click(function () {
                        openSuperSafeModal();
                    });

                    parent.append(overlay);
                }
            });
        }

        return {
            initModals: initModals,
            openSuperSafeModal: openSuperSafeModal
        };
    }();

    Lunarix.SuperSafePrivacyMode.Resources = {
        modalMsg: "This feature is locked for users under 13 years of age. If your birthday is incorrect, go to the <a href='/My/Account.aspx'>Account</a> page to update it.",
        modalTitle: "Update Your Age"
    };
}

$(function () {
    Lunarix.SuperSafePrivacyMode.initModals();
});