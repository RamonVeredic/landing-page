<?php

declare(strict_types=1);

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/landing.php';
landing_start_session();

$return = static function (string $type, string $message): never {
    $_SESSION['landing_feedback_status'] = ['type' => $type, 'message' => $message];
    header('Location: /#masukan', true, 303);
    exit;
};
$input = static function (string $key): string {
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
};

$token = $input('csrf');
$storedToken = (string)($_SESSION['landing_feedback_csrf'] ?? '');
if ($storedToken === '' || !hash_equals($storedToken, $token)) {
    $return('error', 'Muat ulang lalu kirim kembali.');
}

if ($input('website') !== '') {
    $return('success', 'Terima kasih. Masukan Anda sudah diterima.');
}

$name = $input('name');
$contact = $input('contact');
$subject = $input('subject');
$message = $input('message');
if (mb_strlen($name) < 2 || mb_strlen($name) > 100
    || mb_strlen($contact) > 160 || mb_strlen($subject) < 3
    || mb_strlen($subject) > 160 || mb_strlen($message) < 10
    || mb_strlen($message) > 5000) {
    $return('error', 'Nama, judul, dan isi masukan perlu dilengkapi sesuai batas karakter.');
}

$host = trim((string)getenv('FEEDBACK_DB_HOST'));
$database = trim((string)getenv('FEEDBACK_DB_NAME'));
$user = trim((string)getenv('FEEDBACK_DB_USER'));
$key = rtrim((string)@file_get_contents('/run/secrets/feedback_ip_hash_key'), "\r\n");
$password = rtrim((string)@file_get_contents('/run/secrets/feedback_db_password'), "\r\n");
if ($host === '' || $database === '' || $user === '' || $password === '' || strlen($key) < 32) {
    error_log('Landing feedback: konfigurasi database atau kunci hash belum lengkap.');
    $return('error', 'Masukan belum dapat dikirim. Silakan coba lagi nanti.');
}

try {
    $port = (int)(getenv('FEEDBACK_DB_PORT') ?: 3306);
    if ($port < 1 || $port > 65535) throw new RuntimeException('Port database tidak valid.');
    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $host, $port, $database);
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_TIMEOUT => 3,
    ]);
    $ipHash = hash_hmac('sha256', (string)($_SERVER['REMOTE_ADDR'] ?? ''), $key);
    $rate = $pdo->prepare(
        'SELECT COUNT(*) FROM feedback_messages WHERE sender_ip_hash=:hash AND created_at>=DATE_SUB(NOW(),INTERVAL 10 MINUTE)'
    );
    $rate->execute(['hash' => $ipHash]);
    if ((int)$rate->fetchColumn() >= 5) {
        $return('error', 'Terlalu banyak masukan dikirim. Silakan coba lagi beberapa menit lagi.');
    }
    $insert = $pdo->prepare(
        'INSERT INTO feedback_messages(sender_name,sender_contact,subject,message,sender_ip_hash) '
        . 'VALUES (:name,:contact,:subject,:message,:hash)'
    );
    $insert->execute([
        'name' => $name,
        'contact' => $contact !== '' ? $contact : null,
        'subject' => $subject,
        'message' => $message,
        'hash' => $ipHash,
    ]);
    $_SESSION['landing_feedback_csrf'] = bin2hex(random_bytes(32));
    $return('success', 'Terima kasih. Masukan Anda sudah tersimpan.');
} catch (Throwable $error) {
    error_log('Landing feedback gagal: ' . $error->getMessage());
    $return('error', 'Masukan belum dapat dikirim. Silakan coba lagi nanti.');
}
