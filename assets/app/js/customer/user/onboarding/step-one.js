let inputNickname = $('#on_boarding_step_one_nickname');
let nicknameInfo = $('#nickname-info');
let buttonSendForm = $('#on_boarding_step_one_submit');
let errorClasses = 'border-[#f5989a] focus:border-[#f5989a] hover:border-[#f5989a]';
let validClasses = 'border-green-500 focus:border-green-500 hover:border-green-500';
let initialClasses = 'border-[#6C5D73] focus:border-purpleggz hover:border-purpleggz';

$(document).ready(function () {
    inputNickname.on("input", checkValidations);
    inputNickname.focus();

    checkValidations();

    function checkValidations() {
        Promise.all([validateNickname()]).then(results => {
            const isNicknameValid = results[0];

            if (isNicknameValid) {
                toggleButtonSendForm(true);
            } else {
                toggleButtonSendForm(false);
            }
        });
    }

    function toggleButtonSendForm(enable) {
        if (enable) {
            buttonSendForm.addClass('filled');
            buttonSendForm.removeClass('empty');

            return;
        }

        buttonSendForm.addClass('empty');
        buttonSendForm.removeClass('filled');
    }

    function validateNickname() {
        return new Promise((resolve, reject) => {
            let nickname = inputNickname.val();
            let default_message = 'You must enter between 4 and 24 characters';

            if (!nickname || !isValidNickname(nickname)) {
                nicknameInfo.text(default_message);

                if (nicknameInfo.hasClass('text-red-500')) {
                    nicknameInfo.removeClass('text-red-500');
                }

                if (nicknameInfo.hasClass('text-green-500')) {
                    nicknameInfo.removeClass('text-green-500');
                }

                inputNickname.removeClass(errorClasses);
                inputNickname.removeClass(validClasses);
                inputNickname.addClass(initialClasses);

                resolve(false);
                return;
            }

            let checkNicknameUrl = $('#check-nickname-url').data('url');

            $.ajax({
                type: 'POST',
                url: checkNicknameUrl,
                data: {
                    nickname: nickname
                },
                success: function(response) {
                    if (!response.isValid) {
                        let message = 'There is already an account with this nickname';
                        nicknameInfo.text(message);
                        inputNickname.addClass(errorClasses);
                        inputNickname.removeClass(initialClasses);
                        inputNickname.removeClass(validClasses);

                        if (nicknameInfo.hasClass('text-green-500')) {
                            nicknameInfo.removeClass('text-green-500');
                        }

                        nicknameInfo.addClass('text-red-500');

                        resolve(false);
                    } else {
                        nicknameInfo.text(default_message);
                        inputNickname.addClass(validClasses);
                        inputNickname.removeClass(initialClasses);
                        inputNickname.removeClass(errorClasses);

                        if (nicknameInfo.hasClass('text-red-500')) {
                            nicknameInfo.removeClass('text-red-500');
                        }

                        nicknameInfo.addClass('text-green-500');

                        resolve(true);
                    }
                },
                error: function() {
                    let message = 'Nickname verification failed';
                    nicknameInfo.text(message);

                    resolve(false);
                }
            });
        });
    }

    function isValidNickname(nickname) {
        return nickname.length >= 4 && nickname.length <= 24;
    }
});