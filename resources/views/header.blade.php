<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MAI</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<link rel="manifest" href="manifest.json">
		<link rel="mask-icon" href="safari-pinned-tab.svg" color="#2c3e50">
		<meta name="theme-color" content="#ffffff">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
		<link rel="stylesheet" href="/AdminPanel/css/vendor.min.css">
		<link rel="stylesheet" href="/AdminPanel/css/elephant.min.css">
		<link rel="stylesheet" href="/AdminPanel/css/application.min.css">
		 <link rel="stylesheet" href="/AdminPanel/css/login-2.min.css">
		<link rel="stylesheet" href="/AdminPanel/css/profile.min.css">
		<link rel="stylesheet" href="/AdminPanel/css/demo.min.css">
		<link rel="stylesheet" href="/AdminPanel/css/style.css">

	 	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	  	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>

	  	<script src="{{url('Controllers/app.js')}}"></script>
		<script src="{{url('Controllers/login.js')}}"></script>
		<script src="{{url('/services/constants.js')}}"></script>
		<script src="{{url('/services/httpService.js')}}"></script>


	</head>
	

	<body ng-app="GauravApp" >
		<div ng-view autoscroll="true">
			
		</div>
	</body>

	
</html>
