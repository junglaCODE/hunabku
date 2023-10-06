<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $this->Hunabku->title = 'Pagina Demo';
        $parameters =  [
            "welcome" => "Hello World desde Hunabku"
        ];
        return $this->Hunabku->Render('bootstrap_external', $parameters);
    }
}
