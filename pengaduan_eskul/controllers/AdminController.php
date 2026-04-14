<?php
/**
 * AdminController
 * Mengelola fitur-fitur admin
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/InputAspirasi.php';
require_once __DIR__ . '/../models/Aspirasi.php';
require_once __DIR__ . '/../models/Kategori.php';
require_once __DIR__ . '/../models/Siswa.php';

class AdminController extends Controller {
    private $inputAspirasiModel;
    private $aspirasiModel;
    private $kategoriModel;
    private $siswaModel;
    
    public function __construct() {
        $this->inputAspirasiModel = new InputAspirasi();
        $this->aspirasiModel = new Aspirasi();
        $this->kategoriModel = new Kategori();
        $this->siswaModel = new Siswa();
    }
    
    /**
     * Dashboard admin
     */
    public function dashboard() {
        $this->requireLogin('admin');
        
        // Statistik
        $totalPengaduan = $this->inputAspirasiModel->count();
        $menunggu = $this->aspirasiModel->countByStatus('Menunggu');
        $proses = $this->aspirasiModel->countByStatus('Proses');
        $selesai = $this->aspirasiModel->countByStatus('Selesai');
        $totalSiswa = $this->siswaModel->count();
        $totalKategori = $this->kategoriModel->count();
        
        // Pengaduan terbaru
        $pengaduanTerbaru = $this->inputAspirasiModel->getAllWithKategori();
        $pengaduanTerbaru = array_slice($pengaduanTerbaru, 0, 5);
        
        $flash = $this->getFlash();
        
        $this->view('admin/dashboard', [
            'totalPengaduan' => $totalPengaduan,
            'menunggu' => $menunggu,
            'proses' => $proses,
            'selesai' => $selesai,
            'totalSiswa' => $totalSiswa,
            'totalKategori' => $totalKategori,
            'pengaduanTerbaru' => $pengaduanTerbaru,
            'flash' => $flash
        ]);
    }
    
    /**
     * Kelola aspirasi
     */
    public function aspirasi() {
        $this->requireLogin('admin');
        
        $statusFilter = $_GET['status'] ?? '';
        
        if ($statusFilter && in_array($statusFilter, ['Menunggu', 'Proses'])) {
            $aspirasi = $this->aspirasiModel->getByStatus($statusFilter);
        } else {
            // Tampilkan semua kecuali Selesai (Selesai hanya di History)
            $aspirasi = $this->aspirasiModel->getAllExcludingStatus('Selesai');
        }
        
        $flash = $this->getFlash();
        
        $this->view('admin/aspirasi', [
            'aspirasi' => $aspirasi,
            'statusFilter' => $statusFilter,
            'flash' => $flash
        ]);
    }
    
    /**
     * Update status aspirasi
     */
    public function updateStatus() {
        $this->requireLogin('admin');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_aspirasi'] ?? '';
            $status = $_POST['status'] ?? '';
            $feedback = $_POST['feedback'] ?? '';
            
            if (empty($id) || empty($status)) {
                $this->setFlash('error', 'Data tidak lengkap');
                $this->redirect('?page=aspirasi');
                return;
            }
            
            $username = $_SESSION['admin_username'];
            $this->aspirasiModel->updateStatus($id, $status, $username);
            
            if (!empty($feedback)) {
                $this->aspirasiModel->addFeedback($id, $feedback);
            }
            
            $this->setFlash('success', 'Status aspirasi berhasil diupdate');
            $this->redirect('?page=aspirasi');
        }
    }
    
    /**
     * Arsipkan aspirasi (pindahkan ke history)
     */
    public function archiveAspirasi() {
        $this->requireLogin('admin');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_aspirasi'] ?? '';
            $feedback = $_POST['feedback'] ?? '';
            
            if (empty($id)) {
                $this->setFlash('error', 'Data tidak lengkap');
                $this->redirect('?page=aspirasi');
                return;
            }
            
            $username = $_SESSION['admin_username'];
            $result = $this->aspirasiModel->archive($id, $username, $feedback ?: null);
            
            if ($result) {
                $this->setFlash('success', 'Aspirasi #' . $id . ' berhasil diarsipkan');
            } else {
                $this->setFlash('error', 'Gagal mengarsipkan aspirasi');
            }
            
            $this->redirect('?page=aspirasi');
        }
    }
    
    /**
     * Detail aspirasi
     */
    public function showAspirasi($id) {
        $this->requireLogin('admin');
        
        $pengaduan = $this->inputAspirasiModel->getDetail($id);
        
        if (!$pengaduan) {
            $this->setFlash('error', 'Aspirasi tidak ditemukan');
            $this->redirect('?page=aspirasi');
            return;
        }
        
        $this->view('admin/aspirasi_detail', [
            'pengaduan' => $pengaduan
        ]);
    }
    
    /**
     * History / Arsip Pengaduan
     */
    public function history() {
        $this->requireLogin('admin');
        
        // Hanya tampilkan yang sudah Selesai (arsip)
        $pengaduan = $this->aspirasiModel->getByStatus('Selesai');
        
        $flash = $this->getFlash();
        
        $this->view('admin/history', [
            'pengaduan' => $pengaduan,
            'flash' => $flash
        ]);
    }
}
