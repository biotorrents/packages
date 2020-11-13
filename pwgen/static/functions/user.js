// Line 235

// Generate random passwords
$(document).ready(function() {
    $("#random_password").click(function() {
        $.ajax({
            url: '/sections/user/pwgen.php',
            data: {},
            type: 'post',
            success: function(output) {
                $('#change_password').val(output);
            }
        });
    });
});
