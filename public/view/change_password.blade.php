<div class="profilePage"></div>
<div class="layout-content">
    <div class="layout-content-body">
        <div class="title-bar">

            <h1 class="title-bar-title">
              <span class="d-ib">Change Password </span>

            </h1>
            <p class="title-bar-description">
                <small>Welcome to Loovline</small>
            </p>
        </div>

        <div class="row gutter-xs">

            <div class="col-md-8 card panel-body" >
                <div class="col-sm-12 col-md-12">

                    <div class="demo-form-wrapper">
                        <form class="form form-horizontal">
                            <span class="response_message"></span>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="" class=" control-label">Old Password</label>

                                    <input id="" class="form-control old_password" ng-model="old_password" type="password">
                                    <span ng-show="old_password_err" style="color:red"><%oldPasswordMissingMsg%></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="" class=" control-label">New Password</label>

                                    <input id="" class="form-control" type="password" ng-model="new_password">
                                    <span ng-show="new_password_err" style="color:red"><%new_password_err%></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="" class=" control-label">Confirm Password</label>

                                    <input id="" class="form-control" type="password" ng-model="confirm_password">
                                    <span ng-show="confirm_password_err" style="color:red"><%confirm_password_err%>
                                        
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" col-sm-8  col-md-8 ">
                                    <button class="btn btn-primary btn-block " ng-click="change_password()" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="layout-footer">
    <div class="layout-footer-body">

        <small class="copyright">2017 &copy; Zakati</small>
    </div>
</div>
</div>