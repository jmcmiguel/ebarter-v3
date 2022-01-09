<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

<<<<<<< HEAD
     /**
=======
    /**
>>>>>>> feature/mods
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'promoted_to', 'promoted_by',
=======
        'user_id', 'promoted_to', 'promoted_by',
>>>>>>> feature/mods
    ];
}
