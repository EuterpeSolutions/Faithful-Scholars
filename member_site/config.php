<?php
require_once('dbconfig.php');
  // Used to store website configuration information
  function config($key = '')
  {
    $config = [
      'name' => 'Faithful Scholars',
      'nav_menu' => [
        '' => 'Dashboard',
        'update-family-information' => 'Update Family Information',
        'logout' => 'Logout'
      ],
      'template_path' => 'template',
      'content_path' => 'content',
      'pretty_uri' => false,
      'stylesheet_path' => 'stylesheet',
    ];
    if(isAdmin($_SESSION['uname']) == 1){
      $config = [
        'name' => 'Faithful Scholars',
        'nav_menu' => [
          '' => 'Dashboard',
          'update-family-information' => 'Update Family Information',
          'admin' => 'Admin Panel',
          'logout' => 'Logout'
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'pretty_uri' => false,
        'stylesheet_path' => 'stylesheet',
      ];
    }
    return isset($config[$key]) ? $config[$key] : null;
  }

?>
