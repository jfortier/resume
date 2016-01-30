<?php

require __DIR__ . '/../lib/recaptcha.php';
$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method == "post") {

  $recaptcha = new GoogleRecaptcha();
  if ($recaptcha->verify($_POST['g-recaptcha-response'])) {
    print "Hooray you are not a robot";
  } else {
    print "Google say's you're a bot";
  }
}

// echo getenv('EMAIL');
