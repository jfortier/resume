<?php
  $pageTitle = "Contact";
  include('templates/header.php');
?>

<div class="col-xs-12 col-md-4">
  <form method="post">

    <div class="from-group">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" />
    </div>

    <div class="from-group">
      <label for="inputEmail">Email</label>
      <input type="text" class="form-control" name="email" id="inputEmail" placeholder="Email" />
    </div>

    <div class="from-group">
      <label for="inputMessage">Message</label>
      <textarea class="form-control" name="message" id="inputMessage" placeholder="Message"></textarea>
    </div>

    <div class="from-group">
      <label for="inputSpam">Who likes SPAM? Not I.</label>
      <div class="g-recaptcha" id="inputSpam" data-sitekey="6Lef1hYTAAAAAGtbweS2SZrD9v2HdiD4COyLBucN"></div>
    </div>

    <div class="from-group">
      <!-- <label for="inputSubmit">Vg</label> -->
      <button type="submit" id="inputSubmit" class="btn btn-default">Submit</button>
    </div>

  </form>
</div>

<?php include('templates/footer.php'); ?>
