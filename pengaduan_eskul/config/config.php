<?php
// Konfigurasi Database (INFINITYFREE)
define('DB_HOST', 'sql302.infinityfree.com'); // ganti dari panel
define('DB_NAME', 'if0_41633979_db_pengaduan_eskul');    // nama database lu
define('DB_USER', 'if0_41633979');            // username
define('DB_PASS', 'Susuayam123');             // password database

// Konfigurasi Aplikasi
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$domain = $_SERVER['HTTP_HOST'];
$dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$dir = $dir === '/' ? '' : $dir;
define('BASE_URL', $protocol . "://" . $domain . $dir . "/");

define('APP_NAME', 'Sistem Pengaduan Ekstrakulikuler');

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}