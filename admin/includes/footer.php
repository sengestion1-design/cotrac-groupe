<div id="toast-container" style="position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:8px;"></div>
<script>
function showToast(msg, type) {
  type = type || 'success';
  var colors = { success: '#276749', error: '#c53030', info: '#1a6bb5', warning: '#c05621' };
  var bgs    = { success: '#f0fff4', error: '#fff5f5', info: '#ebf8ff', warning: '#fffbeb' };
  var t = document.createElement('div');
  t.textContent = msg;
  t.style.cssText = 'padding:10px 18px;border-radius:8px;font-size:.88rem;font-weight:600;box-shadow:0 4px 16px rgba(0,0,0,.12);'
    + 'background:' + (bgs[type]||bgs.success) + ';color:' + (colors[type]||colors.success) + ';'
    + 'border:1px solid currentColor;opacity:0;transition:opacity .25s;max-width:320px;';
  document.getElementById('toast-container').appendChild(t);
  requestAnimationFrame(function(){ t.style.opacity = '1'; });
  setTimeout(function(){ t.style.opacity = '0'; setTimeout(function(){ t.remove(); }, 300); }, 3000);
}
</script>
