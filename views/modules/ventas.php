
<section class="content-header">
      <h1>
        Panel de Administracion

      </h1>
      <ol class="breadcrumb">
	  <li><a href="template.php?action=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
             <li class="active">Ventas</li>
      </ol>
	</section>

	
<!-- Main content -->
    <section class="content">
	<div class="row">
			<div class="col-md-6  ">
			<!-- general form elements -->
			<div class="box box-success  d-flex">
				<div class="box-header with-border">
				<h3 class="box-title">Ventas</h3>
				</div>
					<form method="post">    
						<div class="box-body">
						<div class="form-group">
				   				<label>Selecciona Categoria</label>
				   				<div>  
				   					<select name="producto" class="form-control">
										<?php 
						 					$categorias = Datos::ObtenerProductos("products");
						 
						 						foreach ($categorias as $a): ?>
								 					<option value="<?php echo $a['id_productos']?>"><?php echo $a['nombre_producto'] ?></option>
										<?php endforeach; ?>
					
					 				</select>												
						
				   				</div>
							</div>


							<div class="form-group">
								<label for="precioRegistro">Cantidad</label>
								<input type="number" class="form-control" min="1" placeholder="Cantidad" id="precioRegistro"name="cantidad" required>
							</div>

							
								<button type="submit" value="Enviar"class="btn btn-flat btn-success">Agregar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		
      
     
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Resumen de Ventas</h3>
			</div>
				<table id="example1" class="table table-bordered table-hover">
					
					<thead>
						
						<tr>
							<th>Codigo del Producto</th>
							<th>Nombre del Producto</th>
							<th>Fecha</th>
							<th>Precio</th>
							<th>Stock</th>
							<th>Inventario</th>
							<th>Modificar</th>
							<th>Eliminar</th>

						</tr>

					</thead>

					<tbody>
						
						<?php

						$vistaUsuario = new MvcController();
						$vistaUsuario -> vistaProductosController();
						$vistaUsuario -> borrarProductoController();

						?>

					</tbody>

				</table>
			</div>
            <!-- /.box-body -->
		  </div>
		</div>
        <!-- /.col -->
  
      <!-- /.row -->
    </section>		  
			<?php

			if(isset($_GET["action"])){

				if($_GET["action"] == "cambioProducto"){

					echo "Cambio Exitoso";
				
				}

			}

			?>




