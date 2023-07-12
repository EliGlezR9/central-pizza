<?php

namespace Model;

class AdminPedido extends ActiveRecord{
    protected static $tabla = 'pedidoPlatillos';
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'platillo', 'precio' ];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $platillo;
    public $precio;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->platillo = $args['platillo'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function getUserId() {
        $query = " SELECT id FROM " . self::$tabla . " WHERE id = '" . $this->id . "' LIMIT 1";
        $resultado = self::$db->query($query); 
        return $resultado;
    }


}