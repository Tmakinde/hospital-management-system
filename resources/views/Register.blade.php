<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hospital|Register</title>
  <link rel="stylesheet" href="{{ url('css/bootstrap.min.css')}}">
</head>

<style>
  .form-signup {
    max-width: 600px;
    border: 1px solid grey;
    border-radius: 20px;
    background-color:whitesmoke;
  }
</style>

<body style="background-color:blue">
  <div class="">
    <div class="row" style="width:100%">
      <div class="col-md-6 col-sm-6" style="margin-bottom:-255px">
        <img class="mediabox-img lazyload" src="{{asset('/img/img3.jpg')}}" width="100%" style="height:100%">
      </div>
      <div class="col-md-6 col-sm-6" style="margin-bottom:-255px">
      <form class="p-3 mx-auto" style="width:100%" action = "{{route('register')}}" method = "post">
      
        
      <h1 class="h3 mb-3 font-weight-normal">Registration</h1>
      @csrf
        @if ($errors->any())
            <ul id="errors">
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
         @endforeach 
            </ul>
        @endif

      <label for="inputFirstName" class="mt-2">Name</label>
      <input type="text" name="name" class="form-control" placeholder="First Name"  autofocus>

      <label for="inputEmail" class="mt-2">Email</label>
      <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelpId"
        placeholder="Email"  autofocus>

      <label for="inputPassword" class="mt-2">Password</label>
      <input type="password" id="inputPassword" class="form-control" name = 'password' placeholder="Password" >

      <label for="inputFirstName" class="mt-2">Phone Number</label>
      <input type="text" class="form-control" name = 'phone' placeholder="Phone Number"  autofocus>

      <label for="inputFirstName" class="mt-2">Date Of Birth</label>
      <input type="date" class="form-control" name = 'dob' placeholder="Date Of Birth" autofocus>

      <label for="inputFirstName" class="mt-2">Role</label><br>
      <select name="role">
        <option >Doctor</option>
        <option>Patient</option>
        </select><br>
      <label for="inputFirstName" class="mt-2">Address</label>
      <input type="text" class="form-control" name = 'address' placeholder="Address" autofocus>
      <div class="checkbox mb-2">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      
       <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
       <span class="" style="float:right;"><a href = "{{route('doctorlogin.show')}}"><b style="color:black">Login As a Doctor</b></a></span>
      <p class="mt-1 mb-3 text-muted">@hospital &copy; 2020</p>
    </form>
      </div>
    
  </div>
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>