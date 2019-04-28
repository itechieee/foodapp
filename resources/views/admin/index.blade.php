@extends('layouts.admin')
@section('content')




  <!-- login area start -->
  <div class="login-area">
        <div class="container">
            <div class="login-box ptb--50">
                <div class="login-form-head">
                    <img src="{{ url('/').'/assets/admin/images/logo_login.png' }}"/>  
                    
                    <div class="row pad20">
                        <h1>Welcome to Admin Dashboard</h1>                              
                    </div>
                    <div>
                        <a href="{{ url('/').'/auth/logout' }}" >Logout</a>        
                    </div>
                </div>     
            </div>
            
        </div>
    </div>
    <!-- login area end -->
    
@endsection

@section('view-styles')
<style>
    .pad20{padding:20px}
</style>
@endsection