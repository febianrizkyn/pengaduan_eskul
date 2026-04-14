<?php
/**
 * KategoriController
 * Mengelola kategori pengaduan
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Kategori.php';

class KategoriController extends Controller {
    private $kategoriModel;
    
    public function __construct() {
        $this->kategoriModel = new Kategori();
    }
    
    /**
     * Daftar kategori
     */
    public function index() {
        $this->requireLogin('admin');
        
        $kategori = $this->kategoriModel->getAll();
        $flash = $this->getFlash();
        
        $this->view('admin/kategori', [
            'kategori' => $kategori,
            'flash' => $flash
        ]);
    }
    
    /**
     * Simpan kategori baru
     */
    public function store() {
        $this->requireLogin('admin');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ketKategori = $_POST['ket_kategori'] ?? '';
            
            if (empty($ketKategori)) {
                $this->setFlash('error', 'Nama kategori tidak boleh kosong');
                $this->redirect('?page=kategori');
                return;
            }
            
            // Cek duplikat nama kategori
            if ($this->kategoriModel->existsByName($ketKategori)) {
                $this->setFlash('error', 'Kategori "' . htmlspecialchars($ketKategori) . '" sudah tersedia');
                $this->redirect('?page=kategori');
                return;
            }
            
            $this->kategoriModel->create($ketKategori);
            $this->setFlash('success', 'Kategori berhasil ditambahkan');
            $this->redirect('?page=kategori');
        }
    }
    

    
    /**
     * Hapus kategori
     */
    public function delete() {
        $this->requireLogin('admin');
        
        $id = $_GET['id'] ?? '';
        
        if (empty($id)) {
            $this->setFlash('error', 'ID kategori tidak ditemukan');
            $this->redirect('?page=kategori');
            return;
        }
        try {
            $this->kategoriModel->delete($id);
            $this->setFlash('success', 'Kategori berhasil dihapus');
        } catch (Exception $e) {
            $this->setFlash('error', 'Kategori gagal dihapus (kategori masih digunakan pada data pengaduan)');
        }
        $this->redirect('?page=kategori');
    }
}
