$(document).ready(function() {
    let profilePicInput = $('#on_boarding_step_three_profilePic');

    $('#profile-pic-img, #add-profile-pic-btn').click(function() {
        profilePicInput.click();
    });

    profilePicInput.change(function() {
        var file = $(this).prop('files')[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#profile-pic-img img')
                .attr('src', e.target.result)
                .addClass('w-full h-full rounded-full object-cover');
        };

        reader.readAsDataURL(file);
    });
});