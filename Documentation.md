## Incorporar el contenido de Render.php a View.php
Este metodo es el adecuado ya Hunabku es extension de la Views que maneja CodeIgniter 
Por lo que se hace mas flexible el mantenimiento y integración

Para esto se debe poner este codigo al final del archivo Config/View.php

> Se debe tener cuidado con el parametro Cache del archivo View ya que este tiene uno por defecto. Asi que solo debe quedar uno

```

    public $instance_render = 'Hunabku';

	public $cache = 60;

	public $widgets = 'templates/widgets/';

	public $path_views = 'interfaces/';
    
	public $repository = [
        'framework'	=>	'assets' ,
        'css'       =>  'assets' ,
        'js'        =>  'assets' ,
    ];
```

## Conectar Kalmanani con Config App

Hunabku trata de integrarse el core principal de CI. Por eso se recomienda adaptar el archivo ```Render.php``` a la configuración de Views. Como se indica en la parte de arriba. 

En este apartado vamos adaptar la configuración de ```App.php``` para que hunabku pueda usarla en los templates.

```
/*en el archivo Kalmanani.php se tiene la siguiente configuración*/

$this->app = (object) [
                'charset' => config('App')->charset,
                'lang'    => config('App')->defaultLocale,
                'name'    => 'junglacode' ,
                'version' => '1.0',
            ]; 

/*charset y lang los toma por default ya que esos parametros vienen por defecto en CI4, nosotro vamos agregar el parametro. name y version*/

```

Incorporar al final del archivo ```App.php```  los siguientes parametros

```
/*
    * --------------------------------------------------------------------------
    * Parameters of App Development for junglaCODE
    * --------------------------------------------------------------------------
*/
        
    public $name = "Nombre de la app";
    public $version = "1.0"; 
	/*este parametro sirve para la cache de los scripts*/

```

Entonces vamos a modificar lo siguiente en kalmanani

```
$this->app = (object) [
                'charset' => config('App')->charset,
                'lang'    => config('App')->defaultLocale,
                'name'    => config('App')->name,
                'version' => config('App')->version,
            ]; 
```

> Puedes agregar los parametros que necesites para crear tus vistas, solo recuerda que deben estar presente en los archivos ```App.php``` y ```Kalmanani.php```

## Estructura de archivos recomendada

Para que se mantenga limpio el codigo en las vistas se recomienda tener la siguiente estructura de directtorios en la carpeta Views.

- Views
    - interfaces : _aqui irán todas las interfaces de tu aplicativo_
    - templates : _aqui irán todos los templates que requiera tu aplicación_
	   - widgets : _aqui irán  todos los widgets que complementen o extiendan a tu templates_


## Funcionalidad para crear un vista

Comose comento anteriormente esta libreria es una extensión del render de vistas que nos provee CodeIgniter. Así que para mas información ir a  [View Layout](https://codeigniter.com/user_guide/outgoing/view_layouts.html)

Recuerde que en un marco MVC, el Controlador actúa como principal ejecutor de todas las peticiones, por lo que es responsable de obtener una vista particular. Es necesario tener conocimiento del [Arquitectura MVC](https://codeigniter.com/user_guide/concepts/mvc.html?highlight=mvc)

### El template

Este es un tamplate simple donde se hace peticiones desde un CDN de boostrap y practicamente hace los llamados de los parametros para que cuando estos se modifiquen desde los archivos de configuración los templates sea actualizen
```
<!doctype html>
<html lang="<?= $Hunabku->app->lang?>" >
  <head>
    <meta charset="<?=$Hunabku->app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="<?=$Hunabku->app->name?>">
    <title><?= $Hunabku->title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
   
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
  </body>
</html>
```
### La interface 

La interface no es mas que la solución que vas realizar la cual se va incrustar dentro del template. Para esto se debe primero hacer referencia a que template vas utilizar y despues donde vas estar poner el contenido. 

Si prestas atención ```renderSection``` que tienes en el template es la parte dinámica donde se quieres que se inserte el HTML , de ahi en adelante todo lo que este dentro de las etiquetas ``$this->section`` y ```$this->endSection```. Sera enviado desde el controlador


```
<?= $this->extend('templates/simple') ?>

<?= $this->section('container') ?>

<h1 class="mt-5">
    <?= $welcome ?>
</h1>

<?= $this->endSection() ?>  
```
### El controlador

Para poder hacer el render solo debes invocar la funcion render Render el cual tiene los dos parametros :
- **$interface :**  es el nombre del archivo donde se ubica la interface donde se va incrustar en el template
- **$parametros :** Son todos los parametros que quieres enviar a la vista

```
 public function index(): string
    {
        $this->Hunabku->title = 'Pagina Demo';
        $parameters =  [
            "welcome" => "Hello World desde Hunabku"
        ];
        return $this->Hunabku->Render('bootstrap_external', $parameters);
    }
```
## Incorporar Widgets en los template

Los widgets practicamente son componentes que van dentro del template esta funcionalidad hace que extienda tus templates con mas funcionalidades. Recordemos que esta librería trata de apagarse al concepto de atom desing. Por lo tanto los componentes vienen siendo los organismos y asu vez estos tienen moleculas. Un tema complejo aquí te dejo  [Mas información](https://www.uifrommars.com/atomic-design-ventajas/).

Para poder integrar Widgets en el template se debe crear una carpeta en el directorio ```App/View/templates/widgets``` si se requiere cambiar el nombre de la carpeta solo hay que modificar el parametro de ``` public $widgets``` que puede estar en ```Config/Render``` o ```Config/Views```.

Dentro de esa carpeta ira fragmentos de codígo HTML que construyen a dicho componente.

### Template

Incorporamos un widget Con la funcion de Widget , esta funcion hace referencia a la funcion de view_cell, para [Mas información](https://codeigniter.com/user_guide/outgoing/view_cells.html)

```
 <header>
    <?= $Hunabku->Widget('TopNavigator',['dark']) ?>
</header>
```

### Widget

Crear un archivo que se llame topnavigator.php y dentro de este poner el siguiente fragmento de codígo

```
<nav class="navbar navbar-expand-md navbar-<?=$color?> fixed-top bg-<?=$color?>">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?= $app?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
</nav>
```

### Amentecatl

Esta clase es practicamente el artista que genera todos los widgets de los templates igual puede adaptarse para mas funcionales que requiera tu solución. Esta clase funciona como una interface donde vas agregando los widgets que requieras.

Agregar la función. Para tener un orden en el codígo se recomienda que el nombre de la función se ha igual al nombre del archivo que tiene en la carpeta widgets

```
 public function TopNavigator(array $params)
    {
        $component = $this->config->widgets.strtolower(__FUNCTION__);
        $properties = [
            'color' => $params[0] ,
            'app'   => $this->app->name ,
        ];
        return  view($component,$properties);
    }
```
Prácticamente para construir un nuevo widget solo necesitas esta lineas de codígo 

```
$component = $this->config->widgets.strtolower(__FUNCTION__);
$properties = [];
return  view($component,$properties);
```

- ```$this->config->widgets.strtolower(__FUNCTION__);``` esto solo funcionara si tu nombre de la función es igual a la nombre del archivo. De lo contrario **$component** debe tener el nombre completo junto con la ruta del archivo que haces refernecia. 
- Las **properties** son todos los datos que quieres que se vayan a tu codigo html que estan en widgets
