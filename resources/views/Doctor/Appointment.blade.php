@extends('Doctor.layouts.master')

@section('title')
Hospital Web App  | All Appointments
@endsection

@section('content')
<div class="container" style="padding-top:100px;">
    <div class="row" style="width:100%;">
        @php
        $i = 1;
        @endphp
        <div class="col-md-4 col-xl-4 col-sm-4">
            @forelse($appointments as $appointment)
            <div class="card mb-5" style="width:100%">
                <div class="card-header">
                    Appointment {{$i}}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$appointment->appointment}}</li>
                    <form action="{{route('doctor.appointment.delete',$appointment->id)}}}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-warning" style="width:100%;" value="Click Here To Cancel">
                    </form>
                </ul>
            </div>
            <span style="display:none">{{$i++}}</span>
            @empty
            <div class="card-header" style="float:center;border-radius:30px">
                <span class="text-info">Oh! You have no appointment available at the moment</span>
            </div>
            @endforelse

        </div>
        <div class="col-md-4 col-xl-4 col-sm-4">
        </div>
        <div class="col-md-4 col-xl-4 col-sm-4">
        <form action="{{route('doctor.appointment.save')}}" method="post">
            @csrf
            <div class="card">
                @if($message = Session::get('message'))
                    <span class="alert alert-info">{{$message}}</span>
                @endif
                <div class="card-header" style="float:center;width:100%;">
                    <span class="text-info;">Appointment ! ! ! </span>
                </div>
                <div class="card-body">
                    <span class="text-info;">Assign Your Appointment Here For Patient</span>
                </div>
            </div>
            <div class="form-group">

                <select class="form-control" name="appointment" style="margin-top:50px">
                <option selected>9:30AM</option>
                <option>10:00AM</option>
                <option>10:30AM</option>
                <option>11:00AM</option>
                <option>11:30AM</option>
                <option>12:00PM</option>
                <option>12:30PM</option>
                <option>01:00PM</option>
                <option>01:30PM</option>
                <option>02:00PM</option>
                <option>02:30PM</option>
                <option>03:00PM</option>
                <option>03:30PM</option>
                <option>04:00PM</option>
                <option>04:30PM</option>
                <option>05:00PM</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Submit Appointment</button>
        </form>
        </div>



    </div>
</div>


@endsection

@section('script')

@parent

@endsection