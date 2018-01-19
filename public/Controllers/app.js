
var app = angular.module('GauravApp',['ngRoute']);

app.constant('API_URL','http://localhost:8000/');

app.config(["$routeProvider","$interpolateProvider",function($routeProvider,$interpolateProvider){

	$routeProvider
	.when('/',{
		templateUrl: "/view/login.blade.php",
    	controller: "login"
	});
	
	// console.log('ssdfsd');
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}]);