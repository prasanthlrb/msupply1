@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
 
  
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">
     
   
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            @if($role->faq_create ==1)
            <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Faq</button>
            @endif
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
             
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Question</th>
                    <th>Answer</th>
                    @if($role->faq_edit ==1)
                    <th>Edit</th>
                    @endif
                    @if($role->faq_delete ==1)
                    <th>Delete</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->question}}</td>
                    <td>{{$row->answer}}</td>
                    @if($role->faq_edit ==1)
                    <td class="text-center" onclick="editFaq({{$row->id}})"><i class="ft-edit"></i></td>
                    @endif
                    @if($role->faq_delete ==1)
                    <td class="text-center" onclick="deleteFaq({{$row->id}})"><i class="ft-trash-2"></i></td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                      <th>S No</th>
                      <th>Question</th>
                      <th>Answer</th>
                      @if($role->faq_edit ==1)
                      <th>Edit</th>
                      @endif
                      @if($role->faq_delete ==1)
                      <th>Delete</th>
                      @endif
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
</div>
    </div>
  </div>

  <div class="modal fade text-left" id="faq_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Faq</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="faq_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Question</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter your question"
              name="question">
            </div>
          </div>
          <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Answer</label>
                <div class="col-md-9">
                    <textarea rows="5" class="form-control" name="answer" placeholder="Enter your Answer"></textarea>
                </div>
              </div>
          
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" onclick="saveFaq()" id="saveCat">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('extra-js')

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

 
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>

 $('.faq').addClass('active');

  var action_type;
  $('#open_model').click(function(){
    $('#faq_model').modal('show');
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Faq');
  })
    function saveFaq(){
      var formData = new FormData($('#faq_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/faq_data',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                 console.log(data);
                    $("#faq_form")[0].reset();
                     $('#faq_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Faq Store Successfully', 'Successfully Save');
                },error: function (data) {
                  
                  toastr.error('Question and Answer Required', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update_faq',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#faq_form")[0].reset();
               $('#faq_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('Faq Update Successfully', 'Successfully Update');
          },error: function (data) {
            toastr.error('Question and Answer Required', 'Required!');
        }
      });
      }
      
    }

    function editFaq(id){
      
      $.ajax({
        url : '/admin/edit_faq/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Faq');
          $('#saveCat').text('Save Change');
          $('input[name=question]').val(data.question);
          $('textarea[name=answer]').val(data.answer);
          $('input[name=id]').val(id);
          $('#faq_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteFaq(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete_faq/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Faq Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
     }
    
</script>
@endsection