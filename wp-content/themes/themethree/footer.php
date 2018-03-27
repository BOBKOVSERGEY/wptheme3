<div class="footer">
  <p class="copy">Copyright 2012. All Right Reserved MonkeeThemes.</p>
  <?php
  $args = [
    'theme_location'  => 'footer_menu',
    'container_class'       => 'ftrmenu',
    'menu_class'      => ''
  ];
  wp_nav_menu($args);
  ?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>