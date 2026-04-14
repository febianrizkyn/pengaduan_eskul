<?php
/**
 * Dashboard Admin - Premium Dark Theme
 */
$pageTitle = 'Dashboard Admin - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    /* === Dashboard Premium Styles === */
    .admin-wrapper {
        display: flex;
        min-height: 100vh;
        background: #0f1523;
    }

    /* --- Sidebar --- */
    .admin-sidebar {
        width: 270px;
        background: linear-gradient(180deg, #141b2d 0%, #0d1117 100%);
        border-right: 1px solid rgba(255,255,255,0.06);
        padding: 0;
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

    .sidebar-nav .nav-item {
        margin-bottom: 2px;
    }

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

    /* --- Main Content --- */
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

    .header-time {
        color: #64748b;
        font-size: 0.85rem;
        text-align: right;
    }

    .header-time .date {
        color: #94a3b8;
        font-weight: 600;
    }

    /* --- Stat Cards --- */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card-new {
        background: #1a2035;
        border-radius: 16px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.04);
        transition: all 0.3s ease;
    }

    .stat-card-new:hover {
        transform: translateY(-4px);
        border-color: rgba(255,255,255,0.08);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }

    .stat-card-new .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .stat-card-new .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #f1f5f9;
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-card-new .stat-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .stat-card-new .stat-glow {
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.15;
        top: -30px;
        right: -30px;
    }

    .stat-total .stat-icon { background: rgba(59,130,246,0.15); color: #3b82f6; }
    .stat-total .stat-glow { background: #3b82f6; }

    .stat-waiting .stat-icon { background: rgba(245,158,11,0.15); color: #f59e0b; }
    .stat-waiting .stat-glow { background: #f59e0b; }

    .stat-process .stat-icon { background: rgba(139,92,246,0.15); color: #8b5cf6; }
    .stat-process .stat-glow { background: #8b5cf6; }

    .stat-done .stat-icon { background: rgba(16,185,129,0.15); color: #10b981; }
    .stat-done .stat-glow { background: #10b981; }

    /* --- Info Grid --- */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: #1a2035;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid rgba(255,255,255,0.04);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        border-color: rgba(255,255,255,0.08);
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .info-card .info-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .info-card .info-number {
        font-size: 1.75rem;
        font-weight: 800;
        color: #f1f5f9;
        line-height: 1.2;
    }

    .info-card .info-label {
        color: #64748b;
        font-size: 0.85rem;
    }

    .info-siswa .info-icon { background: rgba(14,165,233,0.15); color: #0ea5e9; }
    .info-kategori .info-icon { background: rgba(236,72,153,0.15); color: #ec4899; }

    /* --- Recent Table --- */
    .content-card {
        background: #1a2035;
        border-radius: 16px;
        border: 1px solid rgba(255,255,255,0.04);
        overflow: hidden;
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

    .content-card-header .badge-count {
        background: rgba(13,148,136,0.15);
        color: #0d9488;
        border: 1px solid rgba(13,148,136,0.3);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

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

    .dark-table tbody tr:hover {
        background: rgba(255,255,255,0.02);
    }

    .dark-table tbody tr:last-child td {
        border-bottom: none;
    }

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

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .quick-action-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        background: #1a2035;
        border: 1px solid rgba(255,255,255,0.04);
        border-radius: 12px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .quick-action-btn:hover {
        background: rgba(13,148,136,0.1);
        border-color: rgba(13,148,136,0.3);
        color: #0d9488;
        transform: translateY(-2px);
    }

    .quick-action-btn i {
        font-size: 1.2rem;
    }

    /* Animations */
    .stat-card-new, .info-card, .content-card, .quick-action-btn {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .stat-card-new:nth-child(1) { animation-delay: 0.05s; }
    .stat-card-new:nth-child(2) { animation-delay: 0.1s; }
    .stat-card-new:nth-child(3) { animation-delay: 0.15s; }
    .stat-card-new:nth-child(4) { animation-delay: 0.2s; }
    .info-card:nth-child(1) { animation-delay: 0.25s; }
    .info-card:nth-child(2) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Alert override for dark */
    .alert-dark-custom {
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.3);
        color: #6ee7b7;
        border-radius: 12px;
    }

    .alert-dark-custom.alert-danger {
        background: rgba(239,68,68,0.1);
        border-color: rgba(239,68,68,0.3);
        color: #fca5a5;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .quick-actions { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .admin-sidebar { display: none; }
        .admin-main { margin-left: 0; }
        .stat-grid { grid-template-columns: 1fr; }
        .info-grid { grid-template-columns: 1fr; }
        .quick-actions { grid-template-columns: 1fr; }
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
                <a class="nav-link active" href="<?= BASE_URL ?>?page=dashboard">
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
                <a class="nav-link" href="<?= BASE_URL ?>?page=history">
                    <i class="bi bi-clock-history"></i>History Pengaduan
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <a class="nav-link" href="<?= BASE_URL ?>?action=logout-admin" style="display:flex;align-items:center;gap:0.75rem;color:#ef4444;text-decoration:none;padding:0.7rem 1rem;border-radius:10px;font-size:0.9rem;transition:all 0.2s;">
                <i class="bi bi-box-arrow-left"></i>Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Header -->
        <div class="page-header">
            <div>
                <h2><i class="bi bi-grid-1x2-fill me-2"></i>Dashboard</h2>
                <p>Ringkasan data pengaduan ekstrakulikuler</p>
            </div>
            <div class="header-time">
                <div class="date"><?= date('l, d F Y') ?></div>
                <div><?= date('H:i') ?> WIB</div>
            </div>
        </div>

        <?php if ($flash): ?>
            <div class="alert alert-dark-custom <?= $flash['type'] === 'error' ? 'alert-danger' : '' ?> alert-dismissible fade show" role="alert">
                <i class="bi bi-<?= $flash['type'] === 'error' ? 'exclamation-triangle' : 'check-circle' ?> me-2"></i>
                <?= $flash['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1); opacity: 0.5;"></button>
            </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="stat-grid">
            <div class="stat-card-new stat-total">
                <div class="stat-glow"></div>
                <div class="stat-icon"><i class="bi bi-envelope-paper-fill"></i></div>
                <div class="stat-number"><?= $totalPengaduan ?></div>
                <div class="stat-label">Total Pengaduan</div>
            </div>

            <div class="stat-card-new stat-waiting">
                <div class="stat-glow"></div>
                <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
                <div class="stat-number"><?= $menunggu ?></div>
                <div class="stat-label">Menunggu</div>
            </div>

            <div class="stat-card-new stat-process">
                <div class="stat-glow"></div>
                <div class="stat-icon"><i class="bi bi-gear-fill"></i></div>
                <div class="stat-number"><?= $proses ?></div>
                <div class="stat-label">Diproses</div>
            </div>

            <div class="stat-card-new stat-done">
                <div class="stat-glow"></div>
                <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
                <div class="stat-number"><?= $selesai ?></div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="info-grid">
            <div class="info-card info-siswa">
                <div class="info-icon"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="info-number"><?= $totalSiswa ?></div>
                    <div class="info-label">Total Siswa Terdaftar</div>
                </div>
            </div>
            <div class="info-card info-kategori">
                <div class="info-icon"><i class="bi bi-bookmark-star-fill"></i></div>
                <div>
                    <div class="info-number"><?= $totalKategori ?></div>
                    <div class="info-label">Kategori Pengaduan</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="<?= BASE_URL ?>?page=aspirasi" class="quick-action-btn">
                <i class="bi bi-chat-left-text"></i>Kelola Aspirasi
            </a>
            <a href="<?= BASE_URL ?>?page=kategori" class="quick-action-btn">
                <i class="bi bi-tags"></i>Kelola Kategori
            </a>
            <a href="<?= BASE_URL ?>?page=history" class="quick-action-btn">
                <i class="bi bi-clock-history"></i>Lihat History
            </a>
        </div>

        <!-- Recent Pengaduan -->
        <div class="content-card" style="animation-delay: 0.35s;">
            <div class="content-card-header">
                <h5><i class="bi bi-lightning-fill me-2" style="color:#f59e0b;"></i>Pengaduan Terbaru</h5>
                <span class="badge-count"><?= count($pengaduanTerbaru) ?> data terbaru</span>
            </div>
            <?php if (empty($pengaduanTerbaru)): ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Belum ada pengaduan masuk</p>
                </div>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table class="dark-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($pengaduanTerbaru as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:0.5rem;">
                                            <div style="width:32px;height:32px;border-radius:8px;background:rgba(99,102,241,0.15);color:#a78bfa;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8rem;">
                                                <?= strtoupper(substr($item['nama_siswa'] ?? 'U', 0, 1)) ?>
                                            </div>
                                            <?= htmlspecialchars($item['nama_siswa'] ?? '-') ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="background:rgba(255,255,255,0.06);padding:0.25rem 0.65rem;border-radius:6px;font-size:0.8rem;">
                                            <?= htmlspecialchars($item['ket_kategori'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars(substr($item['ket'] ?? '', 0, 45)) ?>
                                        <?= strlen($item['ket'] ?? '') > 45 ? '...' : '' ?>
                                    </td>
                                    <td style="white-space:nowrap;">
                                        <?= isset($item['tgl_lapor']) ? date('d M Y', strtotime($item['tgl_lapor'])) : '-' ?>
                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>?page=aspirasi-detail&id=<?= $item['id_pelaporan'] ?>" 
                                           style="color:#0d9488;text-decoration:none;font-weight:600;font-size:0.85rem;">
                                            Detail →
                                        </a>
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
