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
                    array()
                );
    }

    public function MenuSideNav(){
        $repository = $this->_config->widgets.'/'.strtolower(__FUNCTION__);
        return  view($repository.'/organism',
                    array(
                        'Brand' => view( $repository.'/_brand' ,
                                        array(  ),
                                    ),
                        'MenuOrganism'  => '\\'.__CLASS__.'::_listModules' ,
                    ),
                );
    }


    public function _listModules($params){
        try {
            $items = array();
            return view(
                $this->_config->widgets."/menusidenav/_menu" ,
                array( 'items' => $items)
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
