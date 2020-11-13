# List of administrative bugs

A function should run the same no matter how it's (legally) formatted.
Having arbitrary whitespace break things, and using lax equality checks, are bugs.
PHP is notorious for code that relies on edge cases in its abysmal concepts of things being "equal."

This repo contains file paths and snippets that indicate broken code when run through PHP CS Fixer or converted to strict equality.
According to Visual Studio Code with
[only this PHP CS Fixer extension installed](https://marketplace.visualstudio.com/items?itemName=junstyle.php-cs-fixer)
and set to run without arguments.


# Permissions type warning

[`sections/user/edit.php`](sections/user/edit.php) has the snippet in the BioTorrents.de codebase.
The string `$UserID !== $LoggedUser['ID']` also appears here:

- `sections/bookmarks/artists.php`
- `sections/bookmarks/torrents.php`
- `sections/collages/manage_artists_handle.php`
- `sections/collages/manage_handle.php`
- `sections/collages/take_delete.php`
- `sections/requests/take_unfill.php`

`todo:`
Track down the function that creates `$LoggedUser['ID']` and compare it to the `$UserID` variables created in the above scripts.
Should be cast as `(int)` and thoroughly tested against other pages using the object.
