<div class="profilePage"></div>
<div class="layout-content">
    <div class="layout-content-body">
        <div class="title-bar">

            <h1 class="title-bar-title">
              <span class="d-ib">Edit Profile </span>

            </h1>
            <p class="title-bar-description">
                <small>Welcome to Mai Discounts</small>
            </p>
        </div>

        <div class="row gutter-xs">

            <div class="col-md-8 card panel-body  " id="">
                <div class="col-sm-12 col-md-12">

                    <div class="demo-form-wrapper">
                        <form class="form form-horizontal" method="POST" name="EditProfile" novalidate ng-submit="update_profile($event)" ng-controller="profile">
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="email-2" class=" control-label">Email</label>

                                    <input id="" class="form-control" readonly ng-model="admin_email" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="email-2" class=" control-label">Phone</label>

                                    <input class="form-control" ng-pattern="/^(0|[1-9][0-9]*)$/" name="admin_phone" ng-model="admin_phone" type="text" ng-required='true'>
                                    <!-- <span ng-show="edit_profile.admin_phone.$dirty">Phone is required</span> -->
                                    <span style="color:red; display:block; text-align:center;" ng-show="admin_phone_pattern_err">Please enter correct phone</span>
                                    
                                    <span style="color:red; display:block; text-align:center;" ng-show="admin_phone_err">Phone is required</span>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="email-2" class=" control-label">Add profile pic</label>

                                    <input id="" class="form-control" type="file" single-image-upload ng-model="profile">

                                    <img src="<%admin_image%>" ng-show="adminProfileShow" height="200px" width="200px" alt="image">
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="email-2" class=" control-label">Location</label>

                                    <input id="" class="form-control" ng-model="admin_location" type="text">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="about" class=" control-label">About me</label>

                                    <textarea id="" class="form-control" rows="5" ng-model="admin_about" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label for="address" class=" control-label">Address</label>

                                    <textarea id="" class="form-control" rows="5" ng-model="admin_address"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class=" col-sm-8  col-md-8 ">
                                    <!-- <button class="btn btn-primary " ng-click="update_profile()" type="submit">Submit</button> -->
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>