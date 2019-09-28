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
                          <form class="form form-horizontal" method="POST" action="/admin/homeSettingterms">
                            {{ csrf_field() }}
                            <div class="form-body">
                              <h4 class="form-section"><i class="ft-user"></i> Terms and Condition</h4>
                             <input type="hidden" name="id" value="{{isset($data[0]->id) ? $data[0]->id : ''}}">
                             
                              
                              <div class="form-group row">
                                

                                <div class="col-sm-12">
                                    <textarea id="projectinput9" rows="20" class="form-control tinymce" name="terms"><?php echo $data[0]->terms?></textarea>
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
    $('.termsCondition').addClass('active');
   </script>
@endsection