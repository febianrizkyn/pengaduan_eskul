<?php
/**
 * Model Admin
 * Mengelola data admin
 */

require_once __DIR__ . '/Model.php';

class Admin extends Model {
    protected $table = 'admin';
    protected $primaryKey = 'username';
    
    /**
     * Mengambil admin berdasarkan username
     * @param string $username
     * @return array|false
     */
    public function getByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    
    /**
     * Verifikasi password admin
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function verifyPassword($username, $password) {
        $admin = $this->getByUsername($username);
        if ($admin) {
            // Cek apakah password di-hash atau plain text
            if (password_verify($password, $admin['password'])) {
                return true;
            }
            // Fallback untuk password plain text (development)
            return $admin['password'] === $password;
        }
        return false;
    }
    
    /**
     * Membuat admin baru
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function create($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $hashedPassword]);
    }
}
