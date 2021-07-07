<?php namespace App\Libraries\Hunabku;
/**
 * @package     CodeIgniter Template Hunabku [Dios de la creación]
 * @author      junglaCODE <desarrollo@junglacode.org>
 * @link        https://github.com/junglaCODE/hunabku/
 * @license     MIT License Copyright (c) 2021 JLGC/monolinux
 */

class Kalmanani{

    private $_config = NULL;    
    public $framework = null;
    public $_title = 'page blank';
    public $_stylesheets = NULL;
    public $_javascripts = NULL;
    public $_breadcrumbs = NULL;
    private $module_path =  NULL;

    public function __construct(){
        helper('html');
        $this->_config = config('View');     
        $this->framework = base_url().$this->_config->repository['assets']
                                    .$this->_config->repository['framework'];
    }

    public function __set($property, $value){
        self::_execTriggerFunctions($property,$value);            
    }

    public function Render($view,$params){
        try {
            $data = array_merge($params , array('Template' => $this));
            return view(
                    $this->module_path.$view ,
                    $data ,
                    [ 'cache' => $this->_config->cache ]
                );            
        } catch (\Throwable $error) {
            if(ENVIRONMENT == 'production'):
                print('la vista ['.$view.'] no podido cargar ¡Quiza no exista!. Verifique la ruta');
            else:
                print($error->getMessage());
            endif;    
            exit();
        }
    }

    public function Component($view,$params){
        try {
            return view(
                $this->module_path.$view ,
                $params ,
                [ 'cache' => $this->_config->cache / 2  ]
            );            
        } catch (\Throwable $error) {
            if(ENVIRONMENT == 'production'):
                print('el component ['.$view.'] no podido cargar ¡Quiza no exista!. Verifique la ruta');
            else:
                print($error->getMessage());
            endif;    
            exit();
        }
    } 

    public function Widget($organism){  
        try {
            return view_cell ( __NAMESPACE__.'\Amantecatl::'.$organism , $this->_config->cache );            
        } catch (\Throwable $error) {
            if(ENVIRONMENT == 'production'):
                print('La función ['.$organism.'] no esta implementada');
            else:
                print($error->getMessage());
            endif;  
            exit();
        }
    }
    
    public function setPathModule($path){
        $this->module_path = $this->_config->main_path.$path;
    }

    public function getPathModule(){
        return $this->module_path;
    }

    private function trigger_title($title) {
        return htmlspecialchars(strip_tags($title)).' | '.APP;
    }

    private function trigger_stylesheets($url){
        if (is_array($url)):
            $resource = '';
            foreach ($url as $u):
                $resource .= self::trigger_stylesheets( 
                                    substr($this->_config->repository['assets'],1).$u.'?ver='.VERSION
                            );
            endforeach;
            return $resource;
        endif;

        if (self::_externalValidateUrls($url)):
            $resource = '<link rel="stylesheet" href="' . htmlspecialchars(strip_tags($url)) . '">';
        else:
            $resource = link_tag($url);
        endif;    
        return $resource."\n\t";
    }

    private function trigger_javascripts($url) {
        if (is_array($url)):
            $resource = '';
            foreach ($url as $u):
                $resource .= self::trigger_javascripts( 
                                    substr($this->_config->repository['assets'],1).$u.'?ver='.VERSION
                            );
            endforeach;
            return $resource;
        endif;
        
        if (self::_externalValidateUrls($url)):
            $resource = '<script src="' . htmlspecialchars(strip_tags($url)) . '"></script>';
        else:
            $resource = script_tag($url);
        endif;
        return $resource . "\n\t";
    }

    private function trigger_breadcrumbs($info){
        return  (object) array(
                    'title' => $info[0] ,  
                    'navigator' => $info[1]
                );    
    }

    private function _execTriggerFunctions($function,$params){
        switch($function):
            case 'stylesheets':
                $this->_stylesheets = self::trigger_stylesheets($params);
            break;
            case 'javascripts':
                $this->_javascripts = self::trigger_javascripts($params);
            break;
            case 'title':
                $this->_title = self::trigger_title($params);
            break;
            case 'breadcrumbs':
                $this->_breadcrumbs = self::trigger_breadcrumbs($params);
                break;
            default:
                print('error no funcion');
        endswitch;
    }

    private function _externalValidateUrls($resource){
        if (
                stristr($resource, 'http://') && 
                stristr($resource, 'https://') && 
                substr($resource, 0, 2) == '//'
            ):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

}