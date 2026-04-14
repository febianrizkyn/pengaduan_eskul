<?php
/**
 * Model Aspirasi
 * Mengelola data aspirasi/pengaduan yang telah diproses
 */

require_once __DIR__ . '/Model.php';

class Aspirasi extends Model {
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    
    /**
     * Mengambil semua aspirasi dengan join kategori dan admin
     * @return array
     */
    public function getAllWithDetails() {
        $sql = "SELECT a.*, k.ket_kategori, i.nis, i.lokasi, i.ket, i.tgl_lapor
                FROM {$this->table} a
                LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                LEFT JOIN input_aspirasi i ON a.id_aspirasi = i.id_pelaporan
                ORDER BY a.id_aspirasi DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Mengambil semua aspirasi kecuali status tertentu
     * @param string $excludeStatus
     * @return array
     */
    public function getAllExcludingStatus($excludeStatus) {
        $sql = "SELECT a.*, k.ket_kategori, i.nis, i.lokasi, i.ket, i.tgl_lapor
                FROM {$this->table} a
                LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                LEFT JOIN input_aspirasi i ON a.id_aspirasi = i.id_pelaporan
                WHERE a.status != ?
                ORDER BY a.id_aspirasi DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$excludeStatus]);
        return $stmt->fetchAll();
    }
    
    /**
     * Mengambil aspirasi berdasarkan status
     * @param string $status
     * @return array
     */
    public function getByStatus($status) {
        $sql = "SELECT a.*, k.ket_kategori, i.nis, i.lokasi, i.ket, i.tgl_lapor
                FROM {$this->table} a
                LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                LEFT JOIN input_aspirasi i ON a.id_aspirasi = i.id_pelaporan
                WHERE a.status = ?
                ORDER BY a.id_aspirasi DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    }
    
    /**
     * Membuat aspirasi baru
     * @param int $idPelaporan - ID dari input_aspirasi agar data sinkron
     * @param int $idKategori
     * @param string $status
     * @param string $prioritas
     * @return int Last insert ID
     */
    public function create($idPelaporan, $idKategori, $status = 'Menunggu', $prioritas = 'Sedang') {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (id_aspirasi, status, prioritas, id_kategori) VALUES (?, ?, ?, ?)");
        $stmt->execute([$idPelaporan, $status, $prioritas, $idKategori]);
        return $this->db->lastInsertId();
    }
    
    /**
     * Update status aspirasi
     * @param int $id
     * @param string $status
     * @param string $usernameAdmin
     * @return bool
     */
    public function updateStatus($id, $status, $usernameAdmin = null) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = ?, username_admin = ? WHERE id_aspirasi = ?");
        return $stmt->execute([$status, $usernameAdmin, $id]);
    }
    
    /**
     * Update prioritas aspirasi
     * @param int $id
     * @param string $prioritas
     * @return bool
     */
    public function updatePrioritas($id, $prioritas) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET prioritas = ? WHERE id_aspirasi = ?");
        return $stmt->execute([$prioritas, $id]);
    }
    
    /**
     * Menambah feedback
     * @param int $id
     * @param string $feedback
     * @return bool
     */
    public function addFeedback($id, $feedback) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET feedback = ? WHERE id_aspirasi = ?");
        return $stmt->execute([$feedback, $id]);
    }
    
    /**
     * Arsipkan aspirasi (set status Selesai)
     * @param int $id
     * @param string $usernameAdmin
     * @param string $feedback
     * @return bool
     */
    public function archive($id, $usernameAdmin, $feedback = null) {
        if ($feedback) {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'Selesai', username_admin = ?, feedback = ? WHERE id_aspirasi = ?");
            return $stmt->execute([$usernameAdmin, $feedback, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'Selesai', username_admin = ? WHERE id_aspirasi = ?");
            return $stmt->execute([$usernameAdmin, $id]);
        }
    }
    
    /**
     * Menghitung berdasarkan status
     * @param string $status
     * @return int
     */
    public function countByStatus($status) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE status = ?");
        $stmt->execute([$status]);
        $result = $stmt->fetch();
        return $result['total'];
    }
}
