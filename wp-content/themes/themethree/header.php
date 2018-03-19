<!doctype html>
<html lang="ru">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php wp_head(); ?>
<body>
<div class="karkas">
  <div class="header">
    <a href="#"><img class="logo" src="<?php bloginfo('template_url')?>/images/logo.png" alt="Extendet" /></a>
    <p class="head-contakt">
      <img src="<?php bloginfo('template_url')?>/images/head-mail.png" alt="" /> <a href="mailto:<?php bloginfo('admin_email')?>"><?php bloginfo('admin_email')?></a>&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo('template_url')?>/images/head-phone.png" alt="" /> <?php echo get_option('myPhone'); ?>
    </p>
    <div class="head-soc">
      <a href="#"><img src="<?php bloginfo('template_url')?>/images/head-soc1.png" alt="" /></a>
      <a href="#"><img src="<?php bloginfo('template_url')?>/images/head-soc2.png" alt="" /></a>
      <a href="#"><img src="<?php bloginfo('template_url')?>/images/head-soc3.png" alt="" /></a>
      <a href="#"><img src="<?php bloginfo('template_url')?>/images/head-soc4.png" alt="" /></a>
      <a href="#"><img src="<?php bloginfo('template_url')?>/images/head-soc5.png" alt="" /></a>
      <a href="#"><img src="<?php bloginfo('template_url')?>/images/head-soc6.png" alt="" /></a>
    </div>
    <div class="menu">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">The Team</a></li>
        <li><a href="#">Testimonials</a></li>
        <li><a href="#">Our Work</a></li>
        <li><a href="#">Our Videos</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <div class="serach">
        <form action="">
          <input class="search-txt" type="text" value="Search" onBlur="if(this.value=='')this.value='Search'" onFocus="if(this.value=='Search')this.value=''" />
          <input type="image" src="<?php bloginfo('template_url')?>/images/search-bg.png" name="go" />
        </form>
      </div>
    </div>
  </div>