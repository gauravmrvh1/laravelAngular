<?php include 'header.php';?>
        <div class="createVoucherPage"></div>
		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Create Voucher</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add voucher code</label>
                                                <input type="text" class="form-control" placeholder="enter code" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Voucher validity</label>
                                                <input type="text" class="form-control" placeholder="enter validity" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add point</label>
                                                <input type="text" class="form-control" placeholder="enter point" value="" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add Voucher type</label>
                                                <select class="form-control">
                                                  <option value="volvo">Free</option>
                                                  <option value="saab">Premium</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Voucher Description</label>
                                                <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Store details</button>
                                    <div class="clearfix"></div>
                                </form>
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