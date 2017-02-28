<?php
class Usuario {
    private $datos = [
        'id' => '',
        'username' => '',
        'email' => '',
        'password' => '',
        'nombres' => '',
        'apellidos' => '',
        'foto' => '',
        'rol_id' => ''
    ];

    public function buscarPorId(int $userid) {
        // crear conexion a MySQL
        $cnn = new Conexion();
        // definir sentencia SQL
        $sql = sprintf("select * from usuarios where id=%d", $userid);
        // ejecutar la sentencia ($rst = resultset)
        $rst = $cnn->query($sql);
        // cerrar conexion
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta MySQL');
        } elseif ($rst->num_rows == 1) { // mysqli_restult
            // usuario encontrado
            // recoger los registros devueltos por la consulta
            $r = $rst->fetch_assoc();
            $this->id = $userid;
            $this->username = $r['username'];
            $this->email = $r['email'];
            $this->nombres = $r['nombres'];
            $this->apellidos = $r['apellidos'];
            $this->foto = $r['foto'];
            $this->rol_id = $r['rol_id'];
            return true;
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

    public function nuevo() {
        $cnn = new Conexion();
        $sql = sprintf("insert into usuarios (username,password,email,nombres,apellidos,foto,rol_id) values ('%s','%s','%s','%s','%s','%s',%d)", $this->username, $this->password, $this->email, $this->nombres, $this->apellidos, $this->foto, $this->rol_id);

        $rst = $cnn->query($sql);
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else { // el registro se inserto correctamente
            $this->id = $cnn->insert_id;
            return true;
        }
    }

    public function buscarPorUsername(string $username) {
        $cnn = new Conexion();
        $sql = sprintf("select username from usuarios where username = %s", $username);
        $rst = $cnn->query($sql);
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else {
            if ($rst->num_rows == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function buscarPorEmail(string $email) {
        $cnn = new Conexion();
        $sql = sprintf("select username from usuarios where email = %s", $email);
        $rst = $cnn->query($sql);
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else {
            if ($rst->num_rows == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function actualizar() {}
    public function eliminar() {}
    public function login() {}
    public function cambiarRol() {}
}
