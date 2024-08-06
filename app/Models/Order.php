<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function lunchRequest()
    {
        return $this->belongsTo(LunchRequest::class);
    }

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Food
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
