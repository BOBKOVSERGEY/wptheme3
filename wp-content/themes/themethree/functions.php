<?php
/* gzip сжатие*/

function obSaveCookieAfter($s)
{
  setcookie("page_size_after", strlen($s));
  return $s;
}
// Аналогично, но для Cookie page_size_before.
function obSaveCookieBefore($s)
{
  setcookie("page_size_before", strlen($s));
  return $s;
}
// Устанавливаем конвейер обработчиков.
ob_start("obSaveCookieAfter");
ob_start("ob_gzhandler", 9);
ob_start("obSaveCookieBefore");

/**
 * загружаемые  стили и скрипты
 */
function loadStyleScript()
{
  // подключаем стили сайта
  wp_enqueue_style('styleThemeThee', get_stylesheet_uri());

  wp_enqueue_style('styleThemeTheeFlex', get_template_directory_uri() . '/flexslider.css');
  wp_enqueue_style('styleThemeTheeUi', get_template_directory_uri() . '/css/jquery-ui-1.9.2.custom.css');

  // подключаем скрипты
  wp_enqueue_script('jquery-google', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', [], null, true);
  wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', [], null, true);
  wp_enqueue_script('flexslidermain', get_template_directory_uri() . '/js/main.js', [], null, true);
  wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.js', [], null, true);
  wp_enqueue_script('mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.js', [], null, true);
  wp_enqueue_script('demo', get_template_directory_uri() . '/js/demo.js', [], null, true);
  wp_enqueue_script('ui', get_template_directory_uri() . '/js/jquery-ui-1.9.2.custom.js', [], null, true);
  //wp_enqueue_script('jqueryThemeTwo', get_template_directory_uri() . '/js/script.js', [], null, true);
}
// загружаем стили
add_action('wp_enqueue_scripts', 'loadStyleScript');


// хук для title
add_action('after_setup_theme', 'titleThemeThree');

function titleThemeThree()
{
  /*добавляем title*/
  add_theme_support('title-tag');
}


/**
 * удаляем теги из html
 */
add_filter('the_generator', '__return_empty_string');

remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
// убрать вывод коротких ссылок
remove_action('wp_head', 'wp_shortlink_wp_head');
// Убрать вывод канонических ссылок:
remove_action('wp_head','rel_canonical');

remove_action('wp_head','adjacent_posts_rel_link_wp_head');
remove_action('wp_head','feed_links_extra', 3);

remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');

remove_action( 'wp_head', 'wp_resource_hints', 2 );
// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
remove_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
remove_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

// Отключаем события REST API
remove_action( 'init',          'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
remove_action( 'parse_request', 'rest_api_loaded' );

// Отключаем Embeds связанные с REST API
remove_action( 'rest_api_init',          'wp_oembed_register_route'              );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

/**
 * удаляем теги из html
 */


/**
 *
 * Опции в админке
 */
function myMoreOptions()
{
  // создает поле опции
  // $id, $title, $callback, $page, $section, $args
  add_settings_field(
    'phone',
    'Телефон',
    'displayPhone',
    'general'
  );

  // регистрирует новую опцию и callback функцию
  register_setting(
    'general',
    'myPhone'
  );
}

add_action('admin_init', 'myMoreOptions');

function displayPhone()
{
  echo "<input type='text' class='regular-text' name='myPhone' value='" . esc_attr(get_option('myPhone')) . "'>";
}
/**
 *
 * end Опции в админке
 */
/**Иконки виджет
 *
 */
register_sidebar(
  [
    'name' => 'Иконки в шапке',
    'id'   => 'icons_header',
    'description' => 'Добавление иконок',
    'class'         => '',
    'before_widget' => '',
    'after_widget'  => ''
  ]
);
/**End Иконки виджет
 *
 */

/**
 * Регистрация меню
 */

register_nav_menus(
 [
   'header_menu' => 'Меню в шапке',
   'footer_menu' => 'Меню в подвале'
 ]
);

/**
 * End Регистрация меню
 */
/**
Регистрируем новый тип записи
 */
add_action('init', 'themeThreePostTypes');

function themeThreePostTypes () {
  // регистрация слайдера
  register_post_type('slider', [
    'labels' => [
      'name'               => 'Слайдшоу на главной', // основное название для типа записи
      'singular_name'      => 'Слайд', // название для одной записи этого типа
      'add_new'            => 'Добавить новый', // для добавления новой записи
      'add_new_item'       => 'Добавить новый слайд', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item'          => 'Редактирование слайд', // для редактирования типа записи
      'new_item'           => 'Новый слайд', // текст новой записи
      'view_item'          => 'Смотреть слайд', // для просмотра записи этого типа.
      'search_items'       => 'Искать слайды', // для поиска по этим типам записи
      'not_found'          => 'Слайд не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине слайда', // если не было найдено в корзине
      'parent_item_colon'  => '', // для родителей (у древовидных типов)
      'menu_name'          => 'Слайдшоу на главной', // название меню
    ],
    'public'              => true,
    'publicly_queryable'  => false, // убираем возможность перейти
    'exclude_from_search' => true, // убираем из поиска
    'menu_position'       => 25,
    'menu_icon'           => 'dashicons-images-alt2',
    'hierarchical'        => false,
    'supports'            => array('title', 'thumbnail', 'editor', 'custom-fields'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'query_var'           => false
  ]);

}
/**
End Регистрируем новый тип записи
 */

/**
 * Поддержка миниатюр
 */
add_theme_support('post-thumbnails');
/**
 * End Поддержка миниатюр
 */

/*
 * Несколько миниатур

add_action("admin_init", "images_init");
add_action('save_post', 'save_images_link');
function images_init(){
  $post_types = get_post_types();
  foreach ( $post_types as $post_type ) {
    add_meta_box("my-images", "Pictures", "images_link", $post_type, "normal", "low");
  }
}
function images_link(){
  global $post;
  $custom  = get_post_custom($post->ID);
  $link    = $custom["_link"][0];
  $count   = 0;
  echo '<div class="link_header">';
  $query_images_args = array(
    'post_type' => 'attachment',
    'post_mime_type' =>array(
      'jpg|jpeg|jpe' => 'image/jpeg',
      'gif' => 'image/gif',
      'png' => 'image/png',
    ),
    'post_status' => 'inherit',
    'posts_per_page' => -1,
  );
  $query_images = new WP_Query( $query_images_args );
  $images = array();
  echo '<div class="frame">';
  $thelinks = explode(',', $link);
  foreach ( $query_images->posts as $file) {
    if(in_array($images[]= $file->ID, $thelinks)){
      echo '<label><input type="checkbox" group="images" value="'.$images[]= $file->ID.'" checked /><img src="'.$images[]= $file->guid.'" width="60" height="60" /></label>';
    }else{
      echo '<label><input type="checkbox" group="images" value="'.$images[]= $file->ID.'" /><img src="'.$images[]= $file->guid.'" width="60" height="60" /></label>';
    }
    $count++;
  }
  echo '<br /><br /></div></div>';
  echo '<input type="hidden" name="link" class="field" value="'.$link.'" />';
  echo '<div class="images_count"><span>Files: <b>'.$count.'</b></span> <div class="count-selected"></div></div>';
}
function save_images_link(){
  global $post;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){ return $post->ID; }
  update_post_meta($post->ID, "_link", $_POST["link"]);
}
add_action( 'admin_head-post.php', 'images_css' );
add_action( 'admin_head-post-new.php', 'images_css' );
function images_css() {
  echo '<style type="text/css">
        #my-images .inside{padding:0px !important;margin:0px !important;}
        .frame{
                width:100%;
                height:320px;
                overflow:auto;
                background:#e5e5e5;
                padding-bottom:10px;
                }
        .field{width:800px;}
        #results {
                width:100%;
                overflow:auto;
                background:#e5e5e5;
                padding:0px 0px 10px 0px;
                margin:0px 0px 0px 0px;
                }
        #results img{
                border:solid 5px #FDD153;
                -moz-border-radius:3px;
                margin:10px 0px 0px 10px;
                }
        .frame label{
                margin:10px 0px 0px 10px;
                padding:5px;
                background:#fff;
                -moz-border-radius:3px;
                border:solid 1px #B5B5B5;
                height:60px;
                display:block;
                float:left;
                overflow:hidden;
                }
        .frame label:hover{
                background:#74D3F2;
                }
        .frame label.checked{background:#FDD153 !important;}
        .frame label input{
                opacity:0.0;
                position:absolute;
                top:-20px;
                }
        .images_count{
                font-size:10px;
                color:#666;
                text-transform:uppercase;
                background:#f3f3f3;
                border-top:solid 1px #ccc;
                position:relative;
                }
        .selected_title{border-top:solid 1px #ccc;}
        .images_count span{
                color:#666;
                padding:10px 6px 6px 12px;
                display:block;
                }
        .count-selected{
                font-size:9px;
                font-weight:bold;
                position:absolute;
                top:10px;
                right:10px;
                }
                </style>';
}
add_action( 'admin_head-post.php', 'images_js' );
add_action( 'admin_head-post-new.php', 'images_js' );
function images_js(){?>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      $('.frame input').change(function() {
        var values = new Array();
        $("#results").empty();
        var result = new Array();
        $.each($(".frame input:checked"), function() {
          result.push($(this).attr("value"));
          $(this).parent().addClass('checked');
        });
        $('.field').val(result.join(','));
        $('.count-selected').text('Selected: '+result.length);
        $.each($(".frame input:not(:checked)"), function() {
          $(this).parent().removeClass('checked');
        });
      });
      var result = new Array();
      $.each($(".frame input:checked"), function() {
        result.push($(this).attr("value"));
        $(this).parent().addClass('checked');
      });
      $('.field').val(result.join(','));
      $('.count-selected').text('Selected: '+result.length);
      $.each($(".frame input:not(:checked)"), function() {
        $(this).parent().removeClass('checked');
      });
    });
  </script>
<?php }
function show_thumbnails_list(){
  global $post;
  $image = get_post_meta($post->ID, '_link', true);
  $image = explode(",", $image);
  foreach($image as $images){
    $url = wp_get_attachment_image_src($images, 1, 1);
    echo '<a href="';
    echo $url[0];
    echo '" class="lightbox">';
    echo wp_get_attachment_image($images,'full', 1, 1);
    echo '</a>';
  }
}


 * End Несколько миниатур
 */
/**
 * Список меток
 */
function myListTags()
{
  $tags = get_the_tags();
  $tagStr = null;
  if ($tags) {
    $tagStr = '<p>';
    foreach ($tags as $tag) {
      $tagStr .= $tag->name . ', ';
    }
    // убираем запятую и пробел справа
    $tagStr = rtrim($tagStr, ', ');
    $tagStr .= '</p>';
  }
  echo $tagStr;

}
/**
 * End Список меток
 */
