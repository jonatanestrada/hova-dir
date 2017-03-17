          
		<form name="saveMiembro"  >
			<p id="datepairExample">

				<label for="email">Hora inicio</label>
				<input type="text" ng-model="formData.t_start" class="time start form-control" id='t_start'/>
				<label for="email">Hora fin</label>
				<input type="text" ng-model="formData.t_end" class="time end form-control" id='t_end'/>
			</p>
			
	<label for="ubicacion">Ubicaci&oacute;n</label>
	<div class="form-group">
		<select class="form-control" ng-options="c.id_descripcion as c.clave+' - '+c.nombre for c in catDescripciones | orderBy : 'nombre'" ng-model="selectedDesc"></select>
    </div>


			<label for="email">D&iacute;as</label>
			
			<table style="width: 100%;">
				<tr>
					<td>
						<div class="checkbox">
							<label ><input type="checkbox" value="1" ng-model="formData.lunes" name='lunes' id='lc'>Lunes</label>
						</div>
						<div class="checkbox">
							<label ><input type="checkbox" value="2" ng-model="formData.martes" name='martes' id='mc'>Martes</label>
						</div>
						<div class="checkbox">
							<label ><input type="checkbox" value="3" ng-model="formData.miercoles" name='miercoles' id='mic'>Miercoles</label>
						</div>
					</td>
					<td>
						<div class="checkbox">
							<label><input type="checkbox" value="4" ng-model="formData.jueves" name='jueves' id='jc'>Jueves</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" value="5" ng-model="formData.viernes" name='viernes' id='vc'>Viernes</label>
						</div>
						<div class="checkbox">
							<label class="checkbox"><input type="checkbox" value="6" ng-model="formData.sabado" name='sabado' id='sc'>Sabado</label>
						</div>
					</td>
				</tr>
			<table>

			
			<button type="button" style='float:right' class="btn btn-default" ng-click="submitFormAddHorario()" >Agregar horario</button><br><br>			
			
			
		</form>
			
		<div class="panel panel-default">
			<div class="table-responsive">
				<table class="table table-striped">
				  <thead>
					<tr>
						<th>D&iacute;a</th>
						<th>Horario</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
						<td>Lunes</td>
						<td><p ng-repeat="h in horarios.Lunes">{{h.hora_inicio}} - {{h.hora_fin}} ({{h.nombre}}) <a href='' ng-click='eliminar( h )'>Eliminar</a></p></td>
					</tr>
					<tr>
						<td>Martes</td>
						<td><p ng-repeat="h in horarios.Martes">{{h.hora_inicio}} - {{h.hora_fin}} ({{h.nombre}}) <a href='' ng-click='eliminar( h )'>Eliminar</a></p></td>
					</tr>
					<tr>
						<td>Mi&eacute;rcoles</td>
						<td><p ng-repeat="h in horarios.Miercoles">{{h.hora_inicio}} - {{h.hora_fin}} ({{h.nombre}}) <a href='' ng-click='eliminar( h )'>Eliminar</a></p></td>
					</tr>
					<tr>
						<td>Jueves</td>
						<td><p ng-repeat="h in horarios.Jueves">{{h.hora_inicio}} - {{h.hora_fin}} ({{h.nombre}}) <a href='' ng-click='eliminar( h )'>Eliminar</a></p></td>
					</tr>
					<tr>
						<td>Viernes</td>
						<td><p ng-repeat="h in horarios.Viernes">{{h.hora_inicio}} - {{h.hora_fin}} ({{h.nombre}}) <a href='' ng-click='eliminar( h )'>Eliminar</a></p></td>
					</tr>
					<tr>
						<td>S&aacute;bado</td>
						<td><p ng-repeat="h in horarios.Sabado">{{h.hora_inicio}} - {{h.hora_fin}} ({{h.nombre}}) <a href='' ng-click='eliminar( h )'>Eliminar</a></p></td>
					</tr>
				  </tbody>
				</table>
			</div>
		</div>