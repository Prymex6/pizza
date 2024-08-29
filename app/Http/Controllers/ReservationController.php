<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::paginate(20);

        return view('reservation.index', ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Reservation::create($request->all());

        if (in_array(session('previous_route'), ['home.index', 'home.reservation'])) {
            return redirect()->route('home.index')->with('success', 'Stolik został zarezerwowany!');
        }

        return redirect()->route('reservation.index')->with('success', 'Rezerwacja została dodana!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        return view('reservation.edit', ['reservation' => $reservation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->all());

        return redirect()->route('reservation.index')->with('success', 'Rezerwacja została zmodyfikowana!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservation.index')->with('success', 'Rezerwacja została usunięta!');
    }

    public function status(Request $request, Reservation $reservation)
    {
        $reservation->status = $request->input('status');

        $reservation->save();

        return redirect()->back()->with('success', 'Status został zmieniony');
    }
}
