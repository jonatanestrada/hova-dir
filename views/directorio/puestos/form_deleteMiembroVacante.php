          
            <form name="saveMiembro"  >
				<input id="id_miembro" ng-model="formData.id_miembro" type='hidden' >

				<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped">
						  <tbody>
							<tr><td><label for="id_nombrePuesto">Cargo:</label></td><td> {{formData.nombre}}</td></tr>
							<tr><td><label for="id_proyecto">Grupo:</label></td><td> {{formData.proyecto}}</td></tr>
							<tr><td><label for="id_proyecto">Clave:</label></td><td> {{formData.clave}}</td></tr>
							<tr><td><label for="id_proyecto">Descripcion:</label></td><td> {{formData.descripcion}}</td></tr>
							<tr><td><label for="id_proyecto">Observaciones:</label></td><td> {{formData.observaciones}}</td></tr>
							<tr><td><label for="id_proyecto">Responde a:</label></td><td> {{formData.responde_a}}</td></tr>
						  </tbody>
						</table>
					</div>
				</div>	
				  				
				<div class="form-group">
					<label for="nombre_empleado">Nombre</label>
					  <input type="text" ng-model="formData.nombre_empleado" name="nombre_empleado" class="form-control" placeholder="Empleado"  readonly/>	
					<div ng-show="saveMiembro.$submitted || saveMiembro.nombre_empleado.$touched">
					  <div ng-show="saveMiembro.nombre_empleado.$error.required">Este es un campo requerido.</div>
					</div>
				</div>			
			  
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				  <button type="submit" class="btn btn-default" ng-click="submitFormDelete()">Remover personal</button>
				</div>			  

			</form>
