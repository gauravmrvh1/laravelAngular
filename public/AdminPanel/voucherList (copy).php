<?php include 'header.php';?>
  <div class="voucherListPage">
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">

                <h1 class="title-bar-title">
              <span class="d-ib"> Voucher Detail </span>
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
                  <strong>Voucher list</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-5" class="table table-striped table-bordered table-wrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Store name</th>
                        <th>Owner name</th>
                        <th>Voucher type</th>
                        <th>Voucher code</th>
                        <th>description</th>
                        <th>Validity</th>
                        <th>Point</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Nike</td>
                        <td>Jhon deo</td>
                        <td>Type1</td>
                        <td>#CF34H</td>
                        <td>Lorem ipsum is the dummy text for the testing and show as a dummy content.</td>
                        <td>31 november</td>
                        <td>10</td>
                        <td class="text-center">                            
                            <button class="btn btn-info btn-sm btn-labeled" type="button">
                              <span class="btn-label">
                                <span class="icon icon-bank icon-lg icon-fw"></span>
                              </span>
                             Approved
                            </button>
                            <button class="btn btn-danger btn-sm btn-labeled" type="button">
                              <span class="btn-label">
                                <span class="icon icon-bank icon-lg icon-fw"></span>
                              </span>
                              Reject 
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
    
    
<?php include 'footer.php';?>

<div id="viewProfile" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
              <span class="sr-only">Close</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card" data-toggle="match-height" style="">
                <div class="card-avatar">
                  <a class="card-thumbnail circle sq-100" href="#">
                    <img class="img-circle img-responsive" src="img/0180441436.jpg" alt="Teddy Wilson">
                  </a>
                </div>
                <div class="card-body">
                  <div class="card-content text-center">
                    <h3 class="card-title">
                      <a class="link-muted" href="#">Teddy Wilson</a>
                    </h3>
                    <strong>Profile details</strong>
                  </div>
                  <hr>
                  <div class="col-md-6">
                   <ul class="media-list">
                    <li class="media">
                      <div class="media-middle media-body">D.O.B</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">15-06-1991</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Gender</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Male</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Profession</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Employee</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Hometown</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Delhi</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Relationship status</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Single</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Kids</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">No</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Sexual orientation</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">abc</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Height</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">175 cm</small>
                        </div>
                    </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                   <ul class="media-list">
                     <li class="media">
                      <div class="media-middle media-body">Eye color</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Blue</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Hair color</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Golden</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Smoking</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">No</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Drinking</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Yes</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Language</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">English</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Interest</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Sports</small>
                        </div>
                    </li>
                    <li class="media">
                      <div class="media-middle media-body">Animal</div>
                        <div class="media-middle media-right">
                          <small class="label arrow-left arrow-primary">Cat</small>
                        </div>
                    </li>
                  </ul>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" type="button">Edit</button>
            <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
          </div>
        </div>
      </div>
    </div>