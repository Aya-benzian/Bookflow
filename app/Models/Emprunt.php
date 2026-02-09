<?php
  namespace App\Models;
     
     use Illuminate\Database\Eloquent\Factories\HasFactory;
     use Illuminate\Database\Eloquent\Model;
   
    class Emprunt extends Model
     {
      use HasFactory;
   
        protected $table = 'emprunts';
  
      protected $fillable = [
          'user_id',
            'livre_id',
                       'date_emprunt',
                       'date_retour_prevue',       ];

        protected $casts = [
            'date_emprunt' => 'datetime',
            'date_retour_prevue' => 'datetime',
        ];

     
         // Define relationships
         public function user()
        {
             return $this->belongsTo(User::class);
         }
   
         public function livre()
         {
             return $this->belongsTo(Livre::class);
       }
    }
