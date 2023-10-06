<!doctype html>
<!--simple_without_libraries_internal
https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/
-->
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $Hunabku->title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?= $Hunabku->stylesheets ?>
  </head>
  <body >
   
    <header>
    </header>

    <main>
      <div class="container">
          <?= $this->renderSection('container') ?>
      </div>
    </main>

    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?= $Hunabku->javascripts ?>
  </body>
</html>
