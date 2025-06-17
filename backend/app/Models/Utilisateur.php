<?php

    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Utilisateur extends Authenticatable
    {
        protected $table = 'utilisateur';
        protected $primaryKey = 'mail';
        public $incrementing = false;
        public $timestamps = false;
        protected $fillable = ['mail', 'mot_de_passe', 'role'];
        // protected $hidden = ['mot_de_passe']; // <-- À supprimer ou commenter
    }
?>


