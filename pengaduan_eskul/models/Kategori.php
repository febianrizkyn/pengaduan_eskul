<?php
/**
 * Model Kategori
 * Mengelola data kategori pengaduan
 */

require_once __DIR__ . '/Model.php';

class Kategori extends Model {
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    
    /**
     * Membuat kategori baru
     * @param string $ketKategori
     * @return bool
     */
    public function create($ketKategori) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (ket_kategori) VALUES (?)");
        return $stmt->execute([$ketKategori]);
    }
    
    /**
     * Cek apakah nama kategori sudah ada
     * @param string $ketKategori
     * @return bool
     */
    public function existsByName($ketKategori) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE LOWER(ket_kategori) = LOWER(?)");
        $stmt->execute([$ketKategori]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }
}
