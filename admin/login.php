<?php
session_start();
require_once '../config/database.php';
security_headers();
if (isset($_SESSION['admin_logged'])) { header('Location: index.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $error = 'Erreur de sécurité. Veuillez réessayer.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($username && $password) {
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();
            if ($admin && password_verify($password, $admin['password'])) {
                session_regenerate_id(true);
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_user']   = $admin['username'];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Identifiants incorrects. Veuillez réessayer.';
            }
        } else {
            $error = 'Veuillez remplir tous les champs.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administration - COTRAC</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    body{
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      background:var(--gris-clair,#f4f6f9);
      font-family:'Inter',sans-serif;
    }
    .login-box{
      background:#fff;
      padding:44px 40px;
      border-radius:18px;
      box-shadow:0 8px 40px rgba(0,0,0,.10);
      width:100%;
      max-width:420px;
    }
    .login-logo{
      text-align:center;
      margin-bottom:28px;
    }
    .login-logo .brand{
      font-size:2rem;
      font-weight:900;
      letter-spacing:-.02em;
      color:var(--gris-fonce,#1a202c);
    }
    .login-logo .brand span{color:var(--orange,#f7941d);}
    .login-logo p{
      font-size:.75rem;
      text-transform:uppercase;
      letter-spacing:.12em;
      color:#9aa0b0;
      margin-top:4px;
    }
    h2{
      font-size:1.25rem;
      font-weight:700;
      margin-bottom:24px;
      color:var(--bleu-primaire,#1a3c6e);
      text-align:center;
    }
    .form-group{margin-bottom:18px;}
    .form-group label{
      display:block;
      font-size:.82rem;
      font-weight:600;
      color:#4a5568;
      margin-bottom:6px;
    }
    .form-group input{
      width:100%;
      padding:11px 14px;
      border:1.5px solid #e2e8f0;
      border-radius:8px;
      font-size:.95rem;
      transition:border-color .2s;
      outline:none;
    }
    .form-group input:focus{border-color:var(--bleu-primaire,#1a3c6e);}
    .btn-login{
      width:100%;
      padding:13px;
      background:var(--bleu-primaire,#1a3c6e);
      color:#fff;
      border:none;
      border-radius:10px;
      font-size:1rem;
      font-weight:700;
      cursor:pointer;
      transition:background .2s;
      margin-top:6px;
    }
    .btn-login:hover{background:#143058;}
    .login-error{
      background:#fef2f2;
      border:1px solid #fecaca;
      color:#c0392b;
      padding:12px 16px;
      border-radius:8px;
      font-size:.88rem;
      margin-bottom:18px;
      text-align:center;
    }
    .back-link{
      text-align:center;
      margin-top:22px;
      font-size:.83rem;
    }
    .back-link a{color:var(--bleu-primaire,#1a3c6e); text-decoration:none;}
    .back-link a:hover{text-decoration:underline;}
  </style>
</head>
<body>

<div class="login-box">
  <!-- Logo -->
  <div class="login-logo">
    <div class="brand">CO<span>T</span>RAC</div>
    <p>Compagnie des Travaux et Constructions</p>
  </div>

  <h2>🔐 Administration</h2>

  <?php if ($error): ?>
    <div class="login-error">⚠️ <?= e($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="" autocomplete="off">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

    <div class="form-group">
      <label for="username">Nom d'utilisateur</label>
      <input type="text" id="username" name="username"
             value="<?= e($_POST['username'] ?? '') ?>"
             placeholder="Votre identifiant"
             required autocomplete="username">
    </div>

    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input type="password" id="password" name="password"
             placeholder="••••••••"
             required autocomplete="current-password">
    </div>

    <button type="submit" class="btn-login">Se connecter →</button>
  </form>

  <div class="back-link">
    <a href="<?= SITE_URL ?>">← Retour au site public</a>
  </div>
</div>

</body>
</html>
