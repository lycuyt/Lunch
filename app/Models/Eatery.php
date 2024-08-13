<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Eatery extends Model
{
    use HasFactory;
    protected $table = 'eateries';
    protected $fillable = ['id','name', 'address', 'phone'];
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    public function lunchRequests()
    {
        return $this->hasMany(LunchRequest::class);
    }
}
