<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $borrowedBooksCount = $user->emprunts()->count();
        $reservedBooksCount = $user->reservations()->count();
        $overdueBooksCount = $user->emprunts()->where('date_retour_prevue', '<', Carbon::today())->count();

        // Optionally, fetch some recent borrowed/reserved books for a list view
        $recentBorrowed = $user->emprunts()->with('livre')->latest()->take(3)->get();
        $recentReserved = $user->reservations()->with('livre')->latest()->take(3)->get();







        return view('dashboard', compact(
            'borrowedBooksCount',
            'reservedBooksCount',
            'overdueBooksCount',
            'recentBorrowed',
            'recentReserved'
        ));
    }
}
