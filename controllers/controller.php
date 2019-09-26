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

				header("location:template.php?action=usuarios");

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

		echo'<div class="box-body">
				<input type="hidden" value="'.$respuesta["user_id"].'" name="user_idEditar">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" value="'.$respuesta["firstname"].'" name="nombreEditar" required>
				</div>

				<div class="form-group">
					<label for="apllidos">Apellidos</label>
					<input type="text" class="form-control" value="'.$respuesta["lastname"].'" name="apellidosEditar" required>
		
				</div>
				
				<div class="form-group">
					<label for="correo">Ususario</label>
					<input type="text"class="form-control"  value="'.$respuesta["user_name"].'" name="usuarioEditar" required>				
				</div>
				
				<div class="form-group">
				<label for="correo">correo</label>
				<input type="text" class="form-control" value="'.$respuesta["user_email"].'" name="emailEditar" required>

				</div>
				<button type="submit" value="Actualizar" class="btn btn-flat btn-success">Actualizar</button>
		 </div>
	 </div> ';

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

				header("location:template.php?action=usuarios");

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

				header("location:template.php?action=usuarios");
			
			}

		}

	}


	#REGISTRO DE CATEGORIAS
	#------------------------------------
	public function registroCategoriaController(){

		if(isset($_POST["nombreRegistro"])){

			$datosController = array(
				"nombre"=>$_POST["nombreRegistro"], 

				"descripcion"=>$_POST["desRegistro"], 

				"date_added"=>$_POST["fechaRegistro"]);

			$respuesta = Datos::registroCategoriaModel($datosController, "categorias");

			if($respuesta == "success"){

				header("location:template.php?action=categorias");

			}

			else{

				header("location:index.php");
			}

		}

	}



	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaCategoriasController(){

		$respuesta = Datos::vistaCategoriasModel("categorias");


		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id_categoria"].'</td>
				<td>'.$item["nombre_categoria"].'</td>
				<td>'.$item["descripcion_categoria"].'</td>
				<td>'.$item["date_added"].'</td>
				<td><a href="template.php?action=editar_categoria&id_categoria='.$item["id_categoria"].'"class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
				<td><a href="template.php?action=categorias&idBorrar='.$item["id_categoria"].'"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
			</tr>';

		}
	}

	
	#EDITAR USUARIO
	#------------------------------------

	public function editarCategoriaController(){

		$datosController = $_GET["id_categoria"];
		$respuesta = Datos::editarCategoriaModel($datosController, "categorias");

		echo'
			<div class="box-body">
					<input type="hidden" value="'.$respuesta["id_categoria"].'" name="id_categoriaEditar">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" value="'.$respuesta["nombre_categoria"].'" name="nombreEditar" required>
					</div>
					<div class="form-group">
						<label for="descripcion">Descripcion</label>
						<input type="text" class="form-control"  value="'.$respuesta["descripcion_categoria"].'" name="desEditar" required>
					</div>

					<button type="submit"  value="Actualizar" class="btn btn-flat btn-success">Actualizar</button>
					</div>
			 </div>';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarCategoriaController(){

		if(isset($_POST["nombreEditar"])){

			$datosController = array( 
				"id_categoria"=>$_POST["id_categoriaEditar"],

				"nombre"=>$_POST["nombreEditar"],

				"descripcion"=>$_POST["desEditar"]);
			
			$respuesta = Datos::actualizarCategoriaModel($datosController, "categorias");

			if($respuesta == "success"){

				header("location:template.php?action=categorias");

			}

			else{

				echo "error";

			}

		}
	
	}


	#BORRAR CATEGORIA
	#------------------------------------
	public function borrarCategoriaController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarCategoriaModel($datosController, "categorias");

			if($respuesta == "success"){

				header("location:template.php?action=categorias");
			
			}

		}

	}





}

?>