        <div class="col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main">
			<h1 class="page-header">Plantilla HOVA</h1>
			
			<button style='display:none;' type="button" class="btn btn-default" onclick="location.href='agregar'" data-dismiss="modal">Agregar puesto</button><br><br>
			
			<input  type="hidden" ng-change="load(1, nameSearch)" ng-model="nameSearch" class="form-control" placeholder="Buscar..." 
			ng-model-options='{ debounce: 300 }'/>
			
			<a href='../paginas/export_puestos.php' style='float:right'><img src='/img/excel.png'></a>
			<a href='agregar' style='float:right;margin-right: 5px'><img src='/img/plus.png'></a><br><br>
			
			<div class="form-group">
			  <label for="sel1">Ver:</label>
			  
			  <select id='ver' class="form-control"  ng-change="load(1, nameSearch, vacantes)" ng-model="vacantes" >
				<option value='0' >Todos</option>
				<option value='1'>Vacantes</option>
			  </select>
			</div>
			
			<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Puesto</th>
				  <th>Responde a</th>
				  <th>Nombre</th>
                  <th>Proyecto</th>
                  <th>Clave</th>
				  <th>Descripci&oacute;n</th>
				  <th>Observaciones</th>				  
				  <th>A su cargo</th>
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="m in miembros">
                  <td>{{m.id_puesto}}</td>
                  <td>{{m.nombre}}</td>
				  <td><a href="#" data-toggle="tooltip" title="{{m.responde_a.toString().split(' - ')[1]}}">{{m.responde_a.toString().split(" - ")[0]}}</a></td>
				  <td>
				  <span ng-show='m.vacante != 1'>{{m.nombre_empleado}}</span>
				  <label ng-show='m.vacante == 1'>VACANTE</label>
				  </td>
                  <td>{{m.proyecto}}</td>
                  <td>{{m.clave}}</td>
                  <td>{{m.descripcion}}</td>
				  <td>{{m.observaciones.replace("N/A", "");}}</td>
				  
				  <td style='text-align:center;vertical-align:middle;' > 				  
					<a ng-show='m.subordinado > 0' href='' ng-click="viewSubordinados(m)">{{m.subordinado}}</a>				  
				  </td>
				  
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

<?php Menu::end(); ?>	
	<div  >
		<?php include_once '../views/directorio/puestos/modal_subordinados.php'; ?>
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
  
  