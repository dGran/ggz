document.addEventListener('DOMContentLoaded', () => {
    const $formElements = {
        email: $('#sign_up_email'),
        emailInfo: $('#email-info'),
        password: $('#sign_up_plainPassword'),
        passwordInfo: $('#password-info'),
        buttonSendForm: $('#sign_up_submit'),
        viewPassword: $('#view-password'),
    };

    const inputStyles = {
        valid: 'border-[#B3FF2E] focus:border-[#B3FF2E] hover:border-[#B3FF2E]',
        error: 'border-[#f5989a] focus:border-[#f5989a] hover:border-[#f5989a]',
        initial: 'border-[#c5b7d4] focus:border-white hover:border-white',
    };
    const inputClassMap = {
        'valid': inputStyles.valid,
        'error': inputStyles.error,
        'initial': inputStyles.initial,
    };
    const passwordInfoStyles = {
        valid: 'text-[#B3FF2E]',
        initial: 'text-[#C4C4C4]',
    };
    const passwordInfoClassMap = {
        'valid': passwordInfoStyles.valid,
        'initial': passwordInfoStyles.initial,
    };

    $formElements.email.on('blur', updateFormState);
    $formElements.password.on('input', updateFormState);
    $formElements.viewPassword.on('click', toggleViewPassword);

    updateFormState();

    function updateFormState() {
        Promise.all([validateEmail(), validatePassword()])
            .then(([isEmailValid, isPasswordValid]) => {
                const enable = isEmailValid && isPasswordValid;

                $formElements.buttonSendForm.toggleClass('filled', enable).toggleClass('empty', !enable);
            });
    }

    function validateEmail() {
        return new Promise((resolve, reject) => {
            const email = $formElements.email.val();

            if (!email) {
                renderInputEmail('initial', null, true);

                resolve(false);

                return;
            }

            if (!isValidEmail(email)) {
                const message = 'You must enter a valid email';
                renderInputEmail('error', message);

                resolve(false);

                return;
            }

            const checkEmailAvailabilityUrl = $('#check-email-url').data('url');

            $.ajax({
                type: 'POST',
                url: checkEmailAvailabilityUrl,
                data: {
                    sign_up_email: email,
                },
                success: function (response) {
                    if (!response.isAvailable) {
                        const message = 'There is already an account with this email';
                        renderInputEmail('error', message);

                        resolve(false);
                    } else {
                        renderInputEmail('valid');

                        resolve(true);
                    }
                },
                error: function () {
                    const message = 'Email verification failed';
                    renderInputEmail('error', message);

                    resolve(false);
                },
            });
        });
    }

    function isValidEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/;

        return emailRegex.test(email);
    }

    function validatePassword() {
        const password = $formElements.password.val();

        if (!password) {
            renderInputPassword('initial', null, true);

            return false;
        }

        if (!isValidPassword(password)) {
            renderInputPassword('initial');

            return false;
        }

        renderInputPassword('valid');

        return true;
    }

    function isValidPassword(password) {
        const hasUppercase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const isValidLength = password.length >= passwordMinCharacters && password.length <= passwordMaxCharacters;

        return hasUppercase && hasNumber && isValidLength;
    }

    function renderInputEmail(state, message = null, empty = false) {
        $formElements.email.removeClass(Object.values(inputStyles).join(' '));

        const classToAdd = inputClassMap[state];

        if (classToAdd) {
            $formElements.email.addClass(classToAdd);
        }

        if (message) {
            $formElements.emailInfo.removeClass('hidden');
            $formElements.emailInfo.text(message);
        } else {
            if (empty) {
                $formElements.emailInfo.val('');
            }

            $formElements.emailInfo.addClass('hidden');
        }
    }

    function renderInputPassword(state, message = null, empty = false) {
        $formElements.password.removeClass(Object.values(inputStyles).join(' '));
        $formElements.passwordInfo.removeClass(Object.values(passwordInfoStyles).join(' '));

        const classInputToAdd = inputClassMap[state];

        if (classInputToAdd) {
            $formElements.password.addClass(classInputToAdd);
        }

        const classLabelToAdd = passwordInfoClassMap[state];

        if (classLabelToAdd) {
            $formElements.passwordInfo.addClass(classLabelToAdd);
        }
    }

    function toggleViewPassword() {
        const iconClasses = {
            close: 'icon-eye-close',
            open: 'icon-eye-open',
        };

        if ($formElements.viewPassword.hasClass(iconClasses.close)) {
            $formElements.viewPassword.removeClass(iconClasses.close).addClass(iconClasses.open);
            $formElements.password.attr('type', 'text');
        } else {
            $formElements.viewPassword.removeClass(iconClasses.open).addClass(iconClasses.close);
            $formElements.password.attr('type', 'password');
        }
    }

    Mousetrap.bind(['ctrl+alt+v', 'command+alt+v'], function() {
        toggleViewPassword();

        return false;
    });
});
