<?php

# Line 58
$Properties['Container'] = (isset($_POST['container']) && $_POST['container'] !== '---') ? $_POST['container'] : '';
$Properties['Archive'] = (isset($_POST['archive']) && $_POST['archive'] !== '---') ? $_POST['archive'] : '';
# Line 59

# Line 294
$T['Container'] = $Properties['Container'];
$T['Archive'] = $Properties['Archive'];

//******************************************************************************//
//--------------- Autofill format and archive ----------------------------------//

# Load FileList in lieu of $Tor object
# todo: Format the output for  $Validate->ParseExtensions()
#var_dump($T['FileList']);

# Disable the extension parser for edits
# todo: Make this work with $T['FileList']
if ($T['Container'] === 'Autofill'
 || $T['Archive'] === 'Autofill') {
    $Err = 'Extension parsing is only possible for new uploads';
    error($Err);
}
# Line 310
