<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th>ID</th>
			  <th>Posici&oacute;n</th>
			  <th>Nombre</th>
			</tr>
		  </thead>
		  <tbody>
			<tr ng-repeat="s in subordinados">
			  <td>{{s.id_puesto}}</td>
			  <td>{{s.puesto}}</td>
			  <td>{{s.nombre}}</td>
			  
			</tr>

		  </tbody>
		</table>
	</div>
</div>