<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){


		if($enlaces == "ingresar"  || $enlaces == "registro"|| $enlaces == "inicio"|| $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir"){

			$module =  "../views/modules/".$enlaces.".php";
		
		}

	
		

		else{

			$module =  "../views/modules/ingresar.php";

		}
		
		return $module;

	}

}

?>