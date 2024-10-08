<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchRequest extends Model
{
    use HasFactory;
    protected $table = 'lunch_requests';
    protected $fillable = ['id', 'user_id', 'eatery_id', 'date', 'admin_id', 'status', 'note'];
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Quan hệ với Restaurant
    public function eatery()
    {
        return $this->belongsTo(Eatery::class);
    }

    // Quan hệ với Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
