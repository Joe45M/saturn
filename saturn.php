<?php
/**
Plugin Name: Saturn
 */

/*
 |--------------------------------------------------------------------
 | Config
 |--------------------------------------------------------------------
 |
 | Define constants which are absolutely required.
 |
 */

$plugin_path = plugin_dir_path(__FILE__);


/*
 |--------------------------------------------------------------------
 | Autoload
 |--------------------------------------------------------------------
 |
 | Autoload our namespaced interfaces, bootstrapping the application.
 |
 */

require $plugin_path . 'vendor/autoload.php';