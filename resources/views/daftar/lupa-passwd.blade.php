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
                    <div class="card-header h4">Lupa Password</div>
                    <div class="card-body">
                        <p class="card-text py-2"> 
                            Silakan masukkan alamat email yang terdaftar di akun Anda. Kami akan mengirimkan tautan untuk mereset password ke email Anda.
                        </p>
                        <form action="{{url('lupapasswd-act')}}" method="POST" id="form">
                            @csrf
                            <div data-mdb-input-init class="form-outline"> 
                                <input type="email" placeholder="Email" name="email" class="form-control" />
                                <div class="text text-danger email"></div>
                            </div> 
                            <input type="submit" class="btn btn-outline-primary mt-3" value="Kirim">   
                            <a class="btn btn-outline-secondary mt-3" href="{{url('/')}}">
                                <i class="fas fa-long-arrow-alt-left"></i> Batal<a>
                        </form>  
                    </div>
                </div>

                
            </div>

            <div class="col-sm-3"></div>
        </div>

            
            
    </div>

    <script src="{{asset('vendors')}}/bootstrap5/bootstrap.bundle.min.js"></script>  
    <script src="{{asset('don')}}/js/hr.js"></script>  
  <script>
      const inputs = [ 'email','password' ]   
      $('#form').submit(function(e) { 
            e.preventDefault();
            _cursorWait();
            var action = $(this).attr('action');
            var formData = $(this).serialize();
            _submitFromRedirect(action, formData, inputs);   
      }); 
  </script> 
  </body>
</html>
