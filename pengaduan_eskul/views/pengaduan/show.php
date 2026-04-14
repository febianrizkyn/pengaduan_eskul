<?php
/**
 * Detail Pengaduan Siswa
 * Fitur: Timeline progres, status penyelesaian, feedback admin
 */
$pageTitle = 'Detail Pengaduan - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';

// Determine status info
$currentStatus = $pengaduan['status'] ?? 'Menunggu';
$statusSteps = [
    'Menunggu' => ['label' => 'Pengaduan Diterima', 'icon' => 'bi-envelope-check-fill', 'color' => '#f59e0b', 'desc' => 'Pengaduan Anda telah diterima dan menunggu untuk ditinjau oleh admin.'],
    'Proses'   => ['label' => 'Sedang Diproses', 'icon' => 'bi-gear-fill', 'color' => '#06b6d4', 'desc' => 'Admin sedang meninjau dan memproses pengaduan Anda.'],
    'Selesai'  => ['label' => 'Selesai', 'icon' => 'bi-check-circle-fill', 'color' => '#10b981', 'desc' => 'Pengaduan telah selesai ditangani.']
];
$statusOrder = ['Menunggu', 'Proses', 'Selesai'];
$currentIndex = array_search($currentStatus, $statusOrder);

// Progress percentage
$progressPercent = 0;
if ($currentStatus === 'Menunggu') $progressPercent = 25;
if ($currentStatus === 'Proses') $progressPercent = 60;
if ($currentStatus === 'Selesai') $progressPercent = 100;
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
        <div class="col-lg-10">
            <!-- Back Button -->
            <a href="<?= BASE_URL ?>?page=pengaduan" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Pengaduan
            </a>
            
            <!-- ============================================ -->
            <!-- STATUS & PROGRESS OVERVIEW CARD              -->
            <!-- ============================================ -->
            <div class="card mb-4 overflow-hidden">
                <?php
                    $headerBg = 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)';
                    if ($currentStatus === 'Proses') $headerBg = 'linear-gradient(135deg, #06b6d4 0%, #0891b2 100%)';
                    if ($currentStatus === 'Selesai') $headerBg = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
                ?>
                <div class="card-header py-4" style="background: <?= $headerBg ?>;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 text-white fw-bold">
                                <i class="bi <?= $statusSteps[$currentStatus]['icon'] ?> me-2"></i>
                                Status: <?= $currentStatus ?>
                            </h4>
                            <p class="mb-0 text-white" style="opacity:0.9;">
                                <?= $statusSteps[$currentStatus]['desc'] ?>
                            </p>
                        </div>
                        <div class="text-end text-white">
                            <div class="display-6 fw-bold"><?= $progressPercent ?>%</div>
                            <small style="opacity:0.8;">Progress</small>
                        </div>
                    </div>
                    <!-- Progress bar di header -->
                    <div class="progress mt-3" style="height: 8px; border-radius: 4px; background: rgba(255,255,255,0.2);">
                        <div class="progress-bar <?= $progressPercent < 100 ? 'progress-bar-striped progress-bar-animated' : '' ?>" 
                             role="progressbar" 
                             style="width: <?= $progressPercent ?>%; background: rgba(255,255,255,0.8);" 
                             aria-valuenow="<?= $progressPercent ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Left Column: Detail & Feedback -->
                <div class="col-lg-7 mb-4">
                    <!-- ============================================ -->
                    <!-- DETAIL PENGADUAN                              -->
                    <!-- ============================================ -->
                    <div class="card mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-file-text me-2" style="color: var(--primary-color);"></i>
                                Detail Pengaduan
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted small d-block">Kategori</label>
                                    <span class="badge bg-secondary fs-6 mt-1">
                                        <i class="bi bi-tag me-1"></i>
                                        <?= htmlspecialchars($pengaduan['ket_kategori']) ?>
                                    </span>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted small d-block">Prioritas</label>
                                    <span class="fw-semibold priority-<?= strtolower($pengaduan['prioritas'] ?? 'sedang') ?> fs-6 mt-1 d-inline-block">
                                        <i class="bi bi-flag-fill me-1"></i><?= $pengaduan['prioritas'] ?? 'Sedang' ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted small d-block">
                                        <i class="bi bi-geo-alt me-1"></i>Lokasi
                                    </label>
                                    <p class="fw-semibold mb-0 mt-1"><?= htmlspecialchars($pengaduan['lokasi']) ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="text-muted small d-block">
                                        <i class="bi bi-calendar me-1"></i>Tanggal Lapor
                                    </label>
                                    <p class="fw-semibold mb-0 mt-1"><?= date('d F Y, H:i', strtotime($pengaduan['tgl_lapor'])) ?></p>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <div class="mb-0">
                                <label class="text-muted small d-block mb-2">
                                    <i class="bi bi-chat-text me-1"></i>Keterangan / Isi Pengaduan
                                </label>
                                <div class="bg-light p-3 rounded-3" style="border-left: 3px solid var(--primary-color);">
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($pengaduan['ket'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ============================================ -->
                    <!-- FEEDBACK DARI ADMIN                           -->
                    <!-- ============================================ -->
                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-chat-dots me-2 text-success"></i>
                                Feedback Admin
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <?php if (!empty($pengaduan['feedback'])): ?>
                                <div class="feedback-box">
                                    <div class="d-flex align-items-start">
                                        <div class="feedback-avatar me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);">
                                                <i class="bi bi-person-fill text-white fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong class="text-dark">
                                                    <?= htmlspecialchars($pengaduan['username_admin'] ?? 'Admin') ?>
                                                </strong>
                                                <span class="badge bg-success bg-opacity-10 text-success">
                                                    <i class="bi bi-check2 me-1"></i>Verified Admin
                                                </span>
                                            </div>
                                            <div class="bg-light p-3 rounded-3" style="border-left: 3px solid var(--success-color);">
                                                <p class="mb-0"><?= nl2br(htmlspecialchars($pengaduan['feedback'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                         style="width: 70px; height: 70px; background: #f1f5f9;">
                                        <i class="bi bi-chat-dots text-muted fs-2"></i>
                                    </div>
                                    <h6 class="text-muted">Belum Ada Feedback</h6>
                                    <p class="text-muted small mb-0">
                                        Admin belum memberikan feedback untuk pengaduan ini.<br>
                                        Feedback akan muncul di sini setelah admin meninjau pengaduan Anda.
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Progress Timeline -->
                <div class="col-lg-5 mb-4">
                    <!-- ============================================ -->
                    <!-- TIMELINE PROGRES PERBAIKAN                   -->
                    <!-- ============================================ -->
                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-clock-history me-2" style="color: var(--primary-color);"></i>
                                Progres Perbaikan
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="timeline">
                                <?php foreach ($statusOrder as $index => $step): ?>
                                    <?php
                                        $isCompleted = $index <= $currentIndex;
                                        $isCurrent = $index === $currentIndex;
                                        $stepInfo = $statusSteps[$step];
                                        
                                        $dotColor = $isCompleted ? $stepInfo['color'] : '#cbd5e1';
                                        $lineColor = ($index < $currentIndex) ? $statusSteps[$statusOrder[$index + 1 < count($statusOrder) ? $index + 1 : $index]]['color'] : '#e2e8f0';
                                        if ($index >= $currentIndex) $lineColor = '#e2e8f0';
                                        if ($index < $currentIndex) $lineColor = $statusSteps[$statusOrder[$index]]['color'];
                                    ?>
                                    <div class="timeline-item <?= $isCurrent ? 'timeline-current' : '' ?> <?= $isCompleted ? 'timeline-completed' : 'timeline-pending' ?>" 
                                         style="--dot-color: <?= $dotColor ?>; --line-color: <?= $isCompleted && $index < count($statusOrder) - 1 ? $dotColor : '#e2e8f0' ?>;">
                                        <div class="timeline-dot">
                                            <?php if ($isCompleted): ?>
                                                <i class="bi <?= $isCurrent && $currentStatus !== 'Selesai' ? $stepInfo['icon'] : 'bi-check-lg' ?>" style="font-size: 0.8rem;"></i>
                                            <?php else: ?>
                                                <span class="timeline-number"><?= $index + 1 ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1 <?= $isCompleted ? 'text-dark' : 'text-muted' ?> fw-bold">
                                                <?= $stepInfo['label'] ?>
                                                <?php if ($isCurrent): ?>
                                                    <span class="pulse-dot ms-2"></span>
                                                <?php endif; ?>
                                            </h6>
                                            <p class="small <?= $isCompleted ? 'text-muted' : 'text-muted opacity-50' ?> mb-0">
                                                <?= $stepInfo['desc'] ?>
                                            </p>
                                            <?php if ($isCurrent && $currentStatus !== 'Selesai'): ?>
                                                <span class="badge mt-2" style="background: <?= $stepInfo['color'] ?>15; color: <?= $stepInfo['color'] ?>; font-weight: 600;">
                                                    <i class="bi bi-arrow-right-short me-1"></i>Tahap Saat Ini
                                                </span>
                                            <?php elseif ($isCompleted): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success mt-2">
                                                    <i class="bi bi-check2 me-1"></i>Selesai
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Info Summary -->
                            <div class="mt-4 p-3 rounded-3" style="background: <?= $statusSteps[$currentStatus]['color'] ?>10; border: 1px solid <?= $statusSteps[$currentStatus]['color'] ?>30;">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-circle-fill me-2" style="color: <?= $statusSteps[$currentStatus]['color'] ?>;"></i>
                                    <div>
                                        <small class="fw-bold" style="color: <?= $statusSteps[$currentStatus]['color'] ?>;">
                                            <?php if ($currentStatus === 'Menunggu'): ?>
                                                Pengaduan Anda sedang dalam antrian untuk ditinjau.
                                            <?php elseif ($currentStatus === 'Proses'): ?>
                                                Tim sedang bekerja untuk menyelesaikan masalah ini.
                                            <?php else: ?>
                                                Pengaduan telah diselesaikan. Terima kasih atas laporannya!
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ============================================ -->
                    <!-- INFO PENANGANAN                               -->
                    <!-- ============================================ -->
                    <?php if (!empty($pengaduan['username_admin'])): ?>
                    <div class="card mt-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-person-badge me-2" style="color: var(--primary-color);"></i>
                                Ditangani Oleh
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                     style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light, #f97316) 100%);">
                                    <i class="bi bi-person-fill text-white fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?= htmlspecialchars($pengaduan['username_admin']) ?></h6>
                                    <small class="text-muted">Administrator</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ============================================ */
    /* TIMELINE STYLES                              */
    /* ============================================ */
    .timeline {
        position: relative;
    }
    
    .timeline-item {
        display: flex;
        padding-bottom: 2rem;
        position: relative;
    }
    
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    
    /* Vertical line between dots */
    .timeline-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 18px;
        top: 38px;
        bottom: 0;
        width: 2px;
        background: var(--line-color, #e2e8f0);
        transition: background 0.5s;
    }
    
    .timeline-dot {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 50%;
        background: var(--dot-color, #cbd5e1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        margin-right: 1rem;
        z-index: 1;
        transition: all 0.3s;
    }
    
    .timeline-current .timeline-dot {
        box-shadow: 0 0 0 4px rgba(225, 29, 72, 0.15);
        animation: pulse-ring 2s infinite;
    }
    
    .timeline-pending .timeline-dot {
        background: #e2e8f0;
        color: #94a3b8;
    }
    
    .timeline-number {
        font-size: 0.85rem;
    }
    
    /* Pulse animation for current step */
    @keyframes pulse-ring {
        0% { box-shadow: 0 0 0 0 rgba(225, 29, 72, 0.3); }
        70% { box-shadow: 0 0 0 8px rgba(225, 29, 72, 0); }
        100% { box-shadow: 0 0 0 0 rgba(225, 29, 72, 0); }
    }
    
    .pulse-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--dot-color, #e11d48);
        animation: blink 1.5s infinite;
    }
    
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }
    
    .timeline-content {
        padding-top: 2px;
        flex: 1;
    }
    
    /* Feedback box */
    .feedback-box {
        padding: 1rem;
        background: #fafafa;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
