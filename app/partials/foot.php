<footer class="site">
  <div class="wrap">
    <div class="fcols">
      <div class="fcol">
        <a class="wm wm-foot" href="<?= htmlspecialchars(u('/'), ENT_QUOTES) ?>" aria-label="<?= htmlspecialchars(t('nav.home'), ENT_QUOTES) ?>"><img src="/images/brand/guliyev-white-logo.svg" alt="MGuliyev Studio" width="838" height="346"></a>
        <p style="color:var(--grey);font-size:.88rem;margin-top:14px;max-width:30ch"><?= htmlspecialchars(t('footer.tagline')) ?></p>
      </div>
      <div class="fcol"><h5><?= htmlspecialchars(t('nav.services')) ?></h5><ul>
        <li><a href="<?= htmlspecialchars(u('/uslugi/veb-sayty/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('cat.veb-sayty')) ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/dizayn/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('cat.dizayn')) ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/marketing/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('cat.marketing')) ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/podderzhka/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('cat.podderzhka')) ?></a></li><li><a href="<?= htmlspecialchars(u('/uslugi/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('footer.all_services')) ?></a></li>
      </ul></div>
      <div class="fcol"><h5><?= htmlspecialchars(t('footer.studio')) ?></h5><ul>
        <li><a href="<?= htmlspecialchars(u('/o-studii/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('nav.about')) ?></a></li><li><a href="<?= htmlspecialchars(u('/portfolio/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('nav.portfolio')) ?></a></li><li><a href="<?= htmlspecialchars(u('/') . '#process', ENT_QUOTES) ?>"><?= htmlspecialchars(t('footer.how')) ?></a></li><li><a href="<?= htmlspecialchars(u('/tseny/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('nav.price')) ?></a></li><li><a href="<?= htmlspecialchars(u('/kontakty/'), ENT_QUOTES) ?>"><?= htmlspecialchars(t('nav.contacts')) ?></a></li><li><a href="<?= htmlspecialchars(u('/') . '#faq', ENT_QUOTES) ?>"><?= htmlspecialchars(t('footer.faq')) ?></a></li>
      </ul></div>
      <div class="fcol"><h5><?= htmlspecialchars(t('nav.contacts')) ?></h5><ul>
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
      <span><?= htmlspecialchars(t('footer.city')) ?></span>
      <span><?php if (su('privacy_url') !== ''): ?><a href="<?= e(su('privacy_url')) ?>"><?= e(t('footer.privacy')) ?></a><?php else: ?><?= e(t('footer.privacy')) ?> — <?= e(sv('privacy_url')) ?><?php endif; ?></span>
    </div>
  </div>
</footer>
<script src="/assets/js/app.js" defer></script>
</body>
</html>
