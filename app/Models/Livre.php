<?php
     namespace App\Models;
     
      use Illuminate\Database\Eloquent\Factories\HasFactory;
     use Illuminate\Database\Eloquent\Model;
     
    class Livre extends Model
      {
         use HasFactory;
   
        protected $table = 'livres';
    
        protected $fillable = [
            'titre',
          'auteur',
            'genre',
          'description',
             'statut',
       ];
   
         // Define relationships
         public function emprunts()
     {
            return $this->hasMany(Emprunt::class);
        }
    
       public function reservations()
        {
            return $this->hasMany(Reservation::class);
        }
    }