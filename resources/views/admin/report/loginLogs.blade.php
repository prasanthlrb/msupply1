@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/pickers/daterange/daterange.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
  <style>

  </style>
@endsection
@section('section')
<div class="content-wrapper">
  <div class="content-body">
    <section class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">

              <div class="table-responsive">
                <table id="invoices-list" class="table table-white-space table-bordered dataex-html5-selectors table-middle">
                  <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>System IP</th>
                        <th>Type</th>
                        <th>Date</th>
                  
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>

                </table>
              </div>
              <!--/ Invoices table -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

@endsection
@section('extra-js')
 <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"
  type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"
  type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"
  type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"
  type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/tables/buttons.colVis.min.js" type="text/javascript"></script>
  <script>
$('.singledate').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true
});
$('.log-product').addClass('active');
var orderPageTable = $('.dataex-html5-selectors').DataTable(
    {
        dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copyHtml5',
            exportOptions: {
                columns: [ 0, ':visible' ]
            }
        },
        {
            extend: 'excelHtml5',
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [ 0, 1, 2, 5 ]
            }
        },
        'colvis'
    ],
        processing: true,
        serverSide: true,
        "ajax":'/admin/get-login-log',
        columns: [
            { data: 'employee', name: 'employee' },
            { data: 'ip', name: 'ip' },
            { data: 'type', name: 'type' },
            { data: 'date', name: 'date' },


        ],
    });



   function formatDate(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear();
     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;
     return [year, month, day].join('-');
 }

function Reload(){
    location.reload();
}

function search(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var date1 = formatDate(from_date);
    var date2 = formatDate(to_date);
    var new_url = '/admin/search-product-log/'+date1+'/'+date2;
    orderPageTable.ajax.url(new_url).load();

}


</script>

@endsection
