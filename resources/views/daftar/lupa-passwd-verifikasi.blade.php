<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    
    
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
                    <div class="card-header text-center h4">Reset Password</div>
                    <div class="card-body">
                      <h6>Masukkan password baru</h6>
                        <form action="{{url('resetpassword-act')}}" method="POST" id="form">
                            @csrf
                            <input type="hidden" name="email" value="{{$data->email}}">
                            <div data-mdb-input-init class="form-outline mb-2"> 
                                <input type="password" placeholder="Password" name="password" class="form-control" />
                                <div class="text text-danger password"></div>
                            </div>
                            <div data-mdb-input-init class="form-outline"> 
                                <input type="password" placeholder="Konfirmasi password " name="konfirmasi" class="form-control" />
                                <div class="text text-danger konfirmasi"></div>
                            </div>
                            <input type="submit" class="btn btn-outline-primary mt-3" value="Reset password"> 
                            <a class="btn btn-outline-secondary mt-3" href="{{url('/')}}"><i class="fas fa-long-arrow-alt-left"></i> Batal<a> 
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
      const inputs = [ 'konfirmasi','password' ]   
      $('#form').submit(function(e) { 
            e.preventDefault();
            _cursorWait();
            var action = $(this).attr('action');
            var formData = $(this).serialize();
            _submitFrom(action, formData, '{{url("/")}}', inputs);   
      }); 
  </script> 
  </body>
</html>
