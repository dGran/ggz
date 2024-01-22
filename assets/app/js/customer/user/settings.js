document.addEventListener('DOMContentLoaded', () => {
    let nicknameMode = 'show';
    let emailMode = 'show';
    let currentNickname = '';
    let currentEmail = '';

    const $formElements = {
        formUpdateNickname: $('#customer_user_settings_update_nickname'),
        inputNickname: $('#account_settings_nickname_nickname'),
        infoNickname: $('#nickname_info'),
        buttonNickname: $('#account_settings_nickname_submit'),
        buttonCancelNickname: $('#account_settings_nickname_button_cancel'),
        formAddEmailRequest: $('#customer_user_settings_add_email_request'),
        inputEmail: $('#account_settings_email_email'),
        infoEmail: $('#email_info'),
        buttonEmail: $('#account_settings_email_submit'),
        buttonCancelEmailRequest: $('#account_settings_cancel_email_request'),
        buttonCancelEmail: $('#account_settings_email_button_cancel'),
    };

    $formElements.buttonNickname.on('click', function (event) {
        event.preventDefault();

        if (nicknameMode === 'show') {
            nicknameMode = 'edit';
            $formElements.inputNickname.prop('disabled', false).focus();
            $formElements.buttonCancelNickname.removeClass('hidden');
            $formElements.buttonNickname.text('Save');
            currentNickname = $formElements.inputNickname.prop('value');
        } else {
            updateNickname();
        }
    });

    $formElements.buttonCancelNickname.on('click', function (event) {
        event.preventDefault();

        nicknameMode = 'show';
        $formElements.inputNickname.prop('disabled', true);
        $formElements.buttonCancelNickname.addClass('hidden');
        $formElements.buttonNickname.text('Edit');
        $formElements.inputNickname.val(currentNickname);
        $formElements.infoNickname.text('');
    });

    function updateNickname() {
        const url = $formElements.formUpdateNickname.attr('action');
        const nickname = $formElements.inputNickname.val();

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                nickname: nickname
            },
            success: function(response) {
                if (response.result) {
                    $formElements.buttonCancelNickname.addClass('hidden');
                    $formElements.buttonNickname.removeClass('text-purpleggz2');
                    $formElements.buttonNickname.text('Saved!');

                    setTimeout(function() {
                        $formElements.infoNickname.text('');
                        $formElements.buttonNickname.addClass('text-purpleggz2');
                        $formElements.buttonNickname.text('Edit');
                        $formElements.inputNickname.prop('disabled', true);
                        nicknameMode = 'show';
                    }, 250);
                } else {
                    $formElements.infoNickname.text(response.message);
                }
            },
            error: function() {
                $formElements.infoNickname.text('Internal server error');

            }
        });
    }

    $formElements.buttonEmail.on('click', function (event) {
        event.preventDefault();

        if (emailMode === 'show') {
            emailMode = 'edit';
            $formElements.inputEmail.prop('disabled', false).focus();
            $formElements.buttonCancelEmail.removeClass('hidden');
            $formElements.buttonEmail.text('Request');
            currentEmail = $formElements.inputEmail.prop('value');
        } else {
            addEmailRequest();
        }
    });

    $formElements.buttonCancelEmail.on('click', function (event) {
        event.preventDefault();

        emailMode = 'show';
        $formElements.inputEmail.prop('disabled', true);
        $formElements.buttonCancelEmail.addClass('hidden');
        $formElements.buttonEmail.text('Edit');
        $formElements.inputEmail.val(currentEmail);
        $formElements.infoEmail.text('');
    });

    function addEmailRequest() {
        const url = $formElements.formAddEmailRequest.attr('action');
        const email = $formElements.inputEmail.val();

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                email: email
            },
            success: function(response) {
                if (response.result) {
                    $formElements.buttonCancelEmail.addClass('hidden');
                    $formElements.buttonEmail.removeClass('text-purpleggz2');
                    $formElements.buttonEmail.text('Requested!');

                    setTimeout(function() {
                        // $formElements.infoEmail.text('');
                        // $formElements.buttonEmail.addClass('text-purpleggz2');
                        // $formElements.buttonEmail.text('Edit');
                        // $formElements.inputEmail.prop('disabled', true);
                        // emailMode = 'show';

                        location.reload();
                    }, 300);
                } else {
                    $formElements.infoEmail.text(response.message);
                }
            },
            error: function() {
                $formElements.infoEmail.text('Internal server error');

            }
        });
    }

    $formElements.buttonCancelEmailRequest.on('click', removeEmailRequest);

    function removeEmailRequest() {
        const url = $formElements.buttonCancelEmailRequest.data('url');

        $.ajax({
            type: 'POST',
            url: url,
            success: function(response) {
                if (response.result) {
                    location.reload();
                } else {
                    $formElements.infoEmail.text(response.message);
                }
            },
            error: function() {
                $formElements.infoEmail.text('Internal server error');

            }
        });
    }
});
