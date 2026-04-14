<?php
/**
 * Model Siswa
 * Mengelola data siswa
 */

require_once __DIR__ . '/Model.php';

class Siswa extends Model {
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    
    /**
     * Mengambil siswa berdasarkan NIS
     * @param int $nis
     * @return array|false
     */
    public function getByNis($nis) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE nis = ?");
        $stmt->execute([$nis]);
        return $stmt->fetch();
    }
    
    /**
     * Membuat siswa baru
     * @param int $nis
     * @param string $kelas
     * @return bool
     */
    public function create($nis, $kelas) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (nis, kelas) VALUES (?, ?)");
        return $stmt->execute([$nis, $kelas]);
    }
    
    /**
     * Update kelas siswa
     * @param int $nis
     * @param string $kelas
     * @return bool
     */
    public function updateKelas($nis, $kelas) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET kelas = ? WHERE nis = ?");
        return $stmt->execute([$kelas, $nis]);
    }
    
    /**
     * Mengambil siswa berdasarkan username
     * @param string $username
     * @return array|false
     */
    public function getByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    
    /**
     * Verifikasi password siswa
     * @param string $username
     * @param string $password
     * @return array|false - data siswa jika valid, false jika tidak
     */
    public function verifyPassword($username, $password) {
        $siswa = $this->getByUsername($username);
        if (!$siswa) {
            return false;
        }
        // Cek password (plain text comparison - sesuai data di database)
        if ($siswa['password'] === $password) {
            return $siswa;
        }
        return false;
    }
}
