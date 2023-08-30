let inputEmail = $('#sign_up_email');
let emailInfo = $('#email-info');
let inputPassword = $('#sign_up_plainPassword');
let passwordInfo = $('#password-info');
let buttonSendForm = $('#sign_up_submit');
let viewPassword = $('#view-password');
let errorClasses = 'border-[#f5989a] focus:border-[#f5989a] hover:border-[#f5989a]';
let validClasses = 'border-[#B3FF2E] focus:border-[#B3FF2E] hover:border-[#B3FF2E]';
let initialClasses = 'border-[#c5b7d4] focus:border-white hover:border-white';

$(document).ready(function () {
    inputEmail.on('blur', checkValidations);
    inputPassword.on('input', checkValidations);
    viewPassword.on('click', toggleViewPassword);

    checkValidations();

    function checkValidations() {
        Promise.all([validateEmail(), validatePassword()]).then(results => {
            const isEmailValid = results[0];
            const isPasswordValid = results[1];

            if (isEmailValid && isPasswordValid) {
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

    function toggleViewPassword() {
        if (viewPassword.hasClass('icon-eye-close')) {
            viewPassword.removeClass('icon-eye-close');
            viewPassword.addClass('icon-eye-open');
            inputPassword.attr('type', 'text');
        } else {
            viewPassword.removeClass('icon-eye-open');
            viewPassword.addClass('icon-eye-close');
            inputPassword.attr('type', 'password');
        }
    }

    function validateEmail() {
        return new Promise((resolve, reject) => {
            let email = inputEmail.val();

            if (!email) {
                renderInputEmail(false, null, true);

                resolve(false);
                return;
            }

            if (!isValidEmail(email)) {
                let message = 'You must enter a valid email';
                renderInputEmail(false, message);

                resolve(false);
                return;
            }

            let checkEmailUrl = $('#check-email-url').data('url');

            $.ajax({
                type: 'POST',
                url: checkEmailUrl,
                data: {
                    sign_up_email: email
                },
                success: function(response) {
                    if (response.exists) {
                        let message = 'There is already an account with this email';
                        renderInputEmail(false, message);

                        resolve(false);
                    } else {
                        renderInputEmail(true);

                        resolve(true);
                    }
                },
                error: function() {
                    let message = 'Email verification failed';
                    renderInputEmail(false, message);

                    resolve(false);
                }
            });
        });
    }

    function validatePassword() {
        let password = inputPassword.val();

        if (!password) {
            renderInputPassword(false, true);

            return false;
        }

        if (!isValidPassword(password)) {
            renderInputPassword(false);

            return false;
        }

        renderInputPassword(true);

        return true;
    }

    function isValidEmail(email) {
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/;

        return emailPattern.test(email);
    }

    function isValidPassword(password) {
        let hasUppercase = /[A-Z]/.test(password);
        let hasNumber = /[0-9]/.test(password);
        let isValidLength = password.length >= 8 && password.length <= 32;

        return hasUppercase && hasNumber && isValidLength;
    }

    function renderInputEmail(valid, message = null, empty = false) {
        if (!valid && message) {
            inputEmail.removeClass(initialClasses);
            inputEmail.removeClass(validClasses);
            inputEmail.addClass(errorClasses);
            emailInfo.removeClass('hidden');
            emailInfo.text(message);

            return;
        }

        inputEmail.removeClass(errorClasses);

        if (empty) {
            inputEmail.removeClass(validClasses);
            inputEmail.removeClass(errorClasses);
            inputEmail.addClass(initialClasses);
        } else {
            inputEmail.removeClass(initialClasses);
            inputEmail.removeClass(errorClasses);
            inputEmail.addClass(validClasses);
        }

        if (!emailInfo.hasClass('hidden')) {
            emailInfo.addClass('hidden');
        }
    }

    function renderInputPassword(valid, empty = false) {
        if (!valid) {
            inputPassword.removeClass(validClasses);
            inputPassword.addClass(initialClasses);
            passwordInfo.removeClass('text-[#B3FF2E]');
            passwordInfo.addClass('text-[#C4C4C4]');

            return;
        }

        inputPassword.removeClass(initialClasses);
        inputPassword.addClass(validClasses);
        passwordInfo.removeClass('text-[#C4C4C4]');
        passwordInfo.addClass('text-[#B3FF2E]');
    }
});