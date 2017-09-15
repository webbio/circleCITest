<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */

// Allow SVG files to upload - Webbio settings
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

$sage_includes = [
  'lib/assets.php',     // Scripts and stylesheets
  'lib/extras.php',     // Custom functions
  'lib/setup.php',      // Theme setup
  'lib/titles.php',     // Page titles
  'lib/wrapper.php',    // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/timber.php'      // Timber
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


add_filter( 'timber_context', 'mytheme_timber_context'  );

function mytheme_timber_context( $context ) {
  $context['options'] = get_fields('option');
  return $context;
}

function load_more_comments(){
  $postID = $_POST['ID'];
  $count = $_POST['count'];
  $commnetGroup = get_field('vanriet_block', $postID);

  echo Timber::compile('components/card-vanriet.twig', $commnetGroup[$count]);
  wp_die();
}
/*ajax load comments specialism */
add_action('wp_ajax_more_comments', 'load_more_comments');
add_action('wp_ajax_nopriv_more_comments', 'load_more_comments'); // not really needed

// filter the Gravity Forms button type
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
  return "<button class='uk-button uk-button-secondary' id='gform_submit_button_{$form["id"]}'><span class='uk-box__content-wrap'><span class='uk-box__content'>{$form['button']['text']}</span></span></button>";
}
// filter the Gravity Forms button type
//add_filter("gform_field_content", "form_label", 10, 2);
//function form_label($button, $form){
//  var_dump($form);
//  return "<div class='uk-form-group uk-first-column'>
//  <input class='uk-input' name='input_{$form["id"]}' id='input_1_{$form["id"]}' type='{$form["type"]}' placeholder='Input'>
//  <label class='uk-form-label'>{$form["label"]}</label>
//  </div>";
//
//}
add_filter("gform_validation_message", "change_message", 10, 2);
function change_message($message, $form){
  return "<div class='validation_error'>Oeps, er is wat misgegaan bekijk hieronder waar</div>";
}

/*function to add async and defer attributes*/
function defer_js_async($tag){

## 1: list of scripts to defer. (Edit with your script names)
  $scripts_to_defer = array('jquery-migrate.js', 'particles.js');

#defer scripts
  foreach($scripts_to_defer as $defer_script){
    if(true == strpos($tag, $defer_script ) )
      return str_replace( ' src', ' defer="defer" src', $tag );
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'defer_js_async', 10 );