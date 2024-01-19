document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[id^="tab-"]').forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove the "highlight" class from the previously highlight tab
            document.querySelector('.highlight').classList.remove('highlight');

            // Add the "highlight" class to the clicked tab
            tab.classList.add('highlight');

            // Hide all content sections
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show the content section corresponding to the clicked tab
            const contentId = 'content' + tab.id.slice(3);
            document.getElementById(contentId).classList.remove('hidden');
        });
    });
    document.querySelectorAll('.edit').forEach(editButton => {
        editButton.addEventListener('click', () => {
            const input = editButton.previousElementSibling;
            if (input.disabled) {
                input.disabled = false;
                input.focus();
                editButton.textContent = 'Save';
            } else {
                input.disabled = true;
                editButton.textContent = 'Edit';
                // Save the new value, for example, by sending it to the server using AJAX.
            }
        });
    });
});
