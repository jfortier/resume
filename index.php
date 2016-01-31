<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// quick n' dirty router
$route = strtolower($_SERVER['REQUEST_URI']);
switch ($route)
{
  case '/about':
    require('about.php');
    break;
  case '/contact':
    require __DIR__ . '/action/contact.php';
    require('contact.php');
    break;
  case '/':
  case '/work':
    require('work.php');
    break;
  default:
    require('404.php');
    break;
}

