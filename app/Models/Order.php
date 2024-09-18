<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'telephone', 'email', 'city', 'time', 'realization', 'street', 'house_number', 'zip_code', 'apartment_number', 'fllor', 'payment', 'note', 'status_id', 'hour', 'status_paid', 'user_id'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'order_dish')
            ->withPivot('quantity', 'size', 'price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($date): string
    {
        $date = Carbon::parse($date);
        $currentYear = Carbon::now()->year;

        if ($date->year === $currentYear) {
            return $date->format('m-d H:i');
        }

        return $date->format('Y-m-d H:i');
    }
}
