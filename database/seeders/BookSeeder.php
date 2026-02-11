<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livre; // Ensure your model name is correct (Livre or Book)

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['titre' => 'Les Nuits blanches', 'auteur' => 'Fiodor Dostoïevski', 'genre' => 'Roman', 'statut' => 'disponible'],
            ['titre' => 'La Métamorphose', 'auteur' => 'Franz Kafka', 'genre' => 'Nouvelle', 'statut' => 'disponible'],
            ['titre' => 'Le Procès', 'auteur' => 'Franz Kafka', 'genre' => 'Philosophie', 'statut' => 'disponible'],
            ['titre' => 'Crime et Châtiment', 'auteur' => 'Fiodor Dostoïevski', 'genre' => 'Psychologique', 'statut' => 'disponible'],
            ['titre' => 'L\'Étranger', 'auteur' => 'Albert Camus', 'genre' => 'Absurde', 'statut' => 'disponible'],
            ['titre' => '1984', 'auteur' => 'George Orwell', 'genre' => 'Dystopie', 'statut' => 'disponible'],
            ['titre' => 'Le Petit Prince', 'auteur' => 'Antoine de Saint-Exupéry', 'genre' => 'Conte', 'statut' => 'disponible'],
            ['titre' => 'L\'Alchimiste', 'auteur' => 'Paulo Coelho', 'genre' => 'Aventure', 'statut' => 'disponible'],
            ['titre' => 'Les Misérables', 'auteur' => 'Victor Hugo', 'genre' => 'Classique', 'statut' => 'disponible'],
            ['titre' => 'Le Rouge et le Noir', 'auteur' => 'Stendhal', 'genre' => 'Réalisme', 'statut' => 'disponible'],
            ['titre' => 'Madame Bovary', 'auteur' => 'Gustave Flaubert', 'genre' => 'Réalisme', 'statut' => 'disponible'],
            ['titre' => 'Une saison en enfer', 'auteur' => 'Arthur Rimbaud', 'genre' => 'Poésie', 'statut' => 'disponible'],
            ['titre' => 'Gatsby le Magnifique', 'auteur' => 'F. Scott Fitzgerald', 'genre' => 'Drame', 'statut' => 'disponible'],
            ['titre' => 'Cent ans de solitude', 'auteur' => 'Gabriel García Márquez', 'genre' => 'Réalisme magique', 'statut' => 'disponible'],
            ['titre' => 'Sapiens', 'auteur' => 'Yuval Noah Harari', 'genre' => 'Histoire', 'statut' => 'disponible'],
            ['titre' => 'Le Joueur', 'auteur' => 'Fiodor Dostoïevski', 'genre' => 'Roman', 'statut' => 'disponible'],
            ['titre' => 'Lettre à son père', 'auteur' => 'Franz Kafka', 'genre' => 'Autobiographie', 'statut' => 'disponible'],
            ['titre' => 'Le Vieil Homme et la Mer', 'auteur' => 'Ernest Hemingway', 'genre' => 'Aventure', 'statut' => 'disponible'],
            ['titre' => 'Bel-Ami', 'auteur' => 'Guy de Maupassant', 'genre' => 'Réalisme', 'statut' => 'disponible'],
            ['titre' => 'Fahrenheit 451', 'auteur' => 'Ray Bradbury', 'genre' => 'Dystopie', 'statut' => 'disponible'],
        ];

        foreach ($books as $book) {
            Livre::create($book);
        }
    }
}