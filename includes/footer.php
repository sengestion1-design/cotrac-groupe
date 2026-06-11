<footer class="footer">
  <div class="container">
    <div class="footer-grid">

      <!-- Brand -->
      <div class="footer-brand">
        <div class="logo-text" style="margin-bottom:16px;">
          <span class="name" style="color:#fff;font-family:'Poppins',sans-serif;font-size:1.4rem;font-weight:800;">C<span style="color:#f7941d;">O</span>TRAC</span><br>
          <span class="tagline" style="font-size:0.62rem;color:rgba(255,255,255,0.4);letter-spacing:0.08em;text-transform:uppercase;">Compagnie des Travaux et Constructions</span>
        </div>
        <p><?= t('footer_desc') ?></p>
        <div class="footer-contact-item">
          <span class="icon"><?= icon('location') ?></span>
          <span>Ouest Foire, route de l'aéroport en face SDE Yoff, BP 121754 Dakar</span>
        </div>
        <div class="footer-contact-item">
          <span class="icon"><?= icon('phone') ?></span>
          <span><a href="tel:+221338279639">+221 33 827 96 39</a> &nbsp;|&nbsp; <a href="tel:+221776203603">+221 77 620 36 03</a></span>
        </div>
        <div class="footer-contact-item">
          <span class="icon"><?= icon('mail') ?></span>
          <a href="mailto:cotracsenegal@gmail.com">cotracsenegal@gmail.com</a>
        </div>
      </div>

      <!-- Nos pôles -->
      <div class="footer-col">
        <h4><?= t('footer_poles') ?></h4>
        <ul>
          <li><a href="<?= SITE_URL ?>/btp.php"><?= t('nav_poles_btp') ?></a></li>
          <li><a href="<?= SITE_URL ?>/energie.php"><?= t('nav_poles_energie') ?></a></li>
          <li><a href="<?= SITE_URL ?>/routes.php"><?= t('nav_poles_routes') ?></a></li>
          <li><a href="<?= SITE_URL ?>/industrie.php"><?= t('nav_poles_industrie') ?></a></li>
        </ul>
      </div>

      <!-- Liens rapides -->
      <div class="footer-col">
        <h4><?= t('footer_liens') ?></h4>
        <ul>
          <li><a href="<?= SITE_URL ?>/index.php"><?= t('footer_lien_accueil') ?></a></li>
          <li><a href="<?= SITE_URL ?>/a-propos.php"><?= t('footer_lien_apropos') ?></a></li>
          <li><a href="<?= SITE_URL ?>/galerie.php">Galerie</a></li>
          <li><a href="<?= SITE_URL ?>/realisations.php"><?= t('footer_lien_realisations') ?></a></li>
          <li><a href="<?= SITE_URL ?>/contact.php"><?= t('footer_lien_contact') ?></a></li>
        </ul>
      </div>

      <!-- Infos légales -->
      <div class="footer-col">
        <h4><?= t('footer_infos') ?></h4>
        <ul>
          <li><a href="#">RCCM : SN DKR 2018-B-19082</a></li>
          <li><a href="#">NINEA : 006932504 2V2</a></li>
          <li><a href="#">SARL - Capital 5 000 000 FCFA</a></li>
          <li><a href="#">Créée en 2015</a></li>
        </ul>
        <div style="margin-top:20px;">
          <span class="section-tag" style="margin-bottom:0;"><?= t('footer_aligne') ?></span>
        </div>
      </div>

    </div>

    <!-- Bottom -->
    <div class="footer-bottom">
      <span>© <?= date('Y') ?> <a href="<?= SITE_URL ?>">COTRAC SARL</a>. <?= t('footer_copyright') ?></span>
      <span class="footer-legal-links">
        <a href="<?= SITE_URL ?>/mentions-legales.php">Mentions légales</a>
        <span style="opacity:.4;">|</span>
        <a href="<?= SITE_URL ?>/confidentialite.php">Confidentialité</a>
        <span style="opacity:.4;">|</span>
        <a href="<?= SITE_URL ?>/cgu-cgv.php">CGU / CGV</a>
      </span>
    </div>
  </div>
</footer>

<script src="<?= SITE_URL ?>/assets/js/main.js"></script>

<!-- ── Bouton WhatsApp flottant ── -->
<a href="https://wa.me/221776203603?text=Bonjour%20COTRAC%2C%20je%20souhaite%20obtenir%20des%20informations%20sur%20vos%20services."
   class="whatsapp-float"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="Contacter COTRAC sur WhatsApp">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="28" height="28">
    <path fill="#fff" d="M24 4C13 4 4 13 4 24c0 3.6.97 7 2.66 9.9L4 44l10.4-2.63A19.93 19.93 0 0 0 24 44c11 0 20-9 20-20S35 4 24 4z"/>
    <path fill="#25D366" d="M24 6.5C14.34 6.5 6.5 14.34 6.5 24c0 3.27.9 6.33 2.47 8.96L7 41l8.22-2.15A17.44 17.44 0 0 0 24 41.5c9.66 0 17.5-7.84 17.5-17.5S33.66 6.5 24 6.5z"/>
    <path fill="#fff" d="M32.5 27.8c-.4-.2-2.38-1.17-2.75-1.3-.37-.14-.64-.2-.9.2-.27.4-1.04 1.3-1.27 1.57-.24.27-.47.3-.87.1-.4-.2-1.68-.62-3.2-1.97-1.18-1.05-1.98-2.35-2.21-2.75-.23-.4-.02-.62.17-.82.18-.18.4-.47.6-.7.2-.23.27-.4.4-.66.14-.27.07-.5-.03-.7-.1-.2-.9-2.17-1.23-2.97-.32-.78-.65-.67-.9-.68l-.76-.01c-.27 0-.7.1-1.06.5-.37.4-1.4 1.37-1.4 3.33 0 1.97 1.43 3.87 1.63 4.14.2.26 2.82 4.3 6.83 6.03.96.41 1.7.66 2.28.84.96.3 1.83.26 2.52.16.77-.12 2.38-.97 2.72-1.9.33-.95.33-1.76.23-1.93-.1-.17-.37-.27-.77-.47z"/>
  </svg>
  <span class="whatsapp-float-label">WhatsApp</span>
</a>

<style>
.whatsapp-float {
  position: fixed;
  bottom: 28px;
  right: 28px;
  z-index: 9999;
  background: #25D366;
  color: #fff;
  border-radius: 50px;
  padding: 12px 18px 12px 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  box-shadow: 0 4px 20px rgba(37,211,102,0.45);
  font-family: 'Poppins', sans-serif;
  font-size: 0.88rem;
  font-weight: 600;
  transition: transform .25s, box-shadow .25s;
  animation: wa-pulse 2.5s ease-in-out infinite;
}
.whatsapp-float:hover {
  transform: translateY(-3px) scale(1.04);
  box-shadow: 0 8px 32px rgba(37,211,102,0.55);
  animation: none;
}
.whatsapp-float-label { color: #fff; white-space: nowrap; }
@keyframes wa-pulse {
  0%, 100% { box-shadow: 0 4px 20px rgba(37,211,102,0.45); }
  50%       { box-shadow: 0 4px 28px rgba(37,211,102,0.75), 0 0 0 8px rgba(37,211,102,0.12); }
}
@media (max-width: 480px) {
  .whatsapp-float { padding: 13px; border-radius: 50%; }
  .whatsapp-float-label { display: none; }
}
</style>

</body>
</html>
