<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	
	public function ingreso(){	
		
		include "views/modules/ingresar.php";
	
	}
	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}

		#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( 
				"usuario"=>$_POST["usuarioIngreso"], 
								      
				"password"=>$_POST["passwordIngreso"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

			if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
				
				
				session_start();

				$_SESSION["validar"] = true;
				$_SESSION['user_id'] = $respuesta["no_usu"];
				$_SESSION['nombre'] = $respuesta["nombre"];
				$_SESSION['no_perfil'] = $respuesta["no_perfil"];

				if ($respuesta["no_perfil"] == 1) {
					header("location:views/template.php?action=inicio");
					ob_end_flush();
				}else{
					header("location:views/templateApoyo.php?action=inicio");
					ob_end_flush();
				}

			}

			else{

				header("location:index.php?action=fallo");
				ob_end_flush();

			}

		}	

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

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
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
				<td><a href="index.php?action=editar&user_id='.$item["user_id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["user_id"].'"><button>Borrar</button></a></td>
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