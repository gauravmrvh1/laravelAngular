


app.service('httpService',['$window','$http', function($window,$http){
	// var httpService = {};
	var post = function(url , parameters){
		console.log(url);
		console.log(parameters.email);
		console.log(parameters.password);

		var token = 'token';

		$http.post( url, parameters, { headers: { 'Content-Type': 'application/json','Authorization':token} })
			.success(function (response, status, headers, config, event) {
				console.log ('gyhfgh');
				return response;
			},function myError(response, status, headers, config){
				console.log ('gyhfgh');
				return response;
			}).catch(function (data, status, headers, config, event) { // <--- catch instead error
				console.log ('gyhfgh');
				return data;
			})
		return true;
	};

	// httpService.post = post;
	this.post = post;
	// return httpService;
}]);