<!DOCTYPE html>
<html ng-app="app">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>AngularJS fileuploadqwerty</title>
</head>
    <body>
        <div data-ng-controller="HomeCtrl">
        	<form name="upload" ng-submit="uploadFile()">
                <input type="text" ng-model="name" /><br>
                <input type="file" name="file" uploader-model="file" /> <br>
                <input type="submit" value="Enviar"> 
            </form>
        </div>
        <script type='text/javascript' src="../../../js/angular.min.js"></script>
        <script type='text/javascript' src="../../../js/directorio.js"></script>
    </body>
</html>