<?php include 'header.php';?>
       <div class="voucherListPage"></div>
		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Voucher list</h4>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Sr No.</th>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Point</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>#425BG45</td>
                                            <td>Get two more burger with meal</td>
                                            <td>10</td>
                                            <td>till 10 nov.</td>
                                            <td><button type="button" class="btn btn-info btn-fill">Approved</button>
                                            <button type="button" class="btn btn-danger btn-fill">Pending</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>#425BG45</td>
                                            <td>Get two more burger with meal</td>
                                            <td>10</td>
                                            <td>till 10 nov.</td>
                                            <td><button type="button" class="btn btn-info btn-fill">Approved</button>
                                            <button type="button" class="btn btn-danger btn-fill">Pending</button>
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
<script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#logoUrl').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#addLogo").change(function() {
  readURL(this);
});

function readCoverURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#coverUrl').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#addCoverpic").change(function() {
  readCoverURL(this);
});

function readProfileURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#dpUrl').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#addProfile").change(function() {
  readProfileURL(this);
});
</script>
<script type="text/javascript">
  $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
</script>