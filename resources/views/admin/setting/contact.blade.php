@extends('admin.app')
@section('css-js')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/tinymce/tinymce.min.css">
@endsection
@section('section')
<div class="content-wrapper">
<div class="content-body">
        <section id="horizontal-form-layouts">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                       
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collpase show">
                        <div class="card-body">
                          <form class="form form-horizontal" method="POST" action="/admin/setting-contact">
                            {{ csrf_field() }}
                            <div class="form-body">
                              <h4 class="form-section"><i class="ft-user"></i> Contact Info</h4>
                             <input type="hidden" name="id" value="{{$data['id']}}">
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="email" value="{{$data['email']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput2">Mobile Number</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput2" class="form-control" name="phone" value="{{$data['phone']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput2">Toll Free Number</label>
                                <div class="col-md-9">
                                  <input type="text" id="projectinput2" class="form-control" name="toll_free" value="{{$data['toll_free']}}">
                                </div>
                              </div>
                             
                              
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput9">Address</label>
                                <div class="col-md-9">
                                  <textarea id="projectinput9" rows="5" class="form-control" name="address">{{$data['address']}}</textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput9">Site Info</label>
                                <div class="col-md-9">
                                  <textarea id="described" rows="5" class="form-control tinymce" name="described"><?php echo $data['described']?> </textarea>
                                </div>
                              </div>

                            
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput10">Map contact</label>
                                <div class="col-md-9">
                                  <textarea id="projectinput10" rows="5" class="form-control" name="map1">{{$data['map1']}}</textarea>
                                </div>
                              </div>
                            
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput11">Map sidebar</label>
                                <div class="col-md-9">
                                  <textarea id="projectinput11" rows="5" class="form-control" name="map2">{{$data['map2']}}</textarea>
                                </div>
                              </div>
                            </div>


                          
        
                              <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> Update
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               
             
                
              </section>
            
</div>
</div>

@endsection

@section('extra-js')
<script src="../../../app-assets/vendors/js/editors/tinymce/tinymce.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/editors/editor-tinymce.js" type="text/javascript"></script>
<script>
 $('.contact_info').addClass('active');
</script>
@endsection