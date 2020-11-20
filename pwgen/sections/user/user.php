<?php

# Line 1265
if (check_perms('users_edit_password')) {
?>
<tr>
    <td class="label">New password:</td>
    <td>
      <input type="text" size="30" id="change_password" name="ChangePassword" />
      <button type="button" id="random_password">Generate</button>
    </td>
</tr>
<?php
}
