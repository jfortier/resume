<?php

class GoogleRecaptcha
{
  private $googleUrl = "https://www.google.com/recaptcha/api/siteverify";

  public function verify($response)
  {
    $fields = $this->getFields($response);
    $curlData = $this->submitRecaptcha($fields);
    return $this->processResponse($curlData);
  }

  public function getFields($response)
  {
    return array(
      'secret' => urlencode(getenv('RECAPTCHA_SECRET')),
      'response' => urlencode($response),
      'remoteip' => urlencode($_SERVER['REMOTE_ADDR'])
    );
  }

  public function processResponse($curlData)
  {
    $response = json_decode($curlData, true);

    if($response['success'] == 'true') {
      return true;
    }
    return false;
  }

  public function submitRecaptcha($fields)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $this->googleUrl);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $curlData = curl_exec($curl);
    curl_close($curl);

    return $curlData;
  }
}
