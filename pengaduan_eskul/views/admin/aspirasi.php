<?php
/**
 * Kelola Aspirasi - Premium Dark Theme
 */
$pageTitle = 'Kelola Aspirasi - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    /* === Admin Dark Theme Shared === */
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

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-header h2 {
        color: #f1f5f9;
        font-weight: 800;
        font-size: 1.6rem;
        margin: 0;
    }

    .page-header p {
        color: #64748b;
        font-size: 0.9rem;
        margin: 0.25rem 0 0;
    }

    /* Content Card */
    .content-card {
        background: #1a2035;
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.04);
        overflow: visible;
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
        font-size: 1rem;
        margin: 0;
    }

    .content-card-body {
        padding: 1.5rem;
    }

    /* Filter Styling */
    .filter-bar {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .filter-bar label {
        color: #94a3b8;
        font-weight: 600;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .filter-bar select {
        background: #141b2d;
        border: 2px solid rgba(255,255,255,0.08);
        border-radius: 10px;
        color: #e2e8f0;
        padding: 0.5rem 1rem;
        font-size: 0.88rem;
        min-width: 180px;
        outline: none;
        transition: all 0.3s;
        cursor: pointer;
    }

    .filter-bar select:focus {
        border-color: #0d9488;
        box-shadow: 0 0 0 4px rgba(13,148,136,0.15);
    }

    .btn-reset {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #94a3b8;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s;
    }

    .btn-reset:hover {
        background: rgba(255,255,255,0.08);
        color: #e2e8f0;
    }

    /* Table */
    .dark-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dark-table thead th {
        background: rgba(255,255,255,0.03);
        color: #64748b;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .dark-table tbody td {
        color: #cbd5e1;
        font-size: 0.88rem;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid rgba(255,255,255,0.03);
        vertical-align: middle;
    }

    .dark-table tbody tr {
        transition: background 0.2s;
    }

    .dark-table tbody tr:hover {
        background: rgba(255,255,255,0.02);
    }

    .dark-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status Badge */
    .status-badge {
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
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
    .priority-badge {
        font-size: 0.82rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .priority-rendah { color: #34d399; }
    .priority-sedang { color: #fbbf24; }
    .priority-tinggi { color: #f87171; }

    /* Kategori tag */
    .kategori-tag {
        background: rgba(99,102,241,0.12);
        border: 1px solid rgba(99,102,241,0.2);
        color: #a78bfa;
        padding: 0.25rem 0.65rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Action button */
    .btn-action {
        background: rgba(13,148,136,0.15);
        border: 1px solid rgba(13,148,136,0.3);
        color: #0d9488;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-action:hover {
        background: rgba(13,148,136,0.25);
        color: #14b8a6;
    }

    .btn-archive {
        background: rgba(245,158,11,0.12);
        border: 1px solid rgba(245,158,11,0.3);
        color: #f59e0b;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-archive:hover {
        background: rgba(245,158,11,0.22);
        color: #fbbf24;
        box-shadow: 0 2px 10px rgba(245,158,11,0.15);
    }

    .action-group {
        display: flex;
        gap: 0.4rem;
        flex-wrap: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #475569;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 0.75rem;
        opacity: 0.5;
    }

    /* Alert */
    .alert-dark-custom {
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.3);
        color: #6ee7b7;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .alert-dark-custom.alert-danger {
        background: rgba(239,68,68,0.1);
        border-color: rgba(239,68,68,0.3);
        color: #fca5a5;
    }

    /* Modal dark */
    .modal-content {
        background: #1a2035 !important;
        border: 1px solid rgba(255,255,255,0.08) !important;
        border-radius: 16px !important;
    }

    .modal-header {
        border-bottom-color: rgba(255,255,255,0.06) !important;
    }

    .modal-header .modal-title {
        color: #f1f5f9;
        font-weight: 700;
    }

    .modal-header .btn-close {
        filter: invert(1);
        opacity: 0.5;
    }

    .modal-body .form-label {
        color: #94a3b8;
        font-weight: 600;
    }

    .modal-body .form-control,
    .modal-body .form-select {
        background: #141b2d;
        border: 2px solid rgba(255,255,255,0.08);
        color: #e2e8f0;
        border-radius: 10px;
    }

    .modal-body .form-control:focus,
    .modal-body .form-select:focus {
        border-color: #0d9488;
        box-shadow: 0 0 0 4px rgba(13,148,136,0.15);
        color: #f1f5f9;
    }

    .modal-body .form-control::placeholder {
        color: #475569;
    }

    .modal-body .ket-preview {
        background: #141b2d;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
        padding: 1rem;
        color: #94a3b8;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .modal-footer {
        border-top-color: rgba(255,255,255,0.06) !important;
    }

    .btn-modal-save {
        background: linear-gradient(135deg, #0d9488, #0891b2);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-modal-save:hover {
        color: white;
        box-shadow: 0 4px 15px rgba(13,148,136,0.3);
    }

    .btn-modal-cancel {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #94a3b8;
        padding: 0.5rem 1.25rem;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-modal-cancel:hover {
        background: rgba(255,255,255,0.08);
        color: #e2e8f0;
    }

    .badge-count {
        background: rgba(13,148,136,0.15);
        color: #0d9488;
        border: 1px solid rgba(13,148,136,0.3);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
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
        <div class="page-header">
            <div>
                <h2><i class="bi bi-chat-left-text-fill me-2"></i>Kelola Aspirasi</h2>
                <p>Kelola dan tanggapi aspirasi pengaduan dari siswa</p>
            </div>
        </div>

        <?php if ($flash): ?>
            <div class="alert alert-dark-custom <?= $flash['type'] === 'error' ? 'alert-danger' : '' ?> alert-dismissible fade show" role="alert">
                <i class="bi bi-<?= $flash['type'] === 'error' ? 'exclamation-triangle' : 'check-circle' ?> me-2"></i>
                <?= $flash['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter:invert(1);opacity:0.5;"></button>
            </div>
        <?php endif; ?>

        <!-- Filter Card -->
        <div class="content-card">
            <div class="content-card-body" style="padding: 1rem 1.5rem;">
                <form method="GET" class="filter-bar">
                    <input type="hidden" name="page" value="aspirasi">
                    <label><i class="bi bi-funnel me-1"></i>Filter Status:</label>
                    <select name="status" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" <?= $statusFilter === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                        <option value="Proses" <?= $statusFilter === 'Proses' ? 'selected' : '' ?>>Proses</option>
                    </select>
                    <?php if ($statusFilter): ?>
                        <a href="<?= BASE_URL ?>?page=aspirasi" class="btn-reset">
                            <i class="bi bi-x-circle"></i>Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="bi bi-list-ul me-2" style="color:#6366f1;"></i>Daftar Aspirasi</h5>
                <span class="badge-count"><?= count($aspirasi) ?> data</span>
            </div>

            <?php if (empty($aspirasi)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada aspirasi ditemukan</p>
                </div>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table class="dark-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NIS</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Prioritas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aspirasi as $item): ?>
                                <tr>
                                    <td style="color:#64748b;">#<?= $item['id_aspirasi'] ?></td>
                                    <td><?= htmlspecialchars($item['nis'] ?? '-') ?></td>
                                    <td>
                                        <span class="kategori-tag">
                                            <?= htmlspecialchars($item['ket_kategori'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($item['lokasi'] ?? '-') ?></td>
                                    <td>
                                        <?= htmlspecialchars(substr($item['ket'] ?? '', 0, 40)) ?>
                                        <?= strlen($item['ket'] ?? '') > 40 ? '...' : '' ?>
                                    </td>
                                    <td style="white-space:nowrap;">
                                        <?= isset($item['tgl_lapor']) ? date('d M Y', strtotime($item['tgl_lapor'])) : '-' ?>
                                    </td>
                                    <td>
                                        <?php
                                            $statusClass = 'status-menunggu';
                                            if ($item['status'] === 'Proses') $statusClass = 'status-proses';
                                            if ($item['status'] === 'Selesai') $statusClass = 'status-selesai';
                                        ?>
                                        <span class="status-badge <?= $statusClass ?>"><?= $item['status'] ?></span>
                                    </td>
                                    <td>
                                        <span class="priority-badge priority-<?= strtolower($item['prioritas']) ?>">
                                            <i class="bi bi-flag-fill"></i><?= $item['prioritas'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-group">
                                            <button type="button" class="btn-action" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#updateModal<?= $item['id_aspirasi'] ?>">
                                                <i class="bi bi-pencil-square"></i>Update
                                            </button>
                                            <button type="button" class="btn-archive" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#archiveModal<?= $item['id_aspirasi'] ?>">
                                                <i class="bi bi-archive"></i>Arsip
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modals (outside content-card to avoid overflow:hidden clipping) -->
        <?php if (!empty($aspirasi)): ?>
            <?php foreach ($aspirasi as $item): ?>
                <div class="modal fade" id="updateModal<?= $item['id_aspirasi'] ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $item['id_aspirasi'] ?>" aria-hidden="true" style="z-index: 1060;">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL ?>?action=update-status" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel<?= $item['id_aspirasi'] ?>"><i class="bi bi-pencil-square me-2"></i>Update Aspirasi #<?= $item['id_aspirasi'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_aspirasi" value="<?= $item['id_aspirasi'] ?>">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Keterangan Lengkap</label>
                                        <div class="ket-preview">
                                            <?= nl2br(htmlspecialchars($item['ket'] ?? '-')) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="status<?= $item['id_aspirasi'] ?>" class="form-label fw-semibold">Status</label>
                                        <select class="form-select" name="status" id="status<?= $item['id_aspirasi'] ?>" required>
                                            <option value="Menunggu" <?= $item['status'] === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                            <option value="Proses" <?= $item['status'] === 'Proses' ? 'selected' : '' ?>>Proses</option>
                                            <option value="Selesai" <?= $item['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="feedback<?= $item['id_aspirasi'] ?>" class="form-label fw-semibold">Feedback (Opsional)</label>
                                        <textarea class="form-control" name="feedback" id="feedback<?= $item['id_aspirasi'] ?>" rows="3" placeholder="Berikan tanggapan atau tindak lanjut..."><?= htmlspecialchars($item['feedback'] ?? '') ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn-modal-save">
                                        <i class="bi bi-check-lg me-1"></i>Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Archive Modals -->
        <?php if (!empty($aspirasi)): ?>
            <?php foreach ($aspirasi as $item): ?>
                <div class="modal fade" id="archiveModal<?= $item['id_aspirasi'] ?>" tabindex="-1" aria-labelledby="archiveModalLabel<?= $item['id_aspirasi'] ?>" aria-hidden="true" style="z-index: 1060;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="<?= BASE_URL ?>?action=archive-aspirasi" method="POST">
                                <div class="modal-header" style="border-bottom-color: rgba(245,158,11,0.15) !important;">
                                    <h5 class="modal-title" id="archiveModalLabel<?= $item['id_aspirasi'] ?>" style="color:#fbbf24;">
                                        <i class="bi bi-archive-fill me-2"></i>Arsipkan Aspirasi #<?= $item['id_aspirasi'] ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_aspirasi" value="<?= $item['id_aspirasi'] ?>">
                                    
                                    <div class="mb-3" style="background:rgba(245,158,11,0.08); border:1px solid rgba(245,158,11,0.2); border-radius:12px; padding:1rem;">
                                        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.5rem;">
                                            <i class="bi bi-exclamation-triangle-fill" style="color:#f59e0b;"></i>
                                            <strong style="color:#fbbf24;font-size:0.9rem;">Konfirmasi Arsip</strong>
                                        </div>
                                        <p style="color:#94a3b8;font-size:0.85rem;margin:0;">Aspirasi ini akan dipindahkan ke <strong style="color:#34d399;">History Pengaduan</strong> dengan status <strong style="color:#34d399;">Selesai</strong>. Tindakan ini bisa di-update kembali nanti.</p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Detail Pengaduan</label>
                                        <div class="ket-preview">
                                            <div style="margin-bottom:0.5rem;">
                                                <small style="color:#64748b;">NIS:</small> <span style="color:#e2e8f0;"><?= htmlspecialchars($item['nis'] ?? '-') ?></span>
                                                &nbsp;&bull;&nbsp;
                                                <small style="color:#64748b;">Kategori:</small> <span class="kategori-tag" style="font-size:0.75rem;"><?= htmlspecialchars($item['ket_kategori'] ?? '-') ?></span>
                                            </div>
                                            <?= nl2br(htmlspecialchars($item['ket'] ?? '-')) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="archiveFeedback<?= $item['id_aspirasi'] ?>" class="form-label fw-semibold">Feedback / Catatan Arsip (Opsional)</label>
                                        <textarea class="form-control" name="feedback" id="archiveFeedback<?= $item['id_aspirasi'] ?>" rows="3" placeholder="Tambahkan catatan penutup sebelum mengarsipkan..."><?= htmlspecialchars($item['feedback'] ?? '') ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn-modal-save" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                                        <i class="bi bi-archive-fill me-1"></i>Arsipkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
