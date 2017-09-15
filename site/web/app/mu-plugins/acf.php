<?php
  function acf_groups() {
    include_once 'acf/option-header.php';
    include_once 'acf/sales-page.php';
    include_once 'acf/webbio-pages.php';
  }
  add_action('acf/init', 'acf_groups');