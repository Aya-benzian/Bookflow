<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->paginate(10);
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Store a newly created resource in storage (reserving a book).
     */
    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
        ]);

        $livre = Livre::findOrFail($request->livre_id);
        $user = Auth::user();

        // Check if the book is available
        if ($livre->statut !== 'disponible') {
            return Redirect::back()->with('error', 'This book is not available for reservation.');
        }

        // Check if the user already has an active reservation for this book
        if ($livre->reservations()->where('user_id', $user->id)->exists()) {
            return Redirect::back()->with('error', 'You have already reserved this book.');
        }

        // Create the reservation record
        Reservation::create([
            'user_id' => $user->id,
            'livre_id' => $livre->id,
            'date_reservation' => now(),
        ]);

        // Update book status
        $livre->update(['statut' => 'reservé']);

        return Redirect::back()->with('success', 'Book reserved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        // Not typically used for reservations, but included for resource controller
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Not typically used for reservations, but included for resource controller
        return Redirect::back()->with('error', 'Reservation records should not be updated directly.');
    }

    /**
     * Remove the specified resource from storage (should not be used for canceling a reservation).
     */
    public function destroy(Reservation $reservation)
    {
        // This method is for deleting the reservation record itself, not for canceling a reservation.
        // Cancelling a reservation has its own specific logic.
        return Redirect::back()->with('error', 'Direct deletion of reservation records is not allowed. Use the cancel reservation functionality.');
    }

    /**
     * Handle the cancellation of a reservation.
     */
    public function cancelReservation(Reservation $reservation)
    {
        // Check if the reservation exists and is for a reserved book
        if ($reservation->livre->statut !== 'reservé') {
            return Redirect::back()->with('error', 'This book is not currently reserved.');
        }

        // Update book status to 'disponible'
        $reservation->livre->update(['statut' => 'disponible']);

        // Delete the reservation record
        $reservation->delete();

        return Redirect::back()->with('success', 'Reservation cancelled successfully!');
    }
}
