<?php namespace App\Libraries\Hunabku;

class Amantecatl extends \App\Libraries\Hunabku\Kalmanani
{

    public function TopNavigator(array $params)
    {
        $component = $this->config->widgets.strtolower(__FUNCTION__);
        $properties = [
            'color' => $params[0] ,
            'app'   => $this->app->name ,
        ];
        return  view($component,$properties);
    }
	
    public function MenuSideNav(array $params)
    {
    }

    public function Breadcrumbs(array $params)
    {        
    }

    
}
