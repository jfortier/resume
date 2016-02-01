<?php
$page = "contact";
include('templates/header.php');
?>

<div class="col-xs-12 col-md-4 contact-form">
  <?php
    try{
      if ($contactForm->processForm()) {
        print("
          <div class=\"alert alert-success\" role=\"alert\">
            Message succesfully sent.
          </div>
        ");
      }

    } catch (\Exception $error) {
      printf("
        <div class=\"alert alert-danger\" role=\"alert\">
          <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
          <span class=\"sr-only\">Error:</span>
          %s
        </div>", $error->getMessage()
      );
    }
  ?>

  <form method="post">

    <div class="form-group">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" name="name"
        placeholder="Name" required="required"
        value="<?php echo $contactForm->getField("name"); ?>" />
    </div>

    <div class="form-group">
      <label for="inputEmail">Email</label>
      <input type="text" class="form-control" name="email" id="inputEmail"
        placeholder="Email" required="required"
        value="<?php echo $contactForm->getField("email"); ?>" />
    </div>

    <div class="form-group">
      <label for="inputMessage">Message</label>
      <textarea class="form-control" name="message" id="inputMessage"
        placeholder="Message"><?php
          echo $contactForm->getField("message");
        ?></textarea>
    </div>

    <div class="form-group">
      <div class="g-recaptcha" id="inputSpam"
        data-sitekey="6Lef1hYTAAAAAGtbweS2SZrD9v2HdiD4COyLBucN">
      </div>
    </div>

    <div class="form-group">
      <button type="submit" id="inputSubmit" class="btn btn-default">
        Submit
      </button>
    </div>

  </form>
</div>

<?php include('templates/footer.php'); ?>
