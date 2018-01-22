app.controller('profile',['$scope','API_URL','$rootScope','$window','$route','$location',
	function ($scope,API_URL,$rootScope,$window,$route,$location) {
		console.log('******* Profile Controller ****');

		// var data = JSON.stringify(localStorage.getItem('Mai'));
		var data = JSON.parse(localStorage.getItem('Mai'));

		$('.admin_name').text(data.name);
		$('.admin_desc').text(data.aboutMe);
		$('.admin_email').text(data.email);
		$('.admin_phone').text(data.mobile);
		$('.admin_address').text(data.address);
		$('.admin_location').text(data.location);
		console.log(data);


		
	}]);