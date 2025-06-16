<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    protected $table = 'postes';
    public $timestamps = false; // si tu n'as pas de colonnes created_at/updated_at
    protected $fillable = ['titre', 'descriptif', 'localisation'];
}
?>


