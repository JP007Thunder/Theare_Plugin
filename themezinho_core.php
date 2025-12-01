<?php
/*
Plugin Name: Themezinho Core
Plugin URI: https://themezinho.net
Description: Themezinho Core
Author: themezinho
Version: 1.2.0
Author URI: http://themezinho.net
*/

define( "THEMEZINHO_CORE_PATH", plugin_dir_path( __FILE__ ) );
define( "THEMEZINHO_CORE_URI", plugins_url( 'themezinho_core/' ) );
define( "PAGE_BUILDER_GROUP", __( 'digiflex', 'themezinho' ) );

add_action( 'vc_before_init', 'themezinho_vc_addons' );
/**
 * JS Composer Elements
 */

function themezinho_vc_addons() {


  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/section-title.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/text-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/movies.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/audiobooks.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/theaters.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/tv-show.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/side-image.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/side-icon-content.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/testimonial.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/price-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/icon-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/team-member.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/cta-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/devices-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/accordion-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/support-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/custom-button.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/contact-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/image.php';


}

require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/vc_extra_params.php';

/**
 * Include advanced custom field
 */
// 1. customize ACF path
add_filter( 'acf/settings/path', 'themezinho_acf_settings_path' );

function themezinho_acf_settings_path( $path ) {
  $path = THEMEZINHO_CORE_PATH . '/inc/acf/';

  return $path;
}


// 2. customize ACF dir
add_filter( 'acf/settings/dir', 'themezinho_acf_settings_dir' );

function themezinho_acf_settings_dir( $dir ) {
  $dir = THEMEZINHO_CORE_URI . '/inc/acf/';

  return $dir;
}

//Hide ACF field group menu item
add_filter( 'acf/settings/show_admin', '__return_false' );
require THEMEZINHO_CORE_PATH . '/inc/acf/acf.php';

require_once THEMEZINHO_CORE_PATH . '/inc/theme-options.php';

require_once THEMEZINHO_CORE_PATH . '/inc/cpt-taxonomy.php';
require_once THEMEZINHO_CORE_PATH . '/inc/theaters-options.php';
require_once THEMEZINHO_CORE_PATH . '/inc/google-maps-api.php';



function motts_animations() {

  return array(
    'bounce' => 'bounce',
    'flash' => 'flash',
    'pulse' => 'pulse',
    'rubberBand' => 'rubberBand',
    'shake' => 'shake',
    'headShake' => 'headShake',
    'swing' => 'swing',
    'tada' => 'tada',
    'wobble' => 'wobble',
    'jello' => 'jello',
    'bounceIn' => 'bounceIn',
    'bounceInDown' => 'bounceInDown',
    'bounceInLeft' => 'bounceInLeft',
    'bounceInRight' => 'bounceInRight',
    'bounceInUp' => 'bounceInUp',
    'bounceOut' => 'bounceOut',
    'bounceOutDown' => 'bounceOutDown',
    'bounceOutLeft' => 'bounceOutLeft',
    'bounceOutRight' => 'bounceOutRight',
    'bounceOutUp' => 'bounceOutUp',
    'fadeIn' => 'fadeIn',
    'fadeInDown' => 'fadeInDown',
    'fadeInDownBig' => 'fadeInDownBig',
    'fadeInLeft' => 'fadeInLeft',
    'fadeInLeftBig' => 'fadeInLeftBig',
    'fadeInRight' => 'fadeInRight',
    'fadeInRightBig' => 'fadeInRightBig',
    'fadeInUp' => 'fadeInUp',
    'fadeInUpBig' => 'fadeInUpBig',
    'fadeOut' => 'fadeOut',
    'fadeOutDown' => 'fadeOutDown',
    'fadeOutDownBig' => 'fadeOutDownBig',
    'fadeOutLeft' => 'fadeOutLeft',
    'fadeOutLeftBig' => 'fadeOutLeftBig',
    'fadeOutRight' => 'fadeOutRight',
    'fadeOutRightBig' => 'fadeOutRightBig',
    'fadeOutUp' => 'fadeOutUp',
    'fadeOutUpBig' => 'fadeOutUpBig',
    'flipInX' => 'flipInX',
    'flipInY' => 'flipInY',
    'flipOutX' => 'flipOutX',
    'flipOutY' => 'flipOutY',
    'lightSpeedIn' => 'lightSpeedIn',
    'lightSpeedOut' => 'lightSpeedOut',
    'rotateIn' => 'rotateIn',
    'rotateInDownLeft' => 'rotateInDownLeft',
    'rotateInDownRight' => 'rotateInDownRight',
    'rotateInUpLeft' => 'rotateInUpLeft',
    'rotateInUpRight' => 'rotateInUpRight',
    'rotateOut' => 'rotateOut',
    'rotateOutDownLeft' => 'rotateOutDownLeft',
    'rotateOutDownRight' => 'rotateOutDownRight',
    'rotateOutUpLeft' => 'rotateOutUpLeft',
    'rotateOutUpRight' => 'rotateOutUpRight',
    'hinge' => 'hinge',
    'jackInTheBox' => 'jackInTheBox',
    'rollIn' => 'rollIn',
    'rollOut' => 'rollOut',
    'zoomIn' => 'zoomIn',
    'zoomInDown' => 'zoomInDown',
    'zoomInLeft' => 'zoomInLeft',
    'zoomInRight' => 'zoomInRight',
    'zoomInUp' => 'zoomInUp',
    'zoomOut' => 'zoomOut',
    'zoomOutDown' => 'zoomOutDown',
    'zoomOutLeft' => 'zoomOutLeft',
    'zoomOutRight' => 'zoomOutRight',
    'zoomOutUp' => 'zoomOutUp',
    'slideInDown' => 'slideInDown',
    'slideInLeft' => 'slideInLeft',
    'slideInRight' => 'slideInRight',
    'slideInUp' => 'slideInUp',
    'slideOutDown' => 'slideOutDown',
    'slideOutLeft' => 'slideOutLeft',
    'slideOutRight' => 'slideOutRight',
    'slideOutUp' => 'slideOutUp',
    'heartBeat' => 'heartBeat'
  );
}


// default options
function digiflex_after_import() {

  update_field( 'enable_user_menu', 1, 'option' );


}
