document.addEventListener('DOMContentLoaded', () => {
    const $resendVerifyEmail = $('#resend-verify-email');

    $resendVerifyEmail.on('click', function() {
        resendVerifyEmail();
    });

    function resendVerifyEmail() {
        const resendVerifyEmailUrl = $resendVerifyEmail.data('url');

        $.ajax({
            type: 'POST',
            url: resendVerifyEmailUrl,
            success: function(response) {
                console.log('resend email confirmation, check your email account');
            },
            error: function() {
                console.log('ERROR resend email confirmation, check your email account');
            }
        });
    }
});