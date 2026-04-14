<?php
/**
 * Model InputAspirasi
 * Mengelola data input pengaduan dari siswa
 */

require_once __DIR__ . '/Model.php';

class InputAspirasi extends Model {
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'id_pelaporan';
    
    /**
     * Mengambil semua pengaduan dengan join kategori
     * @return array
     */
    public function getAllWithKategori() {
        $sql = "SELECT i.*, k.ket_kategori, s.nama_siswa 
                FROM {$this->table} i
                LEFT JOIN kategori k ON i.id_kategori = k.id_kategori
                LEFT JOIN siswa s ON i.nis = s.nis
                ORDER BY i.tgl_lapor DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Mengambil pengaduan berdasarkan NIS siswa
     * @param int $nis
     * @return array
     */
    public function getByNis($nis) {
        $sql = "SELECT i.*, k.ket_kategori, a.status, a.prioritas, a.feedback
                FROM {$this->table} i
                LEFT JOIN kategori k ON i.id_kategori = k.id_kategori
                LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_aspirasi
                WHERE i.nis = ?
                ORDER BY i.tgl_lapor DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nis]);
        return $stmt->fetchAll();
    }
    
    /**
     * Mengambil detail pengaduan
     * @param int $id
     * @return array|false
     */
    public function getDetail($id) {
        $sql = "SELECT i.*, k.ket_kategori, s.nama_siswa, a.status, a.prioritas, a.feedback, a.username_admin
                FROM {$this->table} i
                LEFT JOIN kategori k ON i.id_kategori = k.id_kategori
                LEFT JOIN siswa s ON i.nis = s.nis
                LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_aspirasi
                WHERE i.id_pelaporan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Membuat pengaduan baru
     * @param int $nis
     * @param int $idKategori
     * @param string $lokasi
     * @param string $ket
     * @return int Last insert ID
     */
    public function create($nis, $idKategori, $lokasi, $ket) {
        $tglLapor = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (nis, id_kategori, lokasi, ket, tgl_lapor) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nis, $idKategori, $lokasi, $ket, $tglLapor]);
        return $this->db->lastInsertId();
    }
    
    /**
     * Menghitung pengaduan berdasarkan NIS
     * @param int $nis
     * @return int
     */
    public function countByNis($nis) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE nis = ?");
        $stmt->execute([$nis]);
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    /**
     * Mengambil pengaduan berdasarkan NIS dan Status
     * @param int $nis
     * @param string $status
     * @return array
     */
    public function getByNisAndStatus($nis, $status) {
        $sql = "SELECT i.*, k.ket_kategori, a.status, a.prioritas, a.feedback
                FROM {$this->table} i
                LEFT JOIN kategori k ON i.id_kategori = k.id_kategori
                LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_aspirasi
                WHERE i.nis = ? AND a.status = ?
                ORDER BY i.tgl_lapor DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nis, $status]);
        return $stmt->fetchAll();
    }
    
    /**
     * Menghitung pengaduan berdasarkan NIS dan Status
     * @param int $nis
     * @param string $status
     * @return int
     */
    public function countByNisAndStatus($nis, $status) {
        $sql = "SELECT COUNT(*) as total 
                FROM {$this->table} i
                LEFT JOIN aspirasi a ON i.id_pelaporan = a.id_aspirasi
                WHERE i.nis = ? AND a.status = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nis, $status]);
        $result = $stmt->fetch();
        return $result['total'];
    }
}
