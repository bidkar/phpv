<?php
require 'conexion.php';
class Usuario {
    private $datos = [
        'id' => '',
        'username' => '',
        'email' => '',
        'password' => '',
        'nombres' => '',
        'apellidos' => '',
        'rol_id' => ''
    ];

    public function findById(int $userid) {
        // crear conexion a MySQL
        $cnn = new Conexion();
        // definir sentencia SQL
        $sql = sprintf("select * from usuarios where id=%d", $userid);
        // ejecutar la sentencia ($rst = resultset)
        $rst = $cnn->query($sql);
        var_dump($rst);
    }

    public function __get($campo) {
        return $this->datos[$campo];
    }

    public function __set($campo, $valor) {
        $this->datos[$campo] = $valor;
    }  
}

$user = new Usuario();
$user->findById(1);