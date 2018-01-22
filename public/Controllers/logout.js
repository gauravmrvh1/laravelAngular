app.controller('logout',['$scope','$location','$window','API_URL','$route' ,
	 function($scope,$location,$window,API_URL,$route){
	 	console.log('*****Logout Controller******');

	 	$scope.logoutFunction = function(){
	 		console.log("------------------Logout Controller-----------------");
	 		console.log('------------------Logout Function--------------------------------------');

	 		var localData = localStorage.getItem('Mai');

	 		console.log(localData != undefined );

	 		if(localData != undefined || localData != null ){
	 			localStorage.removeItem('Mai');
	 			$window.location.href = API_URL + "#/";
	 		}
	 	}
}]);