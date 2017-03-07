var app = angular.module('addPuestoApp', []);
app.controller('AddPuestoCntroller', function($scope, $http){
	$scope.formData = {};
	$scope.catPuestos = [];
	$scope.catProyectos = [];
	$scope.catClaves = [];
	$scope.catDescripciones = [];
	$scope.catSuperiores = [];
	
	
	
	$http({
      method: 'GET',
      url: 'api/index.php?url=getDataAddPuesto'
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
     
	
   $scope.submitForm = function( formValid ){
   //console.log('form valid?: ', formValid);
   
	if(formValid)
		{
			$('#btnSubmit').attr('disabled',true);
			$http({
			  method: 'POST',
			  url: 'api/index.php?url=addPuesto',
			  data: $scope.formData
		   }).then(function (response){
				console.log(response);
				$scope.formData = {};
				
				alert('Se guardo exitosamente.');
				$('#btnSubmit').attr('disabled',false);
				
		   },function (error){
				console.log(error);
		   });
		}
   }
   
});
