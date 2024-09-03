<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_token'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'cart_dish')
            ->withPivot('quantity');
    }
}
