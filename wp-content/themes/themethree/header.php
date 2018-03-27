<!doctype html>
<html lang="ru">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php wp_head(); ?>
<body>
<div class="karkas">
  <div class="header">
    <a href="<?php echo home_url();?>"><img class="logo" src="<?php bloginfo('template_url')?>/images/logo.png" alt="Extendet" /></a>
    <p class="head-contakt">
      <img src="<?php bloginfo('template_url')?>/images/head-mail.png" alt="" /> <a href="mailto:<?php bloginfo('admin_email')?>"><?php bloginfo('admin_email')?></a>&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo('template_url')?>/images/head-phone.png" alt="" /> <?php echo get_option('myPhone'); ?>
    </p>
    <div class="head-soc">
      <?php if(!dynamic_sidebar('icons_header')){ ?>
        <span>Это виджет иконок соцсети</span>
      <?php } ?>
    </div>
    <div class="menu">
      <?php
      $args = [
        'theme_location'  => 'header_menu',
        'container'       => '',
        'menu_class'      => ''
      ];
        wp_nav_menu($args);
      ?>
      <div class="serach">
        <form action="">
          <input class="search-txt" type="text" value="Search" onBlur="if(this.value=='')this.value='Search'" onFocus="if(this.value=='Search')this.value=''" />
          <input type="image" src="<?php bloginfo('template_url')?>/images/search-bg.png" name="go" />
        </form>
      </div>
    </div>
  </div>