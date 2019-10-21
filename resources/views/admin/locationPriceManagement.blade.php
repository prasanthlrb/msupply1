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
           
                <a href="/admin/create-location-management" class="btn btn-success round btn-glow px-2">Assign New Rules</a>
    
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Product Name</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $x=1; ?>
                  @foreach($lm as $row)
                  <tr>
                    <td>{{$x}}</td>
                    <td>{{$row->product_name}}</td>
                    <td class="text-center" >
                    <a href="/admin/edit-location-management/{{$row->product_id}}"><i class="ft-edit"></i></a>
                  
                    </td>
                  </tr>
                  <?php $x++?>
                @endforeach
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

@endsection
@section('extra-js')

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>


  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
    $('.location-management').addClass('active');
 
     
</script>
@endsection
