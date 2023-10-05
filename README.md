# Hunabku

## Descripcion 

Librería para renderizar vistas para codeigniter 4, Esta basado en la idea de atomic desing de frost https://bradfrost.com/blog/post/atomic-web-design/.

Se usa tambien las libreria de view de ci4 que ayuda mejorar el performance de la render de las vistas https://codeigniter4.github.io/userguide/outgoing/index.html

- **Autor :** JLGC/monolinux | jlgarcia@junglacode.org
- **Web :** junglacode.org
- **Licencia :** https://choosealicense.com/licenses/mit/ 

## Significado

Hunabku fue creado con las mejores intenciones y homenaje a una librería que se utilizaba anteriormente CI3  que se llamaba[codeigniter-template-library](https://github.com/jenssegers/codeigniter-template-library) de @jenssegers. Al cual ser obsoleta para CI4 
me di a la tarea de hacer un fork del proyecto y hacerla compatible con CI4

- **Hunabku :** Dios Maya de la creación
    - **Kalmanani :** Palabra Nahualt que significa Arquitecto
    - **Amantecatl :** Palabra Nahualt que significa Artesano


## Estructura 
- App
  - Config
    -  Archivo Render.php : Agregar archivo en el directorio app/Config. _Se recomienda anexar este contenido en el archivo View.php para mejores practicas_ 
   - Libraries
     - Directorio Hunabku : Agregar la carpeta en este directorio app/Libraries
   - Views
     - Directorio Templates : Crear esta carpeta en el directorio app/Views

## Config > Render.php
```
    /*Objeto principal que crea la instancia de la clase Kalmanani*/ 
    public $instance_render = 'Hunabku';
	
    /**
	* Configuración de caché para view_cell y view. constantes usadas
	* sección: Constantes de tiempo, para duración de tiempo
	* en el caché está en segundos. 
	* a View se debe verificar que este parametro no este duplicado
	*/
	public $cache = 60;

    /** 
	* este directorio se utiliza para almacenar todo lo relacionado con
	* plantillas y widgets de esta biblioteca
	**/

	public $widgets = 'templates/widgets/';

	/**
	* Configuración del repositorio de activos, para qué sirve
    * renderizar plantilla usada.
	*/

	public $repository = [];
```
## Config > Amantecatl.php

Para usar la clase ```Amantecatl``` es necesario anexar en el directorio Templates la carpeta widgets ya que esta clase es una interface que hace se vayan incorporando nuevos componentes al master template como :

- Menu TopNavBar
- Menu SideNav
- Breadcrumbs


## Controller > BaseController.php

Agregar el siguiente codigo en la archivo BaseController.php . Es importante destacar que nombre de la variable debe ser indentica a la nombre del parametro $instance_render
```
	public $Hunabku;

	/*Colocar est codígo en la función initController*/

	$this->Hunabku = new \App\Libraries\Hunabku\Kalmanani();
```

## Ejecutar el demo de la librería

Moverse al directorio test/demo/  y ejecutar  el comando ```php spark serve```  e ir a  http://localhost:8080