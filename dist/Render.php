<?php

namespace Render\Config;


class Render  extends \CodeIgniter\Config\BaseConfig
{

    /*
    * The following settings will be used to configure the hunabku library and the 
    * options are as follows:
    * For more details :  https://github.com/junglaCODE/hunabku
    */ 
    /*Object main for instances*/ 
    public $instace_render = 'Hunabku';
	
    /**
	 * Configuration of cache for view_cell and view. used constants
	 * section : Timing Constants, for time duration
	 * in the cache is in seconds
	*/
	public $cache = 60;
    /**
	 * this directory is used to store everything related to
	 *  templates and widgets of this library
	 **/
	public $widgets = 'templates/widgets/';
	/**
	 * Configuration of the repository of assets, what works for
	 * render used template.
	 */
	public $repository = [
        'framework' => 'nothing'
    ];

}
