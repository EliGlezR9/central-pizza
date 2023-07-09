<?php

namespace Controllers;

use Model\Pedido;
use Model\PedidoPlatillos;
use Model\Platillo;

class APIController {
    public static function index(){
        $platillos = Platillo::all();
        echo json_encode($platillos);
    }

    public static function guardar(){
    //Guarda el pedido y devuelve el pedidoID
        $pedido = new Pedido($_POST);
        $resultado = $pedido->guardar();

        $id = $resultado['id'];

    //Guarda el pedido y los platillos en tabla
        $idPlatillos = explode(",", $_POST['platillos']);

        foreach($idPlatillos as $idPlatillo){
            $args = [
                'pedidoId' => $id,
                'platilloId' => $idPlatillo,
                'mesaId' => '7'
            ];
            $pedidoPlatillo = new PedidoPlatillos($args);
            $pedidoPlatillo->guardar();

        }
        
        echo json_encode(['resultado' => $resultado]);
    }
}

