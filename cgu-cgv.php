<?php
require_once __DIR__ . '/lang/lang.php';
$page_title = 'CGU / CGV | COTRAC';
$page_desc  = 'Conditions Générales d\'Utilisation et Conditions Générales de Vente de COTRAC SARL.';
require_once __DIR__ . '/includes/header.php';
?>

<style>
.legal-hero {
  background: linear-gradient(135deg, #1a3a5c 0%, #1a6bb5 100%);
  padding: 80px 0 60px;
  color: #fff;
  text-align: center;
}
.legal-hero h1 { font-size: 2.4rem; font-weight: 800; margin-bottom: 12px; }
.legal-hero p  { font-size: 1rem; opacity: .75; }
.legal-tabs {
  display: flex; gap: 12px; justify-content: center;
  margin: 40px 0 0; flex-wrap: wrap;
}
.legal-tab {
  padding: 10px 28px; border-radius: 50px; font-weight: 600;
  font-size: .9rem; cursor: pointer; border: 2px solid rgba(255,255,255,.4);
  color: #fff; background: transparent; transition: all .2s;
}
.legal-tab.active, .legal-tab:hover {
  background: #f7941d; border-color: #f7941d; color: #fff;
}
.legal-content { max-width: 860px; margin: 60px auto; padding: 0 24px 80px; }
.legal-section { display: none; }
.legal-section.active { display: block; }
.legal-content h2 {
  font-size: 1.2rem; font-weight: 700; color: #1a6bb5;
  margin: 40px 0 12px; border-left: 4px solid #f7941d;
  padding-left: 14px;
}
.legal-content h3 { font-size: 1rem; font-weight: 700; color: #1a3a5c; margin: 28px 0 8px; }
.legal-content p, .legal-content li { font-size: .97rem; line-height: 1.8; color: #444; }
.legal-content ul { padding-left: 20px; margin-top: 8px; }
.legal-content li { margin-bottom: 6px; }
</style>

<!-- Hero -->
<section class="legal-hero">
  <div class="container">
    <p style="font-size:.8rem;opacity:.6;text-transform:uppercase;letter-spacing:.1em;margin-bottom:10px;">Conditions contractuelles</p>
    <h1>CGU / CGV</h1>
    <p>Dernière mise à jour : juin 2026</p>
    <div class="legal-tabs">
      <button class="legal-tab active" onclick="switchTab('cgu', this)">Conditions d'Utilisation (CGU)</button>
      <button class="legal-tab" onclick="switchTab('cgv', this)">Conditions de Vente (CGV)</button>
    </div>
  </div>
</section>

<!-- Contenu -->
<div class="legal-content">

  <!-- CGU -->
  <div id="tab-cgu" class="legal-section active">

    <h2>1. Objet</h2>
    <p>Les présentes Conditions Générales d'Utilisation (CGU) ont pour objet de définir les modalités et conditions dans lesquelles les utilisateurs accèdent au site cotracgroup.com et en font usage.</p>

    <h2>2. Accès au site</h2>
    <p>Le site cotracgroup.com est accessible gratuitement à tout utilisateur disposant d'un accès à Internet. COTRAC se réserve le droit de modifier, suspendre ou interrompre l'accès au site à tout moment, sans préavis ni indemnité.</p>

    <h2>3. Utilisation du site</h2>
    <p>L'utilisateur s'engage à utiliser le site de manière conforme à sa destination et à la réglementation en vigueur. Il est notamment interdit de :</p>
    <ul>
      <li>Utiliser le site à des fins illicites ou frauduleuses</li>
      <li>Reproduire ou copier les contenus sans autorisation écrite</li>
      <li>Tenter de compromettre la sécurité du site</li>
      <li>Diffuser des contenus faux ou trompeurs via le formulaire de contact</li>
    </ul>

    <h2>4. Formulaire de contact</h2>
    <p>Le formulaire de contact est destiné exclusivement aux demandes professionnelles liées aux services de COTRAC (devis, informations, partenariats). Toute utilisation abusive (spam, démarchage, etc.) entraînera le blocage de l'adresse concernée.</p>

    <h2>5. Propriété intellectuelle</h2>
    <p>Tous les contenus du site (textes, images, logos, marques, vidéos) sont la propriété de COTRAC SARL ou de ses partenaires. Toute reproduction sans autorisation est strictement interdite.</p>

    <h2>6. Responsabilité</h2>
    <p>COTRAC ne saurait être tenu responsable des dommages directs ou indirects résultant de l'utilisation du site, d'une interruption de service ou d'informations inexactes.</p>

    <h2>7. Modification des CGU</h2>
    <p>COTRAC se réserve le droit de modifier les présentes CGU à tout moment. Les modifications prennent effet dès leur mise en ligne. L'utilisateur est invité à les consulter régulièrement.</p>

    <h2>8. Droit applicable</h2>
    <p>Les présentes CGU sont régies par le droit sénégalais. En cas de litige, les tribunaux de Dakar seront compétents.</p>

  </div>

  <!-- CGV -->
  <div id="tab-cgv" class="legal-section">

    <h2>1. Objet et champ d'application</h2>
    <p>Les présentes Conditions Générales de Vente (CGV) régissent les relations contractuelles entre COTRAC SARL et ses clients dans le cadre de la réalisation de prestations de travaux et services dans les domaines du BTP, des réseaux électriques, de la construction routière, du génie industriel et de la climatisation.</p>

    <h2>2. Devis et commandes</h2>
    <p>Toute prestation fait l'objet d'un devis gratuit établi par COTRAC après visite technique si nécessaire. Le devis est valable <strong>30 jours</strong> à compter de sa date d'émission. La commande est ferme à la signature du devis par le client accompagnée du versement de l'acompte convenu.</p>

    <h2>3. Prix et modalités de paiement</h2>
    <ul>
      <li>Les prix sont exprimés en <strong>FCFA TTC</strong></li>
      <li>Un acompte de <strong>30 % minimum</strong> est exigé à la commande</li>
      <li>Le solde est dû à la réception des travaux, constatée par procès-verbal</li>
      <li>Modes de paiement acceptés : virement bancaire, chèque certifié, espèces (dans les limites légales)</li>
    </ul>

    <h2>4. Délais d'exécution</h2>
    <p>Les délais d'exécution sont précisés dans le devis ou le contrat de prestation. Ils courent à compter de la réception de l'acompte et de la mise à disposition du site par le client. COTRAC ne peut être tenu responsable des retards dus à des causes extérieures (intempéries, problèmes d'approvisionnement, décisions administratives).</p>

    <h2>5. Réception des travaux</h2>
    <p>À l'achèvement des travaux, un procès-verbal de réception est établi contradictoirement. Les réserves éventuelles doivent être formulées par écrit lors de la réception. La levée des réserves conditionne le paiement du solde.</p>

    <h2>6. Garanties</h2>
    <ul>
      <li><strong>Garantie de parfait achèvement :</strong> 1 an à compter de la réception</li>
      <li><strong>Garantie biennale :</strong> 2 ans pour les éléments d'équipement dissociables</li>
      <li><strong>Garantie décennale :</strong> 10 ans pour les ouvrages de construction (lorsqu'applicable)</li>
    </ul>

    <h2>7. Responsabilité et assurance</h2>
    <p>COTRAC est couvert par une assurance responsabilité civile professionnelle et, le cas échéant, par une assurance décennale pour les ouvrages éligibles. Les attestations d'assurance sont disponibles sur demande.</p>

    <h2>8. Résiliation</h2>
    <p>En cas de résiliation du contrat à l'initiative du client après signature, les travaux déjà réalisés et les matériaux commandés seront facturés. Une indemnité forfaitaire de <strong>15 %</strong> du montant HT restant sera également due.</p>

    <h2>9. Litiges</h2>
    <p>En cas de litige, les parties s'engagent à rechercher une solution amiable avant tout recours judiciaire. À défaut d'accord, les tribunaux compétents de Dakar seront saisis.</p>

    <h2>10. Droit applicable</h2>
    <p>Les présentes CGV sont soumises au droit sénégalais, notamment au Code des Obligations Civiles et Commerciales (COCC).</p>

  </div>

</div>

<script>
function switchTab(tab, btn) {
  document.querySelectorAll('.legal-section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.legal-tab').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + tab).classList.add('active');
  btn.classList.add('active');
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
