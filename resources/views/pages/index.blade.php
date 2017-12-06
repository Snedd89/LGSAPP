@extends('layouts.app')

@section('content')
   <div class="jumbotron text-center">
        <h1>Welcome to Laravel!</h1>
        <p>This is the Gym Slots Application</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
   </div>
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
            <h3>Bookings</h3>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Control</th>
      </tr>
    </thead>
    <tbody>
    @if(count($bookings) > 0)
        @foreach($bookings as $booking)
            <tr>
                <td>{{$booking->date}}</td>
                <td>{{$booking->time}}:00</td>
                <td>
                    {!!Form::open(['action' => ['BookingsController@destroy', $booking->id], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Cancel', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                </td>
            </tr>
        @endforeach
    @else
        <p>No bookings found</p>
    @endif
        </tbody>
  </table>
    </div>
   </div>
@endsection