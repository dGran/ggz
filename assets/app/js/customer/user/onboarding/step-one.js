let inputNickname = $('#on_boarding_step_one_nickname');
let buttonSendForm = $('#on_boarding_step_one_submit');

toggleButtonSendForm();

inputNickname.on("input", toggleButtonSendForm);

function toggleButtonSendForm() {
    let isInputFilled = inputNickname.val().length > 0;

    buttonSendForm.toggleClass('filled', isInputFilled);
    buttonSendForm.toggleClass('empty', !isInputFilled);
}