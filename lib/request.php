<?php

class Request
{
  public function __construct()
  {

  }

  public function hitme()
  {
    echo "Hit me with your best shot";
  }
}

$request = new Request();
