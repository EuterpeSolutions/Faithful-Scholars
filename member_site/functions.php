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
function navMenu($sep = '  ')
{
  $nav_menu = '';

  // For each page as defined in config.php
  foreach (config('nav_menu') as $uri => $name) {
    $nav_menu .= '<a href="/'.(config('pretty_uri') || $uri == '' ? '' : '?page=').$uri.'">'.$name.'</a>'.'  ';
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

// Displays child input boxes
function childInput($name, $num_child = 9)
{
  $output = '';

  for($i = 1; $i <= $num_child; $i++) {
    $output .= '<div class="form-group">';
    $output .= '<label for="'.$name.$i.'">'.ucfirst($name).' '.$i.':&nbsp</label>';
    $output .= '<input id="'.$name.$i.'" name="'.$name.$i.'"class="form-control">';
    $output .= '</div>';
  }
  return $output;
}


// Starts everything and displays the template
function run()
{
  include config('template_path').'/template.php';
}


?>
