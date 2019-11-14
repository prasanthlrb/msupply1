@extends('admin.app')
@section('extra-css')
 <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/file-uploaders/dropzone.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/ui/prism.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/file-uploaders/dropzone.css">
<style>
.btn-space{
  margin-top: 10px;
}
</style>

@endsection
@section('section')
<div class="content-wrapper">
          <!-- // callback options section end -->
        <div class="content-header row">
            <div class="col-md-12">
               <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$product->product_name}} Gallery</h4>

                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <p class="card-text">maximum file size<code>4 MB</code> number of files<code>10</code>.</p>
                                <button style="display:none" id="testSubmit" class="btn btn-primary mb-1"><i class="ft-trash"></i>Clear All Image</button>
                                <form method="post" action="{{ url('/admin/images-save') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="product_page_id" name="product_page_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_get_id" id="product_get_id" value="{{ $product->id }}">
                                    <div class="dz-message">
                                        <div class="col-xs-8">
                                            <div class="message">
                                                <p>Drop files here or Click to Upload</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fallback">
                                        <input type="file" name="file" id="productGallery" multiple>
                                    </div>

                                </form>
                                
                            </div>
                                 <div class="row">
                            <div class="form-group col-sm-12 col-md-12">

                            <button type="button" class="btn btn-primary float-right" onclick="submitGallery()">
                                    <i class="ft-plus"></i> Upload
                            </button>
                            </div>
                      </div>
                        </div>
                    </div>
                    </div>
        </div>
</div>
@endsection
@section('extra-js')

<script src="{{ url('/dropzone/dropzone.js') }}"></script>
  
<script>
    function submitGallery(){
  $('#testSubmit').trigger('click')
}
// $('.update-tiles').addClass('active');
var total_photos_counter = 0;
var name = "";
Dropzone.options.myDropzone = {
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 10,
    maxFilesize: 5,
    //previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove file',
    dictFileTooBig: 'Image is larger than 4MB',
    timeout: 10000,
    renameFile: function (file) {
        name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
        return name;
    },

    init: function () {
        var _this = this;
        var myDropzone = this;
        var product_page_id = $('#product_page_id').val();

        $.get('/admin/server-images/' + product_page_id, function (data) {
            console.log(data);
            $.each(data.images, function (key, value) {

                var file = { name: value.original, size: value.size };
                myDropzone.options.addedfile.call(myDropzone, file);
                myDropzone.options.thumbnail.call(myDropzone, file, '/product_gallery/' + value.server);
                myDropzone.emit("complete", file);
                total_photos_counter++;
                $("#counter").text("(" + total_photos_counter + ")");
            });
        });
        this.on("removedfile", function (file) {

            $.post({
                url: '/admin/images-delete',
                data: { id: file.name, _token: $('[name="_token"]').val() },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    total_photos_counter--;
                    $("#counter").text("# " + total_photos_counter);
                }
            });
        });
        var submitButton = document.querySelector("#testSubmit");
        submitButton.addEventListener("click", function () {

            _this.processQueue();
            setTimeout(function () {
                if (total_photos_counter == 0) {
                    emptyRedirect();
                }

            }, 2000);
        });
    },
    success: function (file, done) {

        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);
        file["customName"] = name;
        toastr.success('Product Image Successfully', 'Successfully Save');
        window.location.href = "/admin/tiles";
    }
};


function emptyRedirect() {
    toastr.success('Product Image Successfully', 'Successfully Save');
    window.location.href = "/admin/tiles";
}
</script>
@endsection
