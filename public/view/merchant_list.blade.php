<div class="orgListPage">
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">

                <h1 class="title-bar-title">
              <span class="d-ib"> Merchant Detail </span>

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
                            <strong>User Detail</strong>
                        </div>
                        <div class="card-body">
                            <table id="demo-datatables-5" class="table table-striped table-bordered table-wrap dataTable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Store logo</th>
                                        <th>Store Name</th>
                                        <th>Owner name</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Area</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody ng-repeat='merchant in merchant_list'>
                                    <tr>
                                        <td><%$index+1%></td>
                                        <td><img class="userTabelImg" src="img/0299419341.jpg" alt="State Flag"></td>
                                        <td><%merchant.store_name%></td>
                                        <td><%merchant.store_owner_name%></td>
                                        <td><%merchant.store_country%></td>
                                        <td><%merchant.store_city%></td>
                                        <td><%merchant.store_area%></td>
                                        <td><%merchant.store_type%></td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-sm btn-labeled" type="button">
                                                <span class="btn-label">
                                                  <span class="icon icon-bank icon-lg icon-fw"></span>
                                                </span>
                                                Unblock
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-labeled" type="button">
                                                <span class="btn-label">
                                                  <span class="icon icon-bank icon-lg icon-fw"></span>
                                                </span>
                                                Block
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