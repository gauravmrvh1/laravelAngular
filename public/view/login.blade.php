

<div class="login">
      <div class="login-body">
        <a class="login-brand" href="#">
          <img class="img-responsive" src="/AdminPanel/img/logo.png" alt="logo">
        </a>
        <div class="login-form">
          <form data-toggle="validator">
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" class="form-control" ng-model="loginEmail" type="text" name="loginEmail">
            	<span ng-show="loginEmailError" style="color:red"><%loginEmailMissingMsg%></span>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" class="form-control" ng-model="loginPassword" type="password" name="loginPassword">
              <span ng-show="loginPasswordError" style="color:red"><%login_password_error%></span>
            </div>
            <div class="form-group">
              <label class="custom-control custom-control-primary custom-checkbox">
                <input class="custom-control-input" type="checkbox" >
                <span class="custom-control-indicator"></span>
                <span class="custom-control-label">Keep me signed in</span>
              </label>
            </div>
            <button class="btn btn-primary btn-block" ng-click="loginFunction()">Sign in</button>
          </form>
        </div>
      </div>
      
</div>
	
<script src="/AdminPanel/js/vendor.min.js"></script>
<script src="/AdminPanel/js/elephant.min.js"></script>
<script src="/AdminPanel/js/application.min.js"></script>