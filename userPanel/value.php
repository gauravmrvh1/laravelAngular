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
                                                <input type="text" class="form-control myInput" placeholder="enter validity" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add point</label>
                                                <input type="text" class="form-control myInput" placeholder="enter point" value=""  
                                                id="">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Voucher Description</label>
                                                 <input type="button" class="btn btn-primary a" id="" value="123" name="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Voucher Description</label>
                                                <input type="button" class="btn btn-primary a" value="124546" name="">
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
  $(".a").click(function () {
    var number = $(this).val();
    $("#myInput").val(number);
});
  
  $(".myInput").click(function () {
    $(".myInput").removeAttr("id");
    $(this).attr('id', 'myInput');
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