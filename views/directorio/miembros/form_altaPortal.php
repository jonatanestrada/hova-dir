<form name="addPortal"  novalidate>
	<div class="form-group">
		<label for="username">Username</label>
		  <input type="text" ng-model="formData.username" name="username" class="form-control" placeholder="Username" required="" />	
		<div ng-show="addPortal.$submitted || addPortal.username.$touched">
		  <div ng-show="addPortal.username.$error.required">Este es un campo requerido.</div>
		</div>
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		  <input type="password" ng-model="formData.password" name="password" class="form-control" placeholder="Password" required="" />
		<div ng-show="addPortal.$submitted || addPortal.password.$touched">
		  <div ng-show="addPortal.password.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="nivel_usuario">Nivel usuario:</label>
		<select class="form-control" ng-options="n.niv_id as n.niv_nom for n in catNivelesUsuario" ng-model="formData.nivelUser" name='nivelUser' required="" >
			<option value="">Seleccionar ...</option>
		</select>
		<div ng-show="addPortal.$submitted || addPortal.nivelUser.$touched">
		  <div ng-show="addPortal.nivelUser.$error.required">Este es un campo requerido.</div>
		</div>
	</div>

	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  <button type="submit" class="btn btn-default" ng-click="submitAddPortalForm( addPortal.$valid )">Guardar cambios</button>
	</div>
</form>
