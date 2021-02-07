@extends('Patient.layouts.master')

@section('title')
Hospital Web App  | All Appointments
@endsection

@section('content')
<div class="container" style="padding-top:100px;">
    <div class="row" style="width:100%;">
        <div class="col-md-4 col-xl-4 col-sm-4">
            @if($appointment != null)
            <div class="card mb-5" style="width:100%">
                <div class="card-header">
                    My Appointment
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$appointment->appointment}}</li>
                    <form action="{{route('patient.appointment.delete',$appointment->id)}}}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-warning" style="width:100%;" value="Click Here To Cancel">
                    </form>
                </ul>
            </div>
            @endif
            @if($appointment == null)
            <div class="card-header" style="float:center;border-radius:30px">
                <span class="text-info">Oh! You have not book appointment available at the moment</span>
            </div>
            @endif

        </div>
        <div class="col-md-8 col-xl-8 col-sm-8">
            <div class="card">
                @if($message = Session::get('message'))
                    <span class="alert alert-info">{{$message}}</span>
                @endif
                <div class="card-header" style="float:center;width:100%;">
                    <span class="text-info;">Available Appointments</span>
                </div>
            </div>

            @foreach($availableAppointments as $availableAppointment)
            <div class="card mt-5 mb-5">
                <div class="card-header" style="float:center;width:100%;">
                    <span class="text-info;">Doctor <span style="color:red">{{Ucwords($availableAppointment->doctors->name)}}</span> has an available Appointment</span><br>
                </div>
                <div class="card-body" style="float:center;width:100%;">
                    <span>Time: {{$availableAppointment->appointment}}</span><br>
                    <form action="{{route('patient.appointment.save', $availableAppointment->id)}}" method="post">
                        @csrf
                        <input style="margin-top:10px" type="submit" value="Claim Appointment" class="btn btn-success">
                    </form>
                </div>
            </div>
            @endforeach
        </div>



    </div>
</div>

@endsection

@section('script')

@parent

@endsection