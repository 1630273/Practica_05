<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/modules/ingresar.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "template";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}

	#REGISTRO DE USUARIOS
	#------------------------------------
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){

			$datosController = array(
				"firstname"=>$_POST["nombreRegistro"], 

				"lastname"=>$_POST["apellidosRegistro"], 

				"user_name"=>$_POST["usuarioRegistro"], 
								      
				"user_password_hash"=>$_POST["passwordRegistro"],
								      
				"user_email"=>$_POST["emailRegistro"],

				"date_added"=>$_POST["fechaRegistro"]);

			$respuesta = Datos::registroUsuarioModel($datosController, "users");

			if($respuesta == "success"){

				header("location:template.php?action=ok");

			}

			else{

				header("location:index.php");
			}

		}

	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( 
				"user_name"=>$_POST["usuarioIngreso"], 
								      
				"user_password_hash"=>$_POST["passwordIngreso"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "users");

			if($respuesta["user_name"] == $_POST["usuarioIngreso"] && password_verify($_POST['passwordIngreso'], $respuesta['user_password_hash'])){

				session_start();

				$_SESSION["validar"] = true;

				header("location:views/template.php?action=inicio");

			}

			else{

				header("location:views/template.php?action=fallo");

			}

		}	

	}

	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("users");


		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["user_id"].'</td>
				<td>'.$item["firstname"]. " " . 
				$item["lastname"] .'</td>
				<td>'.$item["user_name"].'</td>
				<td>'.$item["user_email"].'</td>
				<td>'.$item["date_added"].'</td>
				<td><a href="template.php?action=editar&user_id='.$item["user_id"].'"class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
				<td><a href="template.php?action=usuarios&idBorrar='.$item["user_id"].'"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["user_id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "users");

		echo'<input type="hidden" value="'.$respuesta["user_id"].'" name="user_idEditar">

			 <input type="text" value="'.$respuesta["firstname"].'" name="nombreEditar" required>

			 <input type="text" value="'.$respuesta["lastname"].'" name="apellidosEditar" required>

			 <input type="text" value="'.$respuesta["user_name"].'" name="usuarioEditar" required>

			 <input type="text" value="'.$respuesta["user_email"].'" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			$datosController = array( 
				"user_id"=>$_POST["user_idEditar"],

				"firstname"=>$_POST["nombreEditar"],

				"lastname"=>$_POST["apellidosEditar"],
							          
				"user_name"=>$_POST["usuarioEditar"],
				                      
				"user_email"=>$_POST["emailEditar"]);
			
			$respuesta = Datos::actualizarUsuarioModel($datosController, "users");

			if($respuesta == "success"){

				header("location:index.php?action=cambio");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarUsuarioModel($datosController, "users");

			if($respuesta == "success"){

				header("location:index.php?action=usuarios");
			
			}

		}

	}

}

?>