
<section class="content-header">
      <h1>
        Panel de Administracion

      </h1>
      <ol class="breadcrumb">
	  <li><a href="template.php?action=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
             <li class="active">Inventario</li>
      </ol>
	<div class="bread" >
	  <a href="template.php?action=registro_producto"><button class="btn btn-lg btn-success "><i class="fa fa-user"></i>  Agregar Producto</button></a>
	  </div>
	</section>

	
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Productos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table id="example2" class="table table-bordered table-hover">
					
					<thead>
						
						<tr>
							<th>Codigo del Producto</th>
							<th>Nombre del Producto</th>
							<th>Fecha</th>
							<th>Precio</th>
							<th>Stock</th>
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
      </div>
      <!-- /.row -->
    </section>		  
			<?php

			if(isset($_GET["action"])){

				if($_GET["action"] == "cambioProducto"){

					echo "Cambio Exitoso";
				
				}

			}

			?>




