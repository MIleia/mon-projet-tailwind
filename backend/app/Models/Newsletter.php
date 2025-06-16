<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Newsletter extends Model
    {
        protected $table = 'newsletter';
        protected $primaryKey = 'mail';
        public $incrementing = false;
        public $timestamps = false;
        protected $fillable = ['mail', 'nom', 'prenom'];
    }
?>


