<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$nb_projets     = $db->query("SELECT COUNT(*) FROM projets")->fetchColumn();
$nb_messages    = $db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();
$nb_partenaires = $db->query("SELECT COUNT(*) FROM partenaires")->fetchColumn();
$nb_actualites  = $db->query("SELECT COUNT(*) FROM actualites")->fetchColumn();
$derniers_messages = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 5")->fetchAll();
$derniers_projets  = $db->query("SELECT * FROM projets ORDER BY created_at DESC LIMIT 5")->fetchAll();

$poles_labels = ['btp'=>'BTP','energie'=>'Énergie','routes'=>'Routes','industrie'=>'Industrie'];
$poles_colors = ['btp'=>'#f7941d','energie'=>'#27ae60','routes'=>'#1a6bb5','industrie'=>'#8e44ad'];

$current_page = 'index';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord - Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <!-- ===== MAIN ===== -->
  <main class="admin-main">

    <div class="admin-topbar">
      <h1>📊 Tableau de bord</h1>
      <div class="admin-topbar-actions">
        <span class="admin-user">Connecté : <strong><?= e($_SESSION['admin_user'] ?? 'Admin') ?></strong></span>
        <a href="<?= SITE_URL ?>" target="_blank" class="btn-site">🌐 Voir le site</a>
      </div>
    </div>

    <div class="admin-content">

      <!-- Statistiques -->
      <div class="admin-stats-grid">
        <div class="admin-stat">
          <div class="admin-stat-icon" style="background:#ebf8ff;">📁</div>
          <div class="admin-stat-info">
            <p>Total projets</p>
            <strong><?= (int)$nb_projets ?></strong>
          </div>
        </div>
        <div class="admin-stat">
          <div class="admin-stat-icon" style="background:#fff5f5;">✉️</div>
          <div class="admin-stat-info">
            <p>Messages non lus</p>
            <strong style="color:<?= $nb_messages > 0 ? '#e74c3c' : '#1a202c' ?>;"><?= (int)$nb_messages ?></strong>
          </div>
        </div>
        <div class="admin-stat">
          <div class="admin-stat-icon" style="background:#f0fff4;">🤝</div>
          <div class="admin-stat-info">
            <p>Partenaires</p>
            <strong><?= (int)$nb_partenaires ?></strong>
          </div>
        </div>
        <div class="admin-stat">
          <div class="admin-stat-icon" style="background:#fffff0;">📰</div>
          <div class="admin-stat-info">
            <p>Actualités</p>
            <strong><?= (int)$nb_actualites ?></strong>
          </div>
        </div>
      </div>

      <!-- Derniers messages -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3>✉️ Derniers messages reçus</h3>
          <a href="messages.php" class="btn-icon btn-edit">Voir tout →</a>
        </div>
        <?php if (empty($derniers_messages)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <p>Aucun message pour le moment.</p>
          </div>
        <?php else: ?>
          <div style="overflow-x:auto;">
            <table class="table">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Sujet</th>
                  <th>Date</th>
                  <th>Statut</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($derniers_messages as $msg): ?>
                  <tr class="<?= !$msg['lu'] ? 'nonlu' : '' ?>">
                    <td>
                      <?php if (!$msg['lu']): ?><span class="unread-dot"></span><?php endif; ?>
                      <strong><?= e($msg['nom']) ?></strong>
                    </td>
                    <td><?= e($msg['email']) ?></td>
                    <td><?= e(mb_strimwidth($msg['sujet'] ?: '(aucun)', 0, 35, '…')) ?></td>
                    <td style="white-space:nowrap; color:#718096; font-size:.82rem;">
                      <?= e(date('d/m/Y H:i', strtotime($msg['created_at']))) ?>
                    </td>
                    <td>
                      <?php if (!$msg['lu']): ?>
                        <span class="badge badge-nonlu">● Non lu</span>
                      <?php else: ?>
                        <span class="badge badge-lu">✓ Lu</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="messages.php?voir=<?= (int)$msg['id'] ?>" class="btn-icon btn-edit">👁 Voir</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>

      <!-- Derniers projets -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3>📁 Derniers projets ajoutés</h3>
          <a href="projets.php" class="btn-icon btn-edit">Gérer →</a>
        </div>
        <?php if (empty($derniers_projets)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">📂</div>
            <p>Aucun projet pour le moment.</p>
          </div>
        <?php else: ?>
          <div style="overflow-x:auto;">
            <table class="table">
              <thead>
                <tr>
                  <th>Titre</th>
                  <th>Pôle</th>
                  <th>Client</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($derniers_projets as $proj): ?>
                  <?php
                    $pole  = $proj['pole'] ?? 'btp';
                    $color = $poles_colors[$pole] ?? '#ccc';
                    $label = $poles_labels[$pole] ?? strtoupper($pole);
                  ?>
                  <tr>
                    <td><strong><?= e($proj['titre']) ?></strong></td>
                    <td>
                      <span class="pole-badge" style="background:<?= $color ?>;"><?= e($label) ?></span>
                    </td>
                    <td><?= e($proj['client'] ?: '-') ?></td>
                    <td>
                      <?php if ($proj['statut'] === 'termine'): ?>
                        <span class="badge badge-termine">✅ Terminé</span>
                      <?php else: ?>
                        <span class="badge badge-encours">🔄 En cours</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="action-btns">
                        <a href="projets.php?edit=<?= (int)$proj['id'] ?>" class="btn-icon btn-edit">✏️ Modifier</a>
                        <a href="projets.php?delete=<?= (int)$proj['id'] ?>"
                           class="btn-icon btn-delete"
                           onclick="return confirm('Supprimer ce projet ?')">🗑 Suppr.</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>

    </div><!-- /admin-content -->
  </main>
</div>
</body>
</html>
