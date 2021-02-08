<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital Web App | Doc</title>
    
        <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    
    </head>

<style>
</style>

<body style="background-color:blue">
    <div class="container">
        <div class="card">
            <div class="card-header">
                PATIENT API ENDPOINTS
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Register EndPoint
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter:  <pre>
            'name',
            'email',
            'password',
            'dob',
            role = Patient,
            'address',
            'phone',</pre>  <br>
                        endpoint: /api/register <br>
                        Users: Guest.
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Get Patient
                    </div>
                    <div class="card-body">
                        Method: Get <br>
                        Parameter: null <br>
                        endpoint: api/patient/ <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Login EndPoint
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: email, username <br>
                        endpoint: /api/patient/login <br>
                        Users: Guest.
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Logout EndPoint
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: null <br>
                        endpoint: /api/patient/logout <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Show AppointMents (Current Patient Booked Appointment and All Doctors Appointment)
                    </div>
                    <div class="card-body">
                        Method: Get <br>
                        Parameter: null <br>
                        endpoint: api/patient/appointment <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Book AppointMent (User can only Book appointments that has been created by doctors)
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: id (Appointment Id from appointment Table) <br>
                        endpoint: api/patient/appointment/{id} <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Cancel Appointment
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: id (Appointment Id from appointment Table) <br>
                        endpoint: api/patient/appointment/delete/{id} <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-header">
                DOCTOR API ENDPOINTS
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Register EndPoint
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter:  <pre>
        'name',
        'email',
        'password',
        'dob',
        role = Doctor,
        'address',
        'phone',</pre>
                        endpoint: /api/register <br>
                        Users: Guest.
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Login EndPoint
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: email, username <br>
                        endpoint: /api/doctor/login <br>
                        Users: Guest.
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Logout EndPoint
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: null <br>
                        endpoint: /api/doctor/logout <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Get Doctor
                    </div>
                    <div class="card-body">
                        Method: Get <br>
                        Parameter: null <br>
                        endpoint: api/doctor/ <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Create AppointMents
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: <pre>{max : The number of patient that a doctor want to attend to for a time slot, e.g 5,  appointment: Time slot (4:30PM - 5:00PM)}</pre> <br>
                        endpoint: api/doctor/appointment/save <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5" style="width:100%">
            <div class="col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Delete Appointment
                    </div>
                    <div class="card-body">
                        Method: Post <br>
                        Parameter: id (Appointment Id from appointment Table) <br>
                        endpoint: api/doctor/appointment/delete/{id} <br>
                        Users: Auth
                    </div>
                </div>
            </div>
        </div>
    </div>
        
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>  
  
</body>
</html>