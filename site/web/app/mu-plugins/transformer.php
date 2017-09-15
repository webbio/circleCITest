<?php

/**
 * Plugin Name: Transformer
 * Description: Serves all the data to the twig views
 * Version: 1.0.0
 * Author: Webbio B.V.
 * Author URI: https://webbio.nl
 */

class PageTransformer {
  public function __construct() {

  }

  /**
	 * Global functions for all site
	 */

  function transformExamplePosts($post) {
    $response = array();
    //$response = json_decode(json_encode($response), $array);
    return $response;
  }
}

?>
