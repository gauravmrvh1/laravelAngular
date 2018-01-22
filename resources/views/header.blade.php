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
		<script src="{{url('Controllers/logout.js')}}"></script>
		<script src="{{url('Controllers/profile.js')}}"></script>
		<script src="{{url('Controllers/change_password.js')}}"></script>
		<script src="{{url('Controllers/index.js')}}"></script>
		<script src="{{url('/services/constants.js')}}"></script>
		<script src="{{url('/services/httpService.js')}}"></script>


	</head>
	

	<body ng-app="GauravApp" class="layout layout-header-fixed" ng-controller="logout">
    	<div class="layout-header" ng-if="header_div">
		    <div class="navbar navbar-default">
		        <div class="navbar-header">
		            <a class="navbar-brand navbar-brand-center" href="index.html">
		                <img class="navbar-brand-logo" src="/AdminPanel/img/logo.png" alt="Elephant">
		            </a>
		            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="bars">
		              <span class="bar-line bar-line-1 out"></span>
		                <span class="bar-line bar-line-2 out"></span>
		                <span class="bar-line bar-line-3 out"></span>
		                </span>
		                <span class="bars bars-x">
		              <span class="bar-line bar-line-4"></span>
		                <span class="bar-line bar-line-5"></span>
		                </span>
		            </button>
		            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="arrow-up"></span>
		                <span class="ellipsis ellipsis-vertical">
		              <img class="ellipsis-object" width="32" height="32" src="/AdminPanel/img/0180441436.jpg" alt="Teddy Wilson">
		            </span>
		            </button>
		        </div>
		        <div class="navbar-toggleable">
		            <nav id="navbar" class="navbar-collapse collapse">
		                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
		                    <span class="sr-only">Toggle navigation</span>
		                    <span class="bars">
		                <span class="bar-line bar-line-1 out"></span>
		                    <span class="bar-line bar-line-2 out"></span>
		                    <span class="bar-line bar-line-3 out"></span>
		                    <span class="bar-line bar-line-4 in"></span>
		                    <span class="bar-line bar-line-5 in"></span>
		                    <span class="bar-line bar-line-6 in"></span>
		                    </span>
		                </button>
		                <ul class="nav navbar-nav navbar-right">

		                    <li class="dropdown hidden-xs">
		                        <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
		                            <img class="rounded" width="36" height="36" src="/AdminPanel/img/0180441436.jpg" alt="Teddy Wilson"> Teddy Wilson
		                            <span class="caret"></span>
		                        </button>
		                        <ul class="dropdown-menu dropdown-menu-right">

		                            <li><a href="#/profile">Profile</a></li>
		                            <li><a href="javascript:void(0);" ng-click="logoutFunction()">Sign out</a></li>
		                        </ul>
		                    </li>
		                    <li class="visible-xs-block">
		                        <a href="contacts.html">
		                            <span class="icon icon-users icon-lg icon-fw"></span> Contacts
		                        </a>
		                    </li>
		                    <li class="visible-xs-block">
		                        <a href="javascript:void(0);">
		                            <span class="icon icon-user icon-lg icon-fw"></span> Profile
		                        </a>
		                    </li>
		                    <li class="visible-xs-block">
		                        <a href="login-1.html">
		                            <span class="icon icon-power-off icon-lg icon-fw"></span> Sign out
		                        </a>
		                    </li>
		                </ul>
		            </nav>
		        </div>
		    </div>
		</div>

    	


		<div class="layout-main">
        	<div class="layout-sidebar" ng-if="header_div">
            <div class="layout-sidebar-backdrop"></div>
            <div class="layout-sidebar-body">
                <div class="custom-scrollbar">
                    <nav id="sidenav" class="sidenav-collapse collapse">
                        <ul class="sidenav">

                            <li class="sidenav-heading">Navigation</li>
                            <li class="sidenav-item dashboardPageNav">
                                <a href="index.php" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-money"></span>
                                    <span class="sidenav-label">Dashboard</span>
                                </a>

                            </li>
                            <li class="sidenav-item profilePageNav">
                                <a href="profile.php" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-user"></span>
                                    <span class="sidenav-label">Profile</span>
                                </a>
                            </li>
                            <li class="sidenav-item userListNav">
                                <a href="userList.php" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-users"></span>
                                    <span class="sidenav-label"> User List </span>
                                </a>
                            </li>
                            <li class="sidenav-item orgListPageNav">
                                <a href="merchantDetail.php" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-list-ol"></span>
                                    <span class="sidenav-label"> Merchant list </span>
                                </a>
                            </li>
                            <li class="sidenav-item voucherListPageNav">
                                <a href="voucherList.php" aria-haspopup="true">
                                    <span class="sidenav-icon icon icon-list-ol"></span>
                                    <span class="sidenav-label"> Voucher list </span>
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        	</div>
        	
        	<div ng-view autoscroll="true">
	  		</div>
		  	
		  	<div class="layout-footer" ng-if="header_div">
		      <div class="layout-footer-body">

		          <small class="copyright">2017 &copy; MAI</small>
		      </div>
		  	</div>
		</div>

		<script src="/AdminPanel/js/jquery.min.js"></script>
		<script src="/AdminPanel/js/vendor.min.js"></script>
		<script src="/AdminPanel/js/elephant.min.js"></script>
		<script src="/AdminPanel/js/application.min.js"></script>
		<script src="/AdminPanel/js/profile.min.js"></script>
		<script src="/AdminPanel/js/demo.min.js"></script>
		<script type="text/javascript">
		  $(window).load(function() {
		      if ($('.profilePage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.profilePageNav').addClass("active");
		      }
		      if ($('.dashboardPage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.dashboardPageNav').addClass("active");
		      }
		      if ($('.voucherListPage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.voucherListPageNav').addClass("active");
		      }
		      if ($('.dashboard3Page').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.dashboard3PageNav').addClass("active");
		      }
		      if ($('.addInterestPage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.addInterestNav').addClass("active");
		      }
		      if ($('.orgListPage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.orgListPageNav').addClass("active");
		      }
		      if ($('.causesByUserPage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.causesByNav').addClass("active");
		      }
		      if ($('.causesByOrgPage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.causesByNav').addClass("active");
		      }
		      if ($('.stuffDonateByUser').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.stuffNav').addClass("active");
		      }
		      if ($('.stuffRecByOrg').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.stuffNav').addClass("active");
		      }
		      if ($('.stuffRecByUser').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.stuffNav').addClass("active");
		      }
		      if ($('.userListPage').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.userListNav').addClass("active");
		      }

		      if ($('.timeDonateByUser').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.timeNav').addClass("active");
		      }
		      if ($('.timeRecByOrg').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.timeNav').addClass("active");
		      }
		      if ($('.timeRecByUser').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.timeNav').addClass("active");
		      }
		      if ($('.moneyDonateByUser').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.moneyNav').addClass("active");
		      }
		      if ($('.moneyRecByOrg').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.moneyNav').addClass("active");
		      }
		      if ($('.moneyRecByUser').length) {
		          $('.sidenav-item').removeClass("active");
		          $('.moneyNav').addClass("active");
		      }
		  });
		</script>
	</body>

	
</html>
