<?php

require_once 'dbconfig.php';

global $county_array;



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
    if($uri == 'logout'){
      $nav_menu .= '<a href="/member_site/'.(config('pretty_uri') || $uri == '' ? '' : '?page=').$uri.'" class="right right-margin">'.$name.'</a>'.'  ';
    } else {
      $nav_menu .= '<a href="/member_site/'.(config('pretty_uri') || $uri == '' ? '' : '?page=').$uri.'">'.$name.'</a>'.'  ';
    }

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
function childInput($name, $data = [], $start_tab_index = 1)
{
  $num_child = 9;
  $output = "";
  for($i = 1; $i <= $num_child; $i++) {
    $output .= '<div class="form-group">';
    $output .= '<label for="'.$name.$i.'">'.ucfirst($name).' '.$i.':&nbsp</label>';
    $tab_offset = $start_tab_index + (($i-1)*3);
    if(isset($data[$i-1])){
      $output .= '<input id="'.$name.$i.'" value="'.$data[$i-1][$name].'" name="'.$name.$i.'"class="form-control">';
    }else{
      $output .= '<input tabindex="'.$tab_offset.'" id="'.$name.$i.'" name="'.$name.$i.'"class="form-control">';
    }

    $output .= '</div>';
  }
  return $output;
}

// Displays the options for the county dropdowns
function generateCounty($selected_county = 'Abbeville'){
  $county_array = array('Abbeville', 'Akien', 'Allendale', 'Anderson', 'Bamberg', 'Barnwell', 'Beaufort', 'Berkeley', 'Calhoun', 'Charleston', 'Cherokee', 'Chester', 'Chesterfield', 'Clarendon', 'Colleton', 'Darlington', 'Dillon', 'Dorchester', 'Edgefield', 'Fairfield', 'Florence', 'Georgetown', 'Greenville', 'Greenwood', 'Hampton', 'Horry', 'Jasper', 'Kershaw', 'Lancaster', 'Laurens', 'Lee', 'Lexington', 'Marion', 'Marlboro', 'McCormick', 'Newberry', 'Oconee', 'Orangeburg', 'Pickens', 'Richland', 'Saluda', 'Spartanburg', 'Sumter', 'Union', 'Williamsburg', 'YORK');
  foreach($county_array as $c){
    echo "<option value='".$c."'";
    if($selected_county == $c) echo ' selected="selected"';
    echo "'>".$c."</option>";
  }
}

// Displays the options for the school district dropdowns
function generateSchoolDisctrict($selected_district){
  $district_array = array('Abbeville 60', 'Aiken 01', 'Allendale 01', 'Anderson 01', 'Anderson 02', 'Anderson 03', 'Anderson 04', 'Anderson 05', 'Bamberg 01', 'Bamberg 02', 'Barnwell 19', 'Barnwell 29', 'Barnwell 45', 'Beaufort 01', 'Berkeley 01', 'Calhoun 01', 'Charleston 01', 'Cherokee 01', 'Chester 01', 'Chesterfield 01', 'Clarendon 01', 'Clarendon 02', 'Clarendon 03', 'Colleton 01', 'Darlington 01', 'Dillon 03', 'Dillon 04', 'Dorchester 02', 'Dorchester 04', 'Edgefield 01', 'Fairfield 01', 'Florence 01', 'Florence 02', 'Florence 03', 'Florence 04', 'Florence 05', 'Georgetown 01', 'Greenville 01', 'Greenwood 50', 'Greenwood 51', 'Greenwood 52', 'Hampton 01', 'Hampton 02', 'Horry 01', 'Jasper 01', 'Kershaw 01', 'Lancaster 01', 'Laurens 55', 'Laurens 56', 'Lee 01', 'Lexington 01', 'Lexington 02', 'Lexington 03', 'Lexington 04', 'Lexington 05', 'Marion 10', 'Marlboro 01', 'McCormick 01', 'Newberry 01', 'Oconee 01', 'Orangeburg 03', 'Orangeburg 04', 'Orangeburg 05', 'Pickens 01', 'Richland 01', 'Richland 02', 'Saluda 01', 'Spartanburg 01', 'Spartanburg 02', 'Spartanburg 03', 'Spartanburg 04', 'Spartanburg 05', 'Spartanburg 06', 'Spartanburg 07', 'Sumter 01', 'Union 01', 'Williamsburg 01', 'York 01', 'York 02', 'York 03', 'York 04');
  foreach($district_array as $d){
    echo "<option value='".$d."'";
    if($selected_district == $d) echo ' selected="selected"';
    echo "'>".$d."</option>";
  }
}

// Starts everything and displays the template
function run()
{
  include config('template_path').'/template.php';
}


?>
