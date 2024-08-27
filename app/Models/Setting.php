<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'key', 'value'];

    public static function getSettings()
    {
        return Setting::all()->map(function ($setting) {
            $skey = explode('_', $setting['key']);
            $endkey = end($skey);
            return [
                $endkey => $setting['value'],
            ];
        });
    }
}
