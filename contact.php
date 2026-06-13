<?php
header("Content-Security-Policy: default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https:; frame-src 'self' https://www.openstreetmap.org https://www.google.com https://maps.google.com;");
require_once __DIR__ . '/lang/lang.php';
/* =========================================================
   TRAITEMENT DU FORMULAIRE (avant tout output HTML)
   ========================================================= */
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config/database.php';

$success = false;
$errors  = [];

/* Valeurs mémorisées pour préremplissage (effacées si succès) */
$v = ['nom' => '', 'email' => '', 'telephone' => '', 'sujet' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* 1. Vérification CSRF */
    if (!csrf_verify()) {
        $errors[] = t('contact_err_csrf');
    }

    /* 2. Anti-spam honeypot : si le champ "website" est rempli, on ignore silencieusement */
    $honeypot = trim($_POST['website'] ?? '');
    if ($honeypot !== '') {
        /* Faux-semblant de succès pour dérouter les bots */
        $success = true;
    } else {

        /* 3. Nettoyage des entrées - suppression retours chariot pour éviter header injection */
        $clean = function(string $val): string {
            return trim(str_replace(["\r", "\n"], ' ', $val));
        };

        $nom       = $clean($_POST['nom']       ?? '');
        $email_raw = $clean($_POST['email']      ?? '');
        $telephone = $clean($_POST['telephone']  ?? '');
        $sujet     = $clean($_POST['sujet']      ?? '');
        $message   = trim($_POST['message']      ?? '');   // on garde les sauts de ligne dans le message

        /* Mémoriser pour préremplissage en cas d'erreur */
        $v = compact('nom', 'email_raw', 'telephone', 'sujet', 'message');
        $v['email'] = $email_raw;

        /* 4. Validation */
        if ($nom === '') {
            $errors[] = t('contact_err_nom');
        }

        $email_valid = filter_var($email_raw, FILTER_VALIDATE_EMAIL);
        if (!$email_valid) {
            $errors[] = t('contact_err_email');
        }

        if (mb_strlen($message, 'UTF-8') < 10) {
            $errors[] = t('contact_err_message');
        }

        /* 5. Envoi email si aucune erreur */
        if (empty($errors)) {
            $to      = 'cotracsenegal@gmail.com';
            $subject = '=?UTF-8?B?' . base64_encode('[COTRAC] Nouveau message : ' . ($sujet ?: 'Contact web')) . '?=';

            /* Corps en texte plein UTF-8 */
            $body  = "Nouveau message reçu depuis le formulaire de contact COTRAC.\n\n";
            $body .= "Nom       : {$nom}\n";
            $body .= "Email     : {$email_raw}\n";
            $body .= "Téléphone : " . ($telephone ?: 'Non renseigné') . "\n";
            $body .= "Sujet     : " . ($sujet ?: 'Non précisé') . "\n";
            $body .= str_repeat('-', 50) . "\n";
            $body .= "Message :\n{$message}\n";
            $body .= str_repeat('-', 50) . "\n";
            $body .= "Envoyé le " . date('d/m/Y à H:i') . " depuis " . SITE_URL . "/contact.php\n";

            $headers  = "From: COTRAC Site Web <no-reply@cotracgroupe.com>\r\n";
            $headers .= "Reply-To: {$nom} <{$email_raw}>\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $headers .= "Content-Transfer-Encoding: 8bit\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

            /* Envoi - on ne bloque pas si mail() échoue sur localhost (XAMPP) */
            @mail($to, $subject, $body, $headers);

            /* Sauvegarde en base de données */
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO messages (nom, email, telephone, sujet, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $email_raw, $telephone, $sujet, $message]);

            $success = true;
            /* Vider les champs */
            $v = ['nom' => '', 'email' => '', 'telephone' => '', 'sujet' => '', 'message' => ''];
        }
    }
}

/* =========================================================
   HTML
   ========================================================= */
$page_title = t('contact_page_title');
$page_desc  = t('contact_page_desc');
// Charger le contenu CMS de cette page
cms_load('contact');
require_once __DIR__ . '/includes/header.php';
?>

<style>
/* ---- Styles propres à la page Contact ---- */
.contact-grid {
  display: grid;
  grid-template-columns: 55fr 45fr;
  gap: 40px;
  align-items: start;
}
@media (max-width: 900px) {
  .contact-grid { grid-template-columns: 1fr; }
}

