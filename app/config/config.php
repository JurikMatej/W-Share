<?php
  // DB params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'projects_wshare');

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)) );

  // URL root   # CHANGE #
  define('URLROOT', "http://$_SERVER[HTTP_HOST]/W-Share/public");

  // Site name  # CHANGE #
  define('SITENAME', 'W-Share');

  // App version 
  define('APPVERSION', '1.0.0');