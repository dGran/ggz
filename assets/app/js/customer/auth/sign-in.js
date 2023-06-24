let inputEmail = $('#input-email');
let inputPassword = $('#input-password');
let buttonSendForm = $('#button-send-form');

buttonSendFormChangeState();

inputEmail.on("input", buttonSendFormChangeState);
inputPassword.on("input", buttonSendFormChangeState);

function buttonSendFormChangeState() {
    let isInputFilled = inputEmail.val().length > 0 && inputPassword.val().length > 0;

    buttonSendForm.toggleClass('filled', isInputFilled);
    buttonSendForm.toggleClass('empty', !isInputFilled);
}