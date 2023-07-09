<?php

namespace Model;


class Pedido extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioid', 'mesaid'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioid;
    public $mesaid;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioid = $args['usuarioid'] ?? '';
        $this->mesaid = $args['mesaid'] ?? '';

    }
}