



app.controller('merchant_list',['API_URL','$scope','$route','$location','$window','$rootScope','$http',
	function(API_URL,$scope,$route,$location,$window,$rootScope,$http){

		$scope.init = function(){
			$http.post(API_URL + 'api/merchant_list')
			.then(function(response){
				console.log('---------Merchant List---------------');
				console.log(response);
				if(response.status == 200){
					$scope.merchant_list = response.data.response;
				}
			},function myError(){

			});
		}
		
		$scope.init();

		/*$scope.blockUnblock = function(value,status){
			if(confirm('Are you sure ?')){
				console.log('---------User List Controller----------- function blockUnblock-----------');
				console.log(value);
				console.log(status);
				var parameters = {};
				parameters.userId = value;
				parameters.status = status;

				$http.post(API_URL + 'api/update_user_status' , parameters)
				.then(function(response){
					console.log(response);
					if(response.status == 200){
						$scope.init();
					}
				},function myError(){

				});
			}
		}*/
	}
]);