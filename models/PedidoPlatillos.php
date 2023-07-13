<?php

namespace Model;

class PedidoPlatillos extends ActiveRecord{
    //conexion database
    protected static $tabla = 'pedidoplatillos';
    protected static $columnasDB = ['id', 'pedidoId', 'platilloId', 'mesaId'];

    public $id;
    public $pedidoId;
    public $platilloId;
    public $mesaId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->pedidoId = $args['pedidoId'] ?? '';
        $this->platilloId = $args['platilloId'] ?? '';
        $this->mesaId = $args['mesaId'] ?? '';
    }

}