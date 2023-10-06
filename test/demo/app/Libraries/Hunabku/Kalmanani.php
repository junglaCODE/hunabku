<?php namespace App\Libraries\Hunabku;
/**
 * @package     CodeIgniter Template Hunabku [Dios de la creación]
 * @author      junglaCODE <soporte@junglacode.org>
 * @link        https://github.com/junglaCODE/hunabku/
 * @license     MIT License Copyright (c) 2021 JLGC/monolinux
 */

class Kalmanani{

    const PATH = 'interfaces/' ;
    
    protected $_partials = [];
    protected $config = NULL;   
    public $app = NULL;
    public $framework = NULL;
    


    public function __construct(){
        helper('html');
        try {
            $this->config = config('Render');     
            $this->framework = base_url( $this->config->repository['framework'] );
            $this->app = (object) [
                'charset' => config('App')->charset,
                'lang'    => config('App')->defaultLocale,
                'name'    => config('App')->name,
                'version' => config('App')->version,
            ]; 

            if (!empty($this->config->custom)):
                $this->custom = $this->config->custom;
            endif;
        } catch (\Throwable $th) {
            exit(":( Hunabku. Need your configuration parameters in Directory Config [ ".$th->getMessage()." ]");
        }
        
    }

    /**
    * Section of the methods magics 
    */
    function __set($function, $params){
        if($function == 'breadcrumbs'):
                $this->_partials[$function] = $params;
        else:
            $this->_partials[$function] = call_user_func_array(
                array($this,"trigger_{$function}"), array($params)
                );
        endif;
    }

    function __get($property){
        if (!array_key_exists($property, $this->_partials)) {
            if($property == 'title'):
                return 'empty page';
            else:
                return null;
            endif;
        }
        return $this->_partials[$property];
    }

    /*
    * Funcion principal para crear la vistas
    */
    public function Render(){

        if( func_num_args() > 2 )
                throw new \Exception(
                    ' :( Hunabku I detect that you don\'t know how to use the function since it only needs 2 parameters'
                ); 

        if(func_num_args() == 1 && ! is_string(func_get_arg(0)) )
            throw new \Exception(
                ' :( Hunabku you need a view [string] to be able to render its'
            ); 

        if(func_num_args() == 2 && ! is_array(func_get_arg(1)) )
            throw new \Exception(
                ' :( Hunabku you need a view [string] and parameters [array] to be able to render its'
            ); 

        try {   
            if(func_num_args() == 2):
                $_view =  self::PATH.func_get_arg(0);
                $params = func_get_arg(1);
            else:
                $_view =  self::PATH.func_get_arg(0);
                $params = [];
            endif;
            $data = array_merge($params , array( $this->config->instace_render => $this));
            return view( $_view , $data );
        } catch (\Throwable $error) {
            throw new \Exception(';( Hunabku could not render the view : '.$error->getMessage(), $error->getLine());            
        }
    }  

    /*
    * Construcción de vistas :
    * 
    * Widgets : Son los organismos que extienden la funcionalidad de los templates
    * Componentes : son los organismos que se encuentran dentro de la sección de modulos
    */

    public function Widget(string $html, array $params = []){
        try {
            $_component = __NAMESPACE__.'\Amantecatl::'.$html;
            return view_cell ($_component,$params);  
        } catch (\Throwable $error) {
            throw new \Exception('did not load widget - '.$error->getMessage());         
        }          
    }

    public function Component(string $view, array $params , $xss = TRUE):string
    {
        $_view = \Config\Services::renderer();
        try {
            foreach($params as $key => $value):
                $context = $xss ? 'html' : 'raw';
                $_view->setVar($key,$value,$context);
            endforeach;
            return $_view->render(self::PATH.$view);         
        } catch (\Throwable $error) {
            throw new \Exception(
                "did not load component {$view} - ".$error->getMessage()
            );          
        }
    }
    /*
    * triggers section that establish a controller and template connection
    * control request in method magic _get & _set
    */

    private function trigger_title($title) {        
        return htmlspecialchars(strip_tags($title));
    }
    private function trigger_properties(array $params){
        return  (object) $params;
    }
    private function trigger_stylesheets($path){
        $resource = empty($this->_partials['stylesheets']) ? '' : $this->_partials['stylesheets'];
        if (is_array($path)):
            foreach ($path as $u):
                if (!filter_var($u, FILTER_VALIDATE_URL) === FALSE):
                    $resource.= self::trigger_stylesheets(htmlspecialchars(strip_tags($u)));
                else:
                    $resource.= self::trigger_stylesheets($u);
                endif;
            endforeach;
            return $resource;
        endif;
        $resource .=  !filter_var($path, FILTER_VALIDATE_URL) === FALSE ? 
                        "<link href=\"{$path}\" rel=\"stylesheet\" type=\"text/css\">" : 
                        link_tag($path.'?ver='. $this->app->version );    
        return $resource."\n";
    }

    private function trigger_javascripts($path) {
        $resource = empty($this->_partials['javascripts']) ? '' : $this->_partials['javascripts'];
        if (is_array($path)):
            foreach ($path as $u):
                if (!filter_var($u, FILTER_VALIDATE_URL) === FALSE):
                    $resource.= self::trigger_javascripts(htmlspecialchars(strip_tags($u)));
                else:
                    $resource.= self::trigger_javascripts($u);
                endif;
            endforeach;
            return $resource;
        endif;   
        $resource .= !filter_var($path, FILTER_VALIDATE_URL) === FALSE ? 
                        "<script src=\"{$path}\" type=\"text/javascript\"></script>" :
                        script_tag($this->config->repository['js'].'/'.$path.'?ver='.$this->app->version ) ;
        return $resource . "\n";
    }


}