<?php
/**
 * Detail Aspirasi (Admin) - Premium Dark Theme
 */
$pageTitle = 'Detail Aspirasi - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    /* === Admin Dark Theme === */
    .admin-wrapper {
        display: flex;
        min-height: 100vh;
        background: #0f1523;
    }

    .admin-sidebar {
        width: 270px;
        background: linear-gradient(180deg, #141b2d 0%, #0d1117 100%);
        border-right: 1px solid rgba(255,255,255,0.06);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 100;
        display: flex;
        flex-direction: column;
    }

    .sidebar-brand {
        padding: 1.5rem 1.5rem 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .sidebar-brand h5 {
        color: #fff;
        font-weight: 800;
        font-size: 1.15rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .sidebar-brand h5 .brand-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #0d9488, #6366f1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .sidebar-brand small {
        color: #64748b;
        display: block;
        margin-top: 0.4rem;
        font-size: 0.82rem;
    }

    .sidebar-nav {
        padding: 1rem 0.75rem;
        flex: 1;
    }

    .sidebar-nav .nav-label {
        color: #475569;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        padding: 0.5rem 1rem;
        margin-top: 0.5rem;
    }

    .sidebar-nav .nav-item { margin-bottom: 2px; }

    .sidebar-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.7rem 1rem;
        color: #94a3b8;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .sidebar-nav .nav-link:hover {
        color: #e2e8f0;
        background: rgba(255,255,255,0.05);
    }

    .sidebar-nav .nav-link.active {
        color: #fff;
        background: linear-gradient(135deg, rgba(13,148,136,0.2), rgba(99,102,241,0.15));
        border: 1px solid rgba(13,148,136,0.3);
    }

    .sidebar-nav .nav-link i {
        font-size: 1.1rem;
        width: 22px;
        text-align: center;
    }

    .sidebar-footer {
        padding: 1rem 0.75rem;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    .admin-main {
        margin-left: 270px;
        flex: 1;
        padding: 2rem;
        background: #0f1523;
        min-height: 100vh;
    }

    /* Back button */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #94a3b8;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        transition: all 0.2s;
        margin-bottom: 1.5rem;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.08);
        color: #e2e8f0;
    }

    /* Content Card */
    .content-card {
        background: #1a2035;
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.04);
        overflow: hidden;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .content-card:nth-child(1) { animation-delay: 0.05s; }
    .content-card:nth-child(2) { animation-delay: 0.15s; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .content-card-header {
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .content-card-header h5 {
        color: #e2e8f0;
        font-weight: 700;
        font-size: 1.05rem;
        margin: 0;
    }

    .content-card-body {
        padding: 1.5rem;
    }

    /* Detail items */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }

    .detail-item {
        padding: 0;
    }

    .detail-item .detail-label {
        color: #475569;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.35rem;
    }

    .detail-item .detail-value {
        color: #e2e8f0;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .detail-divider {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.06);
        margin: 1.25rem 0;
    }

    .detail-ket {
        background: #141b2d;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 12px;
        padding: 1.25rem;
        color: #cbd5e1;
        line-height: 1.7;
        font-size: 0.92rem;
    }

    .detail-feedback {
        background: rgba(16,185,129,0.08);
        border: 1px solid rgba(16,185,129,0.2);
        border-radius: 12px;
        padding: 1.25rem;
        color: #6ee7b7;
        line-height: 1.7;
        font-size: 0.92rem;
    }

    .detail-feedback small {
        color: #475569;
        margin-top: 0.75rem;
        display: block;
    }

    /* Status Badge */
    .status-badge {
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-menunggu {
        background: rgba(245,158,11,0.15);
        color: #f59e0b;
    }
    .status-menunggu::before { background: #f59e0b; }

    .status-proses {
        background: rgba(139,92,246,0.15);
        color: #a78bfa;
    }
    .status-proses::before { background: #a78bfa; }

    .status-selesai {
        background: rgba(16,185,129,0.15);
        color: #34d399;
    }
    .status-selesai::before { background: #34d399; }

    /* Priority */
    .priority-rendah { color: #34d399; }
    .priority-sedang { color: #fbbf24; }
    .priority-tinggi { color: #f87171; }

    /* Form Styling */
    .dark-form .form-label {
        color: #94a3b8;
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .dark-form .form-control,
    .dark-form .form-select {
        background: #141b2d;
        border: 2px solid rgba(255,255,255,0.08);
        border-radius: 10px;
        color: #e2e8f0;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .dark-form .form-control::placeholder {
        color: #475569;
    }

    .dark-form .form-control:focus,
    .dark-form .form-select:focus {
        background: #111827;
        border-color: #0d9488;
        box-shadow: 0 0 0 4px rgba(13,148,136,0.15);
        color: #f1f5f9;
    }

    .btn-save {
        width: 100%;
        background: linear-gradient(135deg, #0d9488, #0891b2);
        border: none;
        color: white;
        padding: 0.75rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13,148,136,0.35);
        color: white;
    }

    @media (max-width: 992px) {
        .detail-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .admin-sidebar { display: none; }
        .admin-main { margin-left: 0; }
    }
</style>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <h5>
                <span class="brand-icon"><i class="bi bi-shield-check"></i></span>
                Admin Panel
            </h5>
            <small>Selamat datang, <?= $_SESSION['admin_username'] ?></small>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>
            <div class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>?page=dashboard">
                    <i class="bi bi-grid-1x2-fill"></i>Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link active" href="<?= BASE_URL ?>?page=aspirasi">
                    <i class="bi bi-chat-left-text-fill"></i>Kelola Aspirasi
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>?page=kategori">
                    <i class="bi bi-tags-fill"></i>Kelola Kategori
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>?page=history">
                    <i class="bi bi-clock-history"></i>History Pengaduan
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <a class="nav-link" href="<?= BASE_URL ?>?action=logout-admin" style="display:flex;align-items:center;gap:0.75rem;color:#ef4444;text-decoration:none;padding:0.7rem 1rem;border-radius:10px;font-size:0.9rem;">
                <i class="bi bi-box-arrow-left"></i>Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <a href="<?= BASE_URL ?>?page=aspirasi" class="btn-back">
            <i class="bi bi-arrow-left"></i>Kembali ke Kelola Aspirasi
        </a>

        <div class="row g-4">
            <!-- Detail Card -->
            <div class="col-lg-8">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5>
                            <i class="bi bi-file-text me-2" style="color:#6366f1;"></i>
                            Detail Aspirasi #<?= $pengaduan['id_pelaporan'] ?>
                        </h5>
                        <?php
                            $statusClass = 'status-menunggu';
                            if ($pengaduan['status'] === 'Proses') $statusClass = 'status-proses';
                            if ($pengaduan['status'] === 'Selesai') $statusClass = 'status-selesai';
                        ?>
                        <span class="status-badge <?= $statusClass ?>">
                            <?= htmlspecialchars($pengaduan['status'] ?? 'Menunggu') ?>
                        </span>
                    </div>
                    <div class="content-card-body">
                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="detail-label">NIS Siswa</div>
                                <div class="detail-value"><?= htmlspecialchars($pengaduan['nis']) ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Nama Siswa</div>
                                <div class="detail-value"><?= htmlspecialchars($pengaduan['nama_siswa'] ?? '-') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Kategori</div>
                                <div class="detail-value">
                                    <span style="background:rgba(99,102,241,0.12);border:1px solid rgba(99,102,241,0.2);color:#a78bfa;padding:0.2rem 0.6rem;border-radius:6px;font-size:0.85rem;">
                                        <?= htmlspecialchars($pengaduan['ket_kategori']) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Prioritas</div>
                                <div class="detail-value priority-<?= strtolower($pengaduan['prioritas'] ?? 'sedang') ?>">
                                    <i class="bi bi-flag-fill me-1"></i><?= $pengaduan['prioritas'] ?? 'Sedang' ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Lokasi</div>
                                <div class="detail-value">
                                    <i class="bi bi-geo-alt me-1" style="color:#0d9488;"></i><?= htmlspecialchars($pengaduan['lokasi']) ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Tanggal Lapor</div>
                                <div class="detail-value">
                                    <i class="bi bi-calendar3 me-1" style="color:#0d9488;"></i><?= date('d F Y, H:i', strtotime($pengaduan['tgl_lapor'])) ?>
                                </div>
                            </div>
                        </div>

                        <hr class="detail-divider">

                        <div>
                            <div class="detail-label" style="margin-bottom:0.5rem;color:#475569;font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Keterangan</div>
                            <div class="detail-ket">
                                <?= nl2br(htmlspecialchars($pengaduan['ket'])) ?>
                            </div>
                        </div>

                        <?php if (!empty($pengaduan['feedback'])): ?>
                            <hr class="detail-divider">
                            <div>
                                <div class="detail-label" style="margin-bottom:0.5rem;color:#475569;font-size:0.78rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">
                                    <i class="bi bi-chat-dots me-1"></i>Feedback Admin
                                </div>
                                <div class="detail-feedback">
                                    <?= nl2br(htmlspecialchars($pengaduan['feedback'])) ?>
                                    <?php if (!empty($pengaduan['username_admin'])): ?>
                                        <small>— <?= htmlspecialchars($pengaduan['username_admin']) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Quick Update Panel -->
            <div class="col-lg-4">
                <div class="content-card" style="animation-delay: 0.15s;">
                    <div class="content-card-header">
                        <h5><i class="bi bi-pencil-square me-2" style="color:#0d9488;"></i>Update Status</h5>
                    </div>
                    <div class="content-card-body">
                        <form action="<?= BASE_URL ?>?action=update-status" method="POST" class="dark-form">
                            <input type="hidden" name="id_aspirasi" value="<?= $pengaduan['id_pelaporan'] ?>">
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="Menunggu" <?= ($pengaduan['status'] ?? '') === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                    <option value="Proses" <?= ($pengaduan['status'] ?? '') === 'Proses' ? 'selected' : '' ?>>Proses</option>
                                    <option value="Selesai" <?= ($pengaduan['status'] ?? '') === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="feedback" class="form-label">Feedback</label>
                                <textarea class="form-control" name="feedback" rows="4" placeholder="Berikan tanggapan atau tindak lanjut..."><?= htmlspecialchars($pengaduan['feedback'] ?? '') ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn-save">
                                <i class="bi bi-check-circle"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
