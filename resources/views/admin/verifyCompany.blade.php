@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
@section('section')
<div class="content-wrapper">
<div class="content-body">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                </li>
               
               
              <li class="breadcrumb-item">Un Verify Customer
                </li>
               
              </ol>
            </div>
          </div>
   <br>
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
          <div class="card-header">
            
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
        <table class="table table-striped table-bordered zero-configuration">
            <thead>
              <tr>
                <th>S No</th>
                <th>Company Name</th>
                <th>contact Person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
             <?php $x=1?>
            @foreach($company as $row)
            <tr>
            <td>{{$x}}</td>
            <td>{{$row->company}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->phone}}</td>
           
          
            <td class="text-center">
               
            <a href="/admin/verifyed-company/{{$row->user_id}}" class="btn btn-success round btn-glow px-2">open</a>
               
               
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
 $('.unverify_customer').addClass('active');</script>
@endsection