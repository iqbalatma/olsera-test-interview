<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'rate'];

    public function getRateAttribute($value)
    {
        $rate = round($value * 10, 2);

        return $rate . "%";
    }

    public function item()
    {
        return $this->belongsToMany(Item::class);
    }
}
