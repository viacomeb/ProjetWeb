<?php
// Fichier : config/security.php

function encryptPage($page) {
    $key = "CESI2025"; // Clé secrète (change-la pour plus de sécurité)
    return urlencode(openssl_encrypt($page, 'AES-128-ECB', $key));
}

function decryptPage($encrypted_page) {
    $key = "CESI2025"; // Même clé que pour le chiffrement
    return openssl_decrypt(urldecode($encrypted_page), 'AES-128-ECB', $key);
}
?>
