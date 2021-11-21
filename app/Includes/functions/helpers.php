<?php

if (!function_exists('is_https')) {
    function is_https()
    {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on') {
            return true;
        }
        if (!empty($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443) {
            return true;
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
            return true;
        }
        return false;
    }
}

if (!function_exists('js_text')) {
    function js_text($text)
    {
        return str_replace("\r\n", "\\r\\n", $text);
    }
}
