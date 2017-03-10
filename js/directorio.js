var app = angular.module('directorioApp', []);
app.controller('DirectorioCntroller', function($scope, $http){
	$scope.formData = {};
	$('#pagEmpleados').addClass('active')
	//$scope.formValid = false;
	
   $scope.submitForm = function( formValid ){
   //console.log('form valid?: ', formValid);
   
	if(formValid)
		{   
			console.log('test');
			
			
			$scope.formData.fecha_nacimiento = $("#fecha_nacimiento").val();
			
		
			$('#btnSubmit').attr('disabled',true);
			$http({
			  method: 'POST',
			  url: '../../api/index.php?url=crearUsuario',
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