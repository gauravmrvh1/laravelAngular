app.controller('logout',['$scope','$location','$window','API_URL','$route','$rootScope' ,
	 function($scope,$location,$window,API_URL,$route,$rootScope){
	 	console.log('*****Logout Controller******');

	 	var localData = localStorage.getItem('Mai');
		// console.log(localData != undefined );
		$rootScope.adminDetails = JSON.parse(localData);
		console.log($rootScope.adminDetails);

		if($rootScope.adminDetails != null ){
			if($rootScope.adminDetails.photo != null){
				console.log($rootScope.adminDetails.photo);
				$scope.admin_image = $rootScope.adminDetails.photo;
			}
		}



	 	$scope.logoutFunction = function(){
	 		// console.log("------------------Logout Controller-----------------");

	 		// console.log('------------------Logout Function--------------------------------------');
	 		if(localData != undefined || localData != null ){
	 			localStorage.removeItem('Mai');
	 			$rootScope.adminDetails = undefined;
	 			$window.location.href = API_URL + "#/";
	 		}

	 	}
}]);