/* Formulaire */
.contact-form-wrap {
  background: #fff;
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 4px 24px rgba(26,107,181,0.08);
}
.form-group { margin-bottom: 20px; }
.form-label {
  display: block;
  font-size: 0.88rem;
  font-weight: 600;
  color: var(--texte);
  margin-bottom: 6px;
}
.form-control {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid var(--border);
  border-radius: 10px;
  font-size: 0.95rem;
  font-family: inherit;
  color: var(--texte);
  transition: border-color 0.25s;
  outline: none;
  background: #fff;
  box-sizing: border-box;
}
.form-control:focus { border-color: var(--bleu); }
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
@media (max-width: 560px) {
  .form-row { grid-template-columns: 1fr; }
  .contact-form-wrap { padding: 24px 16px; }
}
.form-message {
  padding: 12px 16px;
  border-radius: 10px;
  margin-bottom: 20px;
  font-size: 0.9rem;
  font-weight: 600;
}
.form-message.success {
  background: #d1fae5;
  color: #065f46;
  border: 1px solid #6ee7b7;
}
.form-message.error {
  background: #fee2e2;
  color: #991b1b;
  border: 1px solid #fca5a5;
}

/* Infos de contact */
.contact-info-card {
  background: #fff;
  border-radius: 20px;
  padding: 32px;
  box-shadow: 0 4px 24px rgba(26,107,181,0.08);
  margin-bottom: 20px;
}
.contact-info-item {
  display: flex;
  gap: 16px;
  align-items: flex-start;
  padding: 16px 0;
  border-bottom: 1px solid var(--border);
}
.contact-info-item:last-child { border-bottom: none; padding-bottom: 0; }
.contact-info-item:first-child { padding-top: 0; }
.contact-info-icon {
  width: 44px;
  height: 44px;
  min-width: 44px;
  background: rgba(26,107,181,0.08);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--bleu);
}
.contact-info-icon svg { width: 20px; height: 20px; }
.contact-info-label {
  font-size: 0.8rem;
  font-weight: 700;
  color: var(--bleu);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 4px;
}
.contact-info-value { font-size: 0.93rem; color: var(--texte); line-height: 1.6; }
.contact-info-value a { color: var(--texte); text-decoration: none; }
.contact-info-value a:hover { color: var(--bleu); }

/* Carte */
.contact-map { border-radius: 16px; overflow: hidden; height: 220px; }
.contact-map iframe { width: 100%; height: 100%; border: 0; display: block; }

/* Horaires */
.horaires-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
  margin-top: 12px;
  font-size: 0.88rem;
}
.horaire-row { display: contents; }
.horaire-jour { color: var(--texte); font-weight: 500; }
.horaire-heure { color: var(--bleu); font-weight: 700; }

/* Honeypot caché */
.hp-field { display: none !important; visibility: hidden; position: absolute; left: -9999px; }

