<?php
/**
 * Login Siswa
 */
$pageTitle = 'Login Siswa - ' . APP_NAME;
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <h1 class="text-white fw-bold">
                        <i class="bi bi-megaphone-fill me-2"></i>
                        <?= APP_NAME ?>
                    </h1>
                    <p class="text-white-50">Sampaikan aspirasi dan pengaduanmu kepada organisasi ekstrakulikuler</p>
                </div>
                
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4 fw-bold">
                            <i class="bi bi-person-circle me-2" style="color: var(--primary-color);"></i>
                            Login Siswa
                        </h4>
                        
                        <?php if ($flash): ?>
                            <div class="alert alert-<?= $flash['type'] === 'error' ? 'danger' : $flash['type'] ?> alert-dismissible fade show" role="alert">
                                <?= $flash['message'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= BASE_URL ?>?action=login" method="POST">
                            <div class="mb-3">
                                <label for="identifier" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>Username
                                </label>
                                <input type="text" class="form-control" id="identifier" name="identifier" placeholder="Masukkan Username Anda" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-key me-1"></i>Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Anda" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                            </button>
                        </form>
                        
                        <hr class="my-4">
                        
                        <div class="text-center">
                            <a href="<?= BASE_URL ?>?page=login-admin" class="text-decoration-none">
                                <i class="bi bi-shield-lock me-1"></i>Login sebagai Admin
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

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
