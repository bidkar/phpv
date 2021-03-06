<?php
namespace MVC\Models;

use App\Models\Conexion;

class Usuario {
    private $datos = [
        'id' => '',
        'username' => '',
        'password' => '',
        'email' => '',
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
        $this->datos[$campo] = ($campo == 'password') ? md5($valor) : $valor;
    }

    public function nuevo() {
        $cnn = new Conexion();
        $sql = sprintf("insert into usuarios (username,password,email,nombres,apellidos,foto,rol_id) values ('%s','%s','%s','%s','%s','%s',%d)", $this->username, $this->password, $this->email, $this->nombres, $this->apellidos, $this->foto, $this->rol_id);

        $rst = $cnn->query($sql);
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else { // el registro se inserto correctamente
            $this->id = $cnn->insert_id;
            $cnn->close();
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

    public function actualizarPerfil() {
        $cnn = new Conexion();
        $sql = sprintf("update usuarios set nombres='%s', apellidos='%s', foto='%s'", $this->nombres, $this->apellidos, $this->foto);

        $rst = $cnn->query($sql);
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else {
            return true;
        }
    }

    public function changePassword() {
        $cnn = new Conexion();
        $sql = sprintf("update usuarios set password='%s'", md5($this->password));

        $rst = $cnn->query($sql);
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else {
            return true;
        }
    }

    public function cambiarRol() {
        $cnn = new Conexion();
        $sql = sprintf("update usuarios set rol_id=%d", $this->rol_id);

        $rst = $cnn->query($sql);
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else {
            return true;
        }
    }

    public static function eliminar(int $id) {
        $cnn = new Conexion();
        $sql = sprintf("delete from usuarios where id=%d", $id);

        $rst = $cnn->query($sql);
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else {
            return true;
        }
    }
    
    public static function login(string $username, string $password) {
        $usuario = new Usuario();
        $usuario->username = $username;
        $usuario->password = $password;

        $cnn = new Conexion();
        $sql = sprintf("select * from usuarios where username='%s' and password='%s'", $usuario->username, $usuario->password);

        $rst = $cnn->query($sql);
        $cnn->close();
        if (!$rst) {
            die('Error al ejecutar la consulta');
        } else {
            if ($rst->num_rows == 1) {
                $reg = $rst->fetch_assoc();
                $usuario->id = $reg['id'];
                $usuario->email = $reg['email'];
                $usuario->nombres = $reg['nombres'];
                $usuario->apellidos = $reg['apellidos'];
                $usuario->foto = $reg['foto'];
                $usuario->rol_id = $reg['rol_id'];
                $usuario->password = '';

                return $usuario;
            } else {
                return false;
            }
        }
    }
}
