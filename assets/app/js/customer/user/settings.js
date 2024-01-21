document.addEventListener('DOMContentLoaded', () => {
    let nicknameMode = 'show';
    let emailMode = 'show';

    const $formElements = {
        formUpdateNickname: $('#customer_user_settings_update_nickname'),
        inputNickname: $('#account_settings_nickname_nickname'),
        infoNickname: $('#nickname_info'),
        buttonNickname: $('#account_settings_nickname_submit'),
        formUpdateEmail: $('#customer_user_settings_update_email'),
        inputEmail: $('#account_settings_email_email'),
        infoEmail: $('#email_info'),
        buttonEmail: $('#account_settings_email_submit'),
    };

    $formElements.buttonNickname.on('click', function (event) {
        event.preventDefault();

        if (nicknameMode === 'show') {
            nicknameMode = 'edit';
            $formElements.inputNickname.prop('disabled', false).focus();
            $formElements.buttonNickname.text('Save');
        } else {
            updateNickname();
        }
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
                    $formElements.buttonNickname.text('Saved!');

                    setTimeout(function() {
                        $formElements.infoNickname.text('');
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
            $formElements.buttonEmail.text('Save');
        } else {
            updateEmail();
        }
    });

    function updateEmail() {
        const url = $formElements.formUpdateEmail.attr('action');
        const email = $formElements.inputEmail.val();

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                email: email
            },
            success: function(response) {
                if (response.result) {
                    $formElements.buttonEmail.text('Saved!');

                    setTimeout(function() {
                        $formElements.infoEmail.text('');
                        $formElements.buttonEmail.text('Edit');
                        $formElements.inputEmail.prop('disabled', true);
                        emailMode = 'show';
                    }, 250);
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
