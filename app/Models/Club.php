<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

     // Beziehung für Heimspiele
     public function homeGames()
     {
         return $this->hasMany(Game::class, 'home_club_id');
     }

     // Beziehung für Auswärtsspiele
     public function awayGames()
     {
         return $this->hasMany(Game::class, 'away_club_id');
     }
}
