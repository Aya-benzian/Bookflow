<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LivreController extends Controller
{
    public function index(Request $request)
    {
        $query = Livre::query();

        if ($search = $request->input('search')) {
            $query->where('titre', 'like', '%' . $search . '%')
                  ->orWhere('auteur', 'like', '%' . $search . '%');
        }

        $livres = $query->paginate(12);

        return view('livres.index', compact('livres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:disponible,emprunté,reservé',
        ]);

        Livre::create($request->all());

        return Redirect::route('livres.index')->with('success', 'Livre created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livre $livre)
    {
        return view('livres.edit', compact('livre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:disponible,emprunté,reservé',
        ]);

        $livre->update($request->all());

        return Redirect::route('livres.index')->with('success', 'Livre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        if ($livre->emprunts()->exists() || $livre->reservations()->exists()) {
            return Redirect::route('livres.index')->with('error', 'Cannot delete livre with active emprunts or reservations.');
        }

        $livre->delete();

        return Redirect::route('livres.index')->with('success', 'Livre deleted successfully.');
    }
}
