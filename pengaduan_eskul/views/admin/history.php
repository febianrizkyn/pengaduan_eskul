<?php
/**
 * History / Arsip Pengaduan - Premium Dark Theme
 */
$pageTitle = 'History Pengaduan - ' . APP_NAME;
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
        overflow: hidden;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
        animation-delay: 0.05s;
    }

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

    .badge-count {
        background: rgba(16,185,129,0.15);
        color: #34d399;
        border: 1px solid rgba(16,185,129,0.3);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
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
                <a class="nav-link" href="<?= BASE_URL ?>?page=aspirasi">
                    <i class="bi bi-chat-left-text-fill"></i>Kelola Aspirasi
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>?page=kategori">
                    <i class="bi bi-tags-fill"></i>Kelola Kategori
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link active" href="<?= BASE_URL ?>?page=history">
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
                <h2><i class="bi bi-clock-history me-2"></i>History Pengaduan</h2>
                <p>Arsip pengaduan yang sudah selesai ditangani</p>
            </div>
        </div>

        <?php if ($flash): ?>
            <div class="alert alert-dark-custom <?= $flash['type'] === 'error' ? 'alert-danger' : '' ?> alert-dismissible fade show" role="alert">
                <i class="bi bi-<?= $flash['type'] === 'error' ? 'exclamation-triangle' : 'check-circle' ?> me-2"></i>
                <?= $flash['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter:invert(1);opacity:0.5;"></button>
            </div>
        <?php endif; ?>

        <!-- History Table -->
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="bi bi-archive-fill me-2" style="color:#10b981;"></i>Arsip Pengaduan Selesai</h5>
                <span class="badge-count"><?= count($pengaduan) ?> data</span>
            </div>

            <?php if (empty($pengaduan)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Belum ada pengaduan yang selesai</p>
                </div>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table class="dark-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>NIS</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($pengaduan as $item): ?>
                                <tr>
                                    <td style="color:#64748b;"><?= $no++ ?></td>
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
                                        <small><?= isset($item['tgl_lapor']) ? date('d M Y', strtotime($item['tgl_lapor'])) : '-' ?></small>
                                    </td>
                                    <td>
                                        <span class="status-badge status-selesai">Selesai</span>
                                    </td>
                                    <td>
                                        <span class="priority-badge priority-<?= strtolower($item['prioritas']) ?>">
                                            <i class="bi bi-flag-fill"></i><?= $item['prioritas'] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
