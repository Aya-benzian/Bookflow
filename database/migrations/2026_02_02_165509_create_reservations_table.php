<?php
    
    use Illuminate\Database\Migrations\Migration;
      use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;
    
      return new class extends Migration
    {
        
       public function up(): void
        {
          Schema::create('reservations', function (Blueprint $table) {
              $table->id();
    
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('livre_id')->constrained('livres')->onDelete('cascade');
                $table->timestamp('date_reservation')->useCurrent();
                $table->timestamps();
             });
        }
   
         
       public function down(): void
       {
            Schema::dropIfExists('reservations');
       }
     };