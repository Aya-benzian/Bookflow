<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Livre;
use App\Models\Emprunt;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Needed for password, but we are not changing password here.
use Carbon\Carbon; // Import Carbon for date comparisons

class AdminController extends Controller
{
    /**
     * Display a listing of the resources (Admin Dashboard).
     */
    public function index()
    {
        $usersCount = User::count();
        $livresCount = Livre::count();
        $empruntsCount = Emprunt::count(); // Represents currently borrowed books, as records are deleted on return
        $reservationsCount = Reservation::count();
        $overdueEmpruntsCount = Emprunt::where('date_retour_prevue', '<', Carbon::today())->count();

        return view('admin.dashboard', compact('usersCount', 'livresCount', 'empruntsCount', 'reservationsCount', 'overdueEmpruntsCount'));
    }

    /**
     * Display a listing of users.
     */
    public function users(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('prenom', 'like', '%' . $search . '%');
        }

        $users = $query->get();
        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return Redirect::route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroyUser(User $user)
    {
        if ($user->emprunts()->exists() || $user->reservations()->exists()) {
            return Redirect::route('admin.users.index')->with('error', 'Cannot delete user with active loans or reservations.');
        }

        $user->delete();

        return Redirect::route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return Redirect::route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display a listing of all books (for admin).
     */
    public function livres()
    {
        $livres = Livre::all();
        return view('admin.livres.index', compact('livres'));
    }

    /**
     * Display a listing of all loans (for admin).
     */
    public function emprunts()
    {
        $emprunts = Emprunt::all();
        return view('admin.emprunts.index', compact('emprunts'));
    }

    /**
     * Display a listing of all reservations (for admin).
     */
    public function reservations()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new loan.
     */
    public function createEmprunt()
    {
        $users = User::all();
        $livres = Livre::where('statut', 'disponible')->get(); // Only show available books
        return view('admin.emprunts.create', compact('users', 'livres'));
    }

    /**
     * Store a newly created loan in storage.
     */
    public function storeEmprunt(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livre_id' => 'required|exists:livres,id',
        ]);

        $livre = Livre::findOrFail($request->livre_id);

        if ($livre->statut !== 'disponible') {
            return Redirect::back()->with('error', 'The selected book is not available for borrowing.');
        }

        Emprunt::create([
            'user_id' => $request->user_id,
            'livre_id' => $livre->id,
            'date_emprunt' => now(),
            'date_retour_prevue' => now()->addDays(14),
        ]);

        $livre->update(['statut' => 'emprunté']);

        return Redirect::route('admin.emprunts.index')->with('success', 'Loan created successfully.');
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function createReservation()
    {
        $users = User::all();
        // Books that are not currently borrowed
        $livres = Livre::where('statut', 'disponible')
                        ->orWhere('statut', 'reservé') // Can reserve a reserved book, but it will only mark it as 'reserved' once
                        ->get();
        return view('admin.reservations.create', compact('users', 'livres'));
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function storeReservation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livre_id' => 'required|exists:livres,id',
        ]);

        $livre = Livre::findOrFail($request->livre_id);

        // Prevent reserving if already borrowed
        if ($livre->statut === 'emprunté') {
            return Redirect::back()->with('error', 'This book is currently borrowed and cannot be reserved.');
        }

        // Prevent multiple reservations for the same user on the same book
        if ($livre->reservations()->where('user_id', $request->user_id)->exists()) {
            return Redirect::back()->with('error', 'This user already has an active reservation for this book.');
        }

        Reservation::create([
            'user_id' => $request->user_id,
            'livre_id' => $livre->id,
            'date_reservation' => now(),
        ]);

        // If the book was available, change its status to 'reservé'
        if ($livre->statut === 'disponible') {
            $livre->update(['statut' => 'reservé']);
        }

        return Redirect::route('admin.reservations.index')->with('success', 'Reservation created successfully.');
    }
}
