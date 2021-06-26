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

  <body>

    <header>
  
    </header>
  

    <div id="main" data-desing="template-module">
          <?= $this->renderSection('module') ?>
    </div>
	  
    <footer>
	
	</footer>	
	
    <script src="<?= $Template->framework ?>/../jquery.js?ver=<?=VERSION?>" type="text/javascript"></script>
    <?= $Template->_javascripts ?>
  </body>
</html>