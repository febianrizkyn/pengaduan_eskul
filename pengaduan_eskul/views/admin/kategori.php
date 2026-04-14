<?php
/**
 * Kelola Kategori - Full CRUD with Premium Dark Theme
 */
$pageTitle = 'Kelola Kategori - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';
?>

<style>
    /* === Kategori Page Styles (Dark Theme) === */
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

    /* Form Styling */
    .dark-form .form-label {
        color: #94a3b8;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .dark-form .form-control {
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

    .dark-form .form-control:focus {
        background: #111827;
        border-color: #0d9488;
        box-shadow: 0 0 0 4px rgba(13,148,136,0.15);
        color: #f1f5f9;
    }

    .btn-add {
        background: linear-gradient(135deg, #0d9488, #0891b2);
        border: none;
        color: white;
        padding: 0.65rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13,148,136,0.35);
        color: white;
    }


    .btn-delete {
        background: rgba(239,68,68,0.15);
        border: 1px solid rgba(239,68,68,0.3);
        color: #ef4444;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-delete:hover {
        background: rgba(239,68,68,0.25);
        color: #f87171;
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
        font-size: 0.9rem;
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

    .kategori-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.85rem;
        background: rgba(99,102,241,0.12);
        border: 1px solid rgba(99,102,241,0.2);
        border-radius: 8px;
        color: #a78bfa;
        font-weight: 600;
        font-size: 0.85rem;
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

    /* Modal dark override */
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
    }

    .modal-body .form-control {
        background: #141b2d;
        border: 2px solid rgba(255,255,255,0.08);
        color: #e2e8f0;
        border-radius: 10px;
    }

    .modal-body .form-control:focus {
        border-color: #0d9488;
        box-shadow: 0 0 0 4px rgba(13,148,136,0.15);
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

    /* Animations */
    .content-card {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .content-card:nth-child(1) { animation-delay: 0.05s; }
    .content-card:nth-child(2) { animation-delay: 0.15s; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
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
                <a class="nav-link active" href="<?= BASE_URL ?>?page=kategori">
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
                <h2><i class="bi bi-tags-fill me-2"></i>Kelola Kategori</h2>
                <p>Tambah, edit, dan hapus kategori pengaduan</p>
            </div>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
                <i class="bi bi-plus-lg"></i>Tambah Kategori
            </button>
        </div>

        <?php if ($flash): ?>
            <div class="alert alert-dark-custom <?= $flash['type'] === 'error' ? 'alert-danger' : '' ?> alert-dismissible fade show" role="alert">
                <i class="bi bi-<?= $flash['type'] === 'error' ? 'exclamation-triangle' : 'check-circle' ?> me-2"></i>
                <?= $flash['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter:invert(1);opacity:0.5;"></button>
            </div>
        <?php endif; ?>

        <!-- Add Kategori Form Card -->
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="bi bi-bookmark-star-fill me-2" style="color:#ec4899;"></i>Daftar Kategori</h5>
                <span style="background:rgba(13,148,136,0.15);color:#0d9488;border:1px solid rgba(13,148,136,0.3);padding:0.3rem 0.8rem;border-radius:20px;font-size:0.78rem;font-weight:600;">
                    <?= count($kategori) ?> kategori
                </span>
            </div>

            <?php if (empty($kategori)): ?>
                <div class="empty-state">
                    <i class="bi bi-tags"></i>
                    <p>Belum ada kategori. Tambahkan kategori pertama!</p>
                </div>
            <?php else: ?>
                <div style="overflow-x: auto;">
                    <table class="dark-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th style="text-align:right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($kategori as $item): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td style="color:#64748b;">#<?= $item['id_kategori'] ?></td>
                                    <td>
                                        <span class="kategori-badge">
                                            <i class="bi bi-tag-fill"></i>
                                            <?= htmlspecialchars($item['ket_kategori']) ?>
                                        </span>
                                    </td>
                                    <td style="text-align:right;">
                                        <div style="display:flex;gap:0.5rem;justify-content:flex-end;">

                                            <a href="<?= BASE_URL ?>?action=kategori-delete&id=<?= $item['id_kategori'] ?>" 
                                               class="btn-delete"
                                               onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                <i class="bi bi-trash3"></i>Hapus
                                            </a>
                                        </div>
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

<!-- Modal: Tambah Kategori -->
<div class="modal fade" id="addKategoriModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= BASE_URL ?>?action=kategori-store" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ket_kategori" class="form-label fw-semibold">Nama Kategori</label>
                        <input type="text" class="form-control" id="ket_kategori" name="ket_kategori" 
                               placeholder="Contoh: Kegiatan Olahraga, Pelanggaran, dll" required>
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



<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
