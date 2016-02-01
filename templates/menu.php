<?php $menuItems = array('work', 'about', 'contact'); ?>

<div class="row menu">
  <div class="col-xs-12 col-md-12 menu">
    <?php
      foreach($menuItems as $key=>$item) {
        $active = ($page == $item) ? 'class="active"' : '';

        printf("<a href=\"/%s\" %s>%s</a>",
          $item, $active, ucfirst($item)
        );
      }
    ?>
  </div>
</div>

