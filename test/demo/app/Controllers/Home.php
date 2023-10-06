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

    public function test(): string
    {
        $this->Hunabku->title = 'Pagina Demo';
        $this->Hunabku->stylesheets = "style.css";
        $parameters =  [
            "title" => "Hello World desde Hunabku" ,
            "message" => "Cada día me pregunto: «Si hoy fuese el último día de mi vida, ¿querría hacer lo que voy a hacer hoy?». Si la respuesta es «No» durante demasiados días seguidos, sé que necesito cambiar algo (Steve Jobs)."
        ];
        return $this->Hunabku->Render('bootstrap_internal', $parameters);
    }
}
