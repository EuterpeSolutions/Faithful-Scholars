<?php
  // Used to store website configuration information
  function config($key = '')
  {
    $config = [
      'name' => 'Simple PHP Website',
      'nav_menu' => [
        '' => 'Home',
        'test' => 'Test',
      ],
      'template_path' => 'template',
      'content_path' => 'content',
      'pretty_uri' => false,
    ];

    return isset($config[$key]) ? $config[$key] : null;
  }

?>
