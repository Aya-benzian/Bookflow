<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprunts = Emprunt::where('user_id', Auth::id())->paginate(10);
        return view('emprunts.index', compact('emprunts'));
    }

    /**
     * Store a newly created resource in storage (borrowing a book).
     */
    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
        ]);

        $livre = Livre::findOrFail($request->livre_id);
        $user = Auth::user();

        // Check if the book is available or reserved by the current user
        if ($livre->statut === 'emprunté') {
            return Redirect::back()->with('error', 'This book is currently borrowed by someone else.');
        }

        if ($livre->statut === 'reservé') {
            // Check if the book is reserved by the current user
            $reservation = $livre->reservations()->where('user_id', $user->id)->first();
            if (!$reservation) {
                return Redirect::back()->with('error', 'This book is reserved by another user.');
            }
            // If reserved by current user, proceed and remove reservation
            $reservation->delete();
        }

        // Create the loan record
        Emprunt::create([
            'user_id' => $user->id,
            'livre_id' => $livre->id,
            'date_emprunt' => now(),
            'date_retour_prevue' => now()->addDays(14), // Set due date to 14 days from now
        ]);

        // Update book status
        $livre->update(['statut' => 'emprunté']);

        return Redirect::back()->with('success', 'Book borrowed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Emprunt $emprunt)
    {
        return view('emprunts.show', compact('emprunt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emprunt $emprunt)
    {
        // Not typically used for loans, but included for resource controller
        return view('emprunts.edit', compact('emprunt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emprunt $emprunt)
    {
        // Not typically used for loans, but included for resource controller
        return Redirect::back()->with('error', 'Loan records should not be updated directly.');
    }

    /**
     * Remove the specified resource from storage (should not be used for returning a book).
     */
    public function destroy(Emprunt $emprunt)
    {
        // This method is for deleting the loan record itself, not for returning a book.
        // Returning a book has its own specific logic.
        return Redirect::back()->with('error', 'Direct deletion of loan records is not allowed. Use the return book functionality.');
    }

    /**
     * Handle the returning of a borrowed book.
     */
    public function returnBook(Emprunt $emprunt)
    {
        // Check if the emprunt exists and is associated with a borrowed book
        if ($emprunt->livre->statut !== 'emprunté') {
            return Redirect::back()->with('error', 'This book is not currently borrowed.');
        }

        // Update book status to 'disponible'
        $emprunt->livre->update(['statut' => 'disponible']);

        // Delete the emprunt record
        $emprunt->delete();

        return Redirect::back()->with('success', 'Book returned successfully!');
    }
}
