@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
  <style>
  .deleteIcon{
    cursor: pointer;
  }
  </style>
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">

<section id="column-selectors">
    <div class="row">
      <div class="col-12">

        <div class="card">
        <div class="card-header">
            @if($role->catalog_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Add New Product</button>
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
                    <th>S.No</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    @if($role->catalog_delete ==1)
                    <th>Delete</th>
                    @endif
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                  <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        @if($role->catalog_delete ==1)
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


@endsection
@section('extra-js')


<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>


  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>

  @if($role->catalog_delete ==1)
  <script>
      var status_id = null;
      $('.customer').addClass('active');

      var orderPageTable = $('.zero-configuration').DataTable(
      {
          processing: true,
          serverSide: true,
          "ajax":'/admin/get-product',
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
              { data: 'product_name', name: 'product_name' },
              { data: 'product_image', name: 'product_image' },
              { data: 'delete', name: 'delete' },

          ],
      });
      </script>
  @else

  <script>
      var status_id = null;
      $('.customer').addClass('active');

      var orderPageTable = $('.zero-configuration').DataTable(
      {
          processing: true,
          serverSide: true,
          "ajax":'/admin/get-product',
          columns: [
              { data: 'DT_RowIndex', name: 'DT_RowIndex' },
              { data: 'product_name', name: 'product_name' },
              { data: 'product_image', name: 'product_image' },
          ],
      });
      </script>
      @endif
<script>
    $('.catalog-menu').addClass('active');
$('#open_model').click(function(){
  window.location.href="/admin/create-product/";
})
   var ClickEvent = 0;
function Delete(id){
  ClickEvent = 1;
    var r = confirm("Are you sure");
    if (r == true) {
    $.ajax({
        url : '/admin/productDelete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Product Delete Successfully', 'Successfully Delete');
          $('.table').load(location.href+' .table');
          ClickEvent = 0;
        }
      });
    }
}
$(".clickable-Product-row").click(function() {
    if(ClickEvent == 0){
      window.location = $(this).data("href");
    }
    ClickEvent = 0;
    });
</script>


@endsection
