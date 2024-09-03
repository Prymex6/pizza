<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'ingredients', 'price', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_dish')
            ->withPivot('quantity') ?? [];
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_dish')
            ->withPivot('quantity');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
}
