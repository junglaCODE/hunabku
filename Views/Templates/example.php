<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title><?= $Template->_title ?></title>
    <link href="<?= $Template->framework ?>/style.css" type="text/css" rel="stylesheet">
    <?= $Template->_stylesheets ?>
  </head>

  <body class="vertical-layout vertical-menu-collapsible menu-collapse" 
    data-open="click"
    data-menu="vertical-dark-menu-template">

    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed" data-desing="organism-top-navbar"> 
        <?= $Template->Widget('TopNavBar') ?>
      </div>
    </header>
  
    <aside class="sidenav-main nav-collapsible sidenav-active-square sidenav-dark nav-collapsed" 
      data-desing="organism-menu-sidenav">
        <?= $Template->Widget('MenuSideNav') ?>
    </aside>

    <div id="main" data-desing="template-module">
      <div class="row">
          <?= $this->renderSection('module') ?>
      </div>
    </div>
    
    <script src="<?= $Template->framework ?>/../jquery.js?ver=<?=VERSION?>" type="text/javascript"></script>
    <?= $Template->_javascripts ?>
  </body>
</html>