<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assignments;

class Patients extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'gender', 'diagnostic', 'coordinate', 'address', 'phone'];

    public function assignments()
    {
        return $this->hasMany(Assignments::class);
    }
}