<?php

declare(strict_types=1);

function landing_nms_href(string $path): string
{
    $base = rtrim(trim((string)(getenv('LANDING_NMS_BASE_URL') ?: '/NMS')), '/');
    return $base . '/' . ltrim($path, '/');
}

function landing_start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) return;
    session_name('LANDING_SESSION');
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.use_trans_sid', '0');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'secure' => getenv('LANDING_SECURE_COOKIE') !== '0',
        'samesite' => 'Lax',
    ]);
    session_start();
}
