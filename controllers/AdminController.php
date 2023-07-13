<?php

namespace Controllers;

use Model\AdminPedido;
use Model\Usuario;
use MVC\Router;

class AdminController {

    public static function index( Router $router ){
        $userId = $_SESSION['id'];
        //debuguear($userId);
        $fecha = $_GET['fecha']?? date('Y-m-d') ;
        $fechas = explode('-', $fecha);

        if(!checkdate( $fechas[1], $fechas[2], $fechas[0] )){
            header('Location: /404');
        }
        
        //Consulta a la DB
        $consulta = "SELECT pedidos.id, pedidos.hora, pedidos.fecha, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, platillos.nombre as platillo, platillos.precio  ";
        $consulta .= " FROM pedidos  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON pedidos.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN pedidoplatillos ";
        $consulta .= " ON pedidoplatillos.pedidoId=pedidos.id ";
        $consulta .= " LEFT OUTER JOIN platillos ";
        $consulta .= " ON platillos.id=pedidoplatillos.platilloId ";
        $consulta .= " WHERE usuarios.id = '{$userId}'";
        $consulta .= " AND fecha = '{$fecha}' ";
        

        

        $pedidos = AdminPedido::SQL($consulta);

        //debuguear($pedido);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'pedidos' => $pedidos,
            'fecha' => $fecha 

        ]);
    }    
}