let inputEmail = $('#sign_in_email');
let inputPassword = $('#sign_in_plainPassword');
let buttonSendForm = $('#sign_in_submit');

buttonSendFormChangeState();

inputEmail.on("input", buttonSendFormChangeState);
inputPassword.on("input", buttonSendFormChangeState);

function buttonSendFormChangeState() {
    let isInputFilled = inputEmail.val().length > 0 && inputPassword.val().length > 0;

    buttonSendForm.toggleClass('filled', isInputFilled);
    buttonSendForm.toggleClass('empty', !isInputFilled);
}