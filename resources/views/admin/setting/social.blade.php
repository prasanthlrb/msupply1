@extends('admin.app')
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
                          <form class="form form-horizontal" method="POST" action="/admin/add-social">
                            {{ csrf_field() }}
                            <div class="form-body">
                              <h4 class="form-section"><i class="ft-user"></i> Social Media Management</h4>
                             <input type="hidden" name="id" value="{{$data['id']}}">
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Facebook</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="facebook" value="{{$data['facebook']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Twitter</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="twitter" value="{{$data['twitter']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Google+</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="google" value="{{$data['google']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Pinterest</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="pinterest" value="{{$data['pinterest']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Flickr</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="flickr" value="{{$data['flickr']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Youtube</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="youtube" value="{{$data['youtube']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Vimeo</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="vimeo" value="{{$data['vimeo']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">Instagram</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="instagram" value="{{$data['instagram']}}">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control">LinkedIn</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" 
                                  name="linkedin" value="{{$data['linkedin']}}">
                                </div>
                              </div>
                                                         
                              <button type="submit" class="btn btn-primary">
                                  <i class="la la-check-square-o"></i> Update
                                </button>
                            
                            </div>
        
                              
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
<script>
 $('.smm').addClass('active');
</script>
@endsection