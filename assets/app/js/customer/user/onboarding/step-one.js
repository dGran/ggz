document.addEventListener('DOMContentLoaded', () => {
    const $formElements = {
        inputNickname: $('#on_boarding_step_one_nickname'),
        nicknameInfo: $('#nickname-info'),
        buttonSendForm: $('#on_boarding_step_one_submit')
    };

    const inputNicknameStyles = {
        valid: 'border-green-500 focus:border-green-500 hover:border-green-500',
        error: 'border-[#f5989a] focus:border-[#f5989a] hover:border-[#f5989a]',
        initial: 'border-[#6C5D73] focus:border-purpleggz hover:border-purpleggz',
    };
    const inputNicknameClassMap = {
        'valid': inputNicknameStyles['valid'],
        'error': inputNicknameStyles['error'],
        'initial': inputNicknameStyles['initial'],
    };

    const nicknameInfoStyles = {
        valid: 'text-green-500',
        error: 'text-red-500',
        initial: 'text-gray-600',
    };
    const nicknameInfoClassMap = {
        'valid': nicknameInfoStyles['valid'],
        'error': nicknameInfoStyles['error'],
        'initial': nicknameInfoStyles['initial'],
    };

    $formElements.inputNickname.focus();
    $formElements.inputNickname.on("input", updateFormState);

    updateFormState();

    function updateFormState() {
        validateNickname().then(isNicknameValid => {
            $formElements.buttonSendForm.toggleClass('filled', isNicknameValid).toggleClass('empty', !isNicknameValid);
        });
    }

    function validateNickname() {
        return new Promise((resolve, reject) => {
            const nickname = $formElements.inputNickname.val();
            const default_message = 'You must enter between 4 and 24 characters';

            if (!nickname || !isValidNicknameLength(nickname)) {
                $formElements.nicknameInfo.text(default_message);
                setClassesToElements($formElements.inputNickname, inputNicknameClassMap, 'initial');
                setClassesToElements($formElements.nicknameInfo, nicknameInfoClassMap, 'initial');

                resolve(false);
                return;
            }

            const checkNicknameAvailabilityUrl = $('#check-nickname-availability-url').data('url');

            $.ajax({
                type: 'POST',
                url: checkNicknameAvailabilityUrl,
                data: {
                    nickname: nickname
                },
                success: function(response) {
                    if (!response.isAvailable) {
                        $formElements.nicknameInfo.text(response.message);
                        setClassesToElements($formElements.inputNickname, inputNicknameClassMap, 'error');
                        setClassesToElements($formElements.nicknameInfo, nicknameInfoClassMap, 'error');

                        resolve(false);
                    } else {
                        $formElements.nicknameInfo.text(default_message);
                        setClassesToElements($formElements.inputNickname, inputNicknameClassMap, 'valid');
                        setClassesToElements($formElements.nicknameInfo, nicknameInfoClassMap, 'valid');

                        resolve(true);
                    }
                },
                error: function() {
                    const message = 'Nickname verification failed';
                    $formElements.nicknameInfo.text(message);

                    resolve(false);
                }
            });
        });
    }

    function isValidNicknameLength(nickname) {
        return nickname.length >= nicknameMinCharacters && nickname.length <= nicknameMaxCharacters;
    }

    function setClassesToElements($element, classMap, state) {
        const classesToRemove = Object.values(classMap).join(' ');
        const classesToAdd = classMap[state];

        $element.toggleClass(classesToRemove, false).toggleClass(classesToAdd, !!classesToAdd);
    }
});
