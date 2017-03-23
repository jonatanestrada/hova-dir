        <div class="col-sm-9 col-sm-offset-1 col-md-10 col-md-offset-1 main">
          <h1 class="page-header">Agregar empleado</h1>

          
			
			
			
	<form name="saveMiembro" class="css-form" novalidate>
	
	<div class="form-group">
		<label for="nombre">Nombre</label>
		
		<div class="input-group">
			<span class="input-group-addon">
				<input type="checkbox" id="preferencia_nombre" ng-model="formData.preferencia_nombre" >
			</span>
		
		  <input type="text" ng-model="formData.nombre" name="nombre" class="form-control" placeholder="Nombre" required="" />	
		</div>
		<div ng-show="saveMiembro.$submitted || saveMiembro.nombre.$touched">
		  <div ng-show="saveMiembro.nombre.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="nombre_sec">Segundo nombre</label>
		
		<div class="input-group">
			<span class="input-group-addon">
				<input type="checkbox" id="preferencia_nombre_sec" ng-model="formData.preferencia_nombre_sec" >
			</span>
			<input type="text" ng-model="formData.nombre_sec" name="nombre_sec" class="form-control" placeholder="Segundo nombre"  />	
		</div>
		<div ng-show="saveMiembro.$submitted || saveMiembro.nombre_sec.$touched">
		  <div ng-show="saveMiembro.nombre_sec.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="apaterno">Apellido Paterno</label>
		  <input type="text" ng-model="formData.apaterno" name="apaterno" class="form-control" placeholder="Apellido Paterno" required="" />	
		<div ng-show="saveMiembro.$submitted || saveMiembro.apaterno.$touched">
		  <div ng-show="saveMiembro.apaterno.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="amaterno">Apellido Materno</label>
		  <input type="text" ng-model="formData.amaterno" name="amaterno" class="form-control" placeholder="Apellido Materno"  />	
		<div ng-show="saveMiembro.$submitted || saveMiembro.amaterno.$touched">
		  <div ng-show="saveMiembro.amaterno.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
	  <label for="sexo">Sexo:</label>
	  <select class="form-control" id="sexo" name="sexo" ng-model="formData.sexo" required="" >
		  <option value="" >Selecciona una opci&oacute;n</option>
		  <option value="H" >Hombre</option>
		  <option value="M" >Mujer</option>
	  </select>	  
	  	<div ng-show="saveMiembro.$submitted || saveMiembro.sexo.$touched">
		  <div ng-show="saveMiembro.sexo.$error.required">Este es un campo requerido.</div>
		</div>	  
	</div>
		
	<div class="form-group">
		<label for="fecha_nacimiento">Fecha de nacimiento</label>
		  
		<div class="input-group date" >
			<input type="text" class="form-control datepick" ng-model="formData.fecha_nacimiento" name='fecha_nacimiento' id='fecha_nacimiento' placeholder='Fecha de nacimiento'>
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</div>
		</div>
		  
		<div ng-show="saveMiembro.$submitted || saveMiembro.fecha_nacimiento.$touched">
		  <div ng-show="saveMiembro.fecha_nacimiento.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="fecha_ingreso">Fecha de ingreso</label>
		  
		<div class="input-group date" >
			<input type="text" class="form-control " ng-model="formData.fecha_ingreso" name='fecha_ingreso' id='fecha_ingreso' placeholder='Fecha de ingreso'>
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</div>
		</div>
		  
		<div ng-show="saveMiembro.$submitted || saveMiembro.fecha_ingreso.$touched">
		  <div ng-show="saveMiembro.fecha_ingreso.$error.required">Este es un campo requerido.</div>
		</div>
	</div>	

	<div class="form-group">
		<label for="email">Email</label>
		  <input type="email" ng-model="formData.email" name="email" class="form-control" placeholder="Email" required="" />	
		<div ng-show="saveMiembro.$submitted || saveMiembro.email.$touched">
		  <div ng-show="saveMiembro.email.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="telefono_directo">Telefono directo</label>
		  <input type="text" ng-model="formData.telefono_directo" name="telefono_directo" class="form-control" placeholder="Telefono directo" required="" />	
		<div ng-show="saveMiembro.$submitted || saveMiembro.telefono_directo.$touched">
		  <div ng-show="saveMiembro.telefono_directo.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<div class="form-group">
		<label for="observaciones">Observaciones</label>
		  <input type="text" ng-model="formData.observaciones" name="observaciones" class="form-control" placeholder="Observaciones"  />	
		<div ng-show="saveMiembro.$submitted || saveMiembro.observaciones.$touched">
		  <div ng-show="saveMiembro.observaciones.$error.required">Este es un campo requerido.</div>
		</div>
	</div>	
	
	<div class="form-group">
		<label for="celular">Celular</label>
		  <input type="text" ng-model="formData.celular" name="celular" class="form-control" placeholder="Celular"  />	
		<div ng-show="saveMiembro.$submitted || saveMiembro.celular.$touched">
		  <div ng-show="saveMiembro.celular.$error.required">Este es un campo requerido.</div>
		</div>
	</div>
	
	<button type="button" class="btn btn-default" onclick="location.href='../'" data-dismiss="modal">Regresar</button>
	<button type="submit" class="btn btn-default" ng-click='submitForm(saveMiembro.$valid); ' id='btnSubmit' >Guardar</button>
	
  </form>
