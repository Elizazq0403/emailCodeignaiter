<?php

namespace App\Controllers;

class Home extends BaseController
{   
    public function __construct()
    {
        helper('url');
    }
    
    public function index(): string
    {
        return view('form_email');
    }
    public function enviar_email()
    {
        $asunto = $this->request->getPost('asunto');
        $mensaje = $this->request->getPost('mensaje');
        $correo = $this->request->getPost('correo');
        $copia = $this->request->getPost('cccopia');


        $email = \Config\Services::email();

        $email->setFrom('ventas@asherindustriales.com', 'Elizabeth Zapata');
        $email->setTo($correo);
        $email->setCC($copia);
        /*$email->setBCC('them@their-example.com');*/

        $email->setSubject($asunto);
        $email->setMessage($mensaje);

        if (! $email->send())
        {
            echo "No se ha podido enviar el correo.";   
            echo $email->printDebugger(['headers']); 
        }
        else{

            echo "enviado";
    
        }

    
    }

}
