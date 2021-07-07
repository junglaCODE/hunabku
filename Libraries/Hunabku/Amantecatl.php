<?php namespace App\Libraries\Hunabku;

class Amantecatl
{

    public function __construct(){
        $this->_config = config('View');
    }

    public function TopNavBar(){
        $repository = $this->_config->widgets.'/'.strtolower(__FUNCTION__);
        return  view(
                    $repository.'/organism',
                    array(
                        'PluginsOrganism' => '\\'.__CLASS__.'::_plugins' 
                    )
                );
    }

    public function MenuSideNav(){
        $repository = $this->_config->widgets.'/'.strtolower(__FUNCTION__);
        return  view($repository.'/organism',
                    array(
                        'MenuOrganism'  => '\\'.__CLASS__.'::_listModules' ,
                        'BrandComponent' => array(
                                        'title' => explode(' ' ,APP,2),
                                        'logo' => base_url(REPOSITORY_IMGS.LOGO) ,
                                        'home' => base_url()
                                    )
                    ),
                );
    }

    public function _plugins($params){
        try {
            $items = array();
            return view(
                $this->_config->widgets."/topnavbar/_navplugins" ,
                array(
                    'ComponentCardUser' => view(
                        $this->_config->widgets.'/topnavbar/_carduser' ,
                        array(
                            'user'      => 'monolinux' ,
                            'avatar'    => base_url(REPOSITORY_IMGS.'default-avatar.png'),
                            'fullname'  => 'Juan Luis Garcia Corrales',
                            'departament' => 'Sistemas Programación' ,
                            'resource_exit' => '#'
                        )
                    )
                )
            );
        } catch (\Exception $error) {
            if(ENVIRONMENT == 'production'):
                print('Existe un error al crear los items de los plugins') ;              
            else:
                print($error->getMessage());
            endif;  
            exit();
        }
    }

    public function _listModules($params){
        try {            
            return view(
                $this->_config->widgets."/menusidenav/_menu"
            );
        } catch (\Exception $error) {
            if(ENVIRONMENT == 'production'):
                print('Existe un error al crear el menu') ;              
            else:
                print($error->getMessage());
            endif;  
            exit();
        }
       
    }

}
