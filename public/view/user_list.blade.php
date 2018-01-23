<div class="userListPage">
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">MAI User List </span>
                </h1>
            </div>
            <div class="row gutter-xs">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions">
                                <button type="button" class="card-action card-toggler" title="Collapse"></button>
                                <button type="button" class="card-action card-reload" title="Reload"></button>
                            </div>
                            <strong>User list</strong>
                        </div>
                        <div class="card-body">
                            <table id="demo-datatables-5" class="table table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Name</th>
                                        <th>Contact No.</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody ng-repeat='user in userList'>
                                    <tr>
                                        <td><%$index+1%></td>
                                        <td><%user.name%></td>
                                        <td><%user.mobile%></td>
                                        <td><%user.email%></td>
                                        <td class="text-center">
                                            <button ng-if="user.status == 1" class="btn btn-info btn-sm btn-labeled" ng-click="blockUnblock(user.id,0)" type="button">
                                                <span class="btn-label">
                                                      <span class="icon icon-bank icon-lg icon-fw"></span>
                                                </span>
                                                Block
                                            </button>
                                            <button ng-if="user.status == 0" class="btn btn-danger btn-sm btn-labeled" ng-click="blockUnblock(user.id,1)" type="button">
                                                <span class="btn-label">
                                                    <span class="icon icon-bank icon-lg icon-fw"></span>
                                                </span>
                                                Unblock
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>