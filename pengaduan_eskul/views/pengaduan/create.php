<?php
/**
 * Form Buat Pengaduan Baru
 */
$pageTitle = 'Buat Pengaduan - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';
?>

<!-- Navbar Siswa -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand text-white" href="<?= BASE_URL ?>?page=pengaduan">
            <i class="bi bi-megaphone-fill me-2"></i><?= APP_NAME ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link text-white-50">
                        <i class="bi bi-person-circle me-1"></i>
                        <?= $_SESSION['siswa_nama'] ?? $_SESSION['siswa_username'] ?? '' ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= BASE_URL ?>?action=logout-siswa">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Back Button -->
            <a href="<?= BASE_URL ?>?page=pengaduan" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            
            <div class="card">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2" style="color: var(--primary-color);"></i>
                        Buat Pengaduan Baru
                    </h4>
                </div>
                <div class="card-body p-4">
                    <?php if ($flash): ?>
                        <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : $flash['type'] ?> alert-dismissible fade show" role="alert">
                            <?= $flash['message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= BASE_URL ?>?action=pengaduan-store" method="POST">
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label fw-semibold">
                                <i class="bi bi-tag me-1"></i>Kategori Pengaduan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="id_kategori" name="id_kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $kat): ?>
                                    <option value="<?= $kat['id_kategori'] ?>"><?= htmlspecialchars($kat['ket_kategori']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="lokasi" class="form-label fw-semibold">
                                <i class="bi bi-geo-alt me-1"></i>Lokasi Kejadian <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" 
                                   placeholder="Contoh: Ruang OSIS, Lapangan Basket, dll." required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="prioritas" class="form-label fw-semibold">
                                <i class="bi bi-flag me-1"></i>Tingkat Prioritas <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="prioritas" name="prioritas" required>
                                <option value="Rendah">Rendah - Tidak mendesak</option>
                                <option value="Sedang" selected>Sedang - Perlu ditangani</option>
                                <option value="Tinggi">Tinggi - Mendesak</option>
                            </select>
                            <div class="form-text">Pilih prioritas sesuai urgensi pengaduan Anda</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="ket" class="form-label fw-semibold">
                                <i class="bi bi-chat-text me-1"></i>Keterangan / Isi Pengaduan <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="ket" name="ket" rows="5" 
                                      placeholder="Jelaskan secara detail pengaduan atau aspirasi Anda..." required></textarea>
                            <div class="form-text">Jelaskan dengan jelas dan lengkap agar mudah ditindaklanjuti</div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASE_URL ?>?page=pengaduan" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i>Kirim Pengaduan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Tips Card -->
            <div class="card mt-4 border-info">
                <div class="card-body">
                    <h6 class="fw-bold text-info">
                        <i class="bi bi-lightbulb me-2"></i>Tips Membuat Pengaduan
                    </h6>
                    <ul class="mb-0 text-muted small">
                        <li>Pilih kategori yang sesuai agar pengaduan lebih mudah ditangani</li>
                        <li>Jelaskan lokasi kejadian dengan spesifik</li>
                        <li>Berikan keterangan yang jelas, lengkap, dan objektif</li>
                        <li>Gunakan bahasa yang sopan dan santun</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
