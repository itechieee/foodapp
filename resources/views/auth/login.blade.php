@extends('layouts.admin')
@section('content')

  <!-- login area start -->
  <div class="login-area">
        <div class="container">
            <div class="login-box ptb--50">
                <form method="POST" action="{{ url('/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="login-form-head">
                     <img src="{{ url('/').'/assets/admin/images/logo_login.png' }}"/>
                        
                    </div>
                    <div class="login-form-body">
                            <div class="row">
                                    <div class="col-12">
                                       <h4>Welcome to Login</h4> 
                                    </div>
                                </div>      
                        @include('flash-message')              
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" id="exampleInputEmail1" required>
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" id="exampleInputPassword1" required>
                            <i class="ti-lock"></i>
                        </div>
                     
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                            
                        </div>
                      
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

@endsection