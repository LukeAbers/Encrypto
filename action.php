<?php 
// Get Post values from AJAX
$privateKey = $_POST['privateKey'];
$encrypted = $_POST['eMsg'];

// Modify private key for use with PHP
$piKey = openssl_pkey_get_private($privateKey, "PassPhrase");

// Decrypt message
$decrypted = "";
openssl_private_decrypt(base64_decode($encrypted), $decrypted, $piKey);

// Return decrypted message
echo $decrypted;
?>