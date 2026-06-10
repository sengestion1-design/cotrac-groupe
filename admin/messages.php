<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$message_retour = '';
$type_retour    = '';

// ---- Marquer comme lu ----
if (isset($_GET['lire']) && is_numeric($_GET['lire'])) {
    $db->prepare("UPDATE messages SET lu=1 WHERE id=?")->execute([(int)$_GET['lire']]);
    header('Location: messages.php?msg=lu&type=success');
    exit;
}

// ---- Tout marquer comme lu ----
if (isset($_GET['tout_lire'])) {
    $db->exec("UPDATE messages SET lu=1");
    header('Location: messages.php?msg=tout_lu&type=success');
    exit;
}

// ---- Supprimer ----
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $db->prepare("DELETE FROM messages WHERE id=?")->execute([(int)$_GET['delete']]);
    header('Location: messages.php?msg=supprime&type=success');
    exit;
}

// Recuperer message apres redirection
$msg_labels = [
    'lu'       => 'Message marque comme lu.',
    'tout_lu'  => 'Tous les messages ont ete marques comme lus.',
    'supprime' => 'Message supprime avec succes.',
];
if (isset($_GET['msg']) && isset($msg_labels[$_GET['msg']])) {
    $message_retour = $msg_labels[$_GET['msg']];
    $type_retour    = (isset($_GET['type']) && $_GET['type'] === 'success') ? 'success' : 'error';
}

// ---- Voir un message (marquer lu automatiquement) ----
$voir_id = isset($_GET['voir']) && is_numeric($_GET['voir']) ? (int)$_GET['voir'] : 0;
$message_detail = null;
if ($voir_id) {
    $stmt = $db->prepare("SELECT * FROM messages WHERE id=?");
    $stmt->execute([$voir_id]);
    $message_detail = $stmt->fetch();
    if ($message_detail && !$message_detail['lu']) {
        $db->prepare("UPDATE messages SET lu=1 WHERE id=?")->execute([$voir_id]);
        $message_detail['lu'] = 1;
    }
}

// ---- Tous les messages ----
$messages  = $db->query("SELECT * FROM messages ORDER BY lu ASC, created_at DESC")->fetchAll();
$nb_nonlus = $db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();
$nb_messages = $nb_nonlus;

