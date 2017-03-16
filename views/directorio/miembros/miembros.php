

        <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">

			<h1 class="page-header">Empleados</h1>
			
			
			<button type="button" class="btn btn-default" onclick="location.href='agregar'" data-dismiss="modal">Agregar empleado</button>
			<a href='../paginas/export_empleados.php' style='float:right'><img src='/img/excel.png'></a>
			<br><br>
			
			<input type="text" ng-change="load(1, nameSearch)" ng-model="nameSearch" class="form-control" placeholder="Buscar..." 
			ng-model-options='{ debounce: 300 }'/>
			
			<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
				  <th>Puesto</th>
				  <th>Respode a</th>
				  <th>Edad</th>				  
				  <th>Antigüedad</th>
                  <th>Tel</th>
                  <th>Email</th>
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="m in miembros" ng-class="{rowBajaEmpleado: m.active == 0}">
                  <td>{{m.id_miembro}}</td>
                  <td>{{m.nombre2}}</td>
				  <td>{{m.puesto}}</td>
				  <td>{{m.jefe}}</td>
				  <td>{{m.edad}}</td>
				  <td>{{m.years_a}} a&ntilde;os {{m.months_a}} meses</td>
                  <td>{{m.telefono_directo}}</td>
                  <td>{{m.email}}</td>
				  <td>
						<img ng-show='m.active==1' src='/img/pencil.png' ng-click='edit(m)' data-toggle="modal" data-target="#myModal" class='btnImg' >
						<img ng-show='m.active==1' src='/img/clock.png' ng-click='horariosMiembro(m)' data-toggle="modal" data-target="#modalHorarios" class='btnImg'>
						<img ng-show='m.active==1' src='/img/user_delete_2.png' ng-click='darDeBajaEmpleado(m)' data-toggle="modal" data-target="#modalDarDeBaja" class='btnImg'>
						<img ng-show='m.active==1 && !m.accesoPortal' src='/img/key.png' ng-click='darAltaPortal(m)' data-toggle="modal" data-target="#modalAltaPortal" class='btnImg'>
						<img ng-show='m.active==1 && m.accesoPortal' src='/img/key_red.png' ng-click='darBajaPortal(m)' data-toggle="modal" data-target="#modalBajaPortal" class='btnImg'>
				  </td>
                </tr>

              </tbody>
            </table>
          </div>
	
	<div style='float: right;'>
		<?php include_once '../views/general/paginacion.php'; ?>
	</div>

<?php Menu::end(); ?>
	
	<div >
		<?php include_once '../views/directorio/miembros/modal_edit.php'; ?>
	</div>
	
		<div >
		<?php include_once '../views/directorio/miembros/modal_horario.php'; ?>
	</div>
	
	<div >
		<?php include_once '../views/directorio/miembros/modal_darDeBaja.php'; ?>
	</div>
	
	<div >
		<?php include_once '../views/directorio/miembros/modal_altaPortal.php'; ?>
	</div>
  
  	<div >
		<?php include_once '../views/directorio/miembros/modal_bajaPortal.php'; ?>
	</div>
  