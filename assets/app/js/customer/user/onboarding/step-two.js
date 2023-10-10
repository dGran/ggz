document.addEventListener('DOMContentLoaded', () => {
    const $formElements = {
        birthdate: $('#on_boarding_step_two_birthdate'),
        termsAndConditions: $('#on_boarding_step_two_terms_and_conditions'),
        policyPrivacy: $('#on_boarding_step_two_policy_privacy'),
        officialItems: $('#on_boarding_step_two_official_items'),
        buttonSendForm: $('#on_boarding_step_two_submit'),
        acceptAll: $('#accept_all'),
    };

    const inputBirthdateStyles = {
        error: 'border-[#f5989a] focus:border-[#f5989a] hover:border-[#f5989a]',
        initial: 'border-[#6C5D73] focus:border-purpleggz hover:border-purpleggz',
    };
    const inputBirthdateClassMap = {
        'error': inputBirthdateStyles.error,
        'initial': inputBirthdateStyles.initial,
    };

    $formElements.birthdate.on("input change", updateFormState);
    $formElements.termsAndConditions.on("change", updateFormState);
    $formElements.policyPrivacy.on("change", updateFormState);
    $formElements.officialItems.on("change", updateFormState);
    $formElements.acceptAll.on("click", () => {
        markAllCheckboxes();
        updateFormState();
    });

    updateFormState();

    function updateFormState() {
        const birthdateValue = $formElements.birthdate.val();
        const isRequiredChecksMarked = $formElements.termsAndConditions.is(':checked') && $formElements.policyPrivacy.is(':checked') && $formElements.officialItems.is(':checked');
        const isValidBirthdate = validateDate(birthdateValue);

        setClassesToInputBirthdate(isValidBirthdate ? 'initial' : 'error');

        $formElements.buttonSendForm.toggleClass('filled', isRequiredChecksMarked && isValidBirthdate)
            .toggleClass('empty', !isRequiredChecksMarked || !isValidBirthdate);
    }

    function validateDate(birthdate) {
        if (birthdate.length == 0) {
            return true;
        }

        const dateRegex = /^\d{4}-(?:\d{2}-\d{2}|\d{2}-\d{2}-\d{4})$/;

        if (!dateRegex.test(birthdate)) {
            return false;
        }

        const dateSplit = birthdate.split('-');
        const year = parseInt(dateSplit[0], 10);
        const month = parseInt(dateSplit[1], 10);
        const day = parseInt(dateSplit[2], 10);
        const dateObject = new Date(year, month - 1, day);

        return dateObject.getDate() === day && dateObject.getMonth() === month - 1 && dateObject.getFullYear() === year;
    }

    function setClassesToInputBirthdate(classesToSet) {
        $formElements.birthdate.removeClass(inputBirthdateStyles.error + ' ' + inputBirthdateStyles.initial);

        const classToAdd = inputBirthdateClassMap[classesToSet];

        if (classToAdd) {
            $formElements.birthdate.addClass(classToAdd);
        }
    }

    function markAllCheckboxes() {
        $('input[type="checkbox"]').prop('checked', true);
    }
});
