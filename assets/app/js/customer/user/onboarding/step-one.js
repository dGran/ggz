const inputNickname = $('#on_boarding_step_one_nickname');
const nicknameInfo = $('#nickname-info');
const buttonSendForm = $('#on_boarding_step_one_submit');

const inputNicknameErrorClasses = 'border-[#f5989a] focus:border-[#f5989a] hover:border-[#f5989a]';
const inputNicknameValidClasses = 'border-green-500 focus:border-green-500 hover:border-green-500';
const inputNicknameInitialClasses = 'border-[#6C5D73] focus:border-purpleggz hover:border-purpleggz';
const inputNicknameClassMap = {
    'valid': inputNicknameValidClasses,
    'error': inputNicknameErrorClasses,
    'initial': inputNicknameInitialClasses,
};
const nicknameInfoValidClasses = 'text-green-500';
const nicknameInfoErrorClasses = 'text-red-500';
const nicknameInfoInitialClasses = 'text-gray-600';
const nicknameInfoClassMap = {
    'valid': nicknameInfoValidClasses,
    'error': nicknameInfoErrorClasses,
    'initial': nicknameInfoInitialClasses,
};


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

            if (!nickname || !isValidNicknameLength(nickname)) {
                nicknameInfo.text(default_message);
                setClassesToInputNickname('initial');
                setClassesToNicknameInfo('initial');

                resolve(false);

                return;
            }

            let checkNicknameAvailabilityUrl = $('#check-nickname-availability-url').data('url');

            $.ajax({
                type: 'POST',
                url: checkNicknameAvailabilityUrl,
                data: {
                    nickname: nickname
                },
                success: function(response) {
                    if (!response.isAvailable) {
                        nicknameInfo.text(response.message);
                        setClassesToInputNickname('error');
                        setClassesToNicknameInfo('error');

                        resolve(false);
                    } else {
                        nicknameInfo.text(default_message);
                        setClassesToInputNickname('valid');
                        setClassesToNicknameInfo('valid');

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

    function isValidNicknameLength(nickname) {
        return nickname.length >= nicknameMinCharacters && nickname.length <= nicknameMaxCharacters;
    }

    function setClassesToInputNickname(classesToSet) {
        inputNickname.toggleClass(inputNicknameValidClasses + ' ' + inputNicknameErrorClasses + ' ' + inputNicknameInitialClasses, false);
        const classesToAdd = inputNicknameClassMap[classesToSet];

        if (classesToAdd) {
            inputNickname.addClass(classesToAdd);
        }
    }

    function setClassesToNicknameInfo(classesToSet) {
        nicknameInfo.toggleClass(nicknameInfoValidClasses + ' ' + nicknameInfoErrorClasses + ' ' + nicknameInfoInitialClasses, false);
        const classesToAdd = nicknameInfoClassMap[classesToSet];

        if (classesToAdd) {
            nicknameInfo.addClass(classesToAdd);
        }
    }
});