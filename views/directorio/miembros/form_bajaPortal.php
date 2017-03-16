<form name="bajaPortal"  novalidate>
	
	<div class="panel panel-default">
		<div class="table-responsive">
			<table class="table table-striped">
			  <tbody>
				<tr >
				  <td ><label>Nombre:</label></td>
				  <td >{{formData.nombre2}}</td>
				</tr>
				<tr>
					<td><label>Cargo:</label></td>
					<td>{{formData.puesto}}</td>
				</tr>
				<tr>
					<td><label>Respode a:</label>
					<td>{{formData.jefe}}</td>
				</tr>
				<tr>
					<td><label>Email:</label>
					<td>{{formData.email}}</td>
				</tr>
				<tr>
					<td><label>Tel&eacute;fono:</label>
					<td>{{formData.telefono_directo}}</td>
				</tr>
			  </tbody>
			</table>
		</div>
	</div>
	
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  <button type="submit" class="btn btn-default" ng-click="submitBajaPortalForm( bajaPortal.$valid )">Dar de baja</button>
	</div>
</form>
