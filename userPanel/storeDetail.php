<?php include 'header.php';?>
        <div class="storeDetailPage"></div>
		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                              <h4 class="title">Store Detail</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Store name</label>
                                                <input type="text" class="form-control" placeholder="Company name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Store City</label>
                                                <input type="text" class="form-control" placeholder="City" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add company logo</label>
                                                <input type="file" class="form-control" placeholder="logo" value="" id="addLogo">
                                                <br>
                                                <div class="imgView">
                                                 <img style="max-width: 100%; margin:0 auto;" src="" id="logoUrl">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add Stor type</label>
                                                <select class="form-control">
                                                  <option value="volvo">Volvo</option>
                                                  <option value="saab">Saab</option>
                                                  <option value="mercedes">Mercedes</option>
                                                  <option value="audi">Audi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Add store pics</label>
                                                <!-- <input type="file" class="form-control" name="files[]" placeholder="store pic" multiple id="files"> -->
                                                <br>
                                                <button type="button" class="btn btn-info btn-fill multiAddBtn">Add 
                                                <i class="pe-7s-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-12 clearfix storePicDiv">
                                           <div class="col-md-4 storePicBox">
                                              <img src="">
                                              <br>
                                              <div class="fileUpload btn btn-primary">
                                                <span>Upload</span>
                                                <input type="file" class="storePicUpload" />
                                              </div>
                                              <div type="button" class="rmvBtn">
                                                <i class="pe-7s-close-circle"></i>
                                              </div>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
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
//   $(document).ready(function() {
  
// });
  $("#addLogo").change(function() {
  readURL(this);
});
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#logoUrl').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}


$(document).on('change', '.storePicUpload', function(e){
  $(this).parents('.storePicBox').find('img').attr("src", URL.createObjectURL(e.target.files[0]));
});

</script>
<script type="text/javascript">
//   $(function() {
//     // Multiple images preview in browser
//     var imagesPreview = function(input, placeToInsertImagePreview) {
//         if (input.files) {
//             var filesAmount = input.files.length;
//             for (i = 0; i < filesAmount; i++) {
//                 var reader = new FileReader();
//                 reader.onload = function(event) {
//                     $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
//                 }
//                 reader.readAsDataURL(input.files[i]);
//             }
//         }
//     };
//     $('#gallery-photo-add').on('change', function() {
//         imagesPreview(this, 'div.gallery');
//     });
// });
</script>
<script type="text/javascript">
    $('.multiAddBtn').click(function() {
      $(".storePicDiv").append('<div class="col-md-4 storePicBox">\
          <img src="">\
          <br>\
          <div class="fileUpload btn btn-primary">\
            <span>Upload</span>\
            <input type="file" class="storePicUpload" />\
          </div>\
          <div type="button" class="rmvBtn">\
            <i class="pe-7s-close-circle"></i>\
          </div>\
       </div>');
    $(".rmvBtn").on('click',function(){
      $(this).parent('.storePicBox').remove();
    });
   });
</script>