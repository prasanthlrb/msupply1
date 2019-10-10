var total_photos_counter = 0;
var name = "";
Dropzone.options.myDropzone = {
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 10,
    maxFilesize: 2,
    //previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove file',
    dictFileTooBig: 'Image is larger than 16MB',
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
        window.location.href = "/admin/viewProduct";
    }
};


// /*  url:"add-product_image",
//   success: function (data) {
//    console.log(data);
// },
// error: function (data) {
//   console.log(data);
// }*/
//   /*init: function() {
//     var submitButton = document.querySelector("#submit-all")
//         myDropzone = this; 

//     submitButton.addEventListener("click", function() {
//       myDropzone.processQueue(); 
//     });


//     this.on("addedfile", function() {

//     });

//   }

//   Dropzone.options.myDropzone = {
//     //autoProcessQueue: false,
//       //autoProcessQueue: false,
//       uploadMultiple: true,
//       parallelUploads: 2,
//       maxFilesize: 16,
//       addRemoveLinks: true,
//       dictRemoveFile: 'Remove file',
//       dictFileTooBig: 'Image is larger than 16MB',
//       timeout: 10000,

//     init: function() {
//       var _this = this;
//       $("#clear-product").on("click", function() {
//           _this.removeAllFiles();

//       });
//       var submitButton = document.querySelector("#testSubmit");
//       submitButton.addEventListener("click", function() {
//        // _this.processQueue(); 
//       });
//   }
//   };
function emptyRedirect() {
    toastr.success('Product Image Successfully', 'Successfully Save');
    window.location.href = "/admin/viewProduct";
}