<?php
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
        if (!$rst) {
            die('Error al ejecutar la consulta MySQL');
        } elseif ($rst->num_row == 1) {
            // usuario encontrado
            
        } else {
            // usuario no encontrado
            return false;
        }
    }

    public function __get($campo) {
        return $this->datos[$campo];
    }

    public function __set($campo, $valor) {
        $this->datos[$campo] = $valor;
    }  
}
