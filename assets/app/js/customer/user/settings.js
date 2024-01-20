document.addEventListener('DOMContentLoaded', () => {
    // document.querySelectorAll('[id^="tab-"]').forEach(tab => {
    //     tab.addEventListener('click', () => {
    //         // Remove the "highlight" class from the previously highlight tab
    //         document.querySelector('.highlight').classList.remove('highlight');
    //
    //         // Add the "highlight" class to the clicked tab
    //         tab.classList.add('highlight');
    //
    //         // Hide all content sections
    //         document.querySelectorAll('.tab-content').forEach(content => {
    //             content.classList.add('hidden');
    //         });
    //
    //         // Show the content section corresponding to the clicked tab
    //         const contentId = 'content' + tab.id.slice(3);
    //         document.getElementById(contentId).classList.remove('hidden');
    //     });
    // });
    // document.querySelectorAll('.edit').forEach(editButton => {
    //     editButton.addEventListener('click', () => {
    //         const input = editButton.previousElementSibling;
    //         if (input.disabled) {
    //             input.disabled = false;
    //             input.focus();
    //             editButton.textContent = 'Save';
    //         } else {
    //             input.disabled = true;
    //             editButton.textContent = 'Edit';
    //             // Save the new value, for example, by sending it to the server using AJAX.
    //         }
    //     });
    // });

    let nicknameMode = 'show';
    let emailMode = 'show';

    const $formElements = {
        formUpdateNickname: $('#customer_user_settings_update_nickname'),
        inputNickname: $('#account_settings_nickname_nickname'),
        buttonNickname: $('#account_settings_nickname_submit'),
        formUpdateEmail: $('#customer_user_settings_update_email'),
        inputEmail: $('#account_settings_email_email'),
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
                    $formElements.buttonNickname.text('Edit');
                    $formElements.inputNickname.prop('disabled', true);
                    nicknameMode = 'show';
                } else {

                }
            },
            error: function() {
                // const message = 'Nickname verification failed';
                // $formElements.nicknameInfo.text(message);
            }
        });
    }
});
