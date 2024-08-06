<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'eatery_id'];
    protected $table = 'foods';
    protected $primaryKey = 'id';
    public function eatery()
    {
        return $this->belongsTo(Eatery::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
