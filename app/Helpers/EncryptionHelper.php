<?php

if (!function_exists('base64url_encode')) {
    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

if (!function_exists('base64url_decode')) {
    function base64url_decode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}

if (!function_exists('encryptPage')) {
    function encryptPage($page) {
        $key = env('APP_ENCRYPTION_KEY', 'CESI2025CESI2025CESI2025CESI2025');
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($page, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return base64url_encode($iv . $encrypted);
    }
}

if (!function_exists('decryptPage')) {
    function decryptPage($encrypted_page) {
        $key = env('APP_ENCRYPTION_KEY', 'CESI2025CESI2025CESI2025CESI2025');
        $data = base64url_decode($encrypted_page);

        if ($data === false || strlen($data) < 16) {
            return null;
        }

        $iv = substr($data, 0, 16);
        $encrypted_text = substr($data, 16);
        return openssl_decrypt($encrypted_text, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    }
}
