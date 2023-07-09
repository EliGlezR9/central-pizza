<?php

namespace Controllers;

use Model\Pedido;
use Model\PedidoPlatillo;
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

        echo json_encode($resultado);
    }
    

}


//$pedido = new Pedido($_POST);
    //     $resultado = $pedido->guardar(); 
    //     $id = $resultado['id'];
        

    //     //Almacena pedido y platillos
    //     $idPlatillos = explode(",", $_POST['platillos']);

    //     foreach($idPlatillos as $idPlatillo){
    //         $args = [
    //             'pedidoId' => $id,
    //             'platilloId' => $idPlatillo
    //         ];
    //         $pedidoPlatillo = new PedidoPlatillo($args);
    //         $pedidoPlatillo->guardar();
    //     }

    //     $respuesta = [
    //         'resultado' => $resultado
    //     ];
    //     echo json_encode($respuesta);
    // }


// $id = $resultado['id'];

        // //Guarda los platillos con el id del pedido 
        // $idPlatillos = explode(",", $_POST['platillos']);

        // foreach($idPlatillos as $idPlatillo){
        //     $args = [
        //         'platillosId' => $idPlatillo,
        //         'pedidosId' => $id
        //     ];
        //     $pedidoplatillos = new PedidoPlatillo($args);
        //     $pedidoplatillos->guardar();
        // }
        // //return respuesta
        // $respuesta = [
        //     'resultado' => $resultado
        //];

        

         // $pedido = new Pedido($_POST);
        // $resultado = $pedido->guardar();
        // echo json_encode($resultado);