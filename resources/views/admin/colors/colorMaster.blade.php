  @extends('admin.app')
@section('extra-css')
<style>
.sidebar-left.sidebar-fixed {
    background: #fff;
}
footer.footer.footer-static.footer-light.navbar-border.navbar-shadow {
    display: none;
}
span.badge.badge-primary.badge-pill{
    margin-right: 12px;
}
span.badge{
    cursor: pointer;
}
</style>
@endsection
@section('section')
  
    <div class="sidebar-left sidebar-fixed">
      <div class="sidebar">
        <div class="sidebar-content card d-none d-lg-block">
          <div class="card-body text-center">
       <button class="btn btn-outline-secondary" id="new_shade_family">New Shade Family</button>
       <a href="javascript:void(null)" class="alert-link ml-2" onclick="reloadAllcolor()">Show All</a>
          </div>
          <div id="users-list" class="list-group position-relative">
            <div class="users-list-padding media-list">
                <ul class="list-group" id="loadFamily">
                    
                </ul>
                <ul>
              <li></li>
            </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-right">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <section class="chat-app-window">
               <button class="btn btn-outline-secondary float-right ml-2" id="new_color_shade">New Color Shade</button>
           <fieldset class="form-group position-relative has-icon-left m-0">
              <input type="text" class="form-control" id="searchHandle" placeholder="Search user">
              <div class="form-control-position">
                <i class="ft-search"></i>
              </div>
            </fieldset>
            <div class="pb-4"></div>
            <div id="colorCounter" class="pb-2"></div>
             <div class="row" id="loadColors">
                    </div>
            
          </section>
       
        </div>
      </div>
    </div>


    <!-- ShadeFamily Modal -->
     <div class="modal fade text-left" id="shade_family" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="shadeFamilyLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="shade_family_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="family_id">
        <div class="modal-body">

          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Shade Family Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control"
              name="shade_family_name" id="shade_family_name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Shade_family_color</label>
            <div class="col-md-9">
              <input type="text" class="form-control"
              name="shade_family_code" id="shade_family_code">
            </div>
          </div>
         
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" id="saveShadeFamily">Save</button>
        </div>
      </div>
    </div>
  </div></div>

  <!-- Color Modal -->
 <div class="modal fade text-left" id="color_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Color</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="shade_color_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="color_id">
       
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">Shade Name</label>
                <div class="col-md-9">
                  <input type="text" id="shade_name" class="form-control" placeholder="Enter Shade Name"
                  name="shade_name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput4">Shade Code</label>
                <div class="col-md-9">
                  <input type="text" id="shade_code" class="form-control" placeholder="#fffffff" name="shade_code">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput4">Code Name</label>
                <div class="col-md-9">
                  <input type="text" id="code_name" class="form-control" placeholder="Enter Color Name" name="code_name">
                </div>
              </div>

            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Shade Family ID</label>
                <div class="col-md-9">
                  <select name="shade_family_id" class="form-control" id="shade_family_id">
                    <option value="" ></option>
                 
                  </select>
                </div>
              </div>
              



        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-success" id="saveShadeColor">Save</button>
        </div>
      </div>
    </div>
  </div>




  @endsection
@section('extra-js')
<script src="../../../custom/color.js" type="text/javascript"></script>
  @endsection