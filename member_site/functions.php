<?php

// Displays the site name
function siteName()
{
  echo config('name');
}

// Displays page title from the URL
function pageTitle()
{
  $page = isset($_GET['page']) ? $_GET['page'] : 'Dashboard';
  echo ucwords(str_replace('-', ' ', $page));
}

// Website navigation
function navMenu($sep = ' | ')
{
  $nav_menu = '';

  // For each page as defined in config.php
  foreach (config('nav_menu') as $uri => $name) {
    $nav_menu .= '<a href="/'.(config('pretty_uri') || $uri == '' ? '' : '?page=').$uri.'">'.$name.'</a>'.$sep;
  }

  echo trim($nav_menu, $sep);
}

// Displays page content from static pages in the pages/ directory
function pageContent()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    $path = getcwd().'/'.config('content_path').'/'.$page.'.php';
    if (file_exists(filter_var($path, FILTER_SANITIZE_URL))) {
        include $path;
    } else {
        include config('content_path').'/404.php';
    }
}

// Starts everything and displays the template
function run()
{
  include config('template_path').'/template.php';
}

?>
