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
	* en el caché está en segundos.
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