# Hunabku
- **Descripcion :** Librería para renderizar vistas para codeigniter 4, Esta basado en la idea de atomic desing de frost https://bradfrost.com/blog/post/atomic-web-design/.
Se usa tambien las libreria de view de ci4 que ayuda mejorar el performance de la render de las vistas https://codeigniter4.github.io/userguide/outgoing/index.html

- **Autor :** JLGC/monolinux | jlgarcia@junglacode.org
- **web :** junglacode.org

## Significado
- **Hunabku :** Dios Maya de la creación
    - **Kalmanani :** Palabra Nahualt que significa Arquitecto
    - **Amantecatl :** Palabra Nahualt que significa Artesano


## Estructura 
- App
  - Config
    -  Archivo Render.php : Agregar archivo en el directorio app/Config. * Se recomienda anexar este contenido en el archivo View.php 
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
	* en el caché está en segundos. Si se pretende incorporar el contenido de Render
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

## Controller > BaseController.php

Agregar el siguiente codigo en la archivo BaseController.php . Es importante destacar que nombre de la variable debe ser indentica a la nombre del parametro $instance_render
``` public $Hunabku;
	$this->Hunabku = new \App\Libraries\Hunabku\Kalmanani();
```
## Incorporar el contenido de Render.php a View.php
Este metodo es el adecuado ya Hunabku es extension de la Views que maneja CodeIgniter 
Por lo que se hace mas flexible el mantenimiento y integración

Para esto se debe poner este codigo al final del archivo Config/View.php

> Se debe tener cuidado con el parametro Cache del archivo View ya que este tiene uno por defecto. Asi que solo debe quedar uno

```
    /*Objeto principal que crea la instancia de la clase Kalmanani*/ 
    public $instance_render = 'Hunabku';
	
    /**
	* Configuración de caché para view_cell y view. constantes usadas
	* sección: Constantes de tiempo, para duración de tiempo
	* en el caché está en segundos. Si se pretende incorporar el contenido de Render
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