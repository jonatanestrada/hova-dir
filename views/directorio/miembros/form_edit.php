          
            <form name="saveMiembro"  >
				<input id="id_miembro" ng-model="formData.id_miembro" type='hidden' >
			  <div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="nombre" class="form-control" id="nombre" ng-model="formData.nombre" placeholder="Nombre" ng-required='!formData.nombre'>
			  </div>
			  
			  <p ng-show="formData.nombre.$invalid && !formData.nombre.$pristine" class="help-block">You name is required.</p>
			  
			  <div class="form-group">
				<label for="nombre_sec">Segundo nombre</label>
				<input type="nombre_sec" class="form-control" id="nombre_sec" ng-model="formData.nombre_sec" placeholder="Segundo nombre">
			  </div>
			  
			  <div class="form-group">
				<label for="apaterno">Apellido Paterno</label>
				<input type="apaterno" class="form-control" id="apaterno" ng-model="formData.apaterno" placeholder="Apellido Paterno">
			  </div>
			  
  			  <div class="form-group">
				<label for="nombre_sec">Apellido Materno</label>
				<input type="amaterno" class="form-control" id="amaterno" ng-model="formData.amaterno" placeholder="Apellido Materno">
			  </div>		  
			  
			  
	<div class="form-group">
		<label for="fecha_nacimiento">Fecha de nacimiento</label>
		  
			<input data-provide="datepicker" type="text" class="form-control datepick" ng-model="formData.fecha_nacimiento" name='fecha_nacimiento' id='fecha_nacimiento' placeholder='Fecha de nacimiento'>
		  
		<div ng-show="saveMiembro.$submitted || saveMiembro.fecha_nacimiento.$touched">
		  <div ng-show="saveMiembro.fecha_nacimiento.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
			  			  
			  <div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" ng-model="formData.email" placeholder="Email">
			  </div>
			  
			  <div class="form-group">
				<label for="telefono_directo">Telefono directo</label>
				<input type="telefono_directo" class="form-control" id="telefono_directo" ng-model="formData.telefono_directo" placeholder="telefono_directo">
			  </div>

			  <div class="form-group">
				<label for="observaciones">Observaciones</label>
				<input type="observaciones" class="form-control" id="observaciones" ng-model="formData.observaciones" placeholder="Observaciones">
			  </div>
			  
			  <div class="form-group">
				<label for="celular">Celular</label>
				<input type="celular" class="form-control" id="celular" ng-model="formData.celular" placeholder="celular">
			  </div>
			  
			  
		<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		  <button type="submit" class="btn btn-default" ng-click="submitForm()">Guardar cambios</button>
        </div>			  

			</form>
