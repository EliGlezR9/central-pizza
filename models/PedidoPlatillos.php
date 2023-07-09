<?php

namespace Model;

class PedidoPlatillos extends ActiveRecord{
    //conexion database
    protected static $tabla = 'pedidoplatillos';
    protected static $columnasDB = ['id', 'pedidoId', 'platilloId', 'mesaId', 'cantidad'];

    public $id;
    public $pedidoId;
    public $platilloId;
    public $mesaId;
    public $cantidad;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->pedidoId = $args['pedidoId'] ?? '';
        $this->platilloId = $args['platilloId'] ?? '';
        $this->mesaId = $args['mesaId'] ?? '';
        $this->cantidad = $args['cantidad'] ?? 1;
    }

}