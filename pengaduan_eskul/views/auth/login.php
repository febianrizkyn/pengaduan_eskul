<?php
/**
 * Login Unified - Satu form untuk Siswa & Admin
 * Design: Dark Modern Split-Screen with Glassmorphism
 */
$pageTitle = 'Login - ' . APP_NAME;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #0a0e27;
            overflow-x: hidden;
        }

        /* === Animated Background === */
        .login-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background: 
                radial-gradient(ellipse at 20% 50%, rgba(16, 185, 129, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(59, 130, 246, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 60% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                #0a0e27;
        }

        /* Floating orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: float 20s ease-in-out infinite;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: rgba(16, 185, 129, 0.15);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: rgba(59, 130, 246, 0.12);
            top: 50%;
            right: -80px;
            animation-delay: -7s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: rgba(139, 92, 246, 0.1);
            bottom: -80px;
            left: 30%;
            animation-delay: -14s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -30px) scale(1.05); }
            50% { transform: translate(-20px, 20px) scale(0.95); }
            75% { transform: translate(15px, 15px) scale(1.02); }
        }

        /* Particle dots */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: drift linear infinite;
        }

        @keyframes drift {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
        }

        /* === Layout === */
        .login-wrapper {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 560px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 
                0 25px 60px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        /* === Left Side - Branding === */
        .login-branding {
            flex: 1;
            background: linear-gradient(160deg, #0d9488 0%, #0891b2 40%, #6366f1 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-branding::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 30% 40%, rgba(255,255,255,0.08) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(255,255,255,0.05) 0%, transparent 40%);
            animation: shimmer 8s ease-in-out infinite alternate;
        }

        @keyframes shimmer {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(10deg); }
        }

        .branding-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: white;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: pulse-icon 3s ease-in-out infinite;
        }

        @keyframes pulse-icon {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.2); }
            50% { box-shadow: 0 0 0 15px rgba(255,255,255,0); }
        }

        .branding-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 1;
            line-height: 1.3;
        }

        .branding-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
            max-width: 300px;
        }

        .branding-features {
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .branding-feature {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.88rem;
            margin-bottom: 0.75rem;
            text-align: left;
        }

        .branding-feature i {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        /* === Right Side - Form === */
        .login-form-side {
            flex: 1;
            background: #111827;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i.input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 1.1rem;
            transition: color 0.3s;
            z-index: 2;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 3rem;
            background: #1e293b;
            border: 2px solid #1e293b;
            border-radius: 12px;
            color: #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrapper input::placeholder {
            color: #475569;
        }

        .input-wrapper input:focus {
            border-color: #0d9488;
            background: #1a2332;
            box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.15);
        }

        .input-wrapper input:focus ~ i.input-icon {
            color: #0d9488;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #475569;
            cursor: pointer;
            padding: 4px;
            font-size: 1.1rem;
            transition: color 0.3s;
            z-index: 2;
        }

        .toggle-password:hover {
            color: #0d9488;
        }

        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #0d9488 0%, #0891b2 50%, #6366f1 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 148, 136, 0.35);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            color: #475569;
            font-size: 0.82rem;
        }

        /* Alert styling */
        .alert-custom {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-custom.alert-success-custom {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
        }

        .alert-custom .btn-close {
            filter: invert(1);
            opacity: 0.5;
        }

        /* === Responsive === */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 440px;
                min-height: auto;
            }

            .login-branding {
                padding: 2rem 2rem 1.5rem;
            }

            .branding-features {
                display: none;
            }

            .branding-title {
                font-size: 1.4rem;
            }

            .login-form-side {
                padding: 2rem;
            }
        }

        /* Loading animation for button */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-login.loading .btn-text {
            visibility: hidden;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 22px;
            height: 22px;
            margin: -11px 0 0 -11px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Subtle entrance animation */
        .login-container {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<!-- Animated Background -->
<div class="login-bg">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>

<!-- Particles -->
<div class="particles" id="particles"></div>

<!-- Main Layout -->
<div class="login-wrapper">
    <div class="login-container">
        <!-- Left - Branding -->
        <div class="login-branding">
            <div class="branding-icon">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <h1 class="branding-title"><?= APP_NAME ?></h1>
            <p class="branding-subtitle">Sampaikan aspirasi dan pengaduanmu kepada organisasi ekstrakulikuler dengan mudah dan transparan.</p>
            
            <div class="branding-features">
                <div class="branding-feature">
                    <i class="bi bi-shield-check"></i>
                    <span>Aman & terjamin kerahasiaannya</span>
                </div>
                <div class="branding-feature">
                    <i class="bi bi-clock-history"></i>
                    <span>Pantau progres pengaduanmu</span>
                </div>
                <div class="branding-feature">
                    <i class="bi bi-chat-dots"></i>
                    <span>Respon cepat dari admin</span>
                </div>
            </div>
        </div>

        <!-- Right - Login Form -->
        <div class="login-form-side">
            <div class="form-header">
                <h2>Selamat Datang 👋</h2>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <?php if ($flash): ?>
                <div class="alert-custom <?= $flash['type'] === 'success' ? 'alert-success-custom' : '' ?>">
                    <i class="bi bi-<?= $flash['type'] === 'error' ? 'exclamation-triangle' : 'check-circle' ?>"></i>
                    <span><?= $flash['message'] ?></span>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>?action=login" method="POST" id="loginForm">
                <div class="form-group">
                    <label for="identifier">Username</label>
                    <div class="input-wrapper">
                        <input type="text" id="identifier" name="identifier" placeholder="Masukkan username Anda" required autocomplete="username">
                        <i class="bi bi-person input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required autocomplete="current-password">
                        <i class="bi bi-lock input-icon"></i>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    <span class="btn-text"><i class="bi bi-box-arrow-in-right me-2"></i>Masuk</span>
                </button>
            </form>

            <div class="login-footer">
                &copy; <?= date('Y') ?> <?= APP_NAME ?>. All rights reserved.
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle Password
    document.getElementById('togglePassword')?.addEventListener('click', function() {
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

    // Loading state on submit
    document.getElementById('loginForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('btnLogin');
        btn.classList.add('loading');
    });

    // Generate floating particles
    function createParticles() {
        const container = document.getElementById('particles');
        const count = 30;
        
        for (let i = 0; i < count; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.width = (Math.random() * 3 + 1) + 'px';
            particle.style.height = particle.style.width;
            particle.style.animationDuration = (Math.random() * 20 + 15) + 's';
            particle.style.animationDelay = (Math.random() * 20) + 's';
            particle.style.opacity = Math.random() * 0.3 + 0.05;
            container.appendChild(particle);
        }
    }
    
    createParticles();
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
