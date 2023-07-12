<?php

namespace Controllers;

use Model\AdminPedido;
use Model\Usuario;
use MVC\Router;

class AdminController {

    public static function index( Router $router ){

        session_start();
        //$_SESSION['id'] = $usuario->id;
        $fecha = date('Y-m-d');
        //$userId = s($_GET['id']);
        // //buscar usuario por el token
        //$usuario = Usuario::where('id', $userId);

        //Cosulta a la DB para obtener el ID de usuario.
        
        
        //Consulta a la DB
        $consulta = "SELECT pedidos.id, pedidos.hora, pedidos.fecha, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.id, usuarios.email, usuarios.telefono, platillos.nombre as platillo, platillos.precio  ";
        $consulta .= " FROM pedidos  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON pedidos.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN pedidoplatillos ";
        $consulta .= " ON pedidoplatillos.pedidoId=pedidos.id ";
        $consulta .= " LEFT OUTER JOIN platillos ";
        $consulta .= " ON platillos.id=pedidoplatillos.platilloId ";
        $consulta .= " WHERE fecha =  '{$fecha}' ";
        $consulta .= " AND usuarios.id = '3' ";

        

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