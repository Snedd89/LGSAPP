<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Booking;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return view("bookings.index")->with("bookings", $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'input-date' => 'required',
            'input-time' => 'required'
        ]);

        // Create Booking
        $booking = new Booking;
        $booking->date = $request->input('input-date');
        $booking->time = $request->input('input-time');
        $booking->save();

        return redirect('/')->with('success', 'Gym Slot Booked!');
    }

    // Check slots available
    public function check($dateSelection)
    {
        //$weekdaySlots = array(7,8,9,10,11,12,13,14,15,16,17,18,19,20);
        //$weekendSlots = array(10,11,12,13,14,15);
        $slots = DB::table('bookings')
                ->select(DB::raw('count(*) as booked, time'))
                ->where('date', '=', $dateSelection)
                ->groupBy('time')
                ->get();
         // Check if date is a weekend
         $weekendDay = false;
         $day = date("D", strtotime($dateSelection));
         if($day == 'Sat' || $day == 'Sun') {
         $weekendDay = true;
         }

         $availableSlots = array();
         $fullyBooked = array();
         if($weekendDay) {
             // Weekend
             // Iterate through each booked slot
             foreach($slots as $slot) {
                $time = $slot->time;
                $booked = $slot->booked;
                if($booked < 2) {
                    array_push($availableSlots, $time);
                } else {
                    array_push($fullyBooked, $time);
                }
             }
             // Fill up array with empty slots
             for ($i=10; $i <= 15; $i++) {
                if((!in_array($i, $availableSlots, true)) && !in_array($i, $fullyBooked, true)){
                    array_push($availableSlots, $i);
                }
            }
         } else {
             // Weekday
             // Iterate through each booked slot
             foreach($slots as $slot) {
                $time = $slot->time;
                $booked = $slot->booked;
                if($booked < 2) {
                    array_push($availableSlots, $time);
                } else {
                    array_push($fullyBooked, $time);
                }
             }
             // Fill up array with empty slots
             for ($i=7; $i <= 20; $i++) {
                if((!in_array($i, $availableSlots, true)) && !in_array($i, $fullyBooked, true)){
                    array_push($availableSlots, $i);
                }
            }
            }
            sort($availableSlots);
            return $availableSlots;
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return redirect('/')->with('success', 'Gym Slot Cancelled');
    }
}
