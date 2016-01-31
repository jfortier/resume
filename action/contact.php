<?php

require __DIR__ . '/../lib/recaptcha.php';

class ContactForm
{
  private $method;
  private $requiredFields = array(
    'name' => "Missing name field.",
    'email' => "Missing email field.",
    'g-recaptcha-response' => "These aren't the droids I was looking for."
  );

  public function __construct()
  {
    $this->method = strtolower($_SERVER['REQUEST_METHOD']);
  }

  public function getField($field) {
    if (isset($_POST[$field])) {
      return $_POST[$field];
    }
    return "";
  }

  public function processForm()
  {
    if ($this->method == "post") {

      $this->checkRequiredFields();
      $recaptcha = new GoogleRecaptcha();

      if ($recaptcha->verify($_POST['g-recaptcha-response'])) {
        return $this->sendEmail($_POST['email'], $_POST['name'], $_POST['message']);
      } else {
        $this->throwError();
      }

    }
    return false;
  }

  public function checkRequiredFields()
  {
    foreach ($this->requiredFields as $field=>$message) {
      if (empty($_POST[$field])) {
        throw new \Exception($message);
      }
    }
  }

  public function sendEmail($email, $name, $message)
  {
    $mail = $this->configureMailer();
    $mail->addReplyTo($email, $name);
    $mail->Subject = 'Resume Contact Form';
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);

    if(!$mail->send()) {
      throw new \Exception("Message could not be sent. " . $mail->ErrorInfo);
    } else {
      return true;
    }
  }

  public function configureMailer()
  {
    $mail = new \PHPMailer();

    // $mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.zoho.com';                        // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = getenv('EMAIL_FROM');               // SMTP username
    $mail->Password = getenv('EMAIL_FROM_PASSWORD');           // SMTP password
    $mail->SMTPSecure = getenv('EMAIL_SMTP_SECURITY');    // Enable TLS encryption, `ssl` also accepted
    $mail->Port = getenv('EMAIL_SMTP_PORT');              // TCP port to connect to

    //From myself to myself (alter reply address)
    $mail->setFrom(getenv('EMAIL_FROM'), getenv('EMAIL_FROM_NAME'));
    $mail->addAddress(getenv('EMAIL_TO'), getenv('EMAIL_TO_NAME'));
    $mail->isHTML(true);                                  // Set email format to HTML

    return $mail;
  }

  public function throwError()
  {
    throw new \Exception("Could not verify captcha, try again.");
  }

}

$contactForm = new ContactForm();
