<?php 
include('templates/header.php');

// quick n' dirty router
$route = strtolower($_SERVER['REQUEST_URI']);
switch ($route)
{
  case '/about':
    include_once('about.php');
    break;
  case '/contact':
    include_once('contact.php');
    break;
  case '/tech':
    include_once('tech.php');
    break;
  case '/':
  case '/work':
    include_once('work.php');
    break;
  default:
    include_once('404.php');
    break;
}
include('templates/footer.php');
