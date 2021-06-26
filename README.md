# Hunabku
- **Descripcion :** Librería para renderizar vistas para codeigniter 4, Esta basado en la idea de atomic desing de frost https://bradfrost.com/blog/post/atomic-web-design/.
Se usa tambien las libreria de view de ci4 que ayuda mejorar el performance de la render de las vistas https://codeigniter4.github.io/userguide/outgoing/index.html

- **Autor :** JLGC/monolinux | jlgarcia@junglacode.org
- **web :** junglacode.org

## Significado
- **Hunabku :** Dios Maya de la creación
- **Kalkami :** Palabra Nahualt que significa Arquitecto
- **Amantecatl :** Palabra Nahualt que significa Artesano


## Estructura 
- App
  - Config
    -  View.php > sobre escribir este archivo en el directorio
   - Libraries
     -  Hunabku > Agregar la carpeta en este directorio
   - Views
     - Templates > Agregar esta carpeta en este directorio

## Config > View.php
```
  /* este parametro modifica la cache de las vistas*/
	public $cache = SECOND; 
  
 /* este parametro da la ruta de las widgets que se van usar*/
	public $widgets = '/Templates/_widgets'; 
  
/* este parametro modifica las rutas de nuestro directorio que usara para renderizar mis paginas*/
	public $repository = array(
			'assets' 	=> 	'/_assets/' , 
			'framework'	=>	'third_party/framework-css,
			'images'	=> 	'/_assets/images' ,
			'fonts'		=> 	'/_assets/fonts' ,
		);
	
```


