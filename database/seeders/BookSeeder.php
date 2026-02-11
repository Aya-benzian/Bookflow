<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livre; // Change to Book if your model is named Book

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'titre' => 'Les Nuits blanches', 
                'auteur' => 'Fiodor Dostoïevski', 
                'genre' => 'Roman', 
                'statut' => 'disponible',
                'description' => 'Un récit onirique sur la solitude et les rencontres éphémères dans les rues de Saint-Pétersbourg.'
            ],
            [
                'titre' => 'La Métamorphose', 
                'auteur' => 'Franz Kafka', 
                'genre' => 'Nouvelle', 
                'statut' => 'disponible',
                'description' => 'L\'histoire absurde de Gregor Samsa, qui se réveille un matin transformé en un insecte monstrueux.'
            ],
            [
                'titre' => 'Le Procès', 
                'auteur' => 'Franz Kafka', 
                'genre' => 'Philosophie', 
                'statut' => 'disponible',
                'description' => 'Une critique terrifiante de la bureaucratie où un homme est arrêté sans savoir pourquoi.'
            ],
            [
                'titre' => 'Crime et Châtiment', 
                'auteur' => 'Fiodor Dostoïevski', 
                'genre' => 'Psychologique', 
                'statut' => 'disponible',
                'description' => 'L\'exploration psychologique d\'un étudiant qui commet un meurtre pour tester sa théorie de supériorité.'
            ],
            [
                'titre' => 'L\'Étranger', 
                'auteur' => 'Albert Camus', 
                'genre' => 'Absurde', 
                'statut' => 'disponible',
                'description' => 'Un homme indifférent au monde commet un meurtre et fait face à l\'absurdité de la justice humaine.'
            ],
            [
                'titre' => '1984', 
                'auteur' => 'George Orwell', 
                'genre' => 'Dystopie', 
                'statut' => 'disponible',
                'description' => 'Un portrait effrayant d\'une société sous surveillance totale dirigée par Big Brother.'
            ],
            [
                'titre' => 'Le Petit Prince', 
                'auteur' => 'Antoine de Saint-Exupéry', 
                'genre' => 'Conte', 
                'statut' => 'disponible',
                'description' => 'Une fable poétique et philosophique sur l\'amitié, l\'amour et la perte.'
            ],
            [
                'titre' => 'L\'Alchimiste', 
                'auteur' => 'Paulo Coelho', 
                'genre' => 'Aventure', 
                'statut' => 'disponible',
                'description' => 'Le voyage initiatique de Santiago pour trouver son trésor et accomplir sa Légende Personnelle.'
            ],
            [
                'titre' => 'Les Misérables', 
                'auteur' => 'Victor Hugo', 
                'genre' => 'Classique', 
                'statut' => 'disponible',
                'description' => 'La quête de rédemption de Jean Valjean dans la France du XIXe siècle.'
            ],
            [
                'titre' => 'Le Rouge et le Noir', 
                'auteur' => 'Stendhal', 
                'genre' => 'Réalisme', 
                'statut' => 'disponible',
                'description' => 'L\'ambition sociale de Julien Sorel à travers la religion et l\'armée.'
            ],
            [
                'titre' => 'Madame Bovary', 
                'auteur' => 'Gustave Flaubert', 
                'genre' => 'Réalisme', 
                'statut' => 'disponible',
                'description' => 'Le portrait d\'une femme qui cherche à échapper à l\'ennui de la vie provinciale par l\'adultère.'
            ],
            [
                'titre' => 'Une saison en enfer', 
                'auteur' => 'Arthur Rimbaud', 
                'genre' => 'Poésie', 
                'statut' => 'disponible',
                'description' => 'Un recueil de poésie en prose explorant les tourments de l\'âme et la révolte.'
            ],
            [
                'titre' => 'Gatsby le Magnifique', 
                'auteur' => 'F. Scott Fitzgerald', 
                'genre' => 'Drame', 
                'statut' => 'disponible',
                'description' => 'Le déclin du rêve américain à travers la figure tragique et mystérieuse de Jay Gatsby.'
            ],
            [
                'titre' => 'Cent ans de solitude', 
                'auteur' => 'Gabriel García Márquez', 
                'genre' => 'Réalisme magique', 
                'statut' => 'disponible',
                'description' => 'L\'épopée de la famille Buendía dans le village imaginaire de Macondo.'
            ],
            [
                'titre' => 'Sapiens', 
                'auteur' => 'Yuval Noah Harari', 
                'genre' => 'Histoire', 
                'statut' => 'disponible',
                'description' => 'Une brève histoire de l\'humanité, de l\'âge de pierre à la révolution technologique.'
            ],
            [
                'titre' => 'Le Joueur', 
                'auteur' => 'Fiodor Dostoïevski', 
                'genre' => 'Roman', 
                'statut' => 'disponible',
                'description' => 'Une étude fascinante sur l\'obsession du jeu et la dépendance psychologique.'
            ],
            [
                'titre' => 'Lettre à son père', 
                'auteur' => 'Franz Kafka', 
                'genre' => 'Autobiographie', 
                'statut' => 'disponible',
                'description' => 'Une lettre poignante jamais envoyée, analysant la relation complexe entre Kafka et son père.'
            ],
            [
                'titre' => 'Le Vieil Homme et la Mer', 
                'auteur' => 'Ernest Hemingway', 
                'genre' => 'Aventure', 
                'statut' => 'disponible',
                'description' => 'Le combat héroïque d\'un vieux pêcheur cubain contre un marlin géant.'
            ],
            [
                'titre' => 'Bel-Ami', 
                'auteur' => 'Guy de Maupassant', 
                'genre' => 'Réalisme', 
                'statut' => 'disponible',
                'description' => 'L\'ascension sociale d\'un journaliste séducteur et sans scrupules dans le Paris mondain.'
            ],
            [
                'titre' => 'Fahrenheit 451', 
                'auteur' => 'Ray Bradbury', 
                'genre' => 'Dystopie', 
                'statut' => 'disponible',
                'description' => 'Un futur où les livres sont interdits et brûlés par des pompiers dont c\'est la mission.'
            ],
        ];

        foreach ($books as $book) {
            Livre::create($book);
        }
    }
}