<?php 
namespace App\Controllers;
 
class Index extends BaseController
{

    public function index(){   
		$this->Template->setPathModule('{$pathModule}');
        return $this->Template->Render(
            'skeleton' , array(
            )
        );
    }


}