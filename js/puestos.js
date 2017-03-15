var app = angular.module('puestosApp', []);
app.controller('PuestoCntroller', function($scope, $http){
	$scope.miembros = [];
	$scope.formData = {};
	$scope.pages = 0;
	$scope.noPage = 0;
	$scope.vacantes = 0;
	$scope.nameSearch = '';
	
	$scope.catPuestos = [];
	$scope.catProyectos = [];
	$scope.catClaves = [];
	$scope.catDescripciones = [];
	$scope.catSuperiores = [];
	$scope.catMiembrosSinPuesto = [];
	$scope.subordinados = [];
	$scope.jefeSubordinados = [];
	
	
	$('#pagPuestos').addClass('active')
	
	
	$http({
      method: 'GET',
      url: '../api/index.php?url=getDataAddPuesto'
   }).then(function (response){
		console.log(response.data);
		$scope.catPuestos = response.data.catPuestos;
		$scope.catProyectos = response.data.catProyectos;
		$scope.catClaves = response.data.catClaves;
		$scope.catDescripciones = response.data.catDescripciones;
		$scope.catSuperiores = response.data.catSuperiores;
		
		console.log($scope.catDescripciones);
		//console.log($scope.catClaves);
		
   },function (error){

   });
	
	$scope.edit = function( row ){
		//console.log(row);
		$scope.formData = row;
	};
	
	$scope.addMiembroVacante = function( row ){
		getMiembrosSinPuesto();
		$scope.formData = row;
		$scope.formData.id_miembro = '';
		console.log($scope.formData);
		console.log('addUser');
	}
	
	$scope.deleteMiembroVacante = function( row ){
		$scope.formData = row;
		console.log($scope.formData);
		console.log('deleteUser');
	}	
	
	
	$scope.submitForm = function(){
	//console.log($scope.formData);
	
		$http({
		  method: 'POST',
		  url: '../api/index.php?url=editarPuesto',
		  data: $scope.formData
	   }).then(function (response){
			//console.log(response);
			$('#myModal').modal('toggle');
			alert( 'Se guardo exitosamente.' )
			load($scope.noPage);
	   },function (error){
			console.log(error);
	   });
   }
   
   	$scope.submitFormAdd = function( formValid ){
	//console.log($scope.formData);
		if(formValid)
		{   
			$http({
			  method: 'POST',
			  url: '../api/index.php?url=addMiembroVacante',
			  data: $scope.formData
		   }).then(function (response){
				console.log(response);
				$('#modalAdd').modal('toggle');
				alert( 'Se guardo exitosamente.' )
				load($scope.noPage);
		   },function (error){
				console.log(error);
		   });
		}
   }
   
    $scope.submitFormDelete = function(){
	//console.log($scope.formData);
	
		$http({
		  method: 'POST',
		  url: '../api/index.php?url=deleteMiembroPuesto',
		  data: $scope.formData
	   }).then(function (response){
			console.log(response);
			$('#modalDelete').modal('toggle');
			alert( 'Se borro exitosamente.' )
			load($scope.noPage);
	   },function (error){
			console.log(error);
	   });
   }
   
	
	//Cargar primera pagina de registros
	load(1);
   
   $scope.load= function( page, nameSearch, vacantes = 0 ){
		load( page, nameSearch, vacantes );
   }
   
   $scope.viewSubordinados= function( row ){
		//console.log('viewSubordinados');
		console.log(row.id_puesto);
		$scope.jefeSubordinados = row;
		
		var id = row.id_puesto;
		
		$http({
		  method: 'GET',
		  url: '../api/index.php?url=getSubordinados&id='+id,
		  data: $scope.formData
	   }).then(function (response){
			console.log(response);
			$scope.subordinados = response.data.subordinados;
			$('#modalSubordinados').modal('toggle');
	   },function (error){
			console.log(error);
	   });
		
		
   }

function getMiembrosSinPuesto(){
	console.log('getMiembrosSinPuesto');
		$http({
      method: 'GET',
      url: '../api/index.php?url=getMiembrosSinPuesto'
   }).then(function (response){
		console.log(response.data);
		$scope.catMiembrosSinPuesto = response.data.miembros;
		//console.log($scope.catMiembrosSinPuesto);
   },function (error){

   });
}
   
function load( page, nameSearch, vacantes = 0 ){

		$scope.noPage = page;
		//console.log($scope.noPage);
		if( page > 0 ){   
			$http({
			  method: 'GET',
			  url: '../api/index.php?url=getPuestos&page='+page+'&n='+nameSearch+'&vacantes='+vacantes
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