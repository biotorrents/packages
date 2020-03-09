<?php

# Line 255
if (empty($TwoFactor) || $TwoFA->verifyCode($TwoFactor, $_POST['twofa'])) {
    # todo: Make sure the type is (int)
    if ($Enabled === '1') {
# Line 257

# Line 399
// Save the username in a cookie for the disabled page
setcookie('username', db_string($_POST['username']), time() + 60 * 60, '/', '', false);
header('Location: login.php?action=disabled');
# todo: Make sure the type is (int)
} elseif ($Enabled === '0') {
    $Err = 'Your account has not been confirmed.<br />Please check your email.';
# Line 404
