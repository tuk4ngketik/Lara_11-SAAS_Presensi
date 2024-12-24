<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    
    
    <script src="{{asset('plugins')}}/jquery-3.7.1.min.js"></script>
    <script src="{{asset('vendors')}}/sweetalerts2/sweetalert2.all.min.js"></script>  
     
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('lte')}}/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins')}}/fontawesome-free/css/all.min.css">
    
    <!-- vendor --> 
    <link href="{{asset('vendors')}}/bootstrap5/bootstrap.min.css" rel="stylesheet" >  
    <link href="{{asset('vendors')}}/datatables/datatables.min.css" rel="stylesheet" >  
    <link href="{{asset('vendors')}}/sweetalerts2/sweetalert2.min.css" rel="stylesheet" > 
</head>
  <body>

    <div class="container">
        <div class="p-10"></div>

        <div class="row">
            <div class="col-sm-3"></div>

            <div class="col-sm-6"> <br><br><br><br>
                
                <div class="card">
                    <div class="card-header h4 text-center">Permintaan Lupa password</div>
                    <div class="card-body"> 
                        <p class="fs-5">Silahkan cek email Anda <i class="far fa-envelope  fa-lg  text-warning fs-5 m-3"></i></p>
                         
                        <div  class="p-3 border border-warning rounded"> 
                            <div class="float-start"><i class="far fa-lightbulb  fa-lg  text-warning fs-1 m-3"></i> </div>
                            <div>                            
                                Periksa folder spam atau kotak masuk lainnya jika Anda tidak menerima 
                                email dalam beberapa menit setelah meminta reset password.
                            </div>  
                        </div>
                     
                        <div class="d-grid gap-2">
                                <a class="btn btn-outline-secondary mt-3" href="{{url('login')}}"><i class="fas fa-sign-in-alt"></i> Login</a>  
                        </div>  
                </div>

                
            </div>

            <div class="col-sm-3"></div>
        </div>

            
            
    </div>
 
  </body>
</html>
