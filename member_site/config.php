<?php
  // Used to store website configuration information
  function config($key = '')
  {
    $config = [
      'name' => 'Simple PHP Website',
      'nav_menu' => [
        '' => 'Dashboard',
        'update-family-information' => 'Update Family Information'
      ],
      'template_path' => 'template',
      'content_path' => 'content',
      'pretty_uri' => false,
      'stylesheet_path' => 'stylesheet',
    ];

    return isset($config[$key]) ? $config[$key] : null;
  }

?>
