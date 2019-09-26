<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){


		if($enlaces == "ingresar" || $enlaces == "inicio" || $enlaces == "registro"|| $enlaces == "usuarios" || $enlaces == "editar"|| $enlaces == "registro_categoria"|| $enlaces == "categorias" || $enlaces == "editar_categoria" || $enlaces == "salir"){

			$module =  "../views/modules/".$enlaces.".php";
		
		}

	
		

		else{

			$module =  "../views/modules/ingresar.php";

		}
		
		return $module;

	}

}

?>