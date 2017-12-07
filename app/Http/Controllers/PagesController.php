<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to Laravel!!??";
        $bookings = Booking::orderBy("date", "asc")->get();
        $data = array(
            "title" => $title,
        );
        return view("pages.index")->with($data);
    }

    public function about(){
        $title = "About this app";
        return view("pages.about")->with("title", $title);
    }

    public function services(){
        $data = array(
            "title" => "Services",
            "services" => ["Web Design", "Programming", "SEO"]
        );
        return view("pages.services")->with($data);
    }
}
