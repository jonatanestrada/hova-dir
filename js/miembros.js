var app = angular.module('directorioApp', []);
app.controller('DirectorioCntroller', function($scope, $http){
	$scope.miembros = [];
	$scope.formData = {};
	$scope.pages = 0;
	$scope.noPage = 0;
	$scope.selectedDesc = 0;
	$scope.nameSearch = '';
	$scope.horarios = [];
	$scope.ubicaciones = [];
	$scope.catDescripciones = [];
	
	$scope.edit = function( row ){
		//console.log(row);
		$scope.formData = row;
	};
	
	$scope.darDeBajaEmpleado = function( row ){
		//console.log(row);
		$scope.formData = row;
	};
	
	$scope.horariosMiembro = function( row ){
		//console.log(row);
		$('#t_start').val('');
		$('#t_end').val('');
		$scope.formData.lunes = '';
		$scope.formData.martes = '';
		$scope.formData.miercoles = '';
		$scope.formData.jueves = '';
		$scope.formData.viernes = '';
		$scope.formData.sabado = '';
		
		$scope.formData = row;
		getHorarioMiembro( row );		
	};
	
	$scope.eliminar = function( row ){
		var txt;
		var r = confirm("\u00BF Estas seguro que deseas borrar ?");
		if (r == true) {
			deleteHorario( row );
		} else {
			txt = "You pressed Cancel!";
		}
		//console.log(txt);
	}
	
	function deleteHorario( row ){
		//console.log(row);
		//console.log('Delete horario');
		$http({
		  method: 'POST',
		  url: '../api/index.php?url=deleteHorarioMiembro',
		  data: row
	   }).then(function (response){
			//console.log(response);
			getHorarioMiembro( row );
			alert( 'Se borro el horario exitosamente.' )
			
	   },function (error){
			console.log(error);
	   });
	}
	
	$scope.submitFormAddHorario = function(){
		//console.log('Add horario');
		//console.log($scope.formData);
				
		$scope.formData.t_start = $('#t_start').val();
		$scope.formData.t_end = $('#t_end').val();
		
			$http({
			  method: 'POST',
			  url: '../api/index.php?url=AddHorario',
			  data: $scope.formData
		   }).then(function (response){
				console.log(response);
				getHorarioMiembro( $scope.formData );
				//$scope.formData = {};
				clearFormHorario();
				//console.log('Entro');
				
				
				
				alert( 'Se agrego el horario exitosamente.' )
				//$scope.personas.push($scope.newPersona);
				//$scope.newPersona = {};
				
		   },function (error){
				console.log(error);
		   });
	}
	
	function clearFormHorario(){
		$scope.formData.lunes = '';
		$scope.formData.martes = '';
		$scope.formData.miercoles = '';
		$scope.formData.jueves = '';
		$scope.formData.viernes = '';
		$scope.formData.sabado = '';
		$scope.formData.t_start = '';
		$scope.formData.t_end = '';
	}
	
	$scope.submitFormDarDeBaja = function(){
	//console.log('Baja');
		$http({
		  method: 'POST',
		  url: '../api/index.php?url=darDeBaja',
		  data: $scope.formData
	   }).then(function (response){
			console.log(response);
			
			load( $scope.noPage, '' );
			//console.log('Entro');
			$('#modalDarDeBaja').modal('toggle');
			alert( 'Se dio de baja exitosamente.' )
			//$scope.personas.push($scope.newPersona);
			//$scope.newPersona = {};
	   },function (error){
			console.log(error);
	   });
   }
	
	
	$scope.submitForm = function(){
	//console.log($scope.formData);
	$scope.formData.fecha_nacimiento = $("#fecha_nacimiento").val();
	
		$http({
		  method: 'POST',
		  url: '../api/index.php?url=editarMiembro',
		  data: $scope.formData
	   }).then(function (response){
			console.log(response);
			//console.log('Entro');
			$('#myModal').modal('toggle');
			alert( 'Se guardo exitosamente.' )
			//$scope.personas.push($scope.newPersona);
			//$scope.newPersona = {};
	   },function (error){
			console.log(error);
	   });
   }
	
	
	load( 1, '' );
	
	function getHorarioMiembro( row ){
	console.log(row.id_miembro);
			$http({
			  headers: { 'Content-Type': 'application/json; charset=UTF-8'},
			  method: 'GET',
			  url: '../api/index.php?url=getHorarioMiembro&id='+row.id_miembro
		   }).then(function (response){
		   console.log('Horario');
				//$scope.pages = [];
				$scope.horarios.Lunes = response.data.horarioLunes;
				$scope.horarios.Martes = response.data.horarioMartes;
				$scope.horarios.Miercoles = response.data.horarioMiercoles;
				$scope.horarios.Jueves = response.data.horarioJueves;
				$scope.horarios.Viernes = response.data.horarioViernes;
				$scope.horarios.Sabado = response.data.horarioSabado;
				$scope.selectedDesc = row.id_descripcion;
				$scope.catDescripciones = response.data.catDescripciones;
				

				//console.log('Horario');
				//console.log($scope.horarios);
				//$scope.miembros = response.data.miembros.registros;
				
		   },function (error){

		   });
	}
	
   $scope.load= function( page, nameSearch ){ 
		load( page, nameSearch );
   }
   
   function load( page, nameSearch ){
		$scope.noPage = page;
   		if( page > 0 ){   
			$http({
			  headers: { 'Content-Type': 'application/json; charset=UTF-8'},
			  method: 'GET',
			  url: '../api/index.php?url=getMiembros&page='+page+'&n='+nameSearch
		   }).then(function (response){
				$scope.miembros = [];
				$scope.pages = [];		  
				
				$scope.miembros = response.data.miembros.registros;
				//console.log(response.data.miembros.registros.registros);
				
				var page = parseInt(response.data.miembros.page);
				var adjacents = parseInt(response.data.miembros.adjacents);
				var tpages = parseInt(response.data.miembros.noPages);
				
				//console.log(tpages);
				
				pages = getPage( page, adjacents, tpages );
				$scope.pages = pages;
				
		   },function (error){

		   });
	   }
   
   }
   
   
      function getPage( page, adjacents, tpages ){
   
		var pages = [];
		var pmin = ( page > adjacents) ? ( parseInt(page) - parseInt(adjacents)) : 1;
		var pmax = ( page < ( tpages - adjacents ) ) ? ( parseInt(page) + parseInt(adjacents) ) : parseInt(tpages);
		
		//console.log('page: '+ page+', adjacents: '+adjacents+', tpages: '+tpages+', pmin: '+pmin+',pmax: '+ pmax);
		
		var prevlabel = "< Anterior";
		var nextlabel = "Siguiente >";	

		// previous label
		if( page == 1)
			pages.push({label: prevlabel, page:-1});
		else if( page == 2 )
			pages.push({label: prevlabel, page:1});
		else
			pages.push({label: prevlabel, page: (page-1) });

		// first label
		if( page > ( adjacents + 1 ) )
			pages.push({label: 1, page: 1 });
		// interval
		if( page > ( adjacents + 2 ) )
			pages.push({label: '...', page: -2 });

		// pages
		for ( i = pmin; i <= pmax; i++) { 
			if( i == page )
				pages.push({label: i, page:0});
			else if( i == 1 )
				pages.push({label: i, page:1});
			else
				pages.push({label: i, page:i});
		}
		
		// interval
		if( page < ( tpages - adjacents - 1 ) )
			pages.push({label: '...', page:-2});

			
		// last
		if( page < ( parseInt(tpages) - parseInt(adjacents) ) )
			pages.push({label: tpages, page: tpages});

		// next
		if( page < tpages )
			pages.push( {label: nextlabel, page: ( page + 1 ) } );
		else
			pages.push( {label: nextlabel, page: -1 } );
		
		//console.log(pages);
		
		return pages;
   }
     
	$scope.classPage= function( type ){
		var classess = 'btn_paginador';
	
		if( type == 0 )
			classess += ' active';
		else if( type == -1 )
			classess += ' disabled';
		else if( type == -2 )
			classess += '';
	
		return classess;
	}
   
   
});