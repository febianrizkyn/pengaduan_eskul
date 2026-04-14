<?php
/**
 * Login Admin
 */
$pageTitle = 'Login Admin - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <h1 class="text-white fw-bold">
                        <i class="bi bi-shield-lock-fill me-2"></i>
                        Admin Panel
                    </h1>
                    <p class="text-white-50">Kelola pengaduan dan aspirasi siswa</p>
                </div>
                
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4 fw-bold">
                            <i class="bi bi-person-gear me-2" style="color: var(--primary-color);"></i>
                            Login Admin
                        </h4>
                        
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : $flash['type'] ?> alert-dismissible fade show" role="alert">
                                <?= $flash['message'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= BASE_URL ?>?action=login-admin" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>Username
                                </label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-key me-1"></i>Password
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                            </button>
                        </form>
                        
                        <hr class="my-4">
                        
                        <div class="text-center">
                            <a href="<?= BASE_URL ?>?page=login" class="text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke Login Siswa
                            </a>
                        </div>
                    </div>
                </div>
                
                <p class="text-center text-white-50 mt-4">
                    <small>&copy; <?= date('Y') ?> <?= APP_NAME ?>. All rights reserved.</small>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    });
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
