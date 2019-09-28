@extends('admin.app')
@section('extra-css')
@endsection
@section('section')
<div class="content-wrapper">
    <div class="content-body">     
        <form class="form form-horizontal">
            <div class="form-body">
              <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
              <?php echo $output; ?>
            </div>
            <div class="form-actions">
              <button type="button" class="btn btn-warning mr-1">
                <i class="ft-x"></i> Cancel
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> Save
              </button>
            </div>
          </form> 

    </div>
</div>


@endsection
@section('extra-js')
@endsection