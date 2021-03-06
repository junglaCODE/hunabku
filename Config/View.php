<?php namespace Config;

class View extends \CodeIgniter\Config\View
{
	/**
	 * When false, the view method will clear the data between each
	 * call. This keeps your data safe and ensures there is no accidental
	 * leaking between calls, so you would need to explicitly pass the data
	 * to each view. You might prefer to have the data stick around between
	 * calls so that it is available to all views. If that is the case,
	 * set $saveData to true.
	 */
	public $saveData = true;

	/**
	 * Parser Filters map a filter name with any PHP callable. When the
	 * Parser prepares a variable for display, it will chain it
	 * through the filters in the order defined, inserting any parameters.
	 * To prevent potential abuse, all filters MUST be defined here
	 * in order for them to be available for use within the Parser.
	 *
	 * Examples:
	 *  { title|esc(js) }
	 *  { created_on|date(Y-m-d)|esc(attr) }
	 */
	public $filters = [];

	/**
	 * Parser Plugins provide a way to extend the functionality provided
	 * by the core Parser by creating aliases that will be replaced with
	 * any callable. Can be single or tag pair.
	 */
	public $plugins = [];

	/**
	 * Configuration of cache for view_cell and view. used constants
	 * section : Timing Constants, for time duration
	 * in the cache is in seconds
	 * 
	 */
	public $cache = 60;

	/**
	 * this directory is used to store everything related to
	 *  templates and widgets of this library
	 **/
	public $widgets = 'Templates/_widgets/';

	/**
	 * this directory is used for to improve the organization 
	 * of business logic views 
	 **/
	public $main_path = 'Modules/';

	/**
	 * Configuration path/url of the icon of the app
	**/
	public $icon = 'images/logo.png';
	/**
	 * Configuration of the repository of assets, what works for
	 * render used template.
	 */
	public $repository = array(
			'assets' 	=> 	'_assets/' , 
			'libraries' =>  '_assets/thirdparty/',
			'framework'	=>	'thirdparty/materialize-admin' ,
			'images'	=> 	'_assets/images' ,
			'fonts'		=> 	'_assets/fonts' ,
		);

	/**
	 * Configuracion del template
	 */
	public $custom = array(
		'theme' => 'dark'
	);
}
