





app.controller('change_password',['$scope','API_URL','$rootScope','$window','$http','$route','$location','constants',
	function ($scope,API_URL,$rootScope,$window,$http,$route,$location,constants) {
		console.log('******* change_password Controller ****');

		// var data = JSON.stringify(localStorage.getItem('Mai'));
		var data = JSON.parse(localStorage.getItem('Mai'));
		// console.log(data);

		/*$scope.old_password = 11111111;
		$scope.new_password = 11111111;
		$scope.confirm_password = 11111111;*/

		$scope.change_password = function(){
			// console.log($scope.old_password);
			var old_password = $scope.old_password;
			var new_password = $scope.new_password;
			var confirm_password = $scope.confirm_password;
			// console.log(constants);

			if(old_password == null || old_password == undefined || old_password.trim() == "" ){
				$scope.old_password_err = true;
				$scope.old_password = "";
				$scope.oldPasswordMissingMsg = constants.oldPasswordMissingMsg;
			}else{
				if(data.password != old_password){
					$scope.old_password_err = true;
					$scope.oldPasswordMissingMsg = constants.oldPasswordIncorrectMsg;
				}else{
					$scope.old_password_err = false;
				}
			}

			if(new_password == null || new_password == undefined || new_password.trim() == "" ){
				$scope.new_password_err = true;
				$scope.new_password_err = "";
				$scope.new_password_err = constants.newPasswordMissingMsg;
			}else{
				// console.log(new_password.length);
				if(new_password.length < 8){
					$scope.new_password_err = true;
					$scope.new_password_err = constants.loginPasswordValidMsg;
				}else{
					$scope.new_password_err = false;
				}
			}

			if(confirm_password == null || confirm_password == undefined || confirm_password.trim() == "" ){
				$scope.confirm_password_err = true;
				$scope.confirm_password_err = "";
				$scope.confirm_password_err = constants.newPasswordMissingMsg;
			}else{
				// console.log(confirm_password.length);
				if(confirm_password.length < 8){
					$scope.confirm_password_err = true;
					$scope.confirm_password_err = constants.loginPasswordValidMsg;
				}else{
					if(new_password == confirm_password){
						$scope.confirm_password_err = false;
					}else{
						$scope.confirm_password_err = true;
						$scope.confirm_password_err = constants.passwordMismatch;
					}
					
				}
			}

			if($scope.old_password_err || $scope.new_password_err || $scope.confirm_password_err ){
				return false;
			}

			// console.log(JSON.parse(localStorage.getItem('Mai')));

			var localData = JSON.parse(localStorage.getItem('Mai'));

			var parameters = {};
			parameters.admin_id = localData.id;
			parameters.admin_email = localData.email;
			parameters.old_password = old_password;
			parameters.new_password = new_password;

			$http.post(API_URL + '/api/changePassword', parameters)
				.then(function(response){
					console.log(response);
					if(response.status == 200){
						// $('.response_message').text(response.data.message).css('color','green');
						alert(response.data.message);
						localStorage.setItem('Mai',JSON.stringify(response.data.response));
						$window.location.reload();
					}
				},function myError(){

				});

		}
		
	}]);