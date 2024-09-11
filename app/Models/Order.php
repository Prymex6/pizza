<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'telephone', 'email', 'city', 'time', 'realization', 'street', 'house_number', 'zip_code', 'apartment_number', 'fllor', 'payment', 'note', 'status_id', 'hour', 'status_paid'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'order_dish')
            ->withPivot('quantity', 'size', 'price');
    }
}
