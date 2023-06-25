let inputEmail = $('#sign_in_email');
let inputPassword = $('#sign_in_plainPassword');
let buttonSendForm = $('#sign_in_submit');

toggleButtonSendForm();

inputEmail.on("input", toggleButtonSendForm);
inputPassword.on("input", toggleButtonSendForm);

function toggleButtonSendForm() {
    let isInputFilled = inputEmail.val().length > 0 && inputPassword.val().length > 0;

    buttonSendForm.toggleClass('filled', isInputFilled);
    buttonSendForm.toggleClass('empty', !isInputFilled);
}