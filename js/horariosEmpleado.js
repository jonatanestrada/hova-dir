var app = angular.module('directorioApp', []);
app.controller('DirectorioCntroller', function($scope, $http){
	//$scope.miembros = [];
	$scope.formData = {};
	
	
	$scope.submitFormAddHorario = function(){
	console.log('Add horario');
	console.log($scope.formData);
	
	$scope.formData.t_start = $('#t_start').val();
	$scope.formData.t_end = $('#t_end').val();
	
		$http({
		  method: 'POST',
		  url: 'api/index.php?url=AddHorario',
		  data: $scope.formData
	   }).then(function (response){
			console.log(response);
			
			//console.log('Entro');
			alert( 'Se agrego el horario exitosamente.' )
			//$scope.personas.push($scope.newPersona);
			//$scope.newPersona = {};
	   },function (error){
			console.log(error);
	   });
   }
	
	
   
});