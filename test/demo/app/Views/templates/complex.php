
<!doctype html class="h-100">
<!--simple_without_libraries_external
https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/
-->
<html lang="<?= $Hunabku->app->lang?>" >
<head>
    <meta charset="<?=$Hunabku->app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="<?=$Hunabku->app->name?>">
    <title><?= $Hunabku->title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= $Hunabku->framework ?>/sticky_footer.css?ver=<?=$Hunabku->app->version ?>" rel="stylesheet" type="text/css" >
    <?= $Hunabku->stylesheets ?>
</head>
<body class="d-flex flex-column h-100">
    
    <header>
        <?= $Hunabku->Widget('TopNavigator',['dark']) ?>
    </header>

    <main class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <?= $this->renderSection('column_one') ?>
            </div>
            <div class="col-4">
                <?= $this->renderSection('column_two') ?>
            </div>
        </div>
        
    </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?= $Hunabku->javascripts ?>
      
  </body>
</html>
