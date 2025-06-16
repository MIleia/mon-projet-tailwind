<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Entreprise extends Model
    {
        protected $table = 'entreprise';
        public $timestamps = false;
        protected $fillable = ['longitude', 'latitude', 'nom', 'pays', 'ville'];
    }
?>