$current_page = 'messages';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages &mdash; Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1>
        &#x2709;&#xFE0F; Messages recus
        <?php if ($nb_nonlus > 0): ?>
          <span style="font-size:.82rem; font-weight:500; color:#e74c3c; background:#fff5f5; padding:3px 10px; border-radius:20px; border:1px solid #feb2b2;">
            <?= (int)$nb_nonlus ?> non lu<?= $nb_nonlus > 1 ? 's' : '' ?>
          </span>
        <?php endif; ?>
      </h1>
      <div class="admin-topbar-actions">
        <?php if ($nb_nonlus > 0): ?>
          <a href="messages.php?tout_lire=1"
             class="btn-icon btn-lire"
             onclick="return confirm('Marquer tous les messages comme lus ?')"
             style="font-size:.83rem; padding:7px 14px;">
            Tout marquer lu
          </a>
        <?php endif; ?>
        <a href="<?= SITE_URL ?>" target="_blank" class="btn-site">Voir le site</a>
      </div>
    </div>

    <div class="admin-content">

      <?php if ($message_retour): ?>
        <div class="alert alert-<?= $type_retour === 'success' ? 'success' : 'error' ?>">
          <?= e($message_retour) ?>
        </div>
      <?php endif; ?>

      <?php if ($message_detail): ?>
        <div class="admin-card">
          <div class="admin-card-header">
            <h3>Detail du message</h3>
            <a href="messages.php" class="btn-icon btn-edit">&larr; Retour a la liste</a>
          </div>
          <div class="message-detail">
            <div class="message-detail-header">
              <div class="message-detail-meta">
                <p><strong>De :</strong> <?= e($message_detail['nom']) ?></p>
                <p><strong>Email :</strong>
                  <a href="mailto:<?= e($message_detail['email']) ?>" style="color:#1a3c6e; font-weight:600;">
                    <?= e($message_detail['email']) ?>
                  </a>
                </p>
                <?php if (!empty($message_detail['telephone'])): ?>
                  <p><strong>Tel. :</strong>
                    <a href="tel:<?= e($message_detail['telephone']) ?>"><?= e($message_detail['telephone']) ?></a>
                  </p>
                <?php endif; ?>
                <p><strong>Objet :</strong> <?= e($message_detail['sujet'] ?: 'Non precise') ?></p>
                <p><strong>Date :</strong> <?= e(date('d/m/Y a H:i', strtotime($message_detail['created_at']))) ?></p>
              </div>
              <div style="display:flex; gap:8px; flex-direction:column; align-items:flex-end;">
                <span class="badge badge-lu">Lu</span>
                <a href="messages.php?delete=<?= (int)$message_detail['id'] ?>"
                   class="btn-icon btn-delete"
                   onclick="return confirm('Supprimer ce message definitiveement ?')">Supprimer</a>
              </div>
            </div>
            <div class="message-body"><?= e($message_detail['message']) ?></div>
            <div style="margin-top:16px; display:flex; gap:10px; flex-wrap:wrap;">
              <a href="mailto:<?= e($message_detail['email']) ?>?subject=RE%3A%20<?= rawurlencode($message_detail['sujet'] ?: 'Votre demande') ?>"
                 class="btn-icon btn-lire" style="padding:9px 18px;">
                Repondre par email
              </a>
              <a href="messages.php" class="btn-icon btn-edit" style="padding:9px 18px;">
                &larr; Retour a la liste
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="admin-card">
        <div class="admin-card-header">
          <h3>Tous les messages <span style="font-weight:400; color:#718096;">(<?= count($messages) ?>)</span></h3>
          <?php if ($nb_nonlus > 0): ?>
            <span style="font-size:.82rem; color:#e74c3c; font-weight:600;">
              <?= (int)$nb_nonlus ?> non lu<?= $nb_nonlus > 1 ? 's' : '' ?>
            </span>
          <?php endif; ?>
        </div>

        <?php if (empty($messages)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">&#x1F4ED;</div>
            <p>Aucun message recu pour le moment.</p>
          </div>
        <?php else: ?>
          <div style="overflow-x:auto;">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Sujet</th>
                  <th>Date</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($messages as $msg): ?>
                  <tr class="<?= !$msg['lu'] ? 'nonlu' : '' ?>">
                    <td style="color:#a0aec0; font-size:.78rem;"><?= (int)$msg['id'] ?></td>
                    <td>
                      <?php if (!$msg['lu']): ?><span class="unread-dot"></span><?php endif; ?>
                      <strong><?= e($msg['nom']) ?></strong>
                    </td>
                    <td style="font-size:.85rem;"><?= e($msg['email']) ?></td>
                    <td style="font-size:.85rem;"><?= e(mb_strimwidth($msg['sujet'] ?: '(aucun)', 0, 42, '...')) ?></td>
                    <td style="white-space:nowrap; color:#718096; font-size:.8rem;">
                      <?= e(date('d/m/Y H:i', strtotime($msg['created_at']))) ?>
                    </td>
                    <td>
                      <?php if (!$msg['lu']): ?>
                        <span class="badge badge-nonlu">Non lu</span>
                      <?php else: ?>
                        <span class="badge badge-lu">Lu</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="action-btns">
                        <a href="messages.php?voir=<?= (int)$msg['id'] ?>" class="btn-icon btn-edit">Voir</a>
                        <?php if (!$msg['lu']): ?>
                          <a href="messages.php?lire=<?= (int)$msg['id'] ?>" class="btn-icon btn-lire" title="Marquer comme lu">Lu</a>
                        <?php endif; ?>
                        <a href="messages.php?delete=<?= (int)$msg['id'] ?>"
                           class="btn-icon btn-delete"
                           onclick="return confirm('Supprimer ce message ?')">Suppr.</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </main>
</div>
</body>
</html>
