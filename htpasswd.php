<?php
// Password to be encrypted for a .htpasswd file
$clearTextPassword = 'topsecret';

// Encrypt password
$password = crypt($clearTextPassword, base64_encode($clearTextPassword));

// Print encrypted password
echo $password;
?>