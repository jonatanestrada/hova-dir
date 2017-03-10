          
<form name="saveMiembro" class="css-form" novalidate>
	
				<input id="id_miembro" ng-model="formData.id_miembro" type='hidden' >
				  
				<div class="panel panel-default">
					<div class="panel-body">
						<label for="id_nombrePuesto">Cargo:</label> {{formData.nombre}}<br>
						<label for="id_proyecto">Proyecto:</label> {{formData.proyecto}}<br>
						<label for="id_proyecto">Clave:</label> {{formData.clave}}<br>
						<label for="id_proyecto">Descripcion:</label> {{formData.descripcion}}<br>
						<label for="id_proyecto">Observaciones:</label> {{formData.observaciones}}<br>
						<label for="id_proyecto">Responde a:</label> {{formData.responde_a}}<br>
					</div>
				</div>
		
				<div class="form-group">
				  <label for="id_miembro">Empleado: </label>
				  <select class="form-control" id="id_miembro" name="id_miembro" ng-model="formData.id_miembro" ng-options="cm.id_miembro as cm.nombre for cm in catMiembrosSinPuesto" required="" >
					  <option value="" >Selecciona una opci&oacute;n</option>
				  </select>	  
					<div ng-show="saveMiembro.$submitted || saveMiembro.id_miembro.$touched">
					  <div ng-show="saveMiembro.id_miembro.$error.required">Este es un campo requerido.</div>
					</div>	  
				</div>				
	
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		<button type="submit" class="btn btn-default" ng-click="submitFormAdd(saveMiembro.$valid)">Guardar cambios</button>
	</div>			  

</form>