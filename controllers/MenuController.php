<?php

namespace Controllers;

use MVC\Router;

class MenuController{
    public static function index( Router $router ){
        
        session_start();
        //debuguear($_SESSION);

        $router->render('menu/main-menu', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
                     
        ]);

    }
}