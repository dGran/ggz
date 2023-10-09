document.addEventListener('DOMContentLoaded', () => {
    const profilePicInput = $('#on_boarding_step_three_profilePic');

    $('#profile-pic-img, #add-profile-pic-btn').click(function() {
        profilePicInput.click();
    });

    profilePicInput.change(function() {
        let allowedExtensions = ['jpeg', 'jpg', 'png', 'tiff', 'webp'];
        let maxFileSize = 40 * 1024 * 1024; // 40 MB en bytes
        // let profilePicInput = $(this);
        let file = $(this).prop('files')[0];
        let fileName = file.name.toLowerCase();
        let fileSize = file.size;
        let fileExtension = file.extension;

        if (allowedExtensions.indexOf(fileName) === -1) {
            alert('Please select a file with an allowed extension.');
            $(this).value = '';

            return false;
        }

        if (fileSize > maxFileSize) {
            alert('File size must be 40 MB or less.');
            $(this).value = '';

            return false;
        }

        // let file = $(this).prop('files')[0];
        let reader = new FileReader();

        reader.onload = function(e) {
            $('#profile-pic-img img')
                .attr('src', e.target.result)
                .addClass('w-full h-full rounded-full object-cover');
        };

        reader.readAsDataURL(file);

    });

    function validateImage() {
        let allowedExtensions = ['jpeg', 'jpg', 'png', 'tiff', 'webp'];
        let maxFileSize = 40 * 1024 * 1024; // 40 MB en bytes
        // let profilePicInput = this;
        let fileName = profilePicInput.value.split('.').pop().toLowerCase();
        let fileSize = profilePicInput.files[0].size;

        if (allowedExtensions.indexOf(fileName) === -1) {
            alert('Please select a file with an allowed extension.');
            profilePicInput.value = '';

            return false;
        }

        if (fileSize > maxFileSize) {
            alert('File size must be 40 MB or less.');
            profilePicInput.value = '';

            return false;
        }

        return true;
    }
});