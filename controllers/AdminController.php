<?php

namespace Controllers;

use Model\AdminPedido;
use MVC\Router;

class AdminController {
    public static function index( Router $router ){
        session_start();
        
        //Consulta a la DB
        $consulta = "SELECT pedidos.id, pedidos.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, platillos.nombre as platillo, platillos.precio  ";
        $consulta .= " FROM pedidos  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON pedidos.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN pedidoplatillos ";
        $consulta .= " ON pedidoplatillos.pedidoId=pedidos.id ";
        $consulta .= " LEFT OUTER JOIN platillos ";
        $consulta .= " ON platillos.id=pedidoplatillos.platilloId ";
        //$consulta .= " WHERE fecha =  '${fecha}' ";

        $pedido = AdminPedido::SQL($consulta);
        debuguear($pedido);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'pedido'=> $pedido

        ]);
    }    
}