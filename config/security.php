<?php

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); // Encode en Base64 URL-safe
}

function base64url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/')); // Décode proprement
}

function encryptPage($page) {
    $key = "CESI2025CESI2025CESI2025CESI2025"; // Clé 32 caractères pour AES-256
    $iv = openssl_random_pseudo_bytes(16); // IV aléatoire 16 bytes

    $encrypted = openssl_encrypt($page, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return base64url_encode($iv . $encrypted); // Encode en Base64 sans /
}

function decryptPage($encrypted_page) {
    $key = "CESI2025CESI2025CESI2025CESI2025"; // Même clé que pour le chiffrement
    $data = base64url_decode($encrypted_page);

    if ($data === false || strlen($data) < 16) {
        return null; // Vérifie que le texte est valide
    }

    $iv = substr($data, 0, 16); // Récupère l'IV
    $encrypted_text = substr($data, 16); // Récupère le texte chiffré

    return openssl_decrypt($encrypted_text, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
}


?>
