@extends("layouts.app")

@section("content")
    <h1>Bookings</h1>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
    @if(count($bookings) > 0)
        @foreach($bookings as $booking)
            <tr>
                <td>{{$booking->date}}</td>
                <td>{{$booking->time}}:00</td>
            </tr>
        @endforeach
    @else
        <p>No bookings found</p>
    @endif
        </tbody>
    </table>
@endsection