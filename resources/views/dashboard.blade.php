@extends('layouts.app')

@section('content')
@if(Auth::guest())
   <div class="jumbotron text-center">
        <h1>Welcome to Laravel!</h1>
        <p>This is the Gym Slots Application</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
   </div>
   @endif
   @if(!Auth::guest())
   <div class="row">
    <div class="col-md-6">
        <h3>Book a Gym Slot</h3>
        {!! Form::open(['action' => 'BookingsController@store', 'method'=> 'POST']) !!}
        <div class="form-group">
            {{Form::label('input-date', 'Step 1: Pick a date')}}
            {{Form::date('input-date', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control'])}}
        </div>
        {{Form::label('input-time', 'Step 2: Pick a time')}}
        {{Form::select('input-time', [], null, ['class' => 'form-control', 'placeholder' => 'Pick a time...'])}}
        <br />
        {{Form::submit('Book', ['class' => 'form-control btn btn-success'])}}
        {!! Form::close() !!}
    </div>
    <div class="col-md-6">
            <h3>Your Booked Slots</h3>
    @if(count($bookings) > 0)
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Control</th>
      </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td>{{$booking->date}}</td>
                @if ($booking->time < 10)
                <td>0{{$booking->time}}:00</td>
                @else
                <td>{{$booking->time}}:00</td>
                @endif
                <td>
                    {!!Form::open(['action' => ['BookingsController@destroy', $booking->id], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Cancel', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                </td>
            </tr>
        @endforeach
    @else
        <p>You have no gym slots booked.</p>
    @endif
        </tbody>
  </table>
    </div>
   </div>
   @endif
@endsection
