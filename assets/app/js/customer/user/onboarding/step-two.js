let inputBirthdate = $('#on_boarding_step_two_birthdate');
let inputTermsAndConditions = $('#on_boarding_step_two_terms_and_conditions');
let inputPolicyPrivacy = $('#on_boarding_step_two_policy_privacy');
let inputOfficialItems = $('#on_boarding_step_two_official_items');
let buttonSendForm = $('#on_boarding_step_two_submit');
let acceptAll = $('#accept_all');
let errorClasses = 'border-[#f5989a] focus:border-[#f5989a] hover:border-[#f5989a]';
let initialClasses = 'border-[#6C5D73] focus:border-purpleggz hover:border-purpleggz';

$(document).ready(function () {
    inputBirthdate.on("input", toggleButtonSendForm);
    inputTermsAndConditions.on("change", toggleButtonSendForm);
    inputPolicyPrivacy.on("change", toggleButtonSendForm);
    inputOfficialItems.on("change", toggleButtonSendForm);
    acceptAll.on("click", function () {
        markAllCheckboxes();
        toggleButtonSendForm();
    });

    toggleButtonSendForm();

    function toggleButtonSendForm() {
        let isInputFilled = inputBirthdate.val().length > 0 && inputTermsAndConditions.is(':checked') && inputPolicyPrivacy.is(':checked') && inputOfficialItems.is(':checked');
        let isValidBirthdate = validateDate(inputBirthdate.val());

        if (!isValidBirthdate) {
            inputBirthdate.removeClass(initialClasses);
            inputBirthdate.addClass(errorClasses);
        } else {
            inputBirthdate.removeClass(errorClasses);
            inputBirthdate.addClass(initialClasses);
        }

        buttonSendForm.toggleClass('filled', isInputFilled && isValidBirthdate);
        buttonSendForm.toggleClass('empty', !isInputFilled || !isValidBirthdate);
    }

    function markAllCheckboxes() {
        $('input[type="checkbox"]').prop('checked', true);
    }

    function validateDate() {
        let birthdate = inputBirthdate.val();
        var dateRegex = /^\d{4}-(?:\d{2}-\d{2}|\d{2}-\d{2}-\d{4})$/;

        if (!dateRegex.test(birthdate)) {
            return false;
        }

        let dateSplit = birthdate.split('-');
        let year = parseInt(dateSplit[0], 10);
        let month = parseInt(dateSplit[1], 10);
        let day = parseInt(dateSplit[2], 10);
        let dateObject = new Date(year, month - 1, day);

        return dateObject.getDate() === day &&
            dateObject.getMonth() === month -1 &&
            dateObject.getFullYear() === year;
    }
});