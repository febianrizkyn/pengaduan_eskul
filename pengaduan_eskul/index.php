<?php
/**
 * Entry Point - Router Aplikasi
 * Sistem Pengaduan Siswa Ekstrakulikuler
 */

// Load config
require_once __DIR__ . '/config/config.php';

// Load Controllers
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/PengaduanController.php';
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/KategoriController.php';

// Inisialisasi controller
$authController = new AuthController();
$pengaduanController = new PengaduanController();
$adminController = new AdminController();
$kategoriController = new KategoriController();

// Get page and action
$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

// Handle Actions (POST requests)
if ($action) {
    switch ($action) {
        // Auth Actions
        case 'login':
            $authController->doLogin();
            break;
        case 'login-siswa':
            $authController->doLoginSiswa();
            break;
        case 'login-admin':
            $authController->doLoginAdmin();
            break;
        case 'logout-siswa':
            $authController->logoutSiswa();
            break;
        case 'logout-admin':
            $authController->logoutAdmin();
            break;
            
        // Pengaduan Actions
        case 'pengaduan-store':
            $pengaduanController->store();
            break;
            
        // Admin Actions
        case 'update-status':
            $adminController->updateStatus();
            break;
        case 'archive-aspirasi':
            $adminController->archiveAspirasi();
            break;
            
        // Kategori Actions
        case 'kategori-store':
            $kategoriController->store();
            break;
        case 'kategori-update':
            $kategoriController->update();
            break;
        case 'kategori-delete':
            $kategoriController->delete();
            break;
            
        default:
            header("Location: " . BASE_URL);
            exit;
    }
}

// Handle Pages (GET requests)
switch ($page) {
    // Auth Pages
    case 'login':
        $authController->login();
        break;
    case 'login-admin':
        // Redirect ke unified login dengan tab admin
        $authController->loginAdmin();
        break;
        
    // Siswa Pages
    case 'pengaduan':
        $pengaduanController->index();
        break;
    case 'pengaduan-create':
        $pengaduanController->create();
        break;
    case 'pengaduan-detail':
        $pengaduanController->show($id);
        break;
        
    // Admin Pages
    case 'dashboard':
        $adminController->dashboard();
        break;
    case 'aspirasi':
        $adminController->aspirasi();
        break;
    case 'aspirasi-detail':
        $adminController->showAspirasi($id);
        break;
    case 'kategori':
        $kategoriController->index();
        break;
    case 'history':
        $adminController->history();
        break;
        
    default:
        // Redirect to login
        header("Location: " . BASE_URL . "?page=login");
        exit;
}
