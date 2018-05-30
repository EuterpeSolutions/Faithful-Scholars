<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php pageTitle(); ?> | <?php siteName(); ?></title>
    <link rel="stylesheet" href="/stylesheet/app.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="row outer-row">
      <div class="col-md-12">
        <img class="logoimg" src="/assets/faithfulscholarslogo.png" alt="">
        <header>
          <nav class="menu">
            <?php navMenu(); ?>
          </nav>
        </header>
        <article>
          <h3 class="pageTitle"><?php pageTitle(); ?></h3>
          <?php pageContent(); ?>
        </article>
        <footer><small>&copy;<?php echo date('Y'); ?> <?php siteName(); ?>.</small></footer>
      </div>
    </div>
  </body>
</html>
