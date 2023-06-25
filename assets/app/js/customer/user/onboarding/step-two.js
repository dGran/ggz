let inputBirthdate = $('#on_boarding_step_two_birthdate');
let inputTermsAndConditions = $('#on_boarding_step_two_terms_and_conditions');
let inputPolicyPrivacy = $('#on_boarding_step_two_policy_privacy');
let inputOfficialItems = $('#on_boarding_step_two_official_items');
let buttonSendForm = $('#on_boarding_step_two_submit');
let acceptAll = $('#accept_all');

toggleButtonSendForm();

inputBirthdate.on("input", toggleButtonSendForm);
inputTermsAndConditions.on("change", toggleButtonSendForm);
inputPolicyPrivacy.on("change", toggleButtonSendForm);
inputOfficialItems.on("change", toggleButtonSendForm);
acceptAll.on("click", function() {
    markAllCheckboxes();
    toggleButtonSendForm();
});

function toggleButtonSendForm() {
    let isInputFilled = inputBirthdate.val().length > 0 && inputTermsAndConditions.is(':checked') && inputPolicyPrivacy.is(':checked') && inputOfficialItems.is(':checked');
    console.log(isInputFilled);

    buttonSendForm.toggleClass('filled', isInputFilled);
    buttonSendForm.toggleClass('empty', !isInputFilled);
}

function markAllCheckboxes() {
    $('input[type="checkbox"]').prop('checked', true);
}