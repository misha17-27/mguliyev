<footer class="site">
  <div class="wrap">
    <div class="fcols">
      <div class="fcol">
        <a class="wm wm-foot" href="<?= htmlspecialchars(u('/'), ENT_QUOTES) ?>" aria-label="<?= t('nav.home') ?>"><img src="/images/brand/guliyev-white-logo.svg" alt="MGuliyev Studio" width="838" height="346"></a>
        <p style="color:var(--grey);font-size:.88rem;margin-top:14px;max-width:30ch"><?= t('footer.tagline') ?></p>
      </div>
      <div class="fcol"><h2><?= t('nav.services') ?></h2><ul>
        <li><a href="<?= htmlspecialchars(u('/uslugi/veb-sayty/'), ENT_QUOTES) ?>"><?= t('cat.veb-sayty') ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/dizayn/'), ENT_QUOTES) ?>"><?= t('cat.dizayn') ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/marketing/'), ENT_QUOTES) ?>"><?= t('cat.marketing') ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/podderzhka/'), ENT_QUOTES) ?>"><?= t('cat.podderzhka') ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/'), ENT_QUOTES) ?>"><?= t('footer.all_services') ?></a></li>
      </ul></div>
      <div class="fcol"><h2><?= t('footer.studio') ?></h2><ul>
        <li><a href="<?= htmlspecialchars(u('/o-studii/'), ENT_QUOTES) ?>"><?= t('nav.about') ?></a></li><li><a href="<?= htmlspecialchars(u('/portfolio/'), ENT_QUOTES) ?>"><?= t('nav.portfolio') ?></a></li><li><a href="<?= htmlspecialchars(u('/') . '#process', ENT_QUOTES) ?>"><?= t('footer.how') ?></a></li><li><a href="<?= htmlspecialchars(u('/tseny/'), ENT_QUOTES) ?>"><?= t('nav.price') ?></a></li><li><a href="<?= htmlspecialchars(u('/kontakty/'), ENT_QUOTES) ?>"><?= t('nav.contacts') ?></a></li><li><a href="<?= htmlspecialchars(u('/') . '#faq', ENT_QUOTES) ?>"><?= t('footer.faq') ?></a></li>
      </ul></div>
      <div class="fcol"><h2><?= t('nav.contacts') ?></h2><ul>
        <?php /* Контакты и соцсети — из настроек панели. Незаполненное
           показывается пометкой, а не пропадает молча: так видно,
           что данные ждут, а не что их решили не показывать. */ ?>
        <li><a href="<?= e(tel_href()) ?>"><?= e(sv('phone')) ?></a></li>
        <li><a href="mailto:<?= e(s('email')) ?>"><?= e(sv('email')) ?></a></li>
        <?php foreach (['instagram' => 'Instagram', 'facebook' => 'Facebook', 'tiktok' => 'TikTok'] as $k => $nm):
            $href = su($k);
            if ($href === '' && $k === 'tiktok') continue;   // TikTok необязателен
        ?>
          <li><?php if ($href !== ''): ?>
            <a href="<?= e($href) ?>" target="_blank" rel="noopener me"><?= e($k === 'instagram' && s('instagram_name') !== '' ? s('instagram_name') : $nm) ?></a>
          <?php else: ?><span><?= e(sv($k)) ?></span><?php endif; ?></li>
        <?php endforeach; ?>
      </ul></div>
    </div>
    <div class="fbot">
      <span>© 2026 MGuliyev Studio</span>
      <span><?= t('footer.city') ?></span>
      <span><?php if (su('privacy_url') !== ''): ?><a href="<?= e(su('privacy_url')) ?>"><?= t('footer.privacy') ?></a><?php else: ?><?= t('footer.privacy') ?> — <?= e(sv('privacy_url')) ?><?php endif; ?></span>
    </div>
  </div>
</footer>
<script src="/assets/js/app.js" defer></script>
</body>
</html>
