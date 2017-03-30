<?php
return
	spl_autoload_register(function($classname)
	{
		$ruta = strtolower($classname);
		$ruta = str_replace("\\", "/", $ruta) . ".php";
		if (is_readable($ruta)) {
			print $ruta;
			require $ruta;
		}
		else
			die("El archivo $ruta no existe.");
	});