
<section class="content-header">
      <h1>
        Panel de Administracion
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="template.php?action=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="template.php?action=inventario">Inventarios</a></li>
        <li class="active">Editar Producto</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-6  ">
			<!-- general form elements -->
			<div class="box box-success  d-flex">
				<div class="box-header with-border">
				<h3 class="box-title">Editar producto</h3>
				</div>
				
				<form method="post">
					
					<?php

					$editarProducto = new MvcController();
					$editarProducto -> editarProductoController();
					$editarProducto -> actualizarProductoController();

					?>

				</form>

				<table id="example1" class="table table-bordered table-hover">
					
					<thead>
						
						<tr>
							<th>Fecha</th>
							<th>Descripcion</th>
							<th>Referencia</th>
							<th>Total</th>

						</tr>

					</thead>

					<tbody>
						
						<?php

						$editarProducto -> vistaHistorialController();

						?>

					</tbody>

				</table>


				</div>
			</div>
		</div>
</section>
