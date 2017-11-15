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
        <form>
            <div class="form-group">
                <label for="email">Step 1: Pick a date</label>
                <input type="date" class="form-control" name="input-date" id="input-date">
            </div>
            <div class="form-group hidden">
                <label for="time">Step 2: Pick a time</label>
                 <input list="time" class="form-control">
                  <datalist id="time">
                    <option value="Internet Explorer">
                    <option value="Firefox">
                    <option value="Chrome">
                    <option value="Opera">
                    <option value="Safari">
                </datalist>
            </div>
            <button type="submit" class="btn btn-success">Book</button>
        </form>
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
                <td>EDIT CANCEL</td>
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