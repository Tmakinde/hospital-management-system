<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alakada || Register</title>
  <link rel="stylesheet" href="{{ url('css/register/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('css/register/css/css/all.css')}}">
</head>

<style>
  .form-signup {
    max-width: 600px;
    border: 1px solid grey;
    border-radius: 20px;
    background-color:whitesmoke;
  }
</style>

<body>
  <div class="container p-3  mx-auto">
    <form class="form-signup p-3 mx-auto" action = "{{route('register')}}" method = "post">
      
        
      <h1 class="h3 mb-3 font-weight-normal">Registration</h1>
      @csrf
        @if ($errors->any())
            <ul id="errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
         @endforeach 
            </ul>
        @endif

      <label for="inputFirstName" class="P-0">Name</label>
      <input type="text" name="name" class="form-control" placeholder="First Name"  autofocus>

      <label for="inputEmail" class="mt-4">Email</label>
      <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelpId"
        placeholder="Email"  autofocus>

      <label for="inputPassword" class="mt-4">Password</label>
      <input type="password" id="inputPassword" class="form-control" name = 'password' placeholder="Password" >

      <label for="inputFirstName" class="P-0">Phone Number</label>
      <input type="text" class="form-control" name = 'phone' placeholder="Phone Number"  autofocus>

      <label for="inputFirstName" class="P-0">Date Of Birth</label>
      <input type="date" class="form-control" name = 'dob' placeholder="Date Of Birth" autofocus>

      <label for="inputFirstName" class="P-0">Role</label>
      <select name="role">
        <option >Doctor</option>
        <option>Patient</option>
        </select>
      <label for="inputFirstName" class="P-0">Address</label>
      <input type="text" class="form-control" name = 'address' placeholder="Address" autofocus>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      
       <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      <p class="mt-5 mb-3 text-muted">Laurel &copy; 2020</p>
    </form>
  </div>
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>