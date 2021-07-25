<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'prod_name',
        'prod_qty', 'qty_type', 'date_produced',
        'date_expiree', 'status', 'category',
        'views', 'preferred_prod', 'user_id',
        'est_price'
    ];
}
