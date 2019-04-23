<!-- login area start -->
<div class="login-area">
        <div class="container">
            <div class="login-box ptb--50">
                    <div class="login-form-head">
                        <img src="{{ url('/').'/assets/admin/images/logo_login.png' }}"/>  
                        
                        
                        @if(Auth::User()->role_id == 1)
                            <div class="row pad20">
                                <h1>Welcome Admin User</h1>
                            </div>
                            <div>
                                <a href="{{ url('/admin') }}"> Dashboard </a>
                            </div>                            
                        @else
                            <div class="row pad20">
                                <h1>Welcome Restaurant User</h1>  
                            </div>
                            <div>
                                <a href="{{ url('/restaurant') }}"> Dashboard </a>
                            </div>
                            
                        @endif
                        

                    </div>       
                    
                    
            </div>
            
        </div>
    </div>
    <!-- login area end -->