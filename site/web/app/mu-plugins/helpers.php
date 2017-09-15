<?php

/**
 * Plugin Name: Helpers
 * Description: Helps getting data for transformer files
 * Version: 1.0.0
 * Author: Webbio B.V.
 * Author URI: https://webbio.nl
 */

class PageHelpers {
  public function __construct() {

  }

  /**
	 * Global functions for all site
	 */

  function helper1($post) {
    $response = array();
    //$response = json_decode(json_encode($response), $array);
    return $response;
  }
}

?>
