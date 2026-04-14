<?php
/**
 * PengaduanController
 * Mengelola pengaduan siswa
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/InputAspirasi.php';
require_once __DIR__ . '/../models/Aspirasi.php';
require_once __DIR__ . '/../models/Kategori.php';

class PengaduanController extends Controller {
    private $inputAspirasiModel;
    private $aspirasiModel;
    private $kategoriModel;
    
    public function __construct() {
        $this->inputAspirasiModel = new InputAspirasi();
        $this->aspirasiModel = new Aspirasi();
        $this->kategoriModel = new Kategori();
    }
    
    /**
     * Daftar pengaduan siswa dengan filter status
     */
    public function index() {
        $this->requireLogin('siswa');
        
        $nis = $_SESSION['siswa_nis'];
        $statusFilter = $_GET['status'] ?? '';
        
        // Filter berdasarkan status jika ada
        if ($statusFilter && in_array($statusFilter, ['Menunggu', 'Proses', 'Selesai'])) {
            $pengaduan = $this->inputAspirasiModel->getByNisAndStatus($nis, $statusFilter);
        } else {
            $pengaduan = $this->inputAspirasiModel->getByNis($nis);
        }
        
        // Statistik untuk dashboard
        $totalPengaduan = $this->inputAspirasiModel->countByNis($nis);
        $totalMenunggu = $this->inputAspirasiModel->countByNisAndStatus($nis, 'Menunggu');
        $totalProses = $this->inputAspirasiModel->countByNisAndStatus($nis, 'Proses');
        $totalSelesai = $this->inputAspirasiModel->countByNisAndStatus($nis, 'Selesai');
        
        $flash = $this->getFlash();
        
        $this->view('pengaduan/index', [
            'pengaduan' => $pengaduan,
            'flash' => $flash,
            'statusFilter' => $statusFilter,
            'totalPengaduan' => $totalPengaduan,
            'totalMenunggu' => $totalMenunggu,
            'totalProses' => $totalProses,
            'totalSelesai' => $totalSelesai
        ]);
    }
    
    /**
     * Form buat pengaduan baru
     */
    public function create() {
        $this->requireLogin('siswa');
        
        $kategori = $this->kategoriModel->getAll();
        $flash = $this->getFlash();
        
        $this->view('pengaduan/create', [
            'kategori' => $kategori,
            'flash' => $flash
        ]);
    }
    
    /**
     * Simpan pengaduan baru
     */
    public function store() {
        $this->requireLogin('siswa');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nis = $_SESSION['siswa_nis'];
            $idKategori = $_POST['id_kategori'] ?? '';
            $lokasi = $_POST['lokasi'] ?? '';
            $ket = $_POST['ket'] ?? '';
            $prioritas = $_POST['prioritas'] ?? 'Sedang';
            
            // Validasi
            if (empty($idKategori) || empty($lokasi) || empty($ket)) {
                $this->setFlash('error', 'Semua field harus diisi');
                $this->redirect('?page=pengaduan-create');
                return;
            }
            
            // Simpan input aspirasi
            $idPelaporan = $this->inputAspirasiModel->create($nis, $idKategori, $lokasi, $ket);
            
            // Buat record aspirasi untuk tracking status
            if ($idPelaporan) {
                $this->aspirasiModel->create($idPelaporan, $idKategori, 'Menunggu', $prioritas);
            }
            
            $this->setFlash('success', 'Pengaduan berhasil dikirim!');
            $this->redirect('?page=pengaduan');
        }
    }
    
    /**
     * Detail pengaduan
     */
    public function show($id) {
        $this->requireLogin('siswa');
        
        $pengaduan = $this->inputAspirasiModel->getDetail($id);
        
        // Pastikan pengaduan milik siswa yang login
        if (!$pengaduan || $pengaduan['nis'] != $_SESSION['siswa_nis']) {
            $this->setFlash('error', 'Pengaduan tidak ditemukan');
            $this->redirect('?page=pengaduan');
            return;
        }
        
        $this->view('pengaduan/show', [
            'pengaduan' => $pengaduan
        ]);
    }
}
