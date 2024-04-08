<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assignments;

class Doctors extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'speciality', 'coordinate', 'phone'];

    public function assignments()
    {
        return $this->hasMany(Assignments::class);
    }
}