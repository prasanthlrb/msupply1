@extends('layout.app')
@section('content')
<style>
        section.section_offset {
            padding: 50px;
        }
    </style>
<div class="secondary_page_wrapper">
    	<div class="container">
        <section class="section_offset">

                

                <div class="relative">
                    <div class="table_layout">

                        <div class="table_row">

                            <div class="row">
                               <div class="col-sm-8">
                            
                            <div class="table_cell">

                                <section>

                                    <h4>Customer Register</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                         <ul>

                                <li class="row">

                                    <div class="col-xs-12">
                            <label for="user_type" class="required">{{ __('Profile Type') }}</label>
                            <select name="user_type" class="form-control {{ $errors->has('user_type') ? ' is-invalid' : '' }}" required>
                                    <option selected="" disabled>select Profile Type</option>
                                    <option value="user">individual Person</option>
                                    <option value="company">Company</option>
                                 
                                  </select>
                                @if ($errors->has('user_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>
                        
                        <li class="row">

                                <div class="col-xs-12">
                        <label for="name" class="required">{{ __('Name') }}</label>

                        
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </li>


                        <li class="row">

                                <div class="col-xs-12">
                            <label for="email" class="required">{{ __('E-Mail Address') }}</label>

                            
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>

                        <li class="row">

                                <div class="col-xs-12">
                            <label for="phone" class="required">{{ __('Phone Number') }}</label>

                            
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>

                        <li class="row">

                                <div class="col-xs-12">
                            <label for="password" class="required">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>

                        <li class="row">

                                <div class="col-xs-12">
                            <label for="password-confirm" class="required">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </li>

                            <li class="row">

                                    <div class="col-xs-12">
    
                                        <div class="on_the_sides">
    
                                            <div class="left_side">
    
                                               
                                            </div>
    
                                            <div class="right_side">
    
                                              
    
                                            </div>
                                           
    
                                        </div>
                                        
                                    </div>
    
                                </li>
                            <li class="row">
    
                                    <div class="col-xs-12">
                                            <div class="on_the_sides">

                                                    <div class="left_side">
                                <button type="submit" class="button_blue middle_btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="">

                                    <a href="/login" >Go to Login</span></a>
        
                                </div>
                            </div>
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

@endsection