/* Hero responsive */
.contact-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: center;
}
.contact-hero-stats {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
@media (max-width: 768px) {
  .contact-hero-grid {
    grid-template-columns: 1fr;
    gap: 32px;
  }
  .contact-hero-stats {
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }
  .contact-hero-stats > div {
    padding: 14px 10px !important;
  }
}
</style>

<!-- ===================== PAGE HERO ===================== -->
<?php $_contact_hero_bg = cms_bg_url(cms('contact','hero','bg_image','')); ?>
<section class="page-hero" <?= $_contact_hero_bg ? 'style="background-image:url(\''.e($_contact_hero_bg).'\');background-size:cover;background-position:center;"' : '' ?>>
  <div class="container contact-hero-grid">
    <div>
      <nav class="breadcrumb" aria-label="Fil d'Ariane">
        <a href="<?= SITE_URL ?>/index.php"><?= t('nav_accueil') ?></a>
        <span class="sep">›</span>
        <span><?= t('contact_breadcrumb') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        <?= cms('contact','hero','title', t('contact_hero_titre')) ?>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1" style="margin:0;text-align:left;">
        <?= cms('contact','hero','subtitle', t('contact_hero_desc')) ?>
      </p>
    </div>
    <div class="animate-fade-up delay-2 contact-hero-stats">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2rem;font-weight:800;color:#f7941d;line-height:1;">48h</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('contact_stat_delai') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2rem;font-weight:800;color:#f7941d;line-height:1;"><?= t('contact_stat_gratuit') ?></div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('contact_stat_devis') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2rem;font-weight:800;color:#f7941d;line-height:1;">4</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('contact_stat_poles') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2rem;font-weight:800;color:#f7941d;line-height:1;">14</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('contact_stat_regions') ?></div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== CONTACT SECTION ===================== -->
<section class="section">
  <div class="container">
    <div class="contact-grid">

      <!-- ============ COLONNE GAUCHE : FORMULAIRE (55%) ============ -->
      <div>
        <div class="contact-form-wrap">
          <span class="section-tag" style="margin-bottom:12px; display:inline-block;"><?= t('contact_tag_ecrire') ?></span>
          <h2 class="section-title" style="font-size:1.55rem; margin-bottom:6px;"><?= cms('contact','intro_text','title', t('contact_form_titre')) ?></h2>
          <p style="color:var(--gris); font-size:.9rem; margin-bottom:24px; line-height:1.6;">
            <?= t('contact_form_obligatoires') ?>
          </p>

          <!-- Retour succès / erreurs -->
          <?php if ($success): ?>
            <div class="form-message success" role="alert">
              <?= t('contact_succes_msg') ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($errors)): ?>
            <div class="form-message error" role="alert">
              <?php foreach ($errors as $err): ?>
                <div><?= e($err) ?></div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <form method="POST" action="" novalidate>
            <!-- CSRF -->
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

            <!-- Honeypot anti-spam (invisible pour les humains) -->
            <div class="hp-field" aria-hidden="true">
              <label for="website"><?= t('contact_honeypot_label') ?></label>
              <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" value="">
            </div>

            <!-- Ligne 1 : Nom + Email -->
            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="nom">
                  <?= t('contact_label_nom') ?> <span style="color:#e74c3c;">*</span>
                </label>
                <input class="form-control"
                       type="text"
                       id="nom"
                       name="nom"
                       value="<?= e($v['nom']) ?>"
                       placeholder="<?= t('contact_placeholder_nom') ?>"
                       required
                       autocomplete="name">
              </div>
              <div class="form-group">
                <label class="form-label" for="email">
                  <?= t('contact_label_email') ?> <span style="color:#e74c3c;">*</span>
                </label>
                <input class="form-control"
                       type="email"
                       id="email"
                       name="email"
                       value="<?= e($v['email']) ?>"
                       placeholder="<?= t('contact_placeholder_email') ?>"
                       required
                       autocomplete="email">
              </div>
            </div>

            <!-- Ligne 2 : Téléphone + Sujet -->
            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="telephone"><?= t('contact_label_telephone') ?></label>
                <input class="form-control"
                       type="tel"
                       id="telephone"
                       name="telephone"
                       value="<?= e($v['telephone']) ?>"
                       placeholder="<?= t('contact_placeholder_tel') ?>"
                       autocomplete="tel">
              </div>
              <div class="form-group">
                <label class="form-label" for="sujet"><?= t('contact_label_sujet') ?></label>
                <select class="form-control" id="sujet" name="sujet">
                  <option value=""><?= t('contact_sujet_defaut') ?></option>
                  <?php
                  $sujets = ['Devis', 'Partenariat', 'Information', 'Autre'];
                  foreach ($sujets as $s):
                      $sel = ($v['sujet'] === $s) ? 'selected' : '';
                  ?>
                    <option value="<?= e($s) ?>" <?= $sel ?>><?= e($s) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <!-- Message -->
            <div class="form-group">
              <label class="form-label" for="message">
                <?= t('contact_label_message') ?> <span style="color:#e74c3c;">*</span>
              </label>
              <textarea class="form-control"
                        id="message"
                        name="message"
                        rows="7"
                        placeholder="<?= t('contact_placeholder_msg') ?>"
                        required><?= e($v['message']) ?></textarea>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary btn-bleu" style="width:100%; font-size:1rem; padding:14px 20px;">
              <?= t('contact_btn_envoyer') ?>
            </button>

            <p style="font-size:.78rem; color:var(--gris); text-align:center; margin-top:14px; line-height:1.5;">
              <?= t('contact_confidentialite') ?>
            </p>
          </form>
        </div>
      </div>

      <!-- ============ COLONNE DROITE : INFOS + CARTE (45%) ============ -->
      <div>

        <!-- Infos de contact -->
        <div class="contact-info-card">
          <span class="section-tag" style="margin-bottom:16px; display:inline-block;"><?= t('contact_tag_coordonnees') ?></span>

          <div class="contact-info-item">
            <div class="contact-info-icon">
              <?= icon('location') ?>
            </div>
            <div>
              <div class="contact-info-label"><?= t('contact_label_adresse') ?></div>
              <div class="contact-info-value">
                Ouest Foire, route de l'aéroport<br>
                En face SDE Yoff<br>
                BP 121754 Dakar Ponty, Sénégal
              </div>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon">
              <?= icon('phone') ?>
            </div>
            <div>
              <div class="contact-info-label"><?= t('contact_label_telephone2') ?></div>
              <div class="contact-info-value">
                <a href="tel:+221338279639">+221 33 827 96 39</a><br>
                <a href="tel:+221776203603">+221 77 620 36 03</a>
              </div>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon">
              <?= icon('mail') ?>
            </div>
            <div>
              <div class="contact-info-label"><?= t('contact_label_email2') ?></div>
              <div class="contact-info-value">
                <a href="mailto:cotracsenegal@gmail.com">cotracsenegal@gmail.com</a>
              </div>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon">
              <?= icon('users') ?>
            </div>
            <div>
              <div class="contact-info-label"><?= t('contact_label_equipe') ?></div>
              <div class="contact-info-value">
                <?= t('contact_equipe_desc') ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Localisation -->
        <div class="contact-info-card" style="padding:0;overflow:hidden;">
          <a href="https://maps.google.com/?q=Ouest+Foire+Route+Aeroport+Dakar+Senegal" target="_blank" rel="noopener noreferrer"
             style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:240px;text-decoration:none;background:linear-gradient(135deg,#1a4a8a 0%,#0d2a4f 100%);position:relative;overflow:hidden;">
            <!-- Grille routes simulée CSS uniquement -->
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position:absolute;inset:0;opacity:0.15;">
              <line x1="0" y1="80" x2="100%" y2="90" stroke="#fff" stroke-width="3"/>
              <line x1="0" y1="140" x2="100%" y2="135" stroke="#fff" stroke-width="2"/>
              <line x1="180" y1="0" x2="175" y2="100%" stroke="#fff" stroke-width="2"/>
              <line x1="380" y1="0" x2="390" y2="100%" stroke="#fff" stroke-width="1.5"/>
              <line x1="0" y1="50" x2="60%" y2="70" stroke="#fff" stroke-width="1"/>
              <line x1="40%" y1="0" x2="50%" y2="100%" stroke="#fff" stroke-width="1"/>
            </svg>
            <!-- Contenu centré -->
            <div style="position:relative;z-index:1;text-align:center;">
              <svg width="44" height="44" viewBox="0 0 24 24" fill="#f7941d" stroke="#fff" stroke-width="1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3" fill="#fff"/></svg>
              <p style="color:#fff;font-weight:700;margin:10px 0 4px;font-size:0.95rem;">Ouest Foire, route de l'aéroport</p>
              <p style="color:rgba(255,255,255,0.65);font-size:0.8rem;margin:0 0 16px;">Dakar, Sénégal</p>
              <span style="background:#f7941d;color:#fff;padding:8px 20px;border-radius:20px;font-size:0.78rem;font-weight:600;display:inline-block;">Ouvrir dans Google Maps →</span>
            </div>
          </a>
          <a href="https://maps.google.com/?q=Ouest+Foire+Dakar+Senegal" target="_blank" rel="noopener noreferrer"
             style="display:flex;align-items:center;justify-content:center;gap:8px;padding:12px;background:var(--bleu-light);color:var(--bleu);font-size:0.82rem;font-weight:600;text-decoration:none;transition:background .2s;"
             onmouseover="this.style.background='#d4e6f7'" onmouseout="this.style.background='var(--bleu-light)'">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            <?= t('contact_maps_ouvrir') ?>
          </a>
        </div>
        <style>
        @keyframes map-ripple {
          0%   { transform:translate(-50%,-60%) scale(1); opacity:0.5; }
          100% { transform:translate(-50%,-60%) scale(2.2); opacity:0; }
        }
        </style>

        <!-- Horaires -->
        <div class="contact-info-card">
          <span class="section-tag" style="margin-bottom:12px; display:inline-block;"><?= t('contact_tag_dispo') ?></span>
          <h3 style="font-size:1rem; font-weight:700; margin-bottom:4px; color:var(--texte);"><?= t('contact_horaires_titre') ?></h3>
          <p style="font-size:0.82rem; color:var(--gris); margin-bottom:12px;"><?= t('contact_horaires_desc') ?></p>

          <div class="horaires-grid">
            <span class="horaire-jour"><?= t('contact_jour_semaine') ?></span>
            <span class="horaire-heure">8h00 - 18h00</span>
            <span class="horaire-jour"><?= t('contact_jour_samedi') ?></span>
            <span class="horaire-heure">8h00 - 13h00</span>
            <span class="horaire-jour"><?= t('contact_jour_dimanche') ?></span>
            <span class="horaire-heure" style="color:var(--gris);"><?= t('contact_ferme') ?></span>
          </div>

          <p style="font-size:0.8rem; color:var(--gris); margin-top:14px; border-top:1px solid var(--border); padding-top:12px;">
            <?= t('contact_urgences') ?>
          </p>
        </div>

      </div><!-- fin colonne droite -->

    </div><!-- fin contact-grid -->
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
