let inputEmail = $('#sign_up_email');
let inputPassword = $('#sign_up_plainPassword');
let buttonSendForm = $('#sign_up_submit');

buttonSendFormChangeState();

inputEmail.on("input", buttonSendFormChangeState);
inputPassword.on("input", buttonSendFormChangeState);

function buttonSendFormChangeState() {
    let isInputFilled = inputEmail.val().length > 0 && inputPassword.val().length > 0;

    buttonSendForm.toggleClass('filled', isInputFilled);
    buttonSendForm.toggleClass('empty', !isInputFilled);
}