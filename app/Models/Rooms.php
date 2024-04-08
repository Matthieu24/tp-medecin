<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assignments;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'type', 'status'];

    public function assignments()
    {
        return $this->hasMany(Assignments::class);
    }
}