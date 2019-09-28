@extends('admin.app')
@section('extra-css')

  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
  <style>
.ft-edit{
    cursor: pointer;
}
.ft-trash-2{
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
                <a href="/admin/new-color-product" class="btn btn-success round btn-glow px-2">Create Product</a>
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th> Product Name</th>
                    <th> Product Image</th>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach($product  as $index => $row)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$row->product_name}}</td>
                    <td><img style="width: 100px;" src="{{asset('product_img/').'/'.$row->product_image}}" alt=""></td>
                    <td>{{$row->category_name}}</td>
                  <td class="text-center"><a href="/admin/edit-paint-product/{{$row->id}}"><i class="ft-edit"></i></a></td>
                    <td class="text-center" onclick="deleteCat({{$row->id}})"><i class="ft-trash-2"></i></td>
                  </tr>
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

@endsection
