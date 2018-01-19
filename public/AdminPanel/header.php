<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MAI</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#2c3e50">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="css/vendor.min.css">
    <link rel="stylesheet" href="css/elephant.min.css">
    <link rel="stylesheet" href="css/application.min.css">
    <link rel="stylesheet" href="css/profile.min.css">
    <link rel="stylesheet" href="css/demo.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="layout layout-header-fixed">
    <div class="layout-header">
        <div class="navbar navbar-default">
            <div class="navbar-header">
                <a class="navbar-brand navbar-brand-center" href="index.html">
                    <img class="navbar-brand-logo" src="img/logo.png" alt="Elephant">
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
              <img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
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
                                <img class="rounded" width="36" height="36" src="img/0180441436.jpg" alt="Teddy Wilson"> Teddy Wilson
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">

                                <li><a href="index.html">Profile</a></li>
                                <li><a href="#">Sign out</a></li>
                            </ul>
                        </li>
                        <li class="visible-xs-block">
                            <a href="contacts.html">
                                <span class="icon icon-users icon-lg icon-fw"></span> Contacts
                            </a>
                        </li>
                        <li class="visible-xs-block">
                            <a href="profile.html">
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
        <div class="layout-sidebar">
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