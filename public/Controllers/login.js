


app.controller('login',['$scope','constants','API_URL','httpService',function($scope,constants,API_URL,httpService){
	// $scope.email = 'Gauravmrvh1@gmail.com';
	// $scope.password = 'Gauravmrvh1@gmail.com';


	$scope.loginFunction = function(){

		// console.log('gaurav');

		// console.log($scope.loginEmail);
		// console.log($scope.loginPassword);
		
		var loginEmail = $scope.loginEmail;
		var loginPassword = $scope.loginPassword; 

		if(loginEmail == "" || loginEmail == undefined || loginEmail == null){
			$scope.loginEmailError = true;
			$scope.loginEmailMissingMsg = constants.loginEmailMissingMsg;
		}else {
         var regex = new RegExp("^([a-zA-Z0-9_.]+@[a-zA-Z0-9]+[.][.a-zA-Z]+)$");
         if(!$scope.loginEmail.match(regex)){
				$scope.loginEmailError = true;
				$scope.loginEmailMissingMsg = constants.loginEmailValidMsg;
         } else {
				$scope.loginEmailError = false;
         }
     	}

     	if(loginPassword == null || loginPassword == '' || loginPassword == undefined){
     		$scope.loginPasswordError = true;
     		$scope.login_password_error = constants.loginPasswordMissingMsg;
     	}else{
     		if(loginPassword.length < 8){
     			console.log('< 8');
     			$scope.loginPasswordError = true;
     			$scope.login_password_error = constants.loginPasswordValidMsg;
     		} else {
     			console.log('correct');
				$scope.loginPasswordError = false;
         }
     	}

     	var parameters = {};

     	parameters.email = loginEmail;
     	parameters.password = loginPassword;

     	console.log(API_URL + 'api/login');
     	
     	httpService.post(API_URL + 'api/login' , parameters)
     		.then(function(response){
     			console.log(response);
     		},function err(){

     		});
	}
	
}]);

