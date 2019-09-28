@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
  <style>
  .clickable-Product-row{
    cursor: pointer;
  }
  td{
    text-align: center;
  }
  </style>
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/raty/jquery.raty.css">
    <!-- END VENDOR CSS-->

@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">

<section id="column-selectors">
    <div class="row">
            <div class="col-md-2">
            <div class="form-group">
                    <label for="projectinput5">Review Status</label>
                    <select id="reviewStatus" name="reviewStatus" class="form-control">
                      <option value="0" selected="">Un Approval</option>
                      <option value="1">Approval</option>
                      <option value="2">Rejected</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-12 mb-1">
                        <div class="form-group text-center">
                          <!-- Floating button Regular with text -->
                          <a href="javascript:void(null)" id="reviewFilter" class="btn btn-float btn-cyan"><i class="la la-filter"></i><span>Filter</span></a>

                          <a href="#" id="page-reload" class="btn btn-float btn-cyan"><i class="la la-refresh"></i><span>refresh</span></a>
                        </div>
                      </div>
      <div class="col-12">

        <div class="card">

          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Product Name</th>
                    <th>Order ID</th>
                    <th>Date</th>
                    @if($role->review_approval == 1)
                    <th>View Review & Rating</th>
                    @endif
                  </tr>
                </thead>
                <tbody>

                </tbody>

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

  <div class="modal fade text-left" id="review_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Reviews</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form" method="post">
            <input type="hidden" id="reviewID">
            <p id="displayReview" style="padding: 18px;
            text-align: justify;"></p>
        </form>
        <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-danger" onclick="review(2)">Reject</button>
                <button type="button" class="btn btn-outline-primary" onclick="review(1)">Approval</button>
              </div>
      </div>
    </div>
  </div>

@endsection
@section('extra-js')

<!-- BEGIN PAGE VENDOR JS-->
<script src="../../../app-assets/vendors/js/extensions/jquery.raty.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>


  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
  <script>
        setTimeout(function () {
  $.fn.raty.defaults.path = '../../../app-assets/images/raty/';
$('.default-star-rating').raty({
    readOnly: true
});
        },1000);
  </script>
  @if($role->review_approval == 1)
<script>
    var orderPageTable = $('.zero-configuration').DataTable(
    {
        processing: true,
        serverSide: true,
        "ajax":'/admin/review/0',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'product_name', name: 'product_name' },
            { data: 'order_id', name: 'order_id' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' },
        ],

    });

    </script>
@else
<script>
    var orderPageTable = $('.zero-configuration').DataTable(
    {
        processing: true,
        serverSide: true,
        "ajax":'/admin/review/0',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'product_name', name: 'product_name' },
            { data: 'order_id', name: 'order_id' },
            { data: 'updated_at', name: 'updated_at' },
        ],
    });

    </script>
    @endif
    <script>
    $('.reviews').addClass('active');
    function showReview(data){
        var reviewData = $('#review'+data).val();
        $('#displayReview').text(reviewData);
        $('#reviewID').val(data);
        $('#review_model').modal('show');
    }

    function review(data){
        var id = $('#reviewID').val();
        $.ajax({
        url : '/admin/review-status/'+id+'/'+data,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#review_model').modal('hide');
          toastr.success(data);
          $('.zero-configuration').DataTable().ajax.reload();
        }
      });
    }
    $('#reviewFilter').click(function(){
    var orderStatus = $('#reviewStatus').val();
    console.log(orderStatus);
    var new_url = '/admin/review/'+orderStatus;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});
$('#page-reload').click(function(){
    location.reload();
});

</script>


@endsection
