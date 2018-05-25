<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php pageTitle(); ?> | <?php siteName(); ?></title>
    <link rel="stylesheet" href="/stylesheet/app.css">
  </head>
  <body>
    <div class="wrap">
      <header>
        <h2><?php siteName(); ?></h2>
        <nav class="menu">
          <?php navMenu(); ?>
        </nav>
      </header>


      <article>
        <h3><?php pageTitle(); ?></h3>
        <?php pageContent(); ?>
      </article>
    </div>

    <footer><small>&copy;<?php echo date('Y'); ?> <?php siteName(); ?>.</small></footer>
  </body>
</html>
