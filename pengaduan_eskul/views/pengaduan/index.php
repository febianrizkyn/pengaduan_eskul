<?php
/**
 * Halaman Daftar Pengaduan Siswa
 * Fitur: Status tracking, histori, feedback, progres perbaikan
 */
$pageTitle = 'Pengaduan Saya - ' . APP_NAME;
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
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title mb-0">
            <i class="bi bi-list-check me-2"></i>Pengaduan Saya
        </h2>
        <a href="<?= BASE_URL ?>?page=pengaduan-create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan Baru
        </a>
    </div>
    
    <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : $flash['type'] ?> alert-dismissible fade show" role="alert">
            <i class="bi bi-<?= $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle' ?> me-2"></i>
            <?= $flash['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <!-- ============================================ -->
    <!-- RINGKASAN STATUS PENGADUAN (Dashboard Cards) -->
    <!-- ============================================ -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-primary" style="cursor:pointer;" onclick="window.location='<?= BASE_URL ?>?page=pengaduan'" id="stat-total">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1"><?= $totalPengaduan ?></h3>
                        <p class="mb-0 small">Total Pengaduan</p>
                    </div>
                    <i class="bi bi-inbox-fill" style="font-size: 2rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-warning" style="cursor:pointer;" onclick="window.location='<?= BASE_URL ?>?page=pengaduan&status=Menunggu'" id="stat-menunggu">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1"><?= $totalMenunggu ?></h3>
                        <p class="mb-0 small">Menunggu</p>
                    </div>
                    <i class="bi bi-hourglass-split" style="font-size: 2rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-info" style="cursor:pointer;" onclick="window.location='<?= BASE_URL ?>?page=pengaduan&status=Proses'" id="stat-proses">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1"><?= $totalProses ?></h3>
                        <p class="mb-0 small">Sedang Diproses</p>
                    </div>
                    <i class="bi bi-gear-fill" style="font-size: 2rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-success" style="cursor:pointer;" onclick="window.location='<?= BASE_URL ?>?page=pengaduan&status=Selesai'" id="stat-selesai">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1"><?= $totalSelesai ?></h3>
                        <p class="mb-0 small">Selesai</p>
                    </div>
                    <i class="bi bi-check-circle-fill" style="font-size: 2rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================ -->
    <!-- FILTER TAB STATUS                            -->
    <!-- ============================================ -->
    <div class="card mb-4">
        <div class="card-body p-2">
            <ul class="nav nav-pills nav-fill" id="statusTabs">
                <li class="nav-item">
                    <a class="nav-link <?= empty($statusFilter) ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=pengaduan">
                        <i class="bi bi-grid-fill me-1"></i>Semua
                        <span class="badge bg-white text-dark ms-1"><?= $totalPengaduan ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $statusFilter === 'Menunggu' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=pengaduan&status=Menunggu">
                        <i class="bi bi-hourglass-split me-1"></i>Menunggu
                        <span class="badge bg-white text-dark ms-1"><?= $totalMenunggu ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $statusFilter === 'Proses' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=pengaduan&status=Proses">
                        <i class="bi bi-gear-fill me-1"></i>Proses
                        <span class="badge bg-white text-dark ms-1"><?= $totalProses ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $statusFilter === 'Selesai' ? 'active' : '' ?>" href="<?= BASE_URL ?>?page=pengaduan&status=Selesai">
                        <i class="bi bi-check-circle-fill me-1"></i>Selesai
                        <span class="badge bg-white text-dark ms-1"><?= $totalSelesai ?></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- ============================================ -->
    <!-- DAFTAR PENGADUAN                             -->
    <!-- ============================================ -->
    <?php if (empty($pengaduan)): ?>
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                <?php if (!empty($statusFilter)): ?>
                    <h4 class="text-muted">Tidak Ada Pengaduan "<?= htmlspecialchars($statusFilter) ?>"</h4>
                    <p class="text-muted mb-4">Belum ada pengaduan dengan status <strong><?= htmlspecialchars($statusFilter) ?></strong>.</p>
                    <a href="<?= BASE_URL ?>?page=pengaduan" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Lihat Semua Pengaduan
                    </a>
                <?php else: ?>
                    <h4 class="text-muted">Belum Ada Pengaduan</h4>
                    <p class="text-muted mb-4">Anda belum pernah membuat pengaduan. Klik tombol di bawah untuk membuat pengaduan baru.</p>
                    <a href="<?= BASE_URL ?>?page=pengaduan-create" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan Pertama
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($pengaduan as $item): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 hover-lift pengaduan-card" 
                         style="cursor:pointer;" 
                         onclick="window.location='<?= BASE_URL ?>?page=pengaduan-detail&id=<?= $item['id_pelaporan'] ?>'">
                        <div class="card-body">
                            <!-- Header: Kategori & Status -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-secondary"><?= htmlspecialchars($item['ket_kategori'] ?? 'Umum') ?></span>
                                <?php
                                    $statusClass = 'badge-menunggu';
                                    $statusIcon = 'bi-hourglass-split';
                                    if ($item['status'] === 'Proses') { $statusClass = 'badge-proses'; $statusIcon = 'bi-gear-fill'; }
                                    if ($item['status'] === 'Selesai') { $statusClass = 'badge-selesai'; $statusIcon = 'bi-check-circle-fill'; }
                                ?>
                                <span class="badge badge-status <?= $statusClass ?>">
                                    <i class="bi <?= $statusIcon ?> me-1"></i>
                                    <?= htmlspecialchars($item['status'] ?? 'Menunggu') ?>
                                </span>
                            </div>
                            
                            <!-- Lokasi -->
                            <h5 class="card-title">
                                <i class="bi bi-geo-alt text-primary me-1"></i>
                                <?= htmlspecialchars($item['lokasi']) ?>
                            </h5>
                            
                            <!-- Keterangan -->
                            <p class="card-text text-muted">
                                <?= htmlspecialchars(substr($item['ket'], 0, 100)) ?>
                                <?= strlen($item['ket']) > 100 ? '...' : '' ?>
                            </p>
                            
                            <!-- ============================================ -->
                            <!-- PROGRESS BAR PENYELESAIAN                    -->
                            <!-- ============================================ -->
                            <?php
                                $progressPercent = 0;
                                $progressColor = 'warning';
                                $progressLabel = 'Menunggu Ditinjau';
                                if ($item['status'] === 'Menunggu') { $progressPercent = 25; $progressColor = 'warning'; $progressLabel = 'Menunggu Ditinjau'; }
                                if ($item['status'] === 'Proses') { $progressPercent = 60; $progressColor = 'info'; $progressLabel = 'Sedang Diperbaiki'; }
                                if ($item['status'] === 'Selesai') { $progressPercent = 100; $progressColor = 'success'; $progressLabel = 'Selesai'; }
                            ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted fw-semibold">Progres Perbaikan</small>
                                    <small class="text-<?= $progressColor ?> fw-bold"><?= $progressPercent ?>%</small>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 3px;">
                                    <div class="progress-bar bg-<?= $progressColor ?> <?= $progressPercent < 100 ? 'progress-bar-striped progress-bar-animated' : '' ?>" 
                                         role="progressbar" 
                                         style="width: <?= $progressPercent ?>%;" 
                                         aria-valuenow="<?= $progressPercent ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted"><?= $progressLabel ?></small>
                            </div>
                            
                            <!-- Info bawah: Tanggal & Prioritas -->
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    <?= date('d M Y', strtotime($item['tgl_lapor'])) ?>
                                </small>
                                
                                <?php if (!empty($item['prioritas'])): ?>
                                    <span class="priority-<?= strtolower($item['prioritas']) ?>">
                                        <i class="bi bi-flag-fill me-1"></i><?= $item['prioritas'] ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- ============================================ -->
                            <!-- FEEDBACK PREVIEW                             -->
                            <!-- ============================================ -->
                            <?php if (!empty($item['feedback'])): ?>
                                <hr>
                                <div class="feedback-preview">
                                    <small class="fw-semibold text-success">
                                        <i class="bi bi-chat-dots me-1"></i>Feedback Admin:
                                    </small>
                                    <p class="mb-0 small text-muted mt-1">
                                        <?= htmlspecialchars(substr($item['feedback'], 0, 80)) ?>
                                        <?= strlen($item['feedback']) > 80 ? '...' : '' ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Card Footer: Lihat Detail -->
                        <div class="card-footer bg-transparent border-top-0 text-center pb-3">
                            <span class="btn btn-sm btn-outline-primary w-100">
                                <i class="bi bi-eye me-1"></i>Lihat Detail & Progres
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    /* Tab navigation styling */
    #statusTabs .nav-link {
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-weight: 600;
        color: #64748b;
        transition: all 0.3s;
    }
    
    #statusTabs .nav-link:hover {
        background: #f1f5f9;
        color: var(--primary-color);
    }
    
    #statusTabs .nav-link.active {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light, #f97316) 100%);
        color: white;
    }
    
    #statusTabs .nav-link.active .badge {
        background: rgba(255,255,255,0.25) !important;
        color: white !important;
    }
    
    /* Stat card hover */
    .stat-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    /* Pengaduan card interaction */
    .pengaduan-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .pengaduan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }
    
    .pengaduan-card:hover .btn-outline-primary {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
    
    /* Feedback preview styling */
    .feedback-preview {
        background: #f0fdf4;
        padding: 0.75rem;
        border-radius: 10px;
        border-left: 3px solid var(--success-color);
    }
    
    /* Progress bar smooth animation */
    .progress-bar {
        transition: width 1s ease-in-out;
    }
    
    .progress {
        background: #e2e8f0;
    }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
