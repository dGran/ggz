document.addEventListener('DOMContentLoaded', () => {
    const $formElements = {
        profilePicInput: $('#on_boarding_step_three_profilePic'),
        profilePicMaxSizeInfo: $('#profile-pic-max-size-info'),
        profilePicExtensionInfo: $('#profile-pic-extension-info'),
        profilePicPreview: $('#profile-pic-preview'),
        profilePicPreviewImg: $('#profile-pic-preview-img'),
        addProfilePicButton: $('#add-profile-pic-button'),
        shareContentInput: $('#on_boarding_step_three_shareContent'),
        deleteUploadedImageButton: $('#delete-uploaded-image-button'),
        imageNotValidInfo: $('#image-not-valid-info'),
    };

    const profilePicInfoStyles = {
        error: 'text-red-500',
        initial: 'text-gray-600',
    };
    const profilePicInfoClassMap = {
        error: profilePicInfoStyles.error,
        initial: profilePicInfoStyles.initial,
    };
    const imageStyles = {
        uploaded: 'w-full h-full rounded-full object-cover',
        not_loaded: 'h-12 w-12',
    }
    const imageClassMap = {
        uploaded: imageStyles.uploaded,
        not_loaded: imageStyles.not_loaded,
    };

    const maxMegaBytesFileSize = 40;
    const maxFileSize = maxMegaBytesFileSize * 1024 * 1024;
    const allowedExtensions = ['jpeg', 'jpg', 'png', 'webp'];
    const profilePicDefaultImage = $formElements.profilePicPreviewImg.data('profile-pic-default-image');
    const profilePicDefaultImageError = $formElements.profilePicPreviewImg.data('profile-pic-default-image-error');

    $formElements.profilePicInput.on('change', loadImage);
    $formElements.profilePicPreview.add($formElements.addProfilePicButton).on("click", function() {
        $formElements.profilePicInput.click();
    });
    $formElements.deleteUploadedImageButton.on('click', deleteImage);

    function loadImage() {
        const image = $formElements.profilePicInput.prop('files')[0];

        if (!image) {
            return false;
        }

        if (!isValidImage(image)) {
            if (!isValidImageExtension(image)) {
                doInvalidImage($formElements.profilePicExtensionInfo);
            }

            if (!isValidImageSize(image)) {
                doInvalidImage($formElements.profilePicMaxSizeInfo);
            }

            return false;
        }

        doValidImage(image);
    }

    function isValidImage(image) {
        if (!isValidImageExtension(image) || !isValidImageSize(image)) {
            return false;
        }

        return true;
    }

    function doInvalidImage(element) {
        $formElements.profilePicInput.val('');
        $formElements.profilePicPreviewImg.attr('src', profilePicDefaultImageError);
        setStyleToElement(element, profilePicInfoClassMap, 'error');
        setStyleToElement($formElements.profilePicPreviewImg, imageClassMap, 'not_uploaded');

        if ($formElements.deleteUploadedImageButton.hasClass('hidden')) {
            $formElements.deleteUploadedImageButton.removeClass('hidden');
        }

        if ($formElements.imageNotValidInfo.hasClass('hidden')) {
            $formElements.imageNotValidInfo.removeClass('hidden');
        }
    }

    function doValidImage(image) {
        setStyleToElement($formElements.profilePicExtensionInfo, profilePicInfoClassMap, 'initial');
        setStyleToElement($formElements.profilePicMaxSizeInfo, profilePicInfoClassMap, 'initial');

        if ($formElements.deleteUploadedImageButton.hasClass('hidden')) {
            $formElements.deleteUploadedImageButton.removeClass('hidden');
        }

        if (!$formElements.imageNotValidInfo.hasClass('hidden')) {
            $formElements.imageNotValidInfo.addClass('hidden');
        }

        let reader = new FileReader();

        reader.onload = function(e) {
            $formElements.profilePicPreviewImg.attr('src', e.target.result);
            setStyleToElement($formElements.profilePicPreviewImg, imageClassMap, 'uploaded');
        };

        reader.readAsDataURL(image);
    }

    function isValidImageExtension(image) {
        const imageExtension = image.name.split('.').pop().toLowerCase();

        return allowedExtensions.indexOf(imageExtension) !== -1;
    }

    function isValidImageSize(image) {
        const imageSize = image.size;

        return imageSize <= maxFileSize;
    }

    function deleteImage() {
        $formElements.profilePicInput.val('');
        $formElements.profilePicPreviewImg.attr('src', profilePicDefaultImage)
        $formElements.deleteUploadedImageButton.addClass('hidden');
        setStyleToElement($formElements.profilePicExtensionInfo, profilePicInfoClassMap, 'initial');
        setStyleToElement($formElements.profilePicMaxSizeInfo, profilePicInfoClassMap, 'initial');
        setStyleToElement($formElements.profilePicPreviewImg, imageClassMap, 'not_uploaded');

        if (!$formElements.imageNotValidInfo.hasClass('hidden')) {
            $formElements.imageNotValidInfo.addClass('hidden');
        }

    }

    function setStyleToElement($element, classMap, state) {
        const classesToRemove = Object.values(classMap).join(' ');
        const classesToAdd = classMap[state];

        $element.toggleClass(classesToRemove, false).toggleClass(classesToAdd, !!classesToAdd);
    }
});
