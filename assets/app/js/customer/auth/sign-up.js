let inputEmail = $('#sign_up_email');
let inputPassword = $('#sign_up_plainPassword');
let buttonSendForm = $('#sign_up_submit');

toggleButtonSendForm();

inputEmail.on("input", toggleButtonSendForm);
inputPassword.on("input", toggleButtonSendForm);

function toggleButtonSendForm() {
    let isInputFilled = inputEmail.val().length > 0 && inputPassword.val().length > 0;

    buttonSendForm.toggleClass('filled', isInputFilled);
    buttonSendForm.toggleClass('empty', !isInputFilled);
}