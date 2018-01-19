<?php include 'header.php';?>
<div class="addLocPage"></div>
<div class="layout-content">
    <div class="layout-content-body">
        <div class="title-bar">

            <h1 class="title-bar-title">
              <span class="d-ib">Add Location </span>

            </h1>
            <p class="title-bar-description">
                <small>Welcome to MAI</small>
            </p>
        </div>

        <div class="row gutter-xs">
            <div class="col-md-12 card panel-body" id="">
                <div class="col-sm-12 col-md-12">
                    <div class="">
                        <form class="form form-horizontal">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label">Add Country</label>
                                    <input id="" class="form-control" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Add City</label>
                                    <input id="" class="form-control" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Add Area</label>
                                    <input id="" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                  <button class="btn btn-primary " type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutter-xs">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-actions">
                                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                                    <button type="button" class="card-action card-reload" title="Reload"></button>

                                </div>
                                <strong>Location list</strong>
                            </div>
                            <div class="card-body">
                                <table id="demo-datatables-5" class="table table-striped table-bordered table-wrap dataTable" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Country name</th>
                                            <th>City name</th>
                                            <th>Area name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>India</td>
                                            <td>Noida</td>
                                            <td>Sectore 12</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm btn-labeled" type="button">
                                                    <span class="btn-label">
                                                     <span class="icon icon-bank icon-lg icon-fw"></span>
                                                    </span>
                                                    Delete
                                                </button>
                                                <button class="btn btn-success btn-sm btn-labeled" type="button" data-toggle="modal" data-target="#editCategory">
                                                    <span class="btn-label">
                                                     <span class="icon icon-edit icon-lg icon-fw"></span>
                                                    </span>
                                                    Edit
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
<?php include 'footer.php';?>
<div id="editCategory" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">Edit Location</h4>
          </div>
          <div class="modal-body">
            <div class="row gutter-xs">
                <div class="col-md-12 card panel-body" id="">
                    <div class="col-sm-12 col-md-12">
                        <div class="">
                            <form class="form form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Country name</label>
                                        <input id="" class="form-control" type="text">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">City name</label>
                                        <input id="" class="form-control" type="text">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="control-label">Area name</label>
                                        <input id="" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8">
                                      <button class="btn btn-primary " type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
          </div>
        </div>
      </div>
    </div>