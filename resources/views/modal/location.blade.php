<!DOCTYPE html>
<html lang="en">
        <head>
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/app.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/search.css">
        <style>
        html body a.color-cat-menu{
            color:#ff4557;
        }
        html body a.color-cat-menu:hover{
            color:#ff4557;
        }
        html body .price{
            color:#ff4557;
        }
        .card-title{
            color:#ff4557;
        }
        html body a.color-cat-menu.active{
            border-bottom-color:#ff4557;
        }
        .form-control:focus{
            border-color:#ff4557 ;
        }
        .color-item:hover{
          box-shadow: 3px 6px 10px #555555 !important;
        }
        .location-class{
    text-align: center;
    position: relative;
    top: 15px;
    font-size: 18px;
    font-weight: 600;
    color: #fff;
    font-family: sans-serif;
        }
        </style>
      </head>
      <body>
          <div class="container">
<div class="content-body">
        <section id="search-website" class="card overflow-hidden">
          <div class="card-header">
            <h4 class="card-title">Select Your District</h4>
            <a class="heading-elements-toggle" href="javascript:void(null)"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li onclick="closeModals()" ><a data-action="close"><i class="ft-x arcticmodal-close"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-content">
            <div class="card-body pb-0">
              <fieldset class="form-group position-relative mb-0">
                {{-- <input type="text" class="form-control form-control-xl input-xl" id="searchColor" onkeyup="searchResult()" placeholder="Search ...">
              <input type="hidden" id="product_id" value="">
                <div class="form-control-position" onclick="refreshData()">
                  {{-- <i class="ft-refresh-ccw font-medium-4"></i> --}}
                {{-- </div>  --}}
              </fieldset>
            </div>
            
            <div id="search-results" class="card-body">
                    <section id="backColor">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="card">
                                 <div class="card-content">
                                    <div class="card-body">
                                      <div class="row" id="placed_colors">
                                      @foreach($data as $data)
                                        <div class="col-md-3">
                                            <div class="card mb-1 color-item" id="color-item" onclick="getLocation('{{$data}}')">
                                              <div class="card-content">
                                                <div class="bg-lighten-1 height-50" style="background-color:#ff4557;cursor:pointer" >
                                                     <p class="location-class">
                                                         {{$data}}
                                                     </p>
                                                    </div>
                                              
                                              </div>
                                            </div>
                                          </div>

                                          @endforeach
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="table-responsive">
                                          <table class="table table-bordered">
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
            </div>
          </div>
        </section>
      </div>
    </head>
     </div>
</body>
<script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
<script>
   
function getLocation(data){
    $.ajax({
    url:'/set-location/'+data,
    method:'GET',
    success:function(data){
        window.location.href = "/";
       // $('#placed_colors').html(data);
    }
})
    }
</script>
</html>
