

app.controller('profile',['$scope','API_URL','$rootScope','$http','$window','$route','$location',
	function ($scope,API_URL,$rootScope,$http,$window,$route,$location) {
		console.log('******* Profile Controller ****');

		// var data = JSON.stringify(localStorage.getItem('Mai'));
		var data = JSON.parse(localStorage.getItem('Mai'));

		$scope.admin_name = data.name;
		$scope.admin_email = data.email;
		$scope.admin_phone = data.mobile;
		$scope.admin_location = data.location;
		$scope.admin_about = data.aboutMe;
		$scope.admin_address = data.address;

		// $('.admin_name').text(data.name);
		$('.admin_desc').text(data.aboutMe);
		$('.admin_email').text(data.email);
		$('.admin_phone').text(data.mobile);
		$('.admin_address').text(data.address);
		$('.admin_location').text(data.location);

		console.log($rootScope.adminDetails.photo);

		if($rootScope.adminDetails.photo != null ){
			$scope.adminProfileShow = true;
			$scope.admin_image = $rootScope.adminDetails.photo;
		}else{
			$scope.adminProfileShow = false;
		}


		$scope.singleImageUpload = function(value){
			console.log(value);
			$scope.profile_photo = value;
		}


		$scope.update_profile = function(){
			console.log('---------------------------Update Profile -------------------------------------------');
			console.log($scope.admin_email);
			var admin_email = $scope.admin_email;
			var admin_phone = $scope.admin_phone;
			var admin_location = $scope.admin_location;
			var admin_about = $scope.admin_about;
			var admin_address = $scope.admin_address;
			var profile = $scope.profile;

			var fd = new FormData;
			fd.append('email', $scope.admin_email);
        	fd.append('phone', $scope.admin_phone);
        	if($scope.profile_photo != undefined){
				fd.append('photo', $scope.profile_photo);
			}
			fd.append('location',$scope.admin_location);
			fd.append('address',$scope.admin_address);
			fd.append('about',$scope.admin_about);
			fd.append('admin_id', $rootScope.adminDetails.id);

        	$http.post(API_URL + 'api/editProfile' , fd ,{headers: { 'Content-Type': undefined}} )
        		.then(function(response){
        			console.log(response);
        			if(response.status == 200 ){
        				alert(response.data.message);
        				localStorage.setItem('Mai',JSON.stringify(response.data.response));
        				console.log('+++++++++++++++++++++++++'+response.data.response.photo);
        				if(response.data.response.photo != null ){
							$scope.admin_image = $rootScope.adminDetails.photo;
        				}
        				console.log($scope.adminProfileShow);
        				console.log(localStorage.getItem('Mai'));
        				$rootScope.adminDetails = response.data.response;
        				$window.location.reload();
        			}
        		},function myError(){

        		});
		}
		
	}]);