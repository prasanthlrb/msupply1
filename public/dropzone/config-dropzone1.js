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
        this.on("removedfile", function (file) {
            $.post({
                url: '/images-delete',
                data: {id: file.customName, _token: $('[name="_token"]').val()},
                dataType: 'json',
                success: function (data) {
                    total_photos_counter--;
                    $("#counter").text("# " + total_photos_counter);
                }
            });
        });
        var submitButton = document.querySelector("#testSubmit");
    submitButton.addEventListener("click", function() {
        
      _this.processQueue(); 
      setTimeout(function(){
          if(total_photos_counter == 0){
            emptyRedirect();
          }
       
      }, 2000);      
    });
    },
    success: function (file, done) {      
        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);
        file["customName"] = name;
        //toastr.success('Product Store Successfully', 'Successfully Save');
        window.location.href = "/vendor/viewProduct";
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
function emptyRedirect(){
    //toastr.success('Product Store Successfully', 'Successfully Save');
    window.location.href = "/vendor/viewProduct";
}