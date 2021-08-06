<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_user_id', 'receiver_user_id',
    ];

     // Conversation and Message Relationship
     public function message(){
        return $this->hasMany(Message::class);
    }
}
