<?php

namespace Controllers;

use MVC\Router;

class MenuController{
    public static function index( Router $router ){
        
        session_start();
        $fecha = date('Y-m-d');
        
        isAuth();

        $router->render('menu/main-menu', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'fecha' => $fecha
                     
        ]);

    }
}