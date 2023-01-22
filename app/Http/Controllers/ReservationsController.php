<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    public function index() {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    public function create() {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $formValues = $request->validate([
            'offer_id' => 'required',
            'traveler_name' => 'required',
            'traveler_surname' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'payment' => 'required',
            'num_of_travelers' => 'required',
            'comment' => 'required',
        ]);
        $formValues['offer_id'] = $offer_id;
        Reservation::create($formValues);

        return redirect("/home");//->with('message', 'Listing created successfully!');
    }
}