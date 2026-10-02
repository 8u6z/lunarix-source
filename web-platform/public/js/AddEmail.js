if (typeof Lunarix === "undefined") {
    Lunarix = {};
}
if (typeof Lunarix.AddEmail === "undefined") {
    Lunarix.AddEmail = function () {
        var reloadPageOnSuccess = false;
        var holdOnAnotherEnter = false;

        //<sl:translate>
        var normalEmailText = "Email Address:";
        var parentEmailText = "Parent's Email Address";
        var passwordText = "Verify Password:";
        var titleText = "Change Email Address";
        var updateText = "Update";
        var cancelText = "Cancel";
        var okText = "OK";

        var invalidEmailText = "Please enter a valid email address.";
        var noEmailText = "Email address cannot be empty.";
        var noPasswordText = "Please enter your password to continue.";
        var standardErrorText = "An error occurred. Please try again.";

        var emailChangedText = "Email Address Changed";
        var emailVerificationText = "An email has been sent for verification.";

        var processingText = "Processing...";
        //</sl:translate>

        function validateEmail() {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var emailaddressVal = $("#EmailTextBox").val();
            var hasError = false;
            if (emailaddressVal == '') {
                $('#Processing').hide();
                $("#noEmail").show();
                hasError = true;
            } else if (!emailReg.test(emailaddressVal)) {
                $("#invalidEmail").show();
                $('#SubmitEmailButton').show();
                $('#Processing').hide();
                hasError = true;
                holdOnAnotherEnter = false;
            }
            return !hasError;
        };

        function loadEmailModal(showParent) {

            var emailText = "";

            if (showParent) {
                emailText = parentEmailText;
            } else {
                emailText = normalEmailText;
            }
            var bodyContents = "<div id='invalidEmail' style='display: none' class='validation-summary-errors'><span class='text'>" + invalidEmailText +
                "</span></div><div id='noEmail' style='display: none' class='validation-summary-errors'><span class='text'>" + noEmailText +
                "</span></div><div id='noPassword' style='display: none' class='validation-summary-errors'><span class='text'>" + noPasswordText +
                "</span></div><div id='StandardError' style='display: none' class='validation-summary-errors'><span class='text'>" + standardErrorText +
                "</span></div><table style='margin: auto'><tr><td><label class='form-label'>" + emailText +
                "</label></td><td><input id='EmailTextBox' class='text-box text-box-large emailInput emailChangeMonitor' /></td></tr><tr><td><label class='form-label'>" +
                passwordText + "</label></td><td><input id='PasswordTextBox' type='password' class='text-box text-box-large emailInput emailChangeMonitor' /></td></tr></table>" +
                "<div id='Processing' style='display:none;margin-bottom: 10px;'><img src='/images/Accounts/ProgressIndicator.gif' alt='" + processingText + "'/></div>";

            var validate = function () {
                resetWarnings();
                //we need to return false to keep the modal from closing
                return validatePasswordAndAddEmail();
            };

            Lunarix.GenericConfirmation.open({
                titleText: titleText,
                bodyContent: bodyContents,
                acceptText: updateText,
                declineText: cancelText,
                onAccept: validate,
                allowHtmlContentInBody: true,
                dismissable: false,
                fieldValidationRequired: true
            });
            return false;
        };

        function resetWarnings() {
            $('#ConfirmationDialog').hide();
            $('#noPassword').hide();
            $('#noEmail').hide();
            $('#invalidEmail').hide();
            $('#StandardError').hide();
            $('#Processing').hide();
        };

        function validatePasswordAndAddEmail() {
            var password = $('#PasswordTextBox').val();
            var email = $('#EmailTextBox').val();
            var uID = $('#AddEmailScreenModal').data('uid');
            var userIP = $('#AddEmailScreenModal').data('userip');
            if (password == "") {
                $('#noPassword').show();
                return false;
            }

            $('#SubmitEmailButton').hide();
            $('#Processing').show();
            holdOnAnotherEnter = true;

            if (validateEmail()) {
                var onSuccess = onError = function (response) {
                    if (response.Result) {
                        Lunarix.GenericConfirmation.close(); //force close the generic modal
                        $('#Processing').hide();
                        //Don't reload page if it is for Parent's email when DOB is Changed to <13
                        if (!LunarixMissingParentEmail.resetParentEmail)
                            reloadPageOnSuccess = true;
                        Lunarix.GenericConfirmation.open({
                            titleText: emailChangedText,
                            bodyContent: emailVerificationText,
                            acceptText: okText,
                            declineColor: Lunarix.GenericConfirmation.none,
                            dismissable: false
                        });
                        if (LunarixMissingParentEmail.resetParentEmail) {
                            LunarixMissingParentEmail.hasParentEmailBeenReset = true;
                            eval($('#UpdateSettingsBtn').attr('href'));
                        }
                    } else {
                        $('#StandardError span').text(response.Message);
                        $('#StandardError').show();
                        $('#Processing').hide();
                        $('.ConfirmationModalButtonContainer a').removeClass('btn-disabled-neutral');
                        $('.ConfirmationModalButtonContainer a').removeClass('btn-disabled-negative');
                    }
                };
                Lunarix.Website.Services.Secure.AddParentEmail.InsertParentEmail(email, uID, password, userIP, LunarixMissingParentEmail.resetParentEmail, onSuccess, onError);
                $('.ConfirmationModalButtonContainer a.btn-neutral').addClass('btn-disabled-neutral');
                $('.ConfirmationModalButtonContainer a.btn-disabled-neutral').click(function () { return false; });
                $('.ConfirmationModalButtonContainer a.btn-negative').addClass('btn-disabled-negative');
                $('.ConfirmationModalButtonContainer a.btn-disabled-negative').click(function () { return false; });
                return false;
            } else {
                return false;
            }
        };

        return {
            loadEmailModal: loadEmailModal,
            resetWarnings: resetWarnings,
            holdOnAnotherEnter: holdOnAnotherEnter,
            reloadPageOnSuccess: reloadPageOnSuccess
        };
    } ();
}

$(function () {
	
    function closeModal() {
		if (Lunarix.AddEmail.reloadPageOnSuccess) {
			location.reload(true);
		}
		Lunarix.GenericConfirmation.close("#AddEmailScreenModal");
	};

	$(document).keydown(function (event) {
		if ($('#AddEmailScreenModal').is(':visible')) {
			if (event.which == 13 && !Lunarix.AddEmail.holdOnAnotherEnter) {
				$('#SubmitInfoButton').click();
				return false;
			}
			if (event.which == 27) {
				closeModal();
			}
		}
	});

	$('#CloseAddEmailScreen, #updateEmailOK, #CancelInfoButton').click(closeModal);
	$('#SubmitInfoButton').click(function () {
	    if ($("#SubmitInfoButton").hasClass('btn-disabled-neutral')) {
			return false;
		} else {
			Lunarix.AddEmail.resetWarnings();
			Lunarix.AddEmail.validatePasswordAndAddEmail();
		}
	});
	$(".emailChangeMonitor").change(function () {
	    $("#SubmitInfoButton").removeClass('btn-disabled-neutral');
	});
});