        <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
			<h1 class="page-header">Puestos</h1>

			<button type="button" class="btn btn-default" onclick="location.href='agregar'" data-dismiss="modal">Agregar puesto</button>
			<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Posici&oacute;n</th>
				  <th>Empleado</th>
                  <th>Proyecto</th>
                  <th>Clave</th>
				  <th>Descripci&oacute;n</th>
				  <th>Observaciones</th>
				  <th>Responde a</th>
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="m in miembros">
                  <td>{{m.id_puesto}}</td>
                  <td>{{m.nombre}}</td>
				  <td>{{m.nombre_empleado}}</td>
                  <td>{{m.proyecto}}</td>
                  <td>{{m.clave}}</td>
                  <td>{{m.descripcion}}</td>
				  <td>{{m.observaciones}}</td>
				  <td>{{m.responde_a}}</td>

				  <td>
						<img src='/img/pencil.png' ng-click='edit(m)' data-toggle="modal" data-target="#myModal">
						<img ng-show='m.vacante==0' src='/img/user_delete_2.png' ng-click='deleteMiembroVacante(m)' data-toggle="modal" data-target="#modalDelete">
						<img ng-show='m.vacante==1' src='/img/user_add.png' ng-click='addMiembroVacante(m)' data-toggle="modal" data-target="#modalAdd">
				  </td>
                </tr>

              </tbody>
            </table>
          </div>

	<div style='float: right;'>
		<?php include_once '../views/general/paginacion.php'; ?>
	</div>

	<div >
		<?php include_once '../views/directorio/puestos/modal_edit.php'; ?>
	</div>
	<div >
		<?php include_once '../views/directorio/puestos/modal_addMiembroVacante.php'; ?>
	</div>
	<div >
		<?php include_once '../views/directorio/puestos/modal_deleteMiembroVacante.php'; ?>
	</div>
