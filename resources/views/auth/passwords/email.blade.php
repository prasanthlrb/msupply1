@extends('layout.app')

@section('content')


<div class="secondary_page_wrapper">
    <div class="container">
    <section class="section_offset">

            

            <div class="relative">

               


                <div class="table_layout">

                    <div class="table_row">

                        <div class="row">
                           <div class="col-sm-6">
                        
                        <div class="table_cell">

                            <section>

                                <h4>{{ __('Reset Password') }}</h4>
                                @if (session('status'))
                        <div style="color: green;
                        font-size: 18px" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                   
                                    <ul>
            
                                            <li class="row">
            
                                                <div class="col-xs-12">
                                        <label for="email" class="required">{{ __('E-Mail Address') }}</label>
            
                                       
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback text-danger" style="color:#ff4557" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
            
                                    </li>
            

                                    <li class="row">
                                        <div class="col-sm-12">
                                                    <button type="submit" class="button_blue middle_btn">
                                                        {{ __('Send Password Reset Link') }}
                                                    </button>
                    
                                                    
                                                </div>
                                            </li>
                                        </ul>
                                        </form>
                                        
                                    </section>
                    
                                </div><!--/ .table_cell -->
                            </div>
                        </div>
                            </div><!--/ .table_row -->
                    
                    
                        </div><!--/ .table_layout -->
                    
                    </div><!--/ .relative -->
                    
                    </section><!--/ .section_offset -->
                    </div>
                    

{{-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
