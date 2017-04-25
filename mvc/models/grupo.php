<?php
namespace MVC\Models;

use App\MySQL\Conexion;

class Grupo {
	protected $datos = [
		'id' => '',
		'nombre' => '',
		'curso_id' => '',
		'codigo' => ''
	];

	public function __get($campo) {
        return $this->datos[$campo];
    }

    public function __set($campo, $valor) {
        $this->datos[$campo] = $valor;
    }

	public static function getGrupos(int $cursoid)
	{
		$cnn = new Conexion();
		$query = "select * from roles";
		$rst = $cnn->query($query);
		$cnn->close();

		if (!$rst) {
			die('Error al ejecutar la consulta');
		} else {
			if ($rst->num_rows > 0) {
				$resultado = [];
				while ($r = $rst->fetch_assoc()) {
					$rol = new Rol();
					$rol->id = $r['id'];
					$rol->nombre = $r['nombre'];
					$rol->descripcion = $r['descripcion'];
					array_push($resultado, $rol);
				}
				return $resultado;
			} else {
				return false;
			}
		}
	}

	public static function getGrupoByID(int $cursoid)
	{
        $cnn = new Conexion();
        $query = sprintf("select * from roles where id=%d", $rolid);
        $rst = $cnn->query($query);
        $cnn->close();

        if (!$rst) {
            die('Error al ejecutar la consulta MySQL');
        } elseif ($rst->num_rows == 1) {
			$rol = new Rol();
            $r = $rst->fetch_assoc();
            $rol->id = $rolid;
            $rol->nombre = $r['nombre'];
            $rol->descripcion = $r['descripcion'];
            return $rol;
        } else {
            return false;
        }
	}

	public function create()
	{
		// metodo para crear nuevos cursos
	}

	public function delete()
	{
		// metodo para eliminar cursos
	}

	public function edit()
	{
		// metodo para realizar cambios
	}
}