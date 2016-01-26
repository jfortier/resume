<?php include('templates/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <?php
      switch (strtolower($_SERVER['REQUEST_URI']))
      {
        case '/about':
          include_once('about.php');
          break;
        case '/contact':
          include_once('contact.php');
          break;
        case '/technologies':
          include_once('technologies.php');
          break;
        case '/work':
        default:
          include_once('work.php');
          break;
      }
    ?>
  </div>
</div>

<?php include('templates/footer.php'); ?>
