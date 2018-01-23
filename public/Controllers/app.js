
var app = angular.module('GauravApp',['ngRoute']);

app.constant('API_URL','http://localhost:8000/');

app.config(["$routeProvider","$interpolateProvider",function($routeProvider,$interpolateProvider){

	$routeProvider
	.when('/',{
		templateUrl: "/view/login.blade.php",
    	controller: "login"
	})
	.when('/index',{
		templateUrl : '/view/index.blade.php',
		controller : 'index'
	}).when('/profile',{
		templateUrl : '/view/profile.blade.php',
		controller : 'profile'
	}).when('/change-password',{
		templateUrl : '/view/change_password.blade.php',
		controller : 'change_password'
	}).when('/edit-profile',{
		templateUrl : '/view/edit_profile.blade.php',
		controller : 'profile'
	}).when('/user-list',{
		templateUrl : '/view/user_list.blade.php',
		controller : 'user_list'
	}).when('/merchant-list',{
		templateUrl : '/view/merchant_list.blade.php',
		controller : 'merchant_list'
	});
	
	// console.log('ssdfsd');
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}]);


app.run(['$rootScope', '$window', 'API_URL', function($rootScope , $window, API_URL) {
    
   $rootScope.$on('$routeChangeSuccess', function (e, current, pre) {
    	console.log(current);
    	console.log(current.$$route.originalPath);
    	console.log("============LocalStorage Data==================================");
		console.log(localStorage.getItem('Mai'));
		console.log("----------------------Route Scope Data--------------------------------------------");
		console.log($rootScope.adminDetails);

		if(current != undefined){
		   var fullRoute = current.$$route.originalPath;
		   console.log(localStorage.getItem('Mai'));
		   // console.log(fullRoute);
		   // localStorage.removeItem('Mai');
		   if(localStorage.getItem('Mai') != undefined && localStorage.getItem('Mai') != null && localStorage.getItem('Mai') != "undefined"){

		   	$rootScope.header_div = true;

				var user = JSON.parse(localStorage.getItem('Mai'));
				console.log("---------------------Response---------------------");
				console.log(user);
				$rootScope.adminDetails = user;
				$rootScope.currentRoute = fullRoute;
				console.log("---------Full Route------"+fullRoute);
				console.log("---------Detail------"+user);
				if(user == null || user == undefined){
				  $rootScope.adminDetails = undefined;
				  if(fullRoute != '/' && fullRoute != '/' && fullRoute != ''){
				      alert('Session expired! Please login to continue.');
				      console.log('something went wrong in app.js');
				      $window.location.href = API_URL+'#/';
				  }
				} else {
					if(fullRoute == '/' || fullRoute == '/' || fullRoute == ''){
						$window.location.href = API_URL+'#/index';
					}
				}
		   } else {
		   	$rootScope.header_div = false;
				if(fullRoute != '/' && fullRoute != '/' && fullRoute != ''){
				  $window.location.href = API_URL+'#/';
				}
		   }
		}
   });
}]);