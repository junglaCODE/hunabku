<?php namespace App\Libraries\Hunabku;
/**
 * @package     CodeIgniter Template Hunabku [Dios de la creación]
 * @author      junglaCODE <soporte@junglacode.org>
 * @link        https://github.com/junglaCODE/hunabku/
 * @license     MIT License Copyright (c) 2021 JLGC/monolinux
 */

class Kalmanani{

    private $_module_path =  NULL;
    private $_partials = [];
    protected $config = NULL;   
    public $coding = NULL;
    public $framework = NULL;


    public function __construct(){
        helper('html');
        $this->config = config('View');     
        $this->framework = base_url(
            $this->config->repository['assets'].
            $this->config->repository['framework']            
        );
        $this->coding= (object) [
                'charset' => config('App')->charset,
                'lang'    => config('App')->defaultLocale]; 

        if (!empty($this->config->custom)):
            $this->custom = $this->config->custom;
        endif;
    }


    /**
    * Section of the methods magics 
    */
    function __set($function, $params){
        if($function !='libraries'):
            if($function == 'breadcrumbs'):
                $this->_partials[$function] = $params;
            else:
                $this->_partials[$function] = call_user_func_array(
                    array($this,"trigger_{$function}"), array($params)
                );
            endif;
        else:
                self::trigger_libraries($params);
        endif;
    }

    function __get($property){
        if (!array_key_exists($property, $this->_partials)) {
            if($property == 'title'):
                return 'empty page';
            elseif($property == 'icon'):
                return $this->_partials['icon'] = self::generateIcon();
            else:
                return null;
            endif;
        }
        return $this->_partials[$property];
    }

    /*
    * Construcción de vistas :
    * 
    * Widgets : Son los organismos que extienden la funcionalidad de los templates
    * Componentes : son los organismos que se encuentran dentro de la sección de modulos
    */
    public function setPathModule($path){
        $this->_module_path = $this->config->main_path.$path;
    }

    public function getPathModule(){
        return $this->_module_path;
    } 

    public function Render(){
        if(func_num_args() > 2)
            throw new \Exception(
                'hunabku detecto que no sabes usar la función ya que solo necesita 2 parámetros'
            );            
        if(func_num_args() == 1 && is_array(func_get_arg(0)) ):
            $_view =  $this->_module_path.'skeleton';
            $params = func_get_arg(0);
        elseif(func_num_args() == 2 && is_string(func_get_arg(0)) && is_array(func_get_arg(1)) ):
            $_view =  $this->_module_path.func_get_arg(0);
            $params = func_get_arg(1);
        else:
            throw new \Exception(
                'hunabku detecto parámetros invalidos : (string ,array)'
            );  
        endif;
        try {
            $data = array_merge($params , array('Template' => $this));
            if(ENVIRONMENT != 'production'):
                return view( $_view , $data );
            else:
                return view( $_view , $data , ['cache' => $this->config->cache] );   
            endif;      
        } catch (\Throwable $error) {
            throw new \Exception('hunabku detecto errores al publicar la vista -'.$error->getMessage());            
        }
    }  

    public function Component(string $view, array $params , $cache=0):array{
        $_organism = [];
        $_view = \Config\Services::renderer();
        try {
            foreach($params as $key => $value):
                $_view->setVar($key,$value,'html');
            endforeach;
            if(ENVIRONMENT != 'production'):
                $_organism[$view] = $_view->render($this->_module_path.$view);
            else:
                $_cache = $cache == 0 ?  $this->config->cache : $cache;
                $_organism[$view] = $_view->render(
                                        $this->_module_path.$view,
                                        ['cache' =>$cache]
                                    );
            endif;   
            return $_organism;            
        } catch (\Throwable $error) {
            throw new \Exception(
                "hunabku no pudo renderizar el componente {$view} ".$error->getMessage()
            );          
        }
    }

    public function Widget(string $organism, array $params = [], int $cache=0){
        $_component = __NAMESPACE__.'\Amantecatl::'.$organism;
        try {
            if(ENVIRONMENT != 'production'):
                return view_cell ($_component,$params);  
            else:
                $_cache = $cache == 0 ? $this->config->cache : $cache;
                return view_cell($_component,$params, $cache);   
            endif;  
        } catch (\Throwable $error) {
            throw new \Exception('widget no renderizado -'.$error->getMessage());            
        }          
    }
    /*
    * triggers section that establish a controller and template connection
    * control request in method magic _get & _set
    */
    private function generateIcon() {    
        $_icon = link_tag(
                    $this->config->repository['assets'].$this->config->icon ,
                    'shortcut icon', 'image/png'
                );
        return $_icon."\n";
    }
    private function trigger_title($title) {        
        return htmlspecialchars(strip_tags($title)).' | '.APP;
    }
    private function trigger_stylesheets($url,$library=FALSE){
        if (is_array($url)):
            $resource = '';
            foreach ($url as $u):
                if (!filter_var($u, FILTER_VALIDATE_URL) === FALSE):
                    $resource.= self::trigger_stylesheets(htmlspecialchars(strip_tags($u)));
                else:
                    $resource.= self::trigger_stylesheets($u);
                endif;
            endforeach;
            return $resource;
        endif;
        $_path = $this->config->repository['assets'];
        $_path = !$library ? $_path : $this->config->repository['libraries'];
        $resource =  !filter_var($url, FILTER_VALIDATE_URL) === FALSE ? 
                        "<link href=\"{$url}\" rel=\"stylesheet\" type=\"text/css\">" : 
                        link_tag($_path.$url.'?ver='.VERSION );    
        return $resource."\n";
    }
    private function trigger_javascripts($url,$library = FALSE) {
        if (is_array($url)):
            $resource = '';
            foreach ($url as $u):
                if (!filter_var($u, FILTER_VALIDATE_URL) === FALSE):
                    $resource.= htmlspecialchars(strip_tags($url));
                else:
                    $resource.= self::trigger_javascripts($u);
                endif;
            endforeach;
            return $resource;
        endif;      
        $_path = $this->config->repository['assets'];
        $_path =  !$library ? $_path : $this->config->repository['libraries'];
        $resource = !filter_var($url, FILTER_VALIDATE_URL) === FALSE ? 
                        $resource = "<script src=\"{$url}\" type=\"text/javascript\"></script>" :
                        script_tag($_path.$url.'?ver='.VERSION ) ;
        return $resource . "\n";
    }

    private function trigger_libraries($params){
        if( count($params) != 2 )
            throw new \Exception('hunabku detecta parámetros incorrectos');
        $_css = null;
        $_js = null;
        if( isset($params['js']) || isset($params['css']) ):
            $_css = $params['css']; $_js = $params['js'];
        else:
            $_css = $params[0]; $_js = $params[1] ; 
        endif;
        @$this->_partials['javascripts'].= self::trigger_javascripts($_js,TRUE);
        @$this->_partials['stylesheets'].= self::trigger_stylesheets($_css,TRUE);
    }

    private function trigger_custom($params){
        return 
            $this->_partials['custom'] = 
                            (object) array(
                                'theme' => $params['theme']
                            );
    }
}