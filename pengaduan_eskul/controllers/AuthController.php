<?php
/**
 * AuthController
 * Mengelola autentikasi siswa dan admin
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Admin.php';

class AuthController extends Controller {
    private $siswaModel;
    private $adminModel;
    
    public function __construct() {
        $this->siswaModel = new Siswa();
        $this->adminModel = new Admin();
    }
    
    /**
     * Halaman login unified (siswa + admin)
     */
    public function login() {
        if ($this->isLoggedIn('siswa')) {
            $this->redirect('?page=pengaduan');
        }
        if ($this->isLoggedIn('admin')) {
            $this->redirect('?page=dashboard');
        }
        
        $flash = $this->getFlash();
        $this->view('auth/login', ['flash' => $flash]);
    }
    
    /**
     * Proses login unified
     * - Coba login sebagai admin dulu
     * - Jika gagal, coba login sebagai siswa
     */
    public function doLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['identifier'] ?? '');
            $password = $_POST['password'] ?? '';
            
            if (empty($username)) {
                $this->setFlash('error', 'Username tidak boleh kosong');
                $this->redirect('?page=login');
                return;
            }
            
            if (empty($password)) {
                $this->setFlash('error', 'Password tidak boleh kosong');
                $this->redirect('?page=login');
                return;
            }
            
            // Coba login sebagai admin
            if ($this->adminModel->verifyPassword($username, $password)) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                
                $this->setFlash('success', 'Login berhasil! Selamat datang, Admin.');
                $this->redirect('?page=dashboard');
                return;
            }
            
            // Coba login sebagai siswa
            $siswa = $this->siswaModel->verifyPassword($username, $password);
            if ($siswa) {
                $_SESSION['siswa_logged_in'] = true;
                $_SESSION['siswa_nis'] = $siswa['nis'];
                $_SESSION['siswa_username'] = $siswa['username'];
                $_SESSION['siswa_nama'] = $siswa['nama_siswa'] ?? $siswa['username'];
                
                $this->setFlash('success', 'Login berhasil! Selamat datang, ' . ($siswa['nama_siswa'] ?? $siswa['username']) . '.');
                $this->redirect('?page=pengaduan');
                return;
            }
            
            // Gagal login
            $this->setFlash('error', 'Username atau password salah');
            $this->redirect('?page=login');
        }
    }
    
    /**
     * Proses login siswa (backward compat)
     */
    public function doLoginSiswa() {
        // Redirect ke unified
        $this->redirect('?page=login');
    }
    
    /**
     * Halaman login admin (redirect ke unified)
     */
    public function loginAdmin() {
        $this->redirect('?page=login');
    }
    
    /**
     * Proses login admin (backward compat)
     */
    public function doLoginAdmin() {
        // Redirect ke unified
        $this->redirect('?page=login');
    }
    
    /**
     * Logout siswa
     */
    public function logoutSiswa() {
        unset($_SESSION['siswa_logged_in']);
        unset($_SESSION['siswa_nis']);
        unset($_SESSION['siswa_username']);
        unset($_SESSION['siswa_nama']);
        unset($_SESSION['siswa_kelas']);
        
        $this->setFlash('success', 'Anda telah logout');
        $this->redirect('?page=login');
    }
    
    /**
     * Logout admin
     */
    public function logoutAdmin() {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_username']);
        
        $this->setFlash('success', 'Anda telah logout');
        $this->redirect('?page=login');
    }
}
