<?php
return
	spl_autoload_register(function($classname)
	{
		$ruta = strtolower($classname);
		$ruta = str_replace("\\", "/", $ruta) . ".php";
		$ruta = APP_DIR . $ruta;
		if (is_readable($ruta))
			require $ruta;
		else
			die("El archivo $ruta no existe.");
	});