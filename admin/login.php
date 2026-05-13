<?php
session_start();
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user == "maessarbayan" && $pass == "298") {
        $_SESSION['login'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin · PAUD Maessar Bayan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing:border-box; margin:0; padding:0; }
        body {
            font-family:'Inter',sans-serif;
            background:linear-gradient(135deg,#0f172a 0%,#1e1b4b 50%,#0f172a 100%);
            min-height:100vh;
            display:flex; align-items:center; justify-content:center;
            padding:20px;
        }
        .login-wrap {
            display:flex; width:100%; max-width:860px;
            background:white; border-radius:24px;
            overflow:hidden; box-shadow:0 30px 80px rgba(0,0,0,.4);
        }
        /* Left Panel */
        .login-left {
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            flex:1; padding:48px 40px;
            display:flex; flex-direction:column; justify-content:center;
            color:white; position:relative; overflow:hidden;
        }
        .login-left::before {
            content:''; position:absolute;
            width:300px; height:300px; border-radius:50%;
            background:rgba(255,255,255,.07);
            bottom:-80px; right:-80px;
        }
        .login-left .brand-icon {
            width:52px; height:52px; border-radius:14px;
            background:rgba(255,255,255,.2);
            display:flex; align-items:center; justify-content:center;
            font-size:1.5rem; margin-bottom:28px;
        }
        .login-left h2 { font-size:1.8rem; font-weight:800; margin-bottom:10px; }
        .login-left p { font-size:.9rem; color:rgba(255,255,255,.75); line-height:1.6; }
        /* Right Panel */
        .login-right { flex:1.4; padding:48px 44px; }
        .login-right h3 { font-size:1.6rem; font-weight:800; color:#0f172a; margin-bottom:6px; }
        .login-right .sub { font-size:.88rem; color:#64748b; margin-bottom:32px; }
        .form-group { margin-bottom:18px; }
        label { display:block; font-size:.8rem; font-weight:600; color:#374151; margin-bottom:6px; }
        input {
            width:100%; padding:11px 14px;
            border:1.5px solid #e2e8f0; border-radius:10px;
            font-size:.9rem; color:#1e293b; font-family:'Inter',sans-serif;
            transition:border-color .2s, box-shadow .2s; outline:none;
        }
        input:focus { border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.12); }
        .btn-login {
            width:100%; padding:13px;
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            color:white; border:none; border-radius:10px;
            font-size:.95rem; font-weight:700; cursor:pointer;
            transition:all .3s; margin-top:8px;
            box-shadow:0 4px 20px rgba(99,102,241,.35);
        }
        .btn-login:hover { opacity:.9; transform:translateY(-1px); box-shadow:0 8px 30px rgba(99,102,241,.45); }
        .alert-err {
            background:#fef2f2; border:1px solid #fecaca;
            color:#dc2626; padding:10px 14px; border-radius:10px;
            font-size:.85rem; font-weight:500; margin-bottom:18px;
        }
        @media(max-width:600px){
            .login-left { display:none; }
            .login-right { padding:36px 28px; }
        }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="login-left">
        <div class="brand-icon">🎈</div>
        <h2>Panel Admin</h2>
        <p>PAUD Maessar Bayan<br>Masuk untuk mengelola konten website sekolah.</p>
    </div>
    <div class="login-right">
        <h3>Selamat Datang</h3>
        <p class="sub">Masukkan kredensial admin Anda</p>
        <?php if (!empty($error)): ?>
        <div class="alert-err">⚠ Username atau password salah.</div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" autocomplete="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" autocomplete="current-password">
            </div>
            <button type="submit" name="login" class="btn-login">Masuk →</button>
        </form>
    </div>
</div>
</body>
</html>