<?php

# Line 36
if ($UserID !== $LoggedUser['ID'] && !check_perms('users_edit_profiles', $Class)) {
    error(403);
}
# Line 38
