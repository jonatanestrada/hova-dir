

        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 main">

			<h1 class="page-header">Horario Empleado</h1>
			
			
		<form name="saveMiembro"  >
			<div class="form-group">
			<p id="datepairExample">
				
					<label for="email">Hora inicio</label>
						<input type="text" ng-model="formData.t_start" class="time start form-control" id='t_start'/>

					<label for="email">Hora fin</label>
						<input type="text" ng-model="formData.t_end" class="time end form-control" id='t_end'/>
				
			</p>
			</div>


			<div class="col-sm-2">
				<label class="checkbox-inline"><input type="checkbox" value="1" ng-model="formData.lunes" name='lunes'>Lunes</label>
			</div>
			<div class="col-sm-2">
				<label class="checkbox-inline"><input type="checkbox" value="2" ng-model="formData.martes" name='martes'>Martes</label>
			</div>
			<div class="col-sm-2">
				<label class="checkbox-inline"><input type="checkbox" value="3" ng-model="formData.miercoles" name='miercoles'>Miercoles</label>
			</div>
			<div class="col-sm-2">
				<label class="checkbox-inline"><input type="checkbox" value="4" ng-model="formData.jueves" name='jueves'>Jueves</label>
			</div>
			<div class="col-sm-2">
				<label class="checkbox-inline"><input type="checkbox" value="5" ng-model="formData.viernes" name='viernes'>Viernes</label>
			</div>
			<div class="col-sm-2">
				<label class="checkbox-inline"><input type="checkbox" value="6" ng-model="formData.sabado" name='sabado'>Sabado</label>
			</div>
				
			<button type="button" class="btn btn-default" ng-click="submitFormAddHorario()" data-dismiss="modal">Agregar empleado</button><br><br>			
			
		</form>
			
			<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Lunes</th>
                  <th>Martes</th>
				  <th>Miercoles</th>
				  <th>Jueves</th>
                  <th>Viernes</th>
                  <th>Sabado</th>
				  <th>Domingo</th>
                </tr>
              </thead>
              <tbody>
				<tr>
					<td>9:00am - 6:00pm</td>
					<td>9:00am - 6:00pm</td>
					<td>9:00am - 6:00pm</td>
					<td>9:00am - 6:00pm</td>
					<td>9:00am - 3:00pm</td>
					<td>9:00am - 6:00pm</td>
					<td></td>
				</tr>
              </tbody>
            </table>
          </div>
	

  
  