<!doctype html>
<html lang="en">
  <head>
    <title>Registration!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <div class="container text-right">
       <h2 class="text-container"> ERP.</h2>
       <h3 class="text-container">The first step to ace in your business.</h3>
    </div>
  </head>
  <body>

   <form action="{{url('/')}}/signup" method="post">
    @csrf
    
    <div class="container text-center">
        <h1 class="text-container ">Get Started</h1>
        <h4 class="text-container">Already have an account? <a href="{{url('/')}}/login">Log in</a></h4>
    <label for="">Name:</label>
    <input type="text" id="name" name="name" value="{{old('name')}}">
    <span class="text-danger">
      @error('name')
        {{$message}}
      @enderror  
    </span><br>

    <label for="">E-mail:</label>
    <input type="email" id="email" name="email" value="{{old('email')}}">
    <span class="text-danger">
      @error('email')
        {{$message}}
      @enderror  
    </span><br>

    <label for="">Phone No.:</label>
    <input type="tel" id="phone" name="phone" value="{{old('phone')}}" >
    <span class="text-danger">
      @error('phone')
        {{$message}}
      @enderror  
    </span><br>

    <label for="">Password:</label>
    <input type="password" id="password" name="password">
    <span class="text-danger">
      @error('password')
        {{$message}}
      @enderror  
    </span><br>

    <label for="">Confirm Paasword:</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
    <span class="text-danger">
      @error('password_confirmation')
        {{$message}}
      @enderror  
    </span><br>

    <button class="btn btn-primary">Sign Up</button>
    <hr>
    
   </form>

   or Sign Up with
    <img src="https://icons8.com/icon/17949/google" alt="google-signup">
    <img src="https://icons8.com/icon/30840/apple-logo" alt="apple-signup">

    </div>
    
    </body>
</html>