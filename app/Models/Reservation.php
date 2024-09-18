<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'telephone', 'email', 'persons', 'date_time', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